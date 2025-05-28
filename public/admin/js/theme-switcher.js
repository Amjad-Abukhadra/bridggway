document.addEventListener('DOMContentLoaded', function() {
    const themeToggle = document.getElementById('themeToggle');
    const themeStylesheet = document.getElementById('theme-stylesheet');

    // Check if there's a saved theme preference
    const currentTheme = localStorage.getItem('theme') || 'dark';
    setTheme(currentTheme);

    themeToggle.addEventListener('click', function() {
        const currentTheme = localStorage.getItem('theme') || 'dark';
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        setTheme(newTheme);
    });

    function setTheme(theme) {
        const icon = themeToggle.querySelector('i');
        
        if (theme === 'light') {
            themeStylesheet.href = '/admin/css/style.light.css';
            icon.className = 'fa fa-moon-o';
        } else {
            themeStylesheet.href = '/admin/css/style.default.css';
            icon.className = 'fa fa-sun-o';
        }
        
        localStorage.setItem('theme', theme);
    }
}); 