/**
 * Handles the form animation and other various things
 *
 */
class Forms {
	constructor(sector) {
		const rootEl = sector;
		const $inputWrapper = rootEl.querySelectorAll('div.input-wrapper');
		const activeClass = 'input-wrapper--has-input';
		$inputWrapper.forEach((el) => {
			const $input = el.querySelector('input');
			el.addEventListener('mouseenter', function () {
				el.classList.add(activeClass);
			});

			el.addEventListener('mouseleave', function () {
				if ($input && !$input.value) {
					el.classList.remove(activeClass);
				}
			});

			if ($input instanceof window.HTMLElement) {
				$input.addEventListener('focus', function () {
					el.classList.add(activeClass);
				});
				$input.addEventListener('blur', function () {
					if ($input && !$input.value) {
						el.classList.remove(activeClass);
					}
				});
			}
		});
	}
}

class Handler {
	constructor(sector, sectorClass) {
		// Store values
		this.sector = sector;
		this.sectorClass = sectorClass;

		new Forms(this.sector);
	}
}
// Init a handler for each block instance
const sectorClass = 'form';
const sectors = Array.from(document.querySelectorAll(sectorClass));
sectors.forEach((o) => new Handler(o, sectorClass));
