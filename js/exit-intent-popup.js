jQuery(document).ready(function($) {
    // Fetch the popup content using an AJAX request
    $.ajax({
        url: ajax_object.ajax_url,
        type: 'POST',
        data: {
            action: 'get_popup_content',
        },
        success: function(response) {
            // Options for the popup
            var popupOptions = {
                width: 400,
                height: 220,
                html: response, // Set the HTML content
                css: '', // Add your custom CSS here
                fonts: [],
                delay: 5,
                showOnDelay: false,
                cookieExp: 1, // 1 day
                showOncePerSession: false,
                onPopup: null
            };

            // Initialize the popup
            bioEp.init(popupOptions);
        }
    });
});
