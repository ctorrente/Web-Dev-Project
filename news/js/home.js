function setActive(event) {
  if (event.target.tagName !== 'A') {
    return false;
  }

  addActiveClass(event.target);
}

function addActiveClass(link) {
  var activeLink = document.getElementsByClassName('active');
  if (activeLink.length) {
    activeLink[0].className = '';
  }

  link.className = 'active';
}

window.onload = function() {
  var nav = document.getElementsByClassName('nav');
  nav[0].addEventListener('click', setActive);
}