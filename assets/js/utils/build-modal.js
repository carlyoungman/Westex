// Magic vars
const timeout = 200;
const bodyBusyClass = 'modal-opening';
const bodyEventsClass = 'modal-events-attached';
const modalBaseClass = 'modal-base';
const modalCloseClass = 'modal-base__close';
const modalPopupClass = 'modal-base__popup';

/*
 * Handle user clicking the modal background
 *
 * @param     {MouseEvent} event    An event raised by a user action
 * @return    {void}
 */
function handleBackgroundClick(event) {
	const matchesSelector = `.${modalBaseClass}`;

	// Don't continue if the click wasn't inside the modal base element
	if (
		!event.target.matches(matchesSelector) &&
		!event.target.matches(`${matchesSelector} *`)
	) {
		return;
	}

	// Don't continue if the click was inside the popup element
	if (
		event.target.closest(`.${modalPopupClass}`) instanceof
		window.HTMLElement
	) {
		return;
	}

	// Close the modals
	event.preventDefault();
	closeModal();
}

/*
 * Handle user clicking the modal close button
 *
 * @param     {MouseEvent} event    An event raised by a user action
 * @return    {void}
 */
function handleCloseClick(event) {
	const matchesSelector = `.${modalCloseClass}`;

	// Don't continue if the click wasn't inside the modal close button
	if (
		!event.target.matches(matchesSelector) &&
		!event.target.matches(`${matchesSelector} *`)
	) {
		return;
	}

	// Close the modals
	event.preventDefault();
	closeModal();
}

/*
 * Handle key pressed (ESC to close the modal)
 *
 * @param     {KeyboardEvent} event    An event raised by a user action
 * @return    {void}
 */
function handleKeyup(event) {
	switch (event.code) {
		case 'Escape':
			closeModal();
			break;
	}
}

/**
 * Remove the modal from the DOM
 *
 * @return    {void}
 */
function closeModal() {
	// Get the modal base
	const modalEl = document.querySelector(`.${modalBaseClass}`);
	if (modalEl instanceof window.HTMLElement) {
		modalEl?.parentNode.removeChild(modalEl);
	}
}

// function is used to build modals.
// 	The modal will load block/template-parts/modals/modal-postType into the modal body
export default function buildModal({ postID, postSlug, postType, samples }) {
	// Define basic settings
	const settings = {
		action: 'build_modal',
		nonce: window.ajax_params.ajaxNonce,
		postType,
		button: false,
		buttons: false,
	};
	// This is responsible for updating the request samples button
	if (samples === true) {
		const sampleArray = JSON.parse(window.localStorage.getItem('samples'));
		if (sampleArray.includes(String(postID)) === true) {
			settings.button = true;
		}
		if (sampleArray.length >= 3) {
			settings.buttons = true;
		}
	}

	// Add post ID if one exists
	if ('number' === typeof postID && 0 < postID) {
		settings.postID = postID;
		// Add post slug if one exists
	} else if ('string' === typeof postSlug && 0 < postSlug.length) {
		settings.postSlug = postSlug;
	}

	// Don't continue if another modal is open/opening
	if (document.body.classList.contains(bodyBusyClass)) {
		return;
	}
	document.body.classList.add(bodyBusyClass);

	// Attach events if not already attached
	if (!document.body.classList.contains(bodyEventsClass)) {
		// Flag events as attached
		document.body.classList.add(bodyEventsClass);

		// Attach events
		document.body.addEventListener('click', handleBackgroundClick);
		document.body.addEventListener('click', handleCloseClick);
		document.body.addEventListener('keyup', handleKeyup);
	}

	// Fetch data from the server
	window
		.fetch(window.ajax_params.ajaxurl, {
			method: 'POST',
			credentials: 'same-origin',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded',
				'Cache-Control': 'no-cache',
			},
			body: new URLSearchParams(settings),
		})
		// Parse the response
		.then((response) => {
			if (response.ok) {
				return response.text();
			}
			throw new Error('Something went wrong');
		})

		// Inject markup into the DOM
		.then((data) => {
			// Fail if there's no data
			if (0 === data.length) {
				throw new Error('No data returned');
			}

			// Insert the markup into the DOM
			document.body.insertAdjacentHTML('beforeend', data);

			// Fetch elements
			const modalBaseEl = document.querySelector(
				`body > .${modalBaseClass}`
			);
			if (!(modalBaseEl instanceof window.HTMLElement)) {
				return;
			}

			// Responsible for animating in the modal
			setTimeout(
				() => modalBaseEl.classList.remove('modal-base--animate'),
				timeout
			);
		})

		// On failure
		.catch((error) => {
			// eslint-disable-next-line no-console
			console.log(error);
		})

		// Always do this
		.finally(() => {
			// Allow other modals to open
			document.body.classList.remove(bodyBusyClass);
		});
}
