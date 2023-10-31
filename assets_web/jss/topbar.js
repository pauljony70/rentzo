$(document).ready(function () {
    // Initialize Select2
    $('#Language').select2({
        templateResult: addImage, // Call the custom function to add images to dropdown items
        templateSelection: addImage,
        minimumResultsForSearch: Infinity,
    });
});

// Custom function to add images to dropdown items
function addImage(option) {
    if (!option.id) {
        return option.text;
    }

    var $option = $(option.element);
    var imageSrc = $option.data('image-src');
    if (!imageSrc) {
        return option.text;
    }

    var $img = $(`<img style="width: 18px; height: 18px; ${default_language === 1 ? 'margin-left: 5px;' : 'margin-right: 5px;'}">`); // Removed the extra quotes here
    $img.attr('src', imageSrc);

    var $span = $('<div style="margin-top: 0.2rem;"></div>').text(option.text);

    var $result = $('<div class="d-flex align-items-center h-100" style="margin-top: -0.13rem;"></div>');
    $result.append($img).append($span);

    return $result;
}