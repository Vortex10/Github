<?php


// Add custom validation for text fields
add_filter('wpcf7_validate_text*', 'custom_cf7_text_validation', 20, 2);

function custom_cf7_text_validation($result, $tag) {
    $name = $tag['name'];

    // Custom validation for 'your-name'
    if ($name === 'your-name') {
        if (empty($_POST['your-name'])) {
            $result->invalidate($tag, "Please enter your full name.");
        } elseif (strlen(trim($_POST['your-name'])) < 5) {
            $result->invalidate($tag, "Your name must be at least 5 characters.");
        }
    }

    // Custom validation for 'your-location'
    if ($name === 'your-location') {
        if (empty($_POST['your-location'])) {
            $result->invalidate($tag, "Please enter your location.");
        } elseif (strlen(trim($_POST['your-location'])) < 2) {
            $result->invalidate($tag, "Your location must be at least 2 characters.");
        }
    }

    return $result;
}

// Add custom validation for email fields
add_filter('wpcf7_validate_email*', 'custom_cf7_email_validation', 20, 2);

function custom_cf7_email_validation($result, $tag) {
    $name = $tag['name'];

    if ($name === 'your-email' && !filter_var($_POST['your-email'], FILTER_VALIDATE_EMAIL)) {
        $result->invalidate($tag, "Please enter a valid email address.");
    }

    return $result;
}

// Add custom validation for acceptance fields
add_filter('wpcf7_validate_acceptance', 'custom_cf7_acceptance_validation', 20, 2);

function custom_cf7_acceptance_validation($result, $tag) {
    $name = $tag['name'];

    if ($name === 'acceptance-943' && empty($_POST['acceptance-943'])) {
        $result->invalidate($tag, "You must accept the terms to proceed.");
    }

    return $result;
}

?>