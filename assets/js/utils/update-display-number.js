export default function updateDisplayNumber(rootEl, page) {
	if (rootEl instanceof window.HTMLElement) {
		const showingEl = rootEl.querySelector(
			'h6.display-number__results-count span.showing'
		);
		let showing = showingEl.textContent;
		const total = rootEl.querySelector(
			'h6.display-number__results-count span.total'
		).textContent;

		if (
			showingEl instanceof window.HTMLElement &&
			total !== null &&
			showing !== null
		) {
			showing = parseInt(showing) * parseInt(page);
			if (showing > total) {
				showing = total;
			}
			showingEl.textContent = showing;
		}
	}
}
