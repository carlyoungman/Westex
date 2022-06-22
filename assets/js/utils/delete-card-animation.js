// This function is responsible for the content card deleting animation
export default function deleteCardAnimation($cards, timeout) {
	let activeClass;
	$cards.forEach((el) => {
		activeClass = el.className.split(' ')[0] + '--fade-out';
		el.classList.add(activeClass);
		setTimeout(function () {
			el.remove();
		}, timeout);
	});
}
