class FindRetailer {
	constructor(sector) {
		const form = sector.querySelector('form.retailer-locations__form');
		const input = sector.querySelector('input.retailer-locations__input');
		const searchIcon = form.querySelector('svg.retailer-locations__icon');

		if (
			form instanceof window.HTMLElement &&
			input instanceof window.HTMLElement &&
			searchIcon instanceof SVGElement
		) {
			searchIcon.addEventListener('click', function (e) {
				input.focus();
				input.submit();
			});
		}
	}
}

class Handler {
	constructor(sector, sectorClass) {
		// Store values
		this.sector = sector;
		this.sectorClass = sectorClass;
		new FindRetailer(this.sector);
	}
}

// Init a handler for each block instance
const sectorClass = 'retailer-locations';
const sectors = Array.from(document.querySelectorAll(`section.${sectorClass}`));
sectors.forEach((o) => new Handler(o, sectorClass));
