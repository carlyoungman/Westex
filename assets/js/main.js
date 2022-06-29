import { initSlideshows } from './utils/helpers';
import iconSystem from './components/icon-system';
import navigation from './components/navigation';

require('./components/featured-carousel');
// require('./components/find-retailer');
require('./components/find-retailer-new');
require('./components/forms');
require('./components/key-information-with-icons');
require('./components/navigation');
require('./components/products');
require('./components/samples');
require('./components/slider');
require('./components/tabbed-content');

// // Load event helpers on DOM load
document.addEventListener('DOMContentLoaded', () => {
	initSlideshows();
	iconSystem();
	navigation();
});
