<?php
function addAtfReqPlugins() {
    return array(
        array(
            'name'      => 'Advanced Custom Fields',
            'slug'      => 'advanced-custom-fields',
            'required'  => true,
        ),
        array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => true,
        ),
        array(
            'name'      => 'Really simple Captcha',
            'slug'      => 'really-simple-captcha',
            'required'  => true,
        ),
        array(
            'name'      => 'User Frontend',
            'slug'      => 'user-frontend',
            'required'  => true,
        ),
        array(
            'name'               => 'Atfolio', // The plugin name.
            'slug'               => 'atfolio', // The plugin slug (typically the folder name).
            'source'             => get_template_directory() . '/atf/plugins/atfolio.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),
    );
}