<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function h5ab_click_settings() {

    $h5abClickColor = ( isset ( $_POST['h5ab-click-color'] ) ) ? trim(strip_tags($_POST['h5ab-click-color'])) : null;
    $h5abClickDelay = ( isset ( $_POST['h5ab-click-delay'] ) ) ? trim(strip_tags($_POST['h5ab-click-delay'])) : null;
    $h5abClickSize = ( isset ( $_POST['h5ab-click-size'] ) ) ? trim(strip_tags($_POST['h5ab-click-size'])) : null;
    $h5abClickDisableInput = ( isset ( $_POST['h5ab-click-disable-input'] ) ) ? trim(strip_tags($_POST['h5ab-click-disable-input'])) : null;

    $h5abClickColor = sanitize_text_field($h5abClickColor);
    $h5abClickDelay = sanitize_text_field($h5abClickDelay);
    $h5abClickSize = sanitize_text_field($h5abClickSize);

    $h5abClickArray = array (
        "h5ab-click-color" => $h5abClickColor,
        "h5ab-click-delay" => $h5abClickDelay,
        "h5ab-click-size" => $h5abClickSize,
        "h5ab-click-disable-input" => $h5abClickDisableInput
    );

    $updated = update_option( 'h5abClickArray', $h5abClickArray);
	$message = ($updated) ? 'Settings successfully saved' : 'Settings could not be saved';
	$response = array('success' => esc_attr($updated), 'message' => esc_attr($message));

    return $response;

}

?>
