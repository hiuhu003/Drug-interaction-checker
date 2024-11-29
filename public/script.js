function toggleMenu() {
    const menu = document.querySelector(".menu-links");
    const icon = document.querySelector(".icon-links");
    menu.classList.toggle("open")
    icon.classList.toggle("open")
}
function toggleMore(element) {
    console.log("toggleMore function triggered!");
    const moreText = element.nextElementSibling;
    const isHidden = moreText.style.display ==='none'||moreText.style.display === '';
    //the display of additional text
    moreText.style.display  = isHidden ?'inline':'none';
    //ellipsis content
    element.textContent = isHidden ? 'Show less' :'...';
}
