var code_ajax = $("#code_ajax").val();
document.querySelectorAll('#top-offer-edit-btn').forEach((button) => {
	button.addEventListener("click", () => {
		disableTopOfferForm();
		button.parentElement.parentElement.querySelectorAll('input').forEach((input) => {
			input.disabled = false;
		});
		button.parentElement.parentElement.querySelectorAll('textarea').forEach((textarea) => {
			textarea.disabled = false;
		});
		button.parentElement.parentElement.querySelectorAll('button').forEach((button) => {
			button.disabled = false;
		});
	});
});

const disableTopOfferForm = () => {
	document.querySelector('#topbar-offer').querySelectorAll('input').forEach((input) => {
		input.disabled = true;
	});
	document.querySelector('#topbar-offer').querySelectorAll('textarea').forEach((textarea) => {
		textarea.disabled = true;
	});
	document.querySelector('#topbar-offer').querySelectorAll('button').forEach((button) => {
		button.disabled = true;
	});
}

const updateTopOffer = (form_id) => {
	var top_offer_id = document.querySelector('#' + form_id).querySelector('#offer_id').value;
	var heading = document.querySelector('#' + form_id).querySelector('#heading').value;
	var heading_ar = document.querySelector('#' + form_id).querySelector('#heading_ar').value;
	var description = document.querySelector('#' + form_id).querySelector('#description').value;
	var description_ar = document.querySelector('#' + form_id).querySelector('#description_ar').value;
	var offer_page_title = document.querySelector('#' + form_id).querySelector('#offer_page_title').value;
	var offer_page_title_ar = document.querySelector('#' + form_id).querySelector('#offer_page_title_ar').value;
	var offer_page_link = document.querySelector('#' + form_id).querySelector('#offer_page_link').value;

	if (heading !== '' && heading_ar !== '' && description !== '' && description_ar !== '' && offer_page_title !== '' && offer_page_title_ar !== '' && offer_page_link !== '') {
		$.busyLoadFull("show");
		$.ajax({
			method: 'POST',
			url: 'edit_top_offer.php',
			data: {
				code: code_ajax,
				top_offer_id: top_offer_id,
				heading: heading,
				heading_ar: heading_ar,
				description: description,
				description_ar: description_ar,
				offer_page_title: offer_page_title,
				offer_page_title_ar: offer_page_title_ar,
				offer_page_link: offer_page_link,
			},
			success: function (response) {
				$.busyLoadFull("hide");
				disableTopOfferForm();
				successmsg(response);
			}
		});
	} else {
		successmsg('All fields are required');
	}
};