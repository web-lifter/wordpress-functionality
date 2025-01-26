jQuery(document).ready(function ($) {
    // Custom Contact Form
    $('#customContactForm').on('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

        var $form = $(this);
        var $button = $form.find('button[type="submit"]');
        var $responseContainer = $('#contactFormResponse');
        $button.prop('disabled', true); // Disable the submit button

        // Prepare form data
        var formData = {
            action: 'submit_contact_form', // Define the action for WP AJAX
            honeypot: $('#honeypot').val(), // Honeypot field
            full_name: $('#fullName').val(),
            company: $('#company').val(),
            email: $('#email').val(),
            phone_number: $('#phoneNumber').val(),
            message: $('#message').val(),
            form_token: $('input[name="form_token"]').val(), // Form token for verification
        };

        // Check client-side validations
        if (formData.honeypot) {
            $responseContainer.html('<p class="error-message">Spam detected. Submission blocked.</p>');
            $button.prop('disabled', false); // Re-enable the button
            return;
        }

        if (!formData.full_name || !formData.email || !formData.message) {
            $responseContainer.html('<p class="error-message">Please fill in all required fields.</p>');
            $button.prop('disabled', false); // Re-enable the button
            return;
        }

        // Send AJAX request
        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: formData,
            success: function (response) {
                if (response.success) {
                    try {
                        // Push to dataLayer if available
                        dataLayer.push({
                            event: 'long_contact_form_submission',
                            formID: 'customContactForm',
                            formAction: 'submit_contact_form',
                            formStatus: 'success',
                            formInputs: {
                                full_name: formData.full_name,
                                email: formData.email,
                                phone_number: formData.phone_number,
                            },
                            serverResponse: response, // Optional: include server response
                        });
                    } catch (error) {
                        console.error('Failed to push data to dataLayer:', error);
                    }
                    $responseContainer.html('<p class="success-message">Thank you for reaching out! We will get back to you shortly.</p>');
                    $form[0].reset(); // Reset the form
                } else {
                    $responseContainer.html('<p class="error-message">' + response.data + '</p>');
                }
            },
            error: function () {
                try {
                    // Push error event to dataLayer
                    dataLayer.push({
                        event: 'long_contact_form_submission',
                        formID: 'customContactForm',
                        formAction: 'submit_contact_form',
                        formStatus: 'error',
                    });
                } catch (error) {
                    console.error('Failed to push data to dataLayer:', error);
                }
                $responseContainer.html('<p class="error-message">An error occurred. Please try again later.</p>');
            },
            complete: function () {
                $button.prop('disabled', false); // Re-enable the submit button
            },
        });
    });
});
