export default function updateSampleForm() {
	const form = document.querySelector('section.sample-draw form');
	const inputs = form.querySelectorAll('input.sample-form-input');
	Array.prototype.forEach.call(inputs, function (node) {
		node.parentNode.removeChild(node);
	});

	const samples = document.querySelectorAll(
		'div.sample-draw__display--main .sample-card'
	);
	const sams = [
		'sample-one',
		'sample-two',
		'sample-three',
		'sample-four',
		'same-five',
	];
	samples.forEach((element, i) => {
		const input = document.createElement('input');
		const title = element.querySelector('p.sample-card__title').textContent;
		const collection = element.querySelector(
			'p.sample-card__collection'
		).textContent;
		const id = element.getAttribute('data-id');
		input.setAttribute('type', 'hidden');
		input.setAttribute('name', sams[i]);
		input.setAttribute('value', title + ', ' + collection + ', ' + id);
		input.setAttribute('data-title', title);
		input.setAttribute('data-collection', collection);
		input.setAttribute('data-id', id);
		input.setAttribute('class', 'sample-form-input');
		form.appendChild(input);
	});
}
