export default function updateSamples(postID) {
	if (typeof postID !== 'undefined') {
		const samples = JSON.parse(window.localStorage.getItem('samples'));
		toggleValueInArray(samples, postID);
		window.localStorage.setItem('samples', JSON.stringify(samples));
	}
}

function toggleValueInArray(array, value) {
	let index = array.indexOf(value);
	if (index === -1) {
		array.push(value);
	} else {
		do {
			array.splice(index, 1);
			index = array.indexOf(value);
		} while (index !== -1);
	}
}
