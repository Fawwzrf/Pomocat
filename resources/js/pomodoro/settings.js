// File: resources/js/pomodoro/settings.js

export function initSettings(elements, headers, initialSettings, isGuest) {
    const {
        settingsBtn, settingsModal, settingsForm, settingsCancelBtn,
        inputPomodoro, inputShortBreak, inputLongBreak, toggleAutoStartBreaks,
        toggleAutoStartPomodoros, inputLongBreakInterval, toggleAutoCheckTasks,
        toggleAutoSwitchTasks
    } = elements;

    const { jsonHeaders } = headers;
    let settings = isGuest
        ? (JSON.parse(localStorage.getItem('settings')) || defaultSettings)
        : initialSettings;


    function loadSettingsIntoModal() {
        inputPomodoro.value = settings.pomodoro;
        inputShortBreak.value = settings.shortBreak;
        inputLongBreak.value = settings.longBreak;
        toggleAutoStartBreaks.checked = settings.autoStartBreaks;
        toggleAutoStartPomodoros.checked = settings.autoStartPomodoros;
        inputLongBreakInterval.value = settings.longBreakInterval;
        toggleAutoCheckTasks.checked = settings.autoCheckTasks;
        toggleAutoSwitchTasks.checked = settings.autoSwitchTasks;
    }

    function openSettingsModal() { loadSettingsIntoModal(); settingsModal.classList.remove('hidden'); }
    function closeSettingsModal() { settingsModal.classList.add('hidden'); }

    async function handleSaveSettings() {
        const newSettings = {
            pomodoro: parseInt(inputPomodoro.value, 10),
            shortBreak: parseInt(inputShortBreak.value, 10),
            longBreak: parseInt(inputLongBreak.value, 10),
            longBreakInterval: parseInt(inputLongBreakInterval.value, 10),
            autoStartBreaks: toggleAutoStartBreaks.checked,
            autoStartPomodoros: toggleAutoStartPomodoros.checked,
            autoCheckTasks: toggleAutoCheckTasks.checked,
            autoSwitchTasks: toggleAutoSwitchTasks.checked,
        };

        if (isGuest) {
            // STRATEGI TAMU: Simpan ke localStorage
            localStorage.setItem('settings', JSON.stringify(newSettings));
            settings = newSettings;
            document.dispatchEvent(new CustomEvent('settingsUpdated', { detail: newSettings }));
            closeSettingsModal();
        } else {
            // STRATEGI USER LOGIN: Simpan ke API
            try {
                await fetch('/settings', { method: 'PUT', headers: jsonHeaders, credentials: 'same-origin', body: JSON.stringify(newSettings) });
                location.reload(); // Refresh untuk memuat ulang semua
            } catch (error) { console.error('Gagal menyimpan pengaturan:', error); alert('Gagal menyimpan pengaturan.'); }
        }
    }

    settingsBtn.addEventListener('click', openSettingsModal);
    settingsCancelBtn.addEventListener('click', closeSettingsModal);
    settingsForm.addEventListener('submit', (e) => {
        e.preventDefault();
        handleSaveSettings();
    });

    return { getSettings: () => settings };
}