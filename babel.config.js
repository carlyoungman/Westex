/**
 * Babel Config, .babelrc equivalent.
 *
 * @type {{presets: [[]|string|Object]}}
 */
module.exports = {
	presets: [
		[
			/**
			 * @link https://babeljs.io/docs/en/babel-preset-env#corejs
			 */
			'@babel/preset-env',
			{
				useBuiltIns: 'usage',
				corejs: {
					version: 3,
					proposals: true,
				},
			},
		],
		'@babel/preset-react',
		'@wordpress/default'
	],
};
