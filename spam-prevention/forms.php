<form id="customContactForm" class="contact-form" aria-label="<?php esc_attr_e('Contact Us', 'web-lifter'); ?>">
    <!-- Honeypot Field -->
    <input 
        type="text" 
        name="honeypot" 
        id="honeypot" 
        style="display:none;" 
        tabindex="-1" 
        autocomplete="off"
    />

    <!-- Full Name -->
    <div class="formGroup">
        <label for="fullName" class="visually-hidden"><?php esc_html_e('Full Name', 'web-lifter'); ?></label>
        <input 
            type="text" 
            id="fullName" 
            name="full_name" 
            class="inputField" 
            placeholder="<?php esc_attr_e('Full Name', 'web-lifter'); ?>" 
            required 
            maxlength="100"
        />
    </div>

    <!-- Company -->
    <div class="formGroup">
        <label for="company" class="visually-hidden"><?php esc_html_e('Company', 'web-lifter'); ?></label>
        <input 
            type="text" 
            id="company" 
            name="company" 
            class="inputField" 
            placeholder="<?php esc_attr_e('Company', 'web-lifter'); ?>" 
            maxlength="100"
        />
    </div>

    <!-- Email -->
    <div class="formGroup">
        <label for="email" class="visually-hidden"><?php esc_html_e('Email', 'web-lifter'); ?></label>
        <input 
            type="email" 
            id="email" 
            name="email" 
            class="inputField" 
            placeholder="<?php esc_attr_e('Email', 'web-lifter'); ?>" 
            required 
        />
    </div>

    <!-- Phone Number -->
    <div class="formGroup">
        <label for="phoneNumber" class="visually-hidden"><?php esc_html_e('Phone Number', 'web-lifter'); ?></label>
        <input 
            type="tel" 
            id="phoneNumber" 
            name="phone_number" 
            class="inputField" 
            placeholder="<?php esc_attr_e('(000) 000-0000', 'web-lifter'); ?>" 
            maxlength="15"
        />
    </div>

    <!-- Message -->
    <div class="formGroup">
        <label for="message" class="visually-hidden"><?php esc_html_e('Message', 'web-lifter'); ?></label>
        <textarea 
            id="message" 
            name="message" 
            class="inputField" 
            placeholder="<?php esc_attr_e('What can we help you with?', 'web-lifter'); ?>" 
            required 
            maxlength="500"
        ></textarea>
    </div>

    <!-- Form Token -->
    <input type="hidden" name="form_token" value="<?php echo esc_attr(wp_create_nonce('custom_contact_form')); ?>">

    <!-- Submit Button -->
    <div class="formGroup">
        <button type="submit" class="submitButton">
            <?php esc_html_e('Get in touch', 'web-lifter'); ?>
        </button>
    </div>
</form>
<div id="contactFormResponse" class="form-response"></div>
