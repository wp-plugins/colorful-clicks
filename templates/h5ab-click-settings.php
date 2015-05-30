<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$h5abClickArray = get_option('h5abClickArray');
?>

<div id="h5ab-click-container">

    <h1>Settings</h1>

	<form id="h5ab-click" method="post" enctype="multipart/form-data">

        <div class="h5ab-click-settings">

            <p>
            <label class="main-label">Color:</label>
            <input type="text" value="<?php echo esc_attr($h5abClickArray['h5ab-click-color']); ?>" class="h5ab-click-color" name="h5ab-click-color" />
            </p>

            <p>
            <label class="main-label">Animation Time:</label>
            <input type="text" value="<?php echo esc_attr($h5abClickArray['h5ab-click-delay']); ?>" name="h5ab-click-delay" /><label>Seconds</label>
            </p>

            <p>
            <label class="main-label">Size (Width and Height):</label>
            <input type="text" value="<?php echo esc_attr($h5abClickArray['h5ab-click-size']); ?>" name="h5ab-click-size" /><label>px</label>
            </p>

            <p>
            <input type="checkbox" value="true" id="h5ab-click-disable-input" name="h5ab-click-disable-input" <?php if (esc_attr($h5abClickArray['h5ab-click-disable-input']) == true) {echo 'checked';} ?> />
            <label class="main-label" for="h5ab-click-disable-input">Disable on Input Fields</label>
            </p>

        </div>

		<?php
			wp_nonce_field( 'h5ab_click_settings_n', 'h5ab_click_settings_nonce' );
			if ( ! is_admin() ) {
			echo 'Only Admin Users Can Update These Options';
			} else {
			echo '<input type="submit"  class="button button-primary show_field" id="h5ab_click_settings_submit" name="h5ab_click_settings_submit" value="Save and Activate" />';
			}
		?>

	</form>

</div>

<div class="h5ab-affiliate-advert">
                    <p style="margin: 0; text-align: center;">Advertisement</p>
                    <a href="http://themeover.com/microthemer?ap_id=html5andbeyond" target="_blank"><img src="<?php echo esc_url(plugins_url( '../images/MT_300x250.png', __FILE__ )) ?>" border="0" style="max-width: 100%; height: auto;" /></a>
                    <p style="margin: 0;">*Affiliate Link</p>

</div>

<hr/>

<div style="width: 98%; padding: 0 5px;">
<p>*Affiliate Link - We (Plugin Authors) earn commission on sales generated through this link.</p>
</div>

<script>
jQuery(document).ready(function($) {

    $('.h5ab-click-color').spectrum({
        showInput: true,
        clickoutFiresChange: true,
        preferredFormat: 'hex'
    });

});
</script>
