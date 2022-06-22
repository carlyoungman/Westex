export default function processSamples(data, settings) {
	//Insert samples into the draw
	settings.insert.forEach((element) => {
		element.insertAdjacentHTML('afterbegin', data);
	});
}
