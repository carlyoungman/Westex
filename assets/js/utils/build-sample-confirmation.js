// This function is responsible for building the sample confirmation slide
export default function buildConfirmation(slide) {
	const getAllFormElements = (element) =>
		Array.from(element.elements).filter((tag) =>
			['select', 'textarea', 'input'].includes(tag.tagName.toLowerCase())
		);
	if (2 === slide) {
		let addressString = '';
		let emailString = '';
		const address = document.querySelector(
			'section.sample-draw address.sample-draw__address'
		);
		const email = document.querySelector(
			'section.sample-draw p.sample-draw__email'
		);
		const formElements = getAllFormElements(
			document.querySelector('section.sample-draw form')
		);
		formElements.forEach((element) => {
			if (
				element.classList.contains('wpcf7-form-control') &&
				'email' !== element.type &&
				'submit' !== element.type &&
				'' !== element.value
			) {
				addressString = addressString + ', ' + element.value;
			}

			if (
				element.classList.contains('wpcf7-form-control') &&
				'email' === element.type &&
				'' !== element.value
			) {
				emailString = element.value;
			}
		});
		addressString = addressString.substring(1);
		address.textContent = addressString;

		email.textContent = emailString;
	}
}
