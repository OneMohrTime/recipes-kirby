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


/**
 * Activate css modals
 */

const trigger = document.querySelectorAll('.button--open');
//const closeBtn = document.querySelector('.button--close');
const modal   = document.querySelector('.drink__modal');
//
//trigger.addEventListener('click', () => {
//	modal.showModal();
//});
//closeBtn.addEventListener('click', () => {
//	modal.close();
//});

// check for url string
const drinksQuery = window.location.pathname.replace(/^\/|\/$/g, '');
// filter slashes from query
drinksQuery.replace(/^\/|\/$/g, '');
// execute if drinks page
if (drinksQuery == 'drinks') {
	trigger.forEach((button) => {
		// bind to click
		button.addEventListener('click', (e) => {
			//console.log(e.target);
			let target = e.target.parentNode
			
			e.preventDefault();
			target = target.nextElementSibling;
			target.setAttribute('open', 'open');
		});
	});
}

//if( drinksQuery ) {
//  console.log(window.location.hash)
//  document.querySelector(drinksQuery).setAttribute('open', 'open')
//} else {
//  // Fragment doesn't exist
//}
