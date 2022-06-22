export default function updateSampleCount() {
	document
		.querySelectorAll('span.header__samples-count-icon')
		.forEach((count) => {
			count.textContent = JSON.parse(
				window.localStorage.getItem('samples')
			).length;
		});
}
