// File: resources/js/pomodoro/tasks.js (Versi Final)

export function initTasks(elements, headers, initialSettings) {
    const { taskListContainer, addTaskBtn, addTaskModal, addTaskForm, addTaskCancelBtn, taskTitleInput, quantityInput, notesTextarea, clearFinishedTasksBtn, clearAllTasksBtn } = elements;
    const { baseHeaders, jsonHeaders } = headers;
    const modalTitle = document.getElementById('add-task-modal-title');
    const taskIdInput = document.getElementById('task-id-input');
    const modalDeleteBtn = document.getElementById('modal-delete-btn');

    let tasks = [];
    let activeTaskId = parseInt(sessionStorage.getItem('active_task_id'), 10) || null;
    let settings = initialSettings;
    document.addEventListener('settingsUpdated', (e) => { settings = e.detail; });

    async function refreshTaskList() {
        try {
            // Menggunakan rute dari web.php
            const response = await fetch('/tasks/render', { headers: baseHeaders, credentials: 'same-origin' });
            if (!response.ok) throw new Error('Gagal memuat daftar tugas');
            taskListContainer.innerHTML = await response.text();
            initFlowbite();
        } catch (error) { console.error('Gagal me-refresh daftar tugas:', error); }
    }

    async function handleApiAction(url, options = {}) {
        try {
            const fetchOptions = { ...options, headers: options.body ? jsonHeaders : baseHeaders, credentials: 'same-origin' };
            const response = await fetch(url, fetchOptions);
            if (!response.ok) {
                if (response.status === 419) { alert('Sesi Anda telah kedaluwarsa. Silakan refresh halaman.'); }
                const errorData = await response.json();
                throw new Error(errorData.message || 'Aksi gagal');
            }
            return true;
        } catch (error) { console.error('API Action Error:', error); if (!error.message.includes('JSON')) { alert('Error: ' + error.message); } return false; }
    }

    function openAddTaskModal() { addTaskForm.reset(); taskIdInput.value = ''; quantityInput.value = 1; modalDeleteBtn.classList.add('hidden'); if (modalTitle) modalTitle.textContent = 'Tambah Tugas Baru'; addTaskModal.classList.remove('hidden'); taskTitleInput.focus(); }
    function openEditTaskModal(task) { taskIdInput.value = task.id; taskTitleInput.value = task.title; quantityInput.value = task.sessions_needed; notesTextarea.value = task.notes || ''; modalDeleteBtn.classList.remove('hidden'); if (modalTitle) modalTitle.textContent = 'Edit Tugas'; addTaskModal.classList.remove('hidden'); taskTitleInput.focus(); }
    function closeAddTaskModal() { addTaskModal.classList.add('hidden'); }
    function setActiveTask(taskId) { activeTaskId = taskId; if (taskId) { sessionStorage.setItem('active_task_id', taskId); } else { sessionStorage.removeItem('active_task_id'); } refreshTaskList(); }

    addTaskBtn.addEventListener('click', openAddTaskModal);
    addTaskCancelBtn.addEventListener('click', closeAddTaskModal);

    document.addEventListener('click', async (e) => {
        const target = e.target;
        if (target.matches('.task-edit-btn')) {
            e.preventDefault(); const taskId = target.dataset.id;
            try { const response = await fetch(`/tasks/${taskId}`, { headers: baseHeaders, credentials: 'same-origin' }); const task = await response.json(); openEditTaskModal(task); } catch (error) { console.error('Gagal mengambil data tugas:', error); }
        }
        const taskItem = target.closest('.task-item');
        if (taskItem) {
            const id = taskItem.dataset.id;
            if (target.matches('.task-checkbox')) { await handleApiAction(`/tasks/${id}`, { method: 'PUT', body: JSON.stringify({ completed: target.checked }) }); await refreshTaskList(); }
            else if (target.closest('[data-action="set-active"]')) { await handleApiAction(`/tasks/${id}/set-active`, { method: 'POST' }); await refreshTaskList(); }
        }
        if (target.id === 'modal-delete-btn') { const taskId = taskIdInput.value; if (taskId && confirm('Hapus tugas ini?')) { const success = await handleApiAction(`/tasks/${taskId}`, { method: 'DELETE' }); if (success) { closeAddTaskModal(); await refreshTaskList(); } } }
    });

    addTaskForm.addEventListener('submit', async (e) => { e.preventDefault(); const taskId = taskIdInput.value; const taskData = { title: taskTitleInput.value, notes: notesTextarea.value, sessions_needed: parseInt(quantityInput.value, 10) }; let url = '/tasks'; let options = { method: 'POST', body: JSON.stringify(taskData) }; if (taskId) { url = `/tasks/${taskId}`; options.method = 'PUT'; } const success = await handleApiAction(url, options); if (success) { closeAddTaskModal(); await refreshTaskList(); } });
    if (clearFinishedTasksBtn) { clearFinishedTasksBtn.addEventListener('click', async (e) => { e.preventDefault(); if (confirm('Hapus semua tugas yang sudah selesai?')) { const success = await handleApiAction('/tasks/clear/completed', { method: 'DELETE' }); if (success) await refreshTaskList(); } }); }
    if (clearAllTasksBtn) { clearAllTasksBtn.addEventListener('click', async (e) => { e.preventDefault(); if (confirm('HAPUS SEMUA TUGAS? Aksi ini tidak dapat dibatalkan.')) { const success = await handleApiAction('/tasks/clear/all', { method: 'DELETE' }); if (success) await refreshTaskList(); } }); }

    refreshTaskList();
    return { handleCompleteSession: async () => { const activeTaskId = sessionStorage.getItem('active_task_id'); if (!activeTaskId) return; await handleApiAction(`/tasks/${activeTaskId}/complete-session`, { method: 'PUT' }); await refreshTaskList(); } };
}