/**
 * Laravel Mix based WebPack setup
 *
 * @type {mix.Api}
 */
const mix = require('laravel-mix');
//file locations
const dist = './dist/assets';
const src = {
	styles: './assets/scss/main.scss',
	scripts: './assets/js/main.js',
	fonts: './assets/fonts',
	svg: './assets/images/svg',
	image: './assets/images',
	favicons: './assets/favicons',
};

//compile sass, if you want to export each block as separate file, simply run different tasks for each block
mix.sass(src.styles, dist + '/css/');

//compile js, react inc for the admin
mix.js(src.scripts, dist + '/js/')
	.sourceMaps()
	.react();

//copy fonts
mix.copy(src.fonts, dist + '/fonts/');

//copy images to dist directory
mix.copy(src.image, dist + '/images/');

//copy favicons to dist directory
mix.copy(src.favicons, dist + '/favicons/');

// If you require a global jquery sse the following
mix.autoload({
	jquery: ['$', 'window.jQuery'],
});
