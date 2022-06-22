// function is used to change the view more button to various states
export default function btnManagement($button, state) {
	if ($button instanceof window.HTMLElement) {
		switch (state) {
			case 'loading':
				$button.classList.toggle('loading');
				break;
			case 'hide':
				$button.classList.remove('show');
				$button.classList.add('hide');
				break;
			case 'show':
				$button.classList.remove('hide');
				$button.classList.add('show');
				break;
			default:
		}
	}
}
