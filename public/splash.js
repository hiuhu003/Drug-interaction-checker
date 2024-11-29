document.addEventListener("DOMContentLoaded", () => {
    const splashScreen = document.getElementById('splash-screen');
    const homeScreen = document.getElementById('home-screen');
    const logo = document.getElementById('logo');

    // Animation for minimizing the splash screen
    function minimizeSplash() {
        splashScreen.animate(
            [{ transform: 'scale(1)' }, { transform: 'scale(0)' }],
            { duration: 500, fill: 'forwards' }
        );

        setTimeout(() => {
            splashScreen.style.display = 'none';
            homeScreen.style.display = 'block';
        }, 500);
    }

    // Hide splash screen after 3 seconds and show home screen
    setTimeout(() => {
        minimizeSplash();
    }, 3000);
});
