// File: resources/js/pomotime.js (File Utama Baru)

import { initSettings } from './pomodoro/settings.js';
import { initTasks } from './pomodoro/tasks.js';
import { initTimer } from './pomodoro/timer.js';
import { initReport } from './pomodoro/report.js';

if (document.getElementById('pomotime-container')) {

    document.addEventListener('DOMContentLoaded', function () {
        const elements = {
            timeDisplay: document.getElementById('time-display'),
            modeLabel: document.getElementById('mode-label'),
            progressCircle: document.getElementById('progress-circle'),
            timerLogo: document.getElementById('timer-logo'),
            modeButtons: document.querySelectorAll('.pomotime-mode-btn'),
            startPauseBtn: document.getElementById('start-pause-btn'),
            resetBtn: document.getElementById('reset-btn'),
            settingsBtn: document.getElementById('settings-btn'),
            alarmSound: document.getElementById('alarm-sound'),
            taskListContainer: document.getElementById('task-list'),
            addTaskBtn: document.getElementById('add-task-btn'),
            clearFinishedTasksBtn: document.getElementById('clear-finished-tasks-btn'),
            clearAllTasksBtn: document.getElementById('clear-all-tasks-btn'),
            addTaskModal: document.getElementById('add-task-modal'),
            addTaskForm: document.getElementById('add-task-form'),
            addTaskCancelBtn: document.getElementById('modal-cancel-btn'),
            taskTitleInput: document.getElementById('task-title-input'),
            quantityInput: document.getElementById('quantity-input'),
            notesTextarea: document.getElementById('task-notes'),
            settingsModal: document.getElementById('settings-modal'),
            settingsForm: document.getElementById('settings-form'),
            settingsCancelBtn: document.getElementById('settings-cancel-btn'),
            inputPomodoro: document.getElementById('setting-pomodoro'),
            inputShortBreak: document.getElementById('setting-short-break'),
            inputLongBreak: document.getElementById('setting-long-break'),
            toggleAutoStartBreaks: document.getElementById('setting-auto-start-breaks'),
            toggleAutoStartPomodoros: document.getElementById('setting-auto-start-pomodoros'),
            inputLongBreakInterval: document.getElementById('setting-long-break-interval'),
            toggleAutoCheckTasks: document.getElementById('setting-auto-check-tasks'),
            toggleAutoSwitchTasks: document.getElementById('setting-auto-switch-tasks'),
            reportBtn: document.querySelector('[data-modal-target="report-modal"]'),
        };

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const headers = { baseHeaders: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': csrfToken }, jsonHeaders: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' } };

        const pomotimeContainer = document.getElementById('pomotime-container');
        const initialSettings = JSON.parse(pomotimeContainer.dataset.settings);

        // --- PERUBAHAN DI SINI ---
        const settingsModule = initSettings(elements, headers, initialSettings);
        // Berikan initialSettings ke initTasks
        const taskModule = initTasks(elements, headers, initialSettings);
        const timerModule = initTimer(elements, initialSettings, taskModule.handleCompleteSession);
        initReport(elements, headers);
    });
}