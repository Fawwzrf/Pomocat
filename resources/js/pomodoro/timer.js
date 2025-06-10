// File: resources/js/pomodoro/timer.js
export function initTimer(elements, initialSettings, onSessionComplete) {
    const { timeDisplay, modeLabel, progressCircle, timerLogo, modeButtons, startPauseBtn, resetBtn, alarmSound } = elements;

    let settings = initialSettings;
    let modes = {};
    let currentMode = 'pomodoro';
    let timeLeft, totalTime;
    let timerInterval = null;
    let isPaused = true;
    let pomodoroCycle = 0;
    const CIRCLE_CIRCUMFERENCE = 282.743;

    function applySettings() {
        modes = {
            pomodoro: { time: settings.pomodoro * 60, label: 'FOCUS' },
            shortbreak: { time: settings.shortBreak * 60, label: 'SHORT BREAK' },
            longbreak: { time: settings.longBreak * 60, label: 'LONG BREAK' },
        };
        setMode(currentMode);
    }

    function updateDisplay() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        const displayString = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        timeDisplay.textContent = displayString;
        document.title = `${displayString} - ${modes[currentMode].label}`;
        const progress = totalTime > 0 ? (timeLeft / totalTime) : 0;
        progressCircle.style.strokeDashoffset = CIRCLE_CIRCUMFERENCE * (1 - progress);
    }

    function resetTimer() {
        clearInterval(timerInterval);
        timerInterval = null;
        isPaused = true;
        startPauseBtn.textContent = 'Start';
        if (modes[currentMode]) {
            timeLeft = modes[currentMode].time;
            totalTime = modes[currentMode].time;
        }
        console.log('5. resetTimer terpanggil. `timeLeft` diatur ke:', timeLeft);
        updateDisplay();
    }

    function setMode(modeKey) {
        console.log('4. setMode terpanggil untuk mode:', modeKey);
        currentMode = modeKey;
        if (modes[modeKey]) { totalTime = modes[modeKey].time; }
        progressCircle.classList.remove('text-indigo-950', 'text-blue-600', 'text-red-800');
        modeLabel.classList.remove('text-indigo-950', 'text-blue-600', 'text-red-800');
        switch (modeKey) { case 'shortbreak': progressCircle.classList.add('text-blue-600'); modeLabel.textContent = modes[modeKey].label; modeLabel.classList.add('text-blue-600'); timerLogo.src = 'https://img.icons8.com/color/96/clew.png'; break; case 'longbreak': progressCircle.classList.add('text-red-800'); modeLabel.textContent = modes[modeKey].label; modeLabel.classList.add('text-red-800'); timerLogo.src = 'https://img.icons8.com/emoji/48/cup-with-straw-emoji.png'; break; default: progressCircle.classList.add('text-indigo-950'); if (modes.pomodoro) modeLabel.textContent = modes.pomodoro.label; modeLabel.classList.add('text-indigo-950'); timerLogo.src = 'https://img.icons8.com/emoji/96/glasses-emoji.png'; break; }
        modeButtons.forEach(btn => { const buttonText = btn.textContent.toLowerCase().replace(/\s/g, ''); if (buttonText === modeKey) { btn.classList.add('active-mode', 'bg-yellow-100/70'); } else { btn.classList.remove('active-mode', 'bg-yellow-100/70'); } });
        resetTimer();

        const eventMode = (modeKey === 'pomodoro') ? 'focus' : 'break';
        document.dispatchEvent(new CustomEvent('pomoModeChanged', { detail: { mode: eventMode } }));
    }

    function startTimer() {
        if (timerInterval) return;
        isPaused = false;
        startPauseBtn.textContent = 'Pause';
        timerInterval = setInterval(() => {
            timeLeft--;
            updateDisplay();
            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                timerInterval = null;

                // PERUBAHAN: Memilih dan memainkan suara yang sesuai berdasarkan mode
                let soundToPlay;
                switch (currentMode) {
                    case 'pomodoro':
                        soundToPlay = document.getElementById('alarm-sound-pomodoro');
                        break;
                    case 'shortbreak':
                        soundToPlay = document.getElementById('alarm-sound-short');
                        break;
                    case 'longbreak':
                        soundToPlay = document.getElementById('alarm-sound-long');
                        break;
                    default:
                        // Fallback ke suara default jika mode tidak dikenali
                        soundToPlay = document.getElementById('alarm-sound-pomodoro');
                }

                if (soundToPlay) {
                    soundToPlay.play().catch(e => console.error("Gagal memutar suara:", e));
                }
                // Akhir dari perubahan

                if (currentMode === 'pomodoro') {
                    pomodoroCycle++;
                    if (settings.autoCheckTasks) {
                        onSessionComplete();
                    }
                    showNotification("Sesi fokus selesai! Waktunya istirahat.");
                    const nextMode = pomodoroCycle % settings.longBreakInterval === 0 ? 'longbreak' : 'shortbreak';
                    setMode(nextMode);
                    if (settings.autoStartBreaks) {
                        setTimeout(() => startTimer(), 1000);
                    }
                } else {
                    showNotification("Istirahat selesai! Waktunya kembali fokus.");
                    setMode('pomodoro');
                    if (settings.autoStartPomodoros) {
                        setTimeout(() => startTimer(), 1000);
                    }
                }
            }
        }, 1000);
    }    
    function pauseTimer() { isPaused = true; startPauseBtn.textContent = 'Resume'; clearInterval(timerInterval); timerInterval = null; }
    function showNotification(message) { if ('Notification' in window && Notification.permission === 'granted') { new Notification('PomoCat', { body: message, icon: 'https://img.icons8.com/emoji/96/glasses-emoji.png' }); } }

    startPauseBtn.addEventListener('click', () => isPaused ? startTimer() : pauseTimer());
    resetBtn.addEventListener('click', resetTimer);
    modeButtons.forEach(button => button.addEventListener('click', function () { setMode(this.textContent.toLowerCase().replace(/\s/g, '')); }));

    // Inisialisasi awal
    applySettings();

    // Kembalikan fungsi yang bisa dipanggil dari luar modul ini
    return {
        updateSettings: (newSettings) => {
            settings = newSettings;
            applySettings();
        }
    };
}