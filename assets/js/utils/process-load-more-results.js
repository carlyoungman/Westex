import clickModal from '../utils/click-modal';
import updateDisplayNumber from '../utils/update-display-number';
export default function processResults(data, settings) {
	// Adds additional dynamic class that is used for animation
	const regexCard = new RegExp(`class="${settings.card}"`, 'g');
	const results = data.replace(
		regexCard,
		`class="${settings.card} ${settings.card}--dynamic ${settings.card}--animate"`
	);
	//Insert new posts into the page
	const insertParent = settings.insert.parentNode;
	insertParent.insertAdjacentHTML('beforeend', results);
	//Apply an animation delay to the newly inserted cards
	const newElements = document.getElementsByClassName(
		settings.card + '--animate'
	);
	for (let i = 0; i < newElements.length; i++) {
		newElements[i].setAttribute(
			'style',
			'transition-delay:' + '0.1' * i + 's'
		);
	}
	//Update the load more display number;
	updateDisplayNumber(settings.rootEl, settings.page);
	//Animate the cards by removing the dynamic class that we just added
	setTimeout(function () {
		Array.from(
			settings.rootEl.querySelectorAll('.' + settings.card + '--dynamic')
		).forEach((el) => el.classList.remove(settings.card + '--dynamic'));
	}, settings.transition);
	setTimeout(function () {
		//Remove the animation delay class so that the animation will work for the next set of cards
		Array.from(
			settings.rootEl.querySelectorAll('.' + settings.card + '--animate')
		).forEach((el) => el.classList.remove(settings.card + '--animate'));
		//Removing the animation delay so that it doesn't affect the hover effect
		Array.from(
			settings.rootEl.querySelectorAll('.' + settings.card)
		).forEach((el) =>
			el.setAttribute('style', 'transition-delay:' + '0' + 's')
		);
		clickModal(settings.rootEl.querySelectorAll('.' + settings.card));
	}, settings.transition * 3);
}
