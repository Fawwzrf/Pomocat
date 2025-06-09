// File: resources/js/pomodoro/tasks.js

export function initTasks(elements, headers, isGuest) {
    const { taskListContainer, addTaskBtn, addTaskModal, addTaskForm, addTaskCancelBtn, taskTitleInput, quantityInput, notesTextarea, clearFinishedTasksBtn, clearAllTasksBtn } = elements;
    const { baseHeaders, jsonHeaders } = headers;
    const modalTitle = document.getElementById('add-task-modal-title');
    const taskIdInput = document.getElementById('task-id-input');
    const modalDeleteBtn = document.getElementById('modal-delete-btn');

    let tasks = [];
    let activeTaskId = null;

    // --- STRATEGI PENYIMPANAN ---

    const storage = {
        // Strategi untuk pengguna yang login (menggunakan API)
        api: {
            fetch: async () => {
                try {
                    const response = await fetch('/tasks/render', { headers: baseHeaders, credentials: 'same-origin' });
                    if (!response.ok) throw new Error('Gagal memuat daftar tugas');
                    taskListContainer.innerHTML = await response.text();
                    initFlowbite();
                } catch (error) { console.error('Gagal me-refresh daftar tugas:', error); }
            },
            setActive: async (taskId) => {
                sessionStorage.setItem('active_task_id', taskId);
                await handleApiAction(`/tasks/${taskId}/set-active`, { method: 'POST' });
                await storage.api.fetch();
            },
            add: async (taskData) => {
                const success = await handleApiAction('/tasks', { method: 'POST', body: JSON.stringify(taskData) });
                if (success) { closeAddTaskModal(); await storage.api.fetch(); }
            },
            update: async (taskId, taskData) => {
                const success = await handleApiAction(`/tasks/${taskId}`, { method: 'PUT', body: JSON.stringify(taskData) });
                if (success) { closeAddTaskModal(); await storage.api.fetch(); }
            },
            toggle: async (taskId, isCompleted) => {
                await handleApiAction(`/tasks/${taskId}`, { method: 'PUT', body: JSON.stringify({ completed: isCompleted }) });
                await storage.api.fetch();
            },
            delete: async (taskId) => {
                if (confirm('Apakah Anda yakin ingin menghapus tugas ini?')) {
                    const success = await handleApiAction(`/tasks/${taskId}`, { method: 'DELETE' });
                    if (success) { closeAddTaskModal(); await storage.api.fetch(); }
                }
            },
            completeSession: async () => {
                const currentActiveId = sessionStorage.getItem('active_task_id');
                if (!currentActiveId) return;
                await handleApiAction(`/tasks/${currentActiveId}/complete-session`, { method: 'PUT' });
                await storage.api.fetch();
            },
            clearCompleted: async () => { if (confirm('Hapus semua tugas yang sudah selesai?')) { const success = await handleApiAction('/tasks/clear/completed', { method: 'DELETE' }); if (success) await storage.api.fetch(); } },
            clearAll: async () => { if (confirm('HAPUS SEMUA TUGAS? Aksi ini tidak dapat dibatalkan.')) { const success = await handleApiAction('/tasks/clear/all', { method: 'DELETE' }); if (success) await storage.api.fetch(); } }
        },
        // Strategi untuk pengguna tamu (menggunakan localStorage)
        local: {
            fetch: () => {
                tasks = JSON.parse(localStorage.getItem('tasks_guest')) || [];
                activeTaskId = parseInt(localStorage.getItem('activeTaskId_guest'), 10) || null;
                renderTasks();
            },
            setActive: (taskId) => {
                activeTaskId = taskId;
                localStorage.setItem('activeTaskId_guest', taskId);
                renderTasks();
                document.dispatchEvent(new CustomEvent('activeTaskChanged', { detail: activeTaskId }));
            },
            add: (taskData) => {
                const newTask = { id: Date.now(), ...taskData, sessions_completed: 0, completed: false };
                tasks.push(newTask);
                saveTasksToStorage();
                renderTasks();
                closeAddTaskModal();
            },
            update: (taskId, taskData) => {
                const taskIndex = tasks.findIndex(t => t.id === taskId);
                if (taskIndex > -1) { tasks[taskIndex] = { ...tasks[taskIndex], ...taskData }; }
                saveTasksToStorage();
                renderTasks();
                closeAddTaskModal();
            },
            toggle: (taskId, isCompleted) => {
                const taskIndex = tasks.findIndex(t => t.id === taskId);
                if (taskIndex > -1) { tasks[taskIndex].completed = isCompleted; }
                saveTasksToStorage();
                renderTasks();
            },
            delete: (taskId) => {
                if (confirm('Apakah Anda yakin ingin menghapus tugas ini?')) {
                    tasks = tasks.filter(t => t.id !== taskId);
                    if (activeTaskId === taskId) {
                        const firstUncompleted = tasks.find(t => !t.completed);
                        activeTaskId = firstUncompleted ? firstUncompleted.id : null;
                        localStorage.setItem('activeTaskId_guest', activeTaskId);
                    }
                    saveTasksToStorage();
                    renderTasks();
                    closeAddTaskModal();
                }
            },
            completeSession: () => {
                if (!activeTaskId) return;
                const taskIndex = tasks.findIndex(t => t.id === activeTaskId);
                if (taskIndex > -1) {
                    tasks[taskIndex].sessions_completed++;
                    if (tasks[taskIndex].sessions_completed >= tasks[taskIndex].sessions_needed) {
                        tasks[taskIndex].completed = true;
                        // Logika auto-switch untuk local storage
                        const nextTask = tasks.find((t, index) => index > taskIndex && !t.completed);
                        storage.local.setActive(nextTask ? nextTask.id : null);
                    }
                    saveTasksToStorage();
                    renderTasks();
                }
            },
            clearCompleted: () => { if (confirm('Hapus semua tugas yang sudah selesai?')) { tasks = tasks.filter(t => !t.completed); saveTasksToStorage(); renderTasks(); } },
            clearAll: () => { if (confirm('HAPUS SEMUA TUGAS? Aksi ini tidak dapat dibatalkan.')) { tasks = []; activeTaskId = null; localStorage.removeItem('tasks_guest'); localStorage.removeItem('activeTaskId_guest'); renderTasks(); } },
        }
    };

    // Pilih strategi berdasarkan status login
    const dataHandler = isGuest ? storage.local : storage.api;

    // --- Fungsi Pembantu (Shared) ---
    function openAddTaskModal() { addTaskForm.reset(); taskIdInput.value = ''; quantityInput.value = 1; modalDeleteBtn.classList.add('hidden'); if (modalTitle) modalTitle.textContent = 'Tambah Tugas Baru'; addTaskModal.classList.remove('hidden'); taskTitleInput.focus(); }
    function closeAddTaskModal() { addTaskModal.classList.add('hidden'); }
    function renderTasks() { taskListContainer.innerHTML = ''; if (tasks.length === 0) { taskListContainer.innerHTML = `<p class="text-center text-yellow-100/50">Belum ada tugas.</p>`; return; } tasks.forEach(task => { const isTaskActive = (task.id === activeTaskId && !task.completed); const taskEl = document.createElement('div'); taskEl.className = `task-item group p-3 rounded-lg border-b-2 border-yellow-400/30 flex items-start gap-x-4 transition-colors ${task.completed ? 'opacity-60' : ''} ${isTaskActive ? 'bg-yellow-400/20' : ''}`; taskEl.dataset.id = task.id; const noteHtml = task.notes ? `<p class="text-xs text-yellow-200/80 mt-1 font-light">${task.notes}</p>` : ''; taskEl.innerHTML = `<div class="flex-none pt-1"> <input type="checkbox" class="task-checkbox h-5 w-5 rounded-full bg-transparent border-2 border-indigo-950 text-indigo-950 focus:ring-0 cursor-pointer" data-id="${task.id}" ${task.completed ? 'checked' : ''}> </div> <div class="flex-grow cursor-pointer" data-action="set-active"> <span class="font-medium text-yellow-50 ${task.completed ? 'line-through' : ''}">${task.title}</span> ${noteHtml} </div> <div class="flex-none flex items-center gap-x-3 pl-2"> <span class="font-semibold text-yellow-50">${task.sessions_completed}</span><span class="text-yellow-200/80">/</span><span class="text-yellow-200/80">${task.sessions_needed}</span> <button data-dropdown-toggle="task-options-${task.id}" class="p-1 rounded-md opacity-0 group-hover:opacity-100 transition-opacity hover:bg-yellow-400/50"> <svg class="w-5 h-5 text-yellow-200" fill="currentColor" viewBox="0 0 16 16"><path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/></svg> </button> <div id="task-options-${task.id}" class="z-50 hidden bg-yellow-100 divide-y divide-gray-100 rounded-lg shadow w-32"> <ul class="py-1 text-sm text-indigo-900"> <li><a href="#" class="task-edit-btn block px-4 py-2 hover:bg-yellow-200" data-id="${task.id}">Edit</a></li> </ul> </div> </div>`; taskListContainer.appendChild(taskEl); }); if (!isGuest) initFlowbite(); }
    function saveTasksToStorage() { localStorage.setItem('tasks_guest', JSON.stringify(tasks)); }
    async function handleApiAction(url, options = {}) { try { const fetchOptions = { ...options, headers: options.body ? jsonHeaders : baseHeaders, credentials: 'same-origin' }; const response = await fetch(url, fetchOptions); if (!response.ok) { if (response.status === 419) { alert('Sesi Anda telah kedaluwarsa. Silakan refresh halaman.'); } const errorData = await response.json(); throw new Error(errorData.message || 'Aksi gagal'); } return true; } catch (error) { console.error('API Action Error:', error); if (!error.message.includes('JSON')) { alert('Error: ' + error.message); } return false; } }

    // --- Event Listeners ---
    addTaskBtn.addEventListener('click', openAddTaskModal);
    addTaskCancelBtn.addEventListener('click', closeAddTaskModal);
    addTaskForm.addEventListener('submit', (e) => { e.preventDefault(); const taskId = parseInt(taskIdInput.value, 10); const taskData = { title: taskTitleInput.value, notes: notesTextarea.value, sessions_needed: parseInt(quantityInput.value, 10) }; if (taskId) { dataHandler.update(taskId, taskData); } else { dataHandler.add(taskData); } });

    document.addEventListener('click', (e) => {
        const target = e.target;
        if (target.matches('.task-edit-btn')) { e.preventDefault(); const taskId = parseInt(target.dataset.id, 10); const taskToEdit = tasks.find(t => t.id === taskId); if (taskToEdit) openEditTaskModal(taskToEdit); }
        const taskItem = target.closest('.task-item');
        if (taskItem) {
            const id = parseInt(taskItem.dataset.id, 10);
            if (target.matches('.task-checkbox')) { dataHandler.toggle(id, target.checked); }
            else if (target.closest('[data-action="set-active"]')) { dataHandler.setActive(id); }
        }
        if (target.id === 'modal-delete-btn') { const taskId = parseInt(taskIdInput.value, 10); if (taskId) dataHandler.delete(taskId); }
    });

    if (clearFinishedTasksBtn) { clearFinishedTasksBtn.addEventListener('click', (e) => { e.preventDefault(); dataHandler.clearCompleted(); }); }
    if (clearAllTasksBtn) { clearAllTasksBtn.addEventListener('click', (e) => { e.preventDefault(); dataHandler.clearAll(); }); }

    // Inisialisasi awal
    dataHandler.fetch();

    return { handleCompleteSession: dataHandler.completeSession };
}