const searchToggle = document.getElementById('searchToggle'),
	  seachForm    = document.getElementById('searchForm'),
	  searchClose  = document.getElementById('searchClose'),
	  search       = document.getElementById('search'),
	  mainNav      = document.getElementById('mainNav'),
	  menu         = document.getElementById('menu');

searchToggle.addEventListener('click', function(e) {
	mainNav.classList.add('--is-searching');
	menu.classList.add('--is-hidden');
	seachForm.classList.add('--is-active');
	search.focus();
});

searchClose.addEventListener('click', function(e) {
	mainNav.classList.remove('--is-searching');
	menu.classList.remove('--is-hidden');
	seachForm.classList.remove('--is-active');
})

//import '../../node_modules/tingle.js/src/tingle.js';
//
//// instanciate new modal
//var modal = new tingle.modal({
//    footer: true,
//    stickyFooter: false,
//    closeMethods: ['overlay', 'button', 'escape'],
//    closeLabel: "Close",
//    cssClass: ['custom-class-1', 'custom-class-2'],
//    onOpen: function() {
//        console.log('modal open');
//    },
//    onClose: function() {
//        console.log('modal closed');
//    },
//    beforeClose: function() {
//        // here's goes some logic
//        // e.g. save content before closing the modal
//        return true; // close the modal
//        return false; // nothing happens
//    }
//});
//
//// set content
//modal.setContent('<h1>here\'s some content</h1>');
//
//// add a button
//modal.addFooterBtn('Button label', 'tingle-btn tingle-btn--primary', function() {
//    // here goes some logic
//    modal.close();
//});
//
//// add another button
//modal.addFooterBtn('Dangerous action !', 'tingle-btn tingle-btn--danger', function() {
//    // here goes some logic
//    modal.close();
//});
//
//// open modal
//modal.open();
//
//// close modal
//modal.close();
