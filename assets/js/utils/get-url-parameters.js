// function can be used for getting URL parameters by passing in a value
export default function getUrlParameter(Parameter) {
	const urlSearchParams = new URLSearchParams(window.location.search);
	const params = Object.fromEntries(urlSearchParams.entries());
	return params[Parameter];
}
