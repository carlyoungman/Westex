import createSlider from '../util/create-slider';

export default function notifications() {
	const slider = () => {
		const sliders = document.querySelectorAll(
			'section.notification-bar--active .notification-bar__slider'
		);
		const config = {
			type: 'carousel',
			focusAt: 'center',
			perView: 1,
			swipeThreshold: true,
			dragThreshold: true,
			keyboard: true,
			autoplay: 5000,
		};
		sliders.forEach((el) => {
			createSlider(el, config);
		});
	};
	slider();
}
