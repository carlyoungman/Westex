class keyInformationWithIcons {
	constructor(sector) {
		const rootEl = sector;
		const tabs = rootEl.querySelectorAll(
			'div.key-information-with-icon-card__read-more'
		);
		const panels = rootEl.nextElementSibling.querySelectorAll(
			'li.key-information-with-icons__read-more-item'
		);
		const activeTab = 'key-information-with-icon-card__read-more--active';
		const activePanel =
			'key-information-with-icons__read-more-item--active';
		const close = rootEl.nextElementSibling.querySelectorAll(
			'svg.key-information-with-icons__read-more-item-close'
		);
		panels.forEach((panel) => {
			const dropdowns = panel.querySelector(
				'ul.key-information-with-icons__read-more-item_dropdown'
			);
			if (dropdowns instanceof window.HTMLElement) {
				const item = dropdowns.querySelectorAll(
					'li.key-information-with-icons__read-more-item_dropdown-item'
				);

				item.forEach((el) => {
					el.addEventListener('click', () => {
						item.forEach((elm) => {
							elm.classList.remove(
								'key-information-with-icons__read-more-item_dropdown-item--active'
							);
						});
						el.classList.add(
							'key-information-with-icons__read-more-item_dropdown-item--active'
						);
					});
				});
			}
		});

		tabs.forEach((tab) => {
			tab.addEventListener('click', () => {
				tabs.forEach((el) => {
					el.parentElement.classList.add(
						'key-information-with-icon-card--disabled'
					);
				});
				tab.parentElement.classList.remove(
					'key-information-with-icon-card--disabled'
				);
				tabs.forEach((tab) => {
					tab.classList.remove(activeTab);
				});
				tab.classList.add(activeTab);
				panels.forEach((panel) => {
					panel.classList.remove(activePanel);
				});
				panels[
					getElementIndex(tab.parentElement.parentElement)
				].classList.add(activePanel);
			});
		});

		close.forEach((c) => {
			c.addEventListener('click', () => {
				tabs.forEach((el) => {
					el.classList.remove(
						'key-information-with-icon-card__read-more--active'
					);
					el.parentElement.classList.remove(
						'key-information-with-icon-card--disabled'
					);
					c.parentElement.classList.remove(
						'key-information-with-icons__read-more-item--active'
					);
				});
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
		new keyInformationWithIcons(this.sector);
	}
}

// Init a handler for each block instance
const sectorClass = 'key-information-with-icons';
const sectors = Array.from(document.querySelectorAll(`section.${sectorClass}`));
sectors.forEach((o) => new Handler(o, sectorClass));
