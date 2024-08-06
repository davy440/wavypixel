// Main JS file

const toggleSearch = () => {
	const search = document.querySelector( '.search' );

	if ( ! search ) {
		return;
	}
	const searchBtn = document.querySelector( '.search__btn' );
	const searchForm = document.querySelector( '.search__form-wrapper' );
	const searchInput = searchForm.querySelector( 'input[type="search"]' );

	const toggleVal = ( value ) => {
		return value = value === 'true' ? 'false' : 'true';
	};

	searchBtn.addEventListener( 'click', () => {
		searchForm.classList.toggle( 'is-visible' );
		searchBtn.setAttribute( 'aria-expanded', toggleVal( searchBtn.getAttribute( 'aria-expanded' ) ) );
		searchInput.focus();
	} );

	// Disable Search when clicked outside
	document.addEventListener('click', (event) => {
		if (!searchInput.contains(event.target) && !searchBtn.contains(event.target)) {
			searchForm.classList.remove('is-visible');
			searchBtn.setAttribute('aria-expanded', false);
		}
	} );
};
toggleSearch();
