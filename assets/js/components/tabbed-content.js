class Products {
	constructor(sector) {
		const rootEl = sector;
		const tabs = rootEl.querySelectorAll('ul.tabbed_content__headings li');
		const activeTab = 'tabbed_content__heading--active';
		const panels = rootEl.querySelectorAll(
			'ul.tabbed_content__tab-content li'
		);
		const activePanel = 'tabbed_content__content-wrap--active';

		tabs.forEach((tab) => {
			tab.addEventListener('click', () => {
				tabs.forEach((tab) => {
					tab.classList.remove(activeTab);
				});
				tab.classList.add(activeTab);

				panels.forEach((panel) => {
					panel.classList.remove(activePanel);
				});
				panels[getElementIndex(tab)].classList.add(activePanel);
			});
		});

		function getElementIndex(el) {
			return [...el.parentElement.children].indexOf(el);
		}
	}
}

class Handler {
	constructor(sector, sectorClass) {
		// Store values
		this.sector = sector;
		this.sectorClass = sectorClass;

		new Products(this.sector);
	}
}

// Init a handler for each block instance
const sectorClass = 'tabbed_content';
const sectors = Array.from(document.querySelectorAll(`section.${sectorClass}`));
sectors.forEach((o) => new Handler(o, sectorClass));
