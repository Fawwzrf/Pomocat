// File: resources/js/pomodoro/settings.js

export function initSettings(elements, headers, settingsFromServer, isGuest) {
    const { settingsBtn, settingsModal, settingsForm, settingsCancelBtn, inputPomodoro, inputShortBreak, inputLongBreak, toggleAutoStartBreaks, toggleAutoStartPomodoros, inputLongBreakInterval, toggleAutoCheckTasks, toggleAutoSwitchTasks } = elements;
    const { jsonHeaders } = headers;

    // 1. Definisikan default settings DI DALAM modul ini
    const defaultSettings = {
        pomodoro: 25, shortBreak: 5, longBreak: 15,
        autoStartBreaks: true, autoStartPomodoros: false,
        longBreakInterval: 4, autoCheckTasks: true, autoSwitchTasks: true
    };

    // 2. Tentukan pengaturan awal berdasarkan status login
    let settings = isGuest
        ? (JSON.parse(localStorage.getItem('settings_guest')) || defaultSettings)
        : { ...defaultSettings, ...settingsFromServer }; // Gabungkan default dengan data dari server

    function loadSettingsIntoModal() { /* ... (kode tidak berubah) ... */ }
    function openSettingsModal() { /* ... (kode tidak berubah) ... */ }
    function closeSettingsModal() { /* ... (kode tidak berubah) ... */ }

    async function handleSaveSettings() {
        const newSettings = { pomodoro: parseInt(inputPomodoro.value, 10) || 25, shortBreak: parseInt(inputShortBreak.value, 10) || 5, longBreak: parseInt(inputLongBreak.value, 10) || 15, longBreakInterval: parseInt(inputLongBreakInterval.value, 10) || 4, autoStartBreaks: toggleAutoStartBreaks.checked, autoStartPomodoros: toggleAutoStartPomodoros.checked, autoCheckTasks: toggleAutoCheckTasks.checked, autoSwitchTasks: toggleAutoSwitchTasks.checked, };
        if (isGuest) {
            localStorage.setItem('settings_guest', JSON.stringify(newSettings));
            settings = newSettings;
            document.dispatchEvent(new CustomEvent('settingsUpdated', { detail: newSettings }));
            closeSettingsModal();
        } else {
            try { await fetch('/settings', { method: 'PUT', headers: jsonHeaders, credentials: 'same-origin', body: JSON.stringify(newSettings) }); location.reload(); } catch (error) { console.error('Gagal menyimpan pengaturan:', error); alert('Gagal menyimpan pengaturan.'); }
        }
    }

    // ... (sisa event listener tidak berubah, saya sertakan lengkap di bawah)
    loadSettingsIntoModal = function () { inputPomodoro.value = settings.pomodoro; inputShortBreak.value = settings.shortBreak; inputLongBreak.value = settings.longBreak; toggleAutoStartBreaks.checked = settings.autoStartBreaks; toggleAutoStartPomodoros.checked = settings.autoStartPomodoros; inputLongBreakInterval.value = settings.longBreakInterval; toggleAutoCheckTasks.checked = settings.autoCheckTasks; toggleAutoSwitchTasks.checked = settings.autoSwitchTasks; }
    openSettingsModal = function () { loadSettingsIntoModal(); settingsModal.classList.remove('hidden'); }
    closeSettingsModal = function () { settingsModal.classList.add('hidden'); }
    settingsBtn.addEventListener('click', openSettingsModal);
    settingsCancelBtn.addEventListener('click', closeSettingsModal);
    settingsForm.addEventListener('submit', (e) => { e.preventDefault(); handleSaveSettings(); });

    // Inisialisasi awal
    loadSettingsIntoModal();
    return { getSettings: () => settings };
}