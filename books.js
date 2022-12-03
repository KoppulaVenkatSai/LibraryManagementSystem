function studydiv() {
    // Nav Changes
    study = document.getElementById('study-li');
    story = document.getElementById('story-li');
    biography = document.getElementById('biography-li');
    study.style.backgroundColor = 'aqua';
    study.style.color = '#222327';
    story.style.backgroundColor = 'white';
    story.style.color = '#222327';
    biography.style.backgroundColor = 'white';
    biography.style.color = '#222327';
}

function storydiv() {
    // Nav Changes
    study = document.getElementById('study-li');
    story = document.getElementById('story-li');
    biography = document.getElementById('biography-li');
    study.style.backgroundColor = 'white';
    study.style.color = '#222327';
    story.style.backgroundColor = 'aqua';
    story.style.color = '#222327';
    biography.style.backgroundColor = 'white';
    biography.style.color = '#222327';
}

function biographydiv() {
    // Nav Changes
    study = document.getElementById('study-li');
    story = document.getElementById('story-li');
    biography = document.getElementById('biography-li');
    study.style.backgroundColor = 'white';
    study.style.color = '#222327';
    story.style.backgroundColor = 'white';
    story.style.color = '#222327';
    biography.style.backgroundColor = 'aqua';
    biography.style.color = '#222327';
}

// Scroll bar animation

progress = document.getElementById('progressbar');
totalHeight = document.body.scrollHeight - window.innerHeight;
window.onscroll = function(){
    progressHeight = (window.scrollY / totalHeight) * 100;
    progress.style.height = progressHeight + "%";
}

// Navigation scroll effects

// document.querySelectorAll('a[href^="#"]').forEach(anchor => {
//     anchor.addEventListener("click", function(e){
//         e.preventDefault()
//     });
// });
// document.querySelector(this.getAttribute("href")).scrollIntoView({
//     behaviour: "smooth"
// });