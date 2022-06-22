export default function checkFormValidation(inputs) {
	const inputArray = Array.from(inputs).filter((input) => input.value === '');
	return inputArray === undefined || inputArray.length === 0;
}
