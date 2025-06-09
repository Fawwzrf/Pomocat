// File: resources/js/pomodoro/settings.js

export function initSettings(elements, headers, initialSettings) {
    const {
        settingsBtn, settingsModal, settingsForm, settingsCancelBtn,
        inputPomodoro, inputShortBreak, inputLongBreak, toggleAutoStartBreaks,
        toggleAutoStartPomodoros, inputLongBreakInterval, toggleAutoCheckTasks,
        toggleAutoSwitchTasks
    } = elements;

    const { jsonHeaders } = headers;
    let settings = initialSettings;

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

        try {
            const response = await fetch('/settings', {
                method: 'PUT',
                headers: jsonHeaders,
                credentials: 'same-origin',
                body: JSON.stringify(newSettings)
            });

            if (!response.ok) {
                // Jika gagal, tampilkan error dan jangan refresh
                const errorData = await response.json();
                throw new Error(errorData.message || 'Gagal menyimpan pengaturan');
            }

            // =======================================================
            // == PERUBAHAN UTAMA: LANGSUNG REFRESH HALAMAN ==
            // =======================================================
            location.reload();

        } catch (error) {
            console.error('Failed to save settings:', error);
            alert('Gagal menyimpan pengaturan: ' + error.message);
        }
    }

    settingsBtn.addEventListener('click', openSettingsModal);
    settingsCancelBtn.addEventListener('click', closeSettingsModal);
    settingsForm.addEventListener('submit', (e) => {
        e.preventDefault();
        handleSaveSettings();
    });

    return settings;
}