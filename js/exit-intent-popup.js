jQuery(document).ready(function($) {
    // Ensure ajax_object is defined
    if (typeof ajax_object === 'undefined' || !ajax_object.ajax_url) {
        console.error('ajax_object is not defined or missing ajax_url.');
        return;
    }

    // Fetch the popup content using an AJAX request
    $.ajax({
        url: ajax_object.ajax_url,
        type: 'POST',
        data: {
            action: 'get_popup_content',
        },
        success: function(response) {
            // Check if bioEp is defined before initializing the popup
            if (typeof bioEp === 'undefined') {
                console.error('bioEp is not defined.');
                return;
            }

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
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Failed to fetch popup content:', textStatus, errorThrown);
        }
    });
});
