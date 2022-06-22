import createSlide from '../utils/create-slider';

/**
 * Create the collections' slider on the page
 */
const config = {
	type: 'carousel',
	autoplay: 4000,
	perView: 4,
	gap: 30,
	controls: true,
	breakpoints: {
		576: {
			perView: 1,
		},
		992: {
			perView: 2,
		},
	},
};

createSlide('.featured__carousel', config);
