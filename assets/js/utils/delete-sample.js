export default function deleteSample(sample, timeout) {
	let activeClass;
	if (sample instanceof window.HTMLElement) {
		activeClass = sample.className.split(' ')[0] + '--fade-out';
		sample.classList.add(activeClass);
		setTimeout(function () {
			sample.remove();
		}, timeout);
		//Removes the samples from the confirmation page
		const index = [...sample.parentElement.children].indexOf(sample);
		document
			.querySelectorAll('div.sample-draw__display--confirmation')
			.forEach((confirmation) => {
				confirmation
					.querySelectorAll('div.sample-card')
					[index].remove();
			});
	}
}
