import buildModal from './build-modal';
export default function clickModal(cards) {
	cards.forEach((el) => {
		el.addEventListener('click', function () {
			buildModal({
				postID: parseInt(el.dataset.id, 10),
				postType: el.dataset.type,
				samples: true,
			});
		});
	});
}
