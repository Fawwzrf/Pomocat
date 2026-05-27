// File: resources/js/pomodoro/tasks.js (Final dan Lengkap)

export function initTasks(elements, headers, initialSettings, isGuest) {
    const { taskListContainer, addTaskBtn, addTaskModal, addTaskForm, addTaskCancelBtn, taskTitleInput, quantityInput, notesTextarea, clearFinishedTasksBtn, clearAllTasksBtn } = elements;
    const { baseHeaders, jsonHeaders } = headers;
    const modalTitle = document.getElementById('add-task-modal-title');
    const taskIdInput = document.getElementById('task-id-input');
    const modalDeleteBtn = document.getElementById('modal-delete-btn');

    let tasks = [];
    let activeTaskId = null; // Dikelola oleh JS
    let settings = initialSettings;

    // Dengarkan perubahan settings (penting untuk mode tamu)
    document.addEventListener('settingsUpdated', (e) => { settings = e.detail; });

    // --- STRATEGI PENYIMPANAN DATA ---
    const storage = {
        api: {
            fetch: async () => {
                try {
                    const response = await fetch('/tasks/render', { headers: baseHeaders, credentials: 'same-origin' });
                    if (!response.ok) throw new Error('Gagal memuat tugas');
                    taskListContainer.innerHTML = await response.text();
                    // Sinkronisasi activeTaskId dari sessionStorage untuk persistensi
                    activeTaskId = parseInt(sessionStorage.getItem('active_task_id'), 10) || null;
                    renderHighlights();
                    initFlowbite();
                } catch (error) { console.error('Gagal me-refresh daftar tugas:', error); taskListContainer.innerHTML = `<p class="text-center text-red-400">Gagal memuat tugas.</p>`; }
            },
            setActive: (id) => {
                activeTaskId = id;
                if (id) { sessionStorage.setItem('active_task_id', id); }
                else { sessionStorage.removeItem('active_task_id'); }
                renderHighlights(); // Cukup perbarui highlight di frontend
                document.dispatchEvent(new CustomEvent('activeTaskChanged', { detail: activeTaskId }));
            },
            add: async (data) => { if (await handleApiAction('/tasks', { method: 'POST', body: JSON.stringify(data) })) { closeAddTaskModal(); await storage.api.fetch(); } },
            update: async (id, data) => { if (await handleApiAction(`/tasks/${id}`, { method: 'PUT', body: JSON.stringify(data) })) { closeAddTaskModal(); await storage.api.fetch(); } },
            toggle: async (id, completed) => { if (await handleApiAction(`/tasks/${id}`, { method: 'PUT', body: JSON.stringify({ completed }) })) await storage.api.fetch(); },
            delete: async (id) => { if (confirm('Hapus tugas ini?')) { if (await handleApiAction(`/tasks/${id}`, { method: 'DELETE' })) { closeAddTaskModal(); await storage.api.fetch(); } } },
            completeSession: async () => {
                const id = sessionStorage.getItem('active_task_id');
                if (!id) return;
                const res = await handleApiAction(`/tasks/${id}/complete-session`, { method: 'PUT' });
                if (res) {
                    const updatedTask = await res.json();
                    if (updatedTask.completed && settings.autoSwitchTasks) {
                        try {
                            const tasksRes = await fetch('/tasks', { headers: baseHeaders, credentials: 'same-origin' });
                            if (tasksRes.ok) {
                                const allTasks = await tasksRes.json();
                                const idx = allTasks.findIndex(t => t.id == id);
                                if (idx > -1) {
                                    const next = allTasks.find((t, index) => index > idx && !t.completed);
                                    storage.api.setActive(next ? next.id : null);
                                }
                            }
                        } catch (err) {
                            console.error('Gagal mengambil daftar tugas untuk auto-switch:', err);
                        }
                    }
                    await storage.api.fetch();
                }
            },
            clearCompleted: async () => { if (confirm('Hapus semua tugas yang sudah selesai?')) { if (await handleApiAction('/tasks/clear/completed', { method: 'DELETE' })) await storage.api.fetch(); } },
            clearAll: async () => { if (confirm('HAPUS SEMUA TUGAS?')) { if (await handleApiAction('/tasks/clear/all', { method: 'DELETE' })) await storage.api.fetch(); } }
        },
        local: {
            fetch: () => { tasks = JSON.parse(localStorage.getItem('tasks_guest')) || []; activeTaskId = parseInt(localStorage.getItem('activeTaskId_guest'), 10) || null; if (!tasks.find(t => t.id === activeTaskId)) activeTaskId = tasks.find(t => !t.completed)?.id || null; renderTasks(); },
            setActive: (id) => { activeTaskId = id; localStorage.setItem('activeTaskId_guest', id); renderTasks(); document.dispatchEvent(new CustomEvent('activeTaskChanged', { detail: activeTaskId })); },
            add: (data) => { const newTask = { id: Date.now(), ...data, sessions_completed: 0, completed: false }; tasks.push(newTask); if (!activeTaskId) storage.local.setActive(newTask.id); saveTasksToStorage(); renderTasks(); closeAddTaskModal(); },
            update: (id, data) => { const i = tasks.findIndex(t => t.id === id); if (i > -1) { tasks[i] = { ...tasks[i], ...data }; } saveTasksToStorage(); renderTasks(); closeAddTaskModal(); },
            toggle: (id, completed) => { const i = tasks.findIndex(t => t.id === id); if (i > -1) { tasks[i].completed = completed; } saveTasksToStorage(); renderTasks(); },
            delete: (id) => { if (confirm('Hapus tugas ini?')) { tasks = tasks.filter(t => t.id !== id); if (activeTaskId === id) { const first = tasks.find(t => !t.completed); storage.local.setActive(first ? first.id : null); } saveTasksToStorage(); renderTasks(); closeAddTaskModal(); } },
            completeSession: () => { if (!activeTaskId) return; const i = tasks.findIndex(t => t.id === activeTaskId); if (i > -1) { tasks[i].sessions_completed++; if (tasks[i].sessions_completed >= tasks[i].sessions_needed) { tasks[i].completed = true; if (settings.autoSwitchTasks) { const next = tasks.find((t, index) => index > i && !t.completed); storage.local.setActive(next ? next.id : null); } } saveTasksToStorage(); renderTasks(); } },
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
    function renderTasks() { taskListContainer.innerHTML = ''; if (tasks.length === 0) { taskListContainer.innerHTML = `<p class="text-center text-yellow-100/50">Belum ada tugas.</p>`; return; } tasks.sort((a, b) => a.completed - b.completed).forEach(task => { const isTaskActive = (task.id === activeTaskId && !task.completed); const taskEl = document.createElement('div'); taskEl.className = `task-item group p-3 rounded-lg border-b-2 border-yellow-400/30 flex items-start gap-x-4 transition-colors ${task.completed ? 'opacity-60' : ''} ${isTaskActive ? 'bg-yellow-400/20' : ''}`; taskEl.dataset.id = task.id; const noteHtml = task.notes ? `<p class="text-xs text-yellow-200/80 mt-1 font-light">${task.notes}</p>` : ''; taskEl.innerHTML = `<div class="flex-none pt-1"><input type="checkbox" class="task-checkbox h-5 w-5 rounded-full bg-transparent border-2 border-indigo-950 text-indigo-950 focus:ring-0 cursor-pointer" data-id="${task.id}" ${task.completed ? 'checked' : ''}></div><div class="flex-grow cursor-pointer" data-action="edit"><span class="font-medium text-yellow-50 ${task.completed ? 'line-through' : ''}">${task.title}</span>${noteHtml}</div><div class="flex-none flex items-center gap-x-3 pl-2 text-yellow-50"><span class="font-semibold">${task.sessions_completed}</span><span class="opacity-80">/</span><span class="opacity-80">${task.sessions_needed}</span><button type="button" class="edit-task-trigger-btn p-1 rounded-md opacity-0 group-hover:opacity-100 transition-opacity hover:bg-yellow-400/50" data-id="${task.id}"><svg class="w-5 h-5 text-yellow-200 pointer-events-none" fill="currentColor" viewBox="0 0 16 16"><path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/></svg></button></div>`; taskListContainer.appendChild(taskEl); }); }

    // --- Event Listeners ---
    addTaskBtn.addEventListener('click', openAddTaskModal);
    addTaskCancelBtn.addEventListener('click', closeAddTaskModal);
    modalDeleteBtn.addEventListener('click', () => { const taskId = parseInt(taskIdInput.value, 10); if (taskId) dataHandler.delete(taskId); });
    addTaskForm.addEventListener('submit', (e) => { e.preventDefault(); const taskId = parseInt(taskIdInput.value, 10); const taskData = { title: taskTitleInput.value, notes: notesTextarea.value, sessions_needed: parseInt(quantityInput.value, 10) }; if (taskId) { dataHandler.update(taskId, taskData); } else { dataHandler.add(taskData); } });
    if (clearFinishedTasksBtn) { clearFinishedTasksBtn.addEventListener('click', (e) => { e.preventDefault(); dataHandler.clearCompleted(); }); }
    if (clearAllTasksBtn) { clearAllTasksBtn.addEventListener('click', (e) => { e.preventDefault(); dataHandler.clearAll(); }); }

    document.addEventListener('click', async (e) => {
        const target = e.target;
        const editBtn = target.closest('.edit-task-trigger-btn') || target.closest('.task-edit-btn');
        if (editBtn) {
            e.preventDefault();
            const taskId = editBtn.dataset.id;
            if (isGuest) { const taskToEdit = tasks.find(t => t.id == taskId); if (taskToEdit) openEditTaskModal(taskToEdit); }
            else { const response = await handleApiAction(`/tasks/${taskId}`, { method: 'GET' }); if (response) { const task = await response.json(); openEditTaskModal(task); } }
        }
        const taskItem = target.closest('.task-item');
        if (taskItem) {
            if (target.matches('.task-checkbox')) {
                const id = parseInt(taskItem.dataset.id, 10);
                dataHandler.toggle(id, target.checked);
            } else if (
                !target.closest('.edit-task-trigger-btn') &&
                !target.closest('.task-edit-btn') &&
                !target.closest('[data-dropdown-toggle]') &&
                !target.closest('[id^="task-options-"]')
            ) {
                const id = parseInt(taskItem.dataset.id, 10);
                dataHandler.setActive(id);
            }
        }
    });

    dataHandler.fetch();
    return { handleCompleteSession: dataHandler.completeSession };
}