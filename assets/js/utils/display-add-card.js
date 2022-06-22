export default function displayAddCard() {
	const $display = document.querySelector('div.sample-draw__display');
	const $card = $display.querySelector('a.add-sample-card').cloneNode(true);
	setTimeout(function () {
		$display.appendChild($card);
	}, 1000);
}
