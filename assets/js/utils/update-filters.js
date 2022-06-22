// This function is responsible for updating the filters active classes
export default function updateFilters(element, activeClass) {
	const FilterBlock = element.parentElement;

	if (
		FilterBlock instanceof window.HTMLElement &&
		element instanceof window.HTMLElement
	) {
		const activeItem = FilterBlock.querySelector(
			'li.' +
				activeClass +
				':not(.product-filters-block__list-item--fake)'
		);
		if (element.classList.contains(activeClass)) {
			element.classList.remove(activeClass);
		} else {
			if (activeItem instanceof window.HTMLElement) {
				activeItem.classList.remove(activeClass);
			}
			element.classList.add(activeClass);
		}
	}
}
