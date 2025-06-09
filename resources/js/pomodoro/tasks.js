// File: resources/js/pomodoro/tasks.js (Versi Final dengan Path yang Benar)

export function initTasks(elements, headers, initialSettings, isGuest) {
    const { taskListContainer, addTaskBtn, addTaskModal, addTaskForm, addTaskCancelBtn, taskTitleInput, quantityInput, notesTextarea, clearFinishedTasksBtn, clearAllTasksBtn } = elements;
    const { baseHeaders, jsonHeaders } = headers;
    const modalTitle = document.getElementById('add-task-modal-title');
    const taskIdInput = document.getElementById('task-id-input');
    const modalDeleteBtn = document.getElementById('modal-delete-btn');

    let tasks = [];
    let activeTaskId = isGuest ? (parseInt(localStorage.getItem('activeTaskId_guest'), 10) || null) : (parseInt(sessionStorage.getItem('active_task_id'), 10) || null);
    let settings = initialSettings;

    document.addEventListener('settingsUpdated', (e) => { settings = e.detail; });

    // --- STRATEGI PENYIMPANAN ---
    const storage = {
        api: {
            fetch: async () => { try { const response = await fetch('/tasks/render', { headers: baseHeaders, credentials: 'same-origin' }); if (!response.ok) throw new Error('Gagal memuat daftar tugas'); const html = await response.text(); taskListContainer.innerHTML = html; tasks = Array.from(taskListContainer.querySelectorAll('.task-item')).map(item => ({ id: parseInt(item.dataset.id) })); renderHighlights(); initFlowbite(); } catch (error) { console.error('Gagal me-refresh daftar tugas:', error); taskListContainer.innerHTML = `<p class="text-center text-red-400">Gagal memuat tugas. Silakan refresh.</p>`; } },
            setActive: (id) => { activeTaskId = id; if (id) sessionStorage.setItem('active_task_id', id); else sessionStorage.removeItem('active_task_id'); renderHighlights(); },
            add: async (data) => { if (await handleApiAction('/tasks', { method: 'POST', body: JSON.stringify(data) })) { closeAddTaskModal(); await storage.api.fetch(); } },
            update: async (id, data) => { if (await handleApiAction(`/tasks/${id}`, { method: 'PUT', body: JSON.stringify(data) })) { closeAddTaskModal(); await storage.api.fetch(); } },
            toggle: async (id, completed) => { if (await handleApiAction(`/tasks/${id}`, { method: 'PUT', body: JSON.stringify({ completed }) })) await storage.api.fetch(); },
            delete: async (id) => { if (confirm('Hapus tugas ini?')) { if (await handleApiAction(`/tasks/${id}`, { method: 'DELETE' })) { closeAddTaskModal(); await storage.api.fetch(); } } },
            completeSession: async () => { if (!activeTaskId) return; const res = await handleApiAction(`/tasks/${activeTaskId}/complete-session`, { method: 'PUT' }); if (res) { const updatedTask = await res.json(); if (updatedTask.completed && settings.autoSwitchTasks) { const response = await fetch('/tasks', { headers: baseHeaders }); const currentTasks = await response.json(); const currentIndex = currentTasks.findIndex(t => t.id === updatedTask.id); const nextTask = currentTasks.find((t, index) => index > currentIndex && !t.completed); storage.api.setActive(nextTask ? nextTask.id : null); } await storage.api.fetch(); } },
            clearCompleted: async () => { if (confirm('Hapus semua tugas yang sudah selesai?')) { if (await handleApiAction('/tasks/clear/completed', { method: 'DELETE' })) await storage.api.fetch(); } },
            clearAll: async () => { if (confirm('HAPUS SEMUA TUGAS?')) { if (await handleApiAction('/tasks/clear/all', { method: 'DELETE' })) await storage.api.fetch(); } }
        },
        local: {
            fetch: () => { tasks = JSON.parse(localStorage.getItem('tasks_guest')) || []; activeTaskId = parseInt(localStorage.getItem('activeTaskId_guest'), 10) || null; renderTasks(); },
            setActive: (id) => { activeTaskId = id; localStorage.setItem('activeTaskId_guest', id); renderTasks(); document.dispatchEvent(new CustomEvent('activeTaskChanged', { detail: activeTaskId })); },
            add: (data) => { const newTask = { id: Date.now(), ...data, sessions_completed: 0, completed: false }; tasks.push(newTask); saveTasksToStorage(); renderTasks(); closeAddTaskModal(); },
            update: (id, data) => { const i = tasks.findIndex(t => t.id === id); if (i > -1) { tasks[i] = { ...tasks[i], ...data }; } saveTasksToStorage(); renderTasks(); closeAddTaskModal(); },
            toggle: (id, completed) => { const i = tasks.findIndex(t => t.id === id); if (i > -1) { tasks[i].completed = completed; } saveTasksToStorage(); renderTasks(); },
            delete: (id) => { if (confirm('Hapus tugas ini?')) { tasks = tasks.filter(t => t.id !== id); if (activeTaskId === id) { const first = tasks.find(t => !t.completed); storage.local.setActive(first ? first.id : null); } saveTasksToStorage(); renderTasks(); closeAddTaskModal(); } },
            completeSession: () => { if (!activeTaskId) return; const i = tasks.findIndex(t => t.id === activeTaskId); if (i > -1) { tasks[i].sessions_completed++; if (tasks[i].sessions_completed >= tasks[i].sessions_needed) { tasks[i].completed = true; const next = tasks.find((t, index) => index > i && !t.completed); storage.local.setActive(next ? next.id : null); } saveTasksToStorage(); renderTasks(); } },
            clearCompleted: () => { if (confirm('Hapus semua tugas yang sudah selesai?')) { tasks = tasks.filter(t => !t.completed); saveTasksToStorage(); renderTasks(); } },
            clearAll: () => { if (confirm('HAPUS SEMUA TUGAS?')) { tasks = []; activeTaskId = null; localStorage.removeItem('tasks_guest'); localStorage.removeItem('activeTaskId_guest'); renderTasks(); } },
        }
    };

    const dataHandler = isGuest ? storage.local : storage.api;

    function openAddTaskModal() { addTaskForm.reset(); taskIdInput.value = ''; quantityInput.value = 1; modalDeleteBtn.classList.add('hidden'); if (modalTitle) modalTitle.textContent = 'Tambah Tugas Baru'; addTaskModal.classList.remove('hidden'); taskTitleInput.focus(); }
    function openEditTaskModal(task) { taskIdInput.value = task.id; taskTitleInput.value = task.title; quantityInput.value = task.sessions_needed; notesTextarea.value = task.notes || ''; modalDeleteBtn.classList.remove('hidden'); if (modalTitle) modalTitle.textContent = 'Edit Tugas'; addTaskModal.classList.remove('hidden'); taskTitleInput.focus(); }
    function closeAddTaskModal() { addTaskModal.classList.add('hidden'); }
    function saveTasksToStorage() { localStorage.setItem('tasks_guest', JSON.stringify(tasks)); }
    function renderHighlights() { document.querySelectorAll('.task-item').forEach(el => { el.classList.remove('bg-yellow-400/20'); if (parseInt(el.dataset.id) === activeTaskId) { el.classList.add('bg-yellow-400/20'); } }); }

    async function handleApiAction(url, options = {}) { try { const fetchOptions = { ...options, headers: options.body ? jsonHeaders : baseHeaders, credentials: 'same-origin' }; const response = await fetch(url, fetchOptions); if (!response.ok) { if (response.status === 419) { alert('Sesi Anda telah kedaluwarsa. Silakan refresh halaman.'); } const errorData = await response.json(); throw new Error(errorData.message || 'Aksi gagal'); } return response; } catch (error) { console.error('API Action Error:', error); if (!error.message.includes('JSON')) { alert('Error: ' + error.message); } return null; } }

    function renderTasks() { taskListContainer.innerHTML = ''; if (tasks.length === 0) { taskListContainer.innerHTML = `<p class="text-center text-yellow-100/50">Belum ada tugas.</p>`; return; } tasks.forEach(task => { const isTaskActive = (task.id === activeTaskId && !task.completed); const taskEl = document.createElement('div'); taskEl.className = `task-item group p-3 rounded-lg border-b-2 border-yellow-400/30 flex items-start gap-x-4 transition-colors ${task.completed ? 'opacity-60' : ''} ${isTaskActive ? 'bg-yellow-400/20' : ''}`; taskEl.dataset.id = task.id; const noteHtml = task.notes ? `<p class="text-xs text-yellow-200/80 mt-1 font-light">${task.notes}</p>` : ''; taskEl.innerHTML = `<div class="flex-none pt-1"><input type="checkbox" class="task-checkbox h-5 w-5 rounded-full bg-transparent border-2 border-indigo-950 text-indigo-950 focus:ring-0 cursor-pointer" data-id="${task.id}" ${task.completed ? 'checked' : ''}></div><div class="flex-grow cursor-pointer" data-action="edit"><span class="font-medium text-yellow-50 ${task.completed ? 'line-through' : ''}">${task.title}</span>${noteHtml}</div><div class="flex-none flex items-center gap-x-3 pl-2 text-yellow-50"><span class="font-semibold">${task.sessions_completed}</span><span class="opacity-80">/</span><span class="opacity-80">${task.sessions_needed}</span></div>`; taskListContainer.appendChild(taskEl); }); }

    // --- Event Listeners ---
    addTaskBtn.addEventListener('click', openAddTaskModal);
    addTaskCancelBtn.addEventListener('click', closeAddTaskModal);
    modalDeleteBtn.addEventListener('click', () => { const taskId = parseInt(taskIdInput.value, 10); if (taskId) dataHandler.delete(taskId); });
    addTaskForm.addEventListener('submit', (e) => { e.preventDefault(); const taskId = parseInt(taskIdInput.value, 10); const taskData = { title: taskTitleInput.value, notes: notesTextarea.value, sessions_needed: parseInt(quantityInput.value, 10) }; if (taskId) { dataHandler.update(taskId, taskData); } else { dataHandler.add(taskData); } });
    if (clearFinishedTasksBtn) { clearFinishedTasksBtn.addEventListener('click', (e) => { e.preventDefault(); dataHandler.clearCompleted(); }); }
    if (clearAllTasksBtn) { clearAllTasksBtn.addEventListener('click', (e) => { e.preventDefault(); dataHandler.clearAll(); }); }

    document.addEventListener('click', async (e) => {
        const target = e.target;
        const taskItem = target.closest('.task-item');
        if (target.matches('.task-edit-btn')) { e.preventDefault(); const taskId = target.dataset.id; const response = await handleApiAction(`/tasks/${taskId}`, { method: 'GET' }); if (response) { const task = await response.json(); openEditTaskModal(task); } }
        else if (taskItem) {
            const id = parseInt(taskItem.dataset.id, 10);
            if (target.matches('.task-checkbox')) { dataHandler.toggle(id, target.checked); }
            else { dataHandler.setActive(id); } // Klik di area lain akan set active
        }
    });

    dataHandler.fetch();
    return { handleCompleteSession: dataHandler.completeSession };
}