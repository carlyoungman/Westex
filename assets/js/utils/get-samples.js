import processSamples from './process-samples';
export default function getSamples(sampleID) {
	const settings = {
		nonce: ajax_params.ajaxNonce,
		insert: document.querySelectorAll('div.sample-draw__display'),
		action: 'get_samples',
		samples: JSON.parse(window.localStorage.getItem('samples')),
		single: false,
	};

	if (typeof sampleID !== 'undefined') {
		settings.samples = sampleID;
		settings.single = true;
	}

	fetch(ajax_params.ajaxurl, {
		method: 'POST',
		credentials: 'same-origin',
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded',
			'Cache-Control': 'no-cache',
		},
		body: new URLSearchParams(settings),
	})
		.then(function (response) {
			if (response.ok) {
				return response.text();
			}
			throw new Error('Something went wrong');
		})
		.then((data) => {
			if (data.length) {
				processSamples(data, settings);
			} else {
				console.log('No data returned');
			}
		})
		.catch((error) => {
			console.log(error);
		});
}
