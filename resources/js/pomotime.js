// File: resources/js/pomotime.js

// Pastikan kode hanya berjalan jika elemen utama halaman Pomotime ada
if (document.getElementById('time-display')) {

    document.addEventListener('DOMContentLoaded', function () {
        // ===================================================================
        // BAGIAN 1: SETUP & INISIALISASI
        // ===================================================================

        // === Inisialisasi Elemen DOM (Lengkap & Benar) ===
        const timeDisplay = document.getElementById('time-display');
        const modeLabel = document.getElementById('mode-label');
        const progressCircle = document.getElementById('progress-circle');
        const timerLogo = document.getElementById('timer-logo');
        const modeButtons = document.querySelectorAll('.pomotime-mode-btn');
        const startPauseBtn = document.getElementById('start-pause-btn');
        const resetBtn = document.getElementById('reset-btn');
        const settingsBtn = document.getElementById('settings-btn');
        const alarmSound = document.getElementById('alarm-sound');
        const taskListContainer = document.getElementById('task-list');
        const addTaskBtn = document.getElementById('add-task-btn');
        const clearFinishedTasksBtn = document.getElementById('clear-finished-tasks-btn');
        const clearAllTasksBtn = document.getElementById('clear-all-tasks-btn');
        const addTaskModal = document.getElementById('add-task-modal');
        const addTaskForm = document.getElementById('add-task-form');
        const addTaskCancelBtn = document.getElementById('modal-cancel-btn');
        const taskTitleInput = document.getElementById('task-title-input');
        const quantityInput = document.getElementById('quantity-input');
        const notesTextarea = document.getElementById('task-notes');
        const settingsModal = document.getElementById('settings-modal');
        const settingsForm = document.getElementById('settings-form');
        const settingsCancelBtn = document.getElementById('settings-cancel-btn');
        const inputPomodoro = document.getElementById('setting-pomodoro');
        const inputShortBreak = document.getElementById('setting-short-break');
        const inputLongBreak = document.getElementById('setting-long-break');
        const toggleAutoStartBreaks = document.getElementById('setting-auto-start-breaks');
        const toggleAutoStartPomodoros = document.getElementById('setting-auto-start-pomodoros');
        const inputLongBreakInterval = document.getElementById('setting-long-break-interval');
        const toggleAutoCheckTasks = document.getElementById('setting-auto-check-tasks');
        const toggleAutoSwitchTasks = document.getElementById('setting-auto-switch-tasks');
        const reportBtn = document.querySelector('[data-modal-target="report-modal"]');

        // === Variabel & Konfigurasi State Aplikasi ===
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const baseHeaders = { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': csrfToken };
        const jsonHeaders = { ...baseHeaders, 'Content-Type': 'application/json' };
        const defaultSettings = { pomodoro: 25, shortBreak: 5, longBreak: 15, autoStartBreaks: true, autoStartPomodoros: false, longBreakInterval: 4, autoCheckTasks: true, autoSwitchTasks: true };
        let settings = JSON.parse(localStorage.getItem('settings')) || defaultSettings;

        let tasks = [];
        let activeTaskId = null;
        let modes = {};
        let currentMode = 'pomodoro';
        let timeLeft, totalTime;
        let timerInterval = null;
        let isPaused = true;
        let pomodoroCycle = 0;
        let chartsRendered = false;

        const tabsWrapper = document.getElementById('report-tabs-wrapper');
        if (tabsWrapper) {
            const tabElements = [{ id: 'summary', triggerEl: document.getElementById('summary-tab'), targetEl: document.getElementById('summary-content') }, { id: 'detail', triggerEl: document.getElementById('detail-tab'), targetEl: document.getElementById('detail-content') }, { id: 'ranking', triggerEl: document.getElementById('ranking-tab'), targetEl: document.getElementById('ranking-content') }];
            const options = { defaultTabId: 'summary', activeClasses: 'text-indigo-900 border-indigo-900', inactiveClasses: 'text-slate-500 hover:text-indigo-900 border-transparent' };
            new Tabs(tabsWrapper, tabElements, options, { id: 'report-tabs', override: true });
        }

        // ===================================================================
        // BAGIAN 2: FUNGSI INTERAKSI DENGAN API (BACKEND)
        // ===================================================================
        async function fetchTasks() {
            try {
                const response = await fetch('/api/tasks', { method: 'GET', headers: baseHeaders, credentials: 'same-origin' });
                if (!response.ok) { const errorText = await response.text(); throw new Error(`HTTP error! status: ${response.status}. Response: ${errorText}`); }
                tasks = await response.json();
                renderTasks();
                if (!activeTaskId || !tasks.find(t => t.id === activeTaskId)) { const firstUncompleted = tasks.find(t => !t.completed); setActiveTask(firstUncompleted ? firstUncompleted.id : null); }
            } catch (error) { console.error("Could not fetch tasks:", error); taskListContainer.innerHTML = `<p class="text-center text-red-400">Gagal memuat tugas. Pastikan Anda sudah login.</p>`; }
        }
        async function handleAddTask(taskData) { try { const response = await fetch('/api/tasks', { method: 'POST', headers: jsonHeaders, credentials: 'same-origin', body: JSON.stringify(taskData) }); if (!response.ok) { const errorData = await response.json(); throw new Error(errorData.message || 'Gagal menambahkan tugas'); } await fetchTasks(); closeAddTaskModal(); } catch (error) { console.error('Error adding task:', error); alert('Error: ' + error.message); } }
        async function handleToggleTask(taskId, isCompleted) { try { await fetch(`/api/tasks/${taskId}`, { method: 'PUT', headers: jsonHeaders, credentials: 'same-origin', body: JSON.stringify({ completed: isCompleted }) }); await fetchTasks(); } catch (error) { console.error('Error toggling task:', error); } }
        async function handleDeleteTask(taskId) { if (!confirm('Apakah Anda yakin ingin menghapus tugas ini?')) return; try { await fetch(`/api/tasks/${taskId}`, { method: 'DELETE', headers: baseHeaders, credentials: 'same-origin' }); if (activeTaskId === taskId) activeTaskId = null; await fetchTasks(); } catch (error) { console.error('Error deleting task:', error); } }
        async function handleCompleteSession() { if (!activeTaskId) return; try { await fetch(`/api/tasks/${activeTaskId}/complete-session`, { method: 'PUT', headers: jsonHeaders, credentials: 'same-origin' }); await fetchTasks(); } catch (error) { console.error('Error completing session:', error); } }

        // ===================================================================
        // BAGIAN 3: FUNGSI-FUNGSI UI DAN TIMER
        // ===================================================================
        function applySettings() { modes = { pomodoro: { time: settings.pomodoro * 60, label: 'FOCUS' }, shortbreak: { time: settings.shortBreak * 60, label: 'SHORT BREAK' }, longbreak: { time: settings.longBreak * 60, label: 'LONG BREAK' }, }; setMode(currentMode); }
        function loadSettingsIntoModal() { inputPomodoro.value = settings.pomodoro; inputShortBreak.value = settings.shortBreak; inputLongBreak.value = settings.longBreak; toggleAutoStartBreaks.checked = settings.autoStartBreaks; toggleAutoStartPomodoros.checked = settings.autoStartPomodoros; inputLongBreakInterval.value = settings.longBreakInterval; toggleAutoCheckTasks.checked = settings.autoCheckTasks; toggleAutoSwitchTasks.checked = settings.autoSwitchTasks; }
        function openSettingsModal() { loadSettingsIntoModal(); settingsModal.classList.remove('hidden'); }
        function closeSettingsModal() { settingsModal.classList.add('hidden'); }
        function requestNotificationPermission() { if ('Notification' in window && Notification.permission !== 'granted' && Notification.permission !== 'denied') { Notification.requestPermission(); } }
        function showNotification(message) { if ('Notification' in window && Notification.permission === 'granted') { new Notification('PomoCat', { body: message, icon: 'https://img.icons8.com/emoji/96/glasses-emoji.png' }); } }
        const CIRCLE_CIRCUMFERENCE = 282.743;
        function updateDisplay() { const minutes = Math.floor(timeLeft / 60); const seconds = timeLeft % 60; const displayString = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`; if (timeDisplay) { timeDisplay.textContent = displayString; } if (modes[currentMode]) { document.title = `${displayString} - ${modes[currentMode].label}`; } const progress = totalTime > 0 ? (timeLeft / totalTime) : 0; const dashOffset = CIRCLE_CIRCUMFERENCE * (1 - progress); if (progressCircle) { progressCircle.style.strokeDashoffset = dashOffset; } }
        function startTimer() { if (timerInterval) return; isPaused = false; startPauseBtn.textContent = 'Pause'; timerInterval = setInterval(() => { timeLeft--; updateDisplay(); if (timeLeft <= 0) { clearInterval(timerInterval); timerInterval = null; if (alarmSound) { alarmSound.play().catch(e => console.error("Gagal memutar suara:", e)); } if (currentMode === 'pomodoro') { pomodoroCycle++; if (settings.autoCheckTasks && activeTaskId) { handleCompleteSession(); } showNotification("Sesi fokus selesai! Waktunya istirahat."); const nextMode = pomodoroCycle % settings.longBreakInterval === 0 ? 'longbreak' : 'shortbreak'; setMode(nextMode); if (settings.autoStartBreaks) setTimeout(() => startTimer(), 1000); } else { showNotification("Istirahat selesai! Waktunya kembali fokus."); setMode('pomodoro'); if (settings.autoStartPomodoros) setTimeout(() => startTimer(), 1000); } } }, 1000); }
        function pauseTimer() { isPaused = true; startPauseBtn.textContent = 'Resume'; clearInterval(timerInterval); timerInterval = null; }
        function resetTimer() { clearInterval(timerInterval); timerInterval = null; isPaused = true; startPauseBtn.textContent = 'Start'; if (modes[currentMode]) { timeLeft = modes[currentMode].time; } updateDisplay(); }
        function openAddTaskModal() { addTaskForm.reset(); quantityInput.value = 1; addTaskModal.classList.remove('hidden'); taskTitleInput.focus(); }
        function closeAddTaskModal() { addTaskModal.classList.add('hidden'); }
        function setActiveTask(taskId) { activeTaskId = taskId; renderTasks(); }

        // --- INI FUNGSI setMode VERSI ANDA ---
        function setMode(modeKey) {
            currentMode = modeKey;
            if (modes[modeKey]) {
                totalTime = modes[modeKey].time;
            }
            progressCircle.classList.remove('text-indigo-950', 'text-blue-600', 'text-red-800');
            modeLabel.classList.remove('text-indigo-950', 'text-blue-600', 'text-red-800');

            switch (modeKey) {
                case 'shortbreak':
                    progressCircle.classList.add('text-blue-600');
                    modeLabel.textContent = modes[modeKey].label;
                    modeLabel.classList.add('text-blue-600');
                    timerLogo.src = 'https://img.icons8.com/color/96/clew.png';
                    timerLogo.alt = 'yarn-logo';
                    break;
                case 'longbreak':
                    progressCircle.classList.add('text-red-800');
                    modeLabel.textContent = modes[modeKey].label;
                    modeLabel.classList.add('text-red-800');
                    timerLogo.src = 'https://img.icons8.com/emoji/48/cup-with-straw-emoji.png';
                    timerLogo.alt = 'drink-logo';
                    break;
                default: // 'pomodoro'
                    progressCircle.classList.add('text-indigo-950');
                    if (modes.pomodoro) modeLabel.textContent = modes.pomodoro.label;
                    modeLabel.classList.add('text-indigo-950');
                    timerLogo.src = 'https://img.icons8.com/emoji/96/glasses-emoji.png';
                    timerLogo.alt = 'glasses-logo';
                    break;
            }

            modeButtons.forEach(btn => {
                const buttonText = btn.textContent.toLowerCase().replace(/\s/g, '');
                if (buttonText === modeKey) {
                    btn.classList.add('active-mode', 'bg-yellow-100/70');
                } else {
                    btn.classList.remove('active-mode', 'bg-yellow-100/70');
                }
            });
            resetTimer();
        }

        function renderTasks() {
            tasks.sort((a, b) => a.completed - b.completed);
            taskListContainer.innerHTML = '';
            if (tasks.length === 0) {
                taskListContainer.innerHTML = `<p class="text-center text-yellow-100/50">Belum ada tugas. Tambahkan satu!</p>`;
                return;
            }
            tasks.forEach(task => {
                const taskEl = document.createElement('div');
                taskEl.className = `task-item cursor-pointer flex items-center justify-between p-3 rounded-lg transition-all ${task.completed ? 'bg-yellow-500/30 text-yellow-100/60' : 'bg-yellow-400/50'}`;
                taskEl.dataset.id = task.id;
                if (task.id == activeTaskId) { taskEl.classList.add('task-active'); }
                taskEl.innerHTML = `<div class="flex items-center gap-x-3"><input type="checkbox" class="task-checkbox h-5 w-5 rounded-full bg-transparent border-2 border-indigo-950 text-indigo-950 focus:ring-0 cursor-pointer" ${task.completed ? 'checked' : ''}><div><span class="font-medium ${task.completed ? 'line-through' : ''}">${task.title}</span><div class="text-xs text-indigo-900/80 font-semibold">${task.sessions_completed} / ${task.sessions_needed} Sesi</div></div></div><button class="delete-task-btn text-indigo-950/60 hover:text-indigo-950 text-2xl leading-none">&times;</button>`;
                taskListContainer.appendChild(taskEl);
            });
        }

        function getReportChartsOptions() { /* ... (Kode tidak berubah) ... */ const summaryAreaChartOptions = { chart: { height: "100%", maxWidth: "100%", type: "area", fontFamily: "Poppins, sans-serif", dropShadow: { enabled: false, }, toolbar: { show: false, }, }, tooltip: { enabled: true, x: { show: false, }, }, fill: { type: "gradient", gradient: { opacityFrom: 0.55, opacityTo: 0, shade: "#312e81", gradientToColors: ["#312e81"], }, }, dataLabels: { enabled: false, }, stroke: { width: 4, curve: 'smooth' }, grid: { show: false }, series: [{ name: "Menit Fokus", data: [65, 59, 80, 81, 56, 55, 40], color: "#312e81", },], xaxis: { categories: ['Juni 1', 'Juni 2', 'Juni 3', 'Juni 4', 'Juni 5', 'Juni 6', 'Juni 7'], labels: { show: false, }, axisBorder: { show: false, }, axisTicks: { show: false, }, }, yaxis: { show: false, }, }; const detailBarChartOptions = { series: [{ name: "Fokus", color: "#16a34a", data: [14, 16, 18, 14, 16, 21], }, { name: "Istirahat", data: [7, 8, 6, 8, 11, 12], color: "#f97316", }], chart: { sparkline: { enabled: false, }, type: "bar", width: "100%", height: 400, toolbar: { show: false, } }, plotOptions: { bar: { horizontal: true, columnWidth: "100%", borderRadiusApplication: "end", borderRadius: 6, }, }, legend: { show: true, position: "bottom" }, dataLabels: { enabled: false }, tooltip: { shared: true, intersect: false, }, xaxis: { labels: { show: true, style: { fontFamily: "Poppins, sans-serif", cssClass: 'text-xs font-normal fill-amber-700' }, formatter: function (value) { return value + " Sesi" } }, categories: ["Tugas A", "Tugas B", "Tugas C", "Tugas D", "Tugas E", "Tugas F"], }, yaxis: { labels: { show: true, style: { fontFamily: "Poppins, sans-serif", cssClass: 'text-xs font-normal fill-amber-700' } } }, grid: { show: true, strokeDashArray: 4, padding: { left: 2, right: 2, top: -20 }, }, }; return { summaryAreaChartOptions, detailBarChartOptions }; }
        function renderReportCharts() { if (chartsRendered) return; if (document.getElementById("summary-area-chart") && typeof ApexCharts !== 'undefined') { const { summaryAreaChartOptions } = getReportChartsOptions(); const chart = new ApexCharts(document.getElementById("summary-area-chart"), summaryAreaChartOptions); chart.render(); } if (document.getElementById("detail-bar-chart") && typeof ApexCharts !== 'undefined') { const { detailBarChartOptions } = getReportChartsOptions(); const chart = new ApexCharts(document.getElementById("detail-bar-chart"), detailBarChartOptions); chart.render(); } chartsRendered = true; }

        // BAGIAN 4: EVENT LISTENERS & INISIALISASI AKHIR
        startPauseBtn.addEventListener('click', () => isPaused ? startTimer() : pauseTimer());
        resetBtn.addEventListener('click', resetTimer);
        settingsBtn.addEventListener('click', openSettingsModal);
        modeButtons.forEach(button => button.addEventListener('click', function () { setMode(this.textContent.toLowerCase().replace(/\s/g, '')); }));
        addTaskBtn.addEventListener('click', openAddTaskModal);
        addTaskCancelBtn.addEventListener('click', closeAddTaskModal);
        settingsCancelBtn.addEventListener('click', closeSettingsModal);
        if (reportBtn) { reportBtn.addEventListener('click', renderReportCharts); }
        if (clearFinishedTasksBtn) { clearFinishedTasksBtn.addEventListener('click', (e) => { e.preventDefault(); alert("Fitur ini belum diimplementasikan di backend."); }); }
        if (clearAllTasksBtn) { clearAllTasksBtn.addEventListener('click', (e) => { e.preventDefault(); alert("Fitur ini belum diimplementasikan di backend."); }); }
        addTaskForm.addEventListener('submit', e => { e.preventDefault(); handleAddTask({ title: taskTitleInput.value, notes: notesTextarea.value, sessions_needed: parseInt(quantityInput.value, 10) }); });
        settingsForm.addEventListener('submit', e => { e.preventDefault(); settings.pomodoro = parseInt(inputPomodoro.value, 10); settings.shortBreak = parseInt(inputShortBreak.value, 10); settings.longBreak = parseInt(inputLongBreak.value, 10); settings.autoStartBreaks = toggleAutoStartBreaks.checked; settings.autoStartPomodoros = toggleAutoStartPomodoros.checked; settings.longBreakInterval = parseInt(inputLongBreakInterval.value, 10); settings.autoCheckTasks = toggleAutoCheckTasks.checked; settings.autoSwitchTasks = toggleAutoSwitchTasks.checked; localStorage.setItem('settings', JSON.stringify(settings)); applySettings(); closeSettingsModal(); });
        taskListContainer.addEventListener('click', e => { const taskItem = e.target.closest('.task-item'); if (!taskItem) return; const id = parseInt(taskItem.dataset.id, 10); if (e.target.matches('.task-checkbox')) { handleToggleTask(id, e.target.checked); } else if (e.target.matches('.delete-task-btn')) { handleDeleteTask(id); } else { setActiveTask(id); } });

        // === Inisialisasi Aplikasi ===
        function init() { requestNotificationPermission(); applySettings(); fetchTasks(); }
        init();
    });
}
