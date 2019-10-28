/**
 * Searchbar in the nav activation
 */

const searchToggle = document.getElementById('searchToggle'),
	seachForm      = document.getElementById('searchForm'),
	searchClose    = document.getElementById('searchClose'),
	search         = document.getElementById('search'),
	mainNav        = document.getElementById('mainNav'),
	menu           = document.getElementById('menu');

searchToggle.addEventListener('click', function (e) {
	mainNav.classList.add('--is-searching');
	menu.classList.add('--is-hidden');
	seachForm.classList.add('--is-active');
	search.focus();
});

searchClose.addEventListener('click', function (e) {
	mainNav.classList.remove('--is-searching');
	menu.classList.remove('--is-hidden');
	seachForm.classList.remove('--is-active');
})
