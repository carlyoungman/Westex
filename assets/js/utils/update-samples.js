export default function updateSamples(postID, quality) {
	if (typeof postID !== 'undefined') {
		const samples = JSON.parse(window.localStorage.getItem('samples'));
		toggleValueInArray(samples, { id: postID, quality });
		window.localStorage.setItem('samples', JSON.stringify(samples));
	}
}

function toggleValueInArray(array, obj) {
	if (array.length !== 0) {
		console.log('true');
		let arrayNew = JSON.stringify(array);
		const objNew = JSON.stringify(obj);
		if (arrayNew.includes(objNew)) {
			array.splice(array.indexOf(obj), 1);
		} else {
			arrayNew = JSON.parse(objNew);
			array.push(arrayNew);
		}
	} else {
		array.push(obj);
	}
}
