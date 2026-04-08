document.addEventListener('DOMContentLoaded', function () {
    const body = document.body;
    const themeCards = document.querySelectorAll('.theme-card');
    const saveButton = document.querySelector('.save-btn');
    const discardButton = document.querySelector('.discard-btn');

    const themeClassMap = {
        light: 'theme-light',
        dark: 'theme-dark',
        comic: 'theme-comic'
    };

    const savedTheme = localStorage.getItem('kinetic_preferences_theme') || 'light';
    let currentTheme = savedTheme;
    let appliedTheme = savedTheme;

    function clearThemeClasses() {
        body.classList.remove('theme-light', 'theme-dark', 'theme-comic');
    }

    function applyTheme(themeName) {
        clearThemeClasses();
        body.classList.add(themeClassMap[themeName] || 'theme-light');
    }

    function updateActiveCard(themeName) {
        themeCards.forEach(function (card) {
            const cardTheme = card.getAttribute('data-theme');
            card.classList.toggle('active', cardTheme === themeName);

            const oldCheck = card.querySelector('.theme-check');
            if (oldCheck) {
                oldCheck.remove();
            }

            if (cardTheme === themeName) {
                const check = document.createElement('div');
                check.className = 'theme-check';
                check.innerHTML = '<span class="material-symbols-outlined">check</span>';
                card.appendChild(check);
            }
        });
    }

    applyTheme(savedTheme);
    updateActiveCard(savedTheme);

    themeCards.forEach(function (card) {
        card.addEventListener('click', function () {
            const themeName = card.getAttribute('data-theme');
            currentTheme = themeName;
            applyTheme(themeName);
            updateActiveCard(themeName);
        });
    });

    if (saveButton) {
        saveButton.addEventListener('click', function () {
            localStorage.setItem('kinetic_preferences_theme', currentTheme);
            appliedTheme = currentTheme;
        });
    }

    if (discardButton) {
        discardButton.addEventListener('click', function () {
            currentTheme = appliedTheme;
            applyTheme(appliedTheme);
            updateActiveCard(appliedTheme);
        });
    }
});