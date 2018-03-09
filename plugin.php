<?php 
/*	
Plugin Name: Minimalist Google Analytics
Description: Minimalist Google Analytics plugin.
Author: Christopher Lehmann
Version: 1.0
*/

function min_ga() { ?>

<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( get_option('ua_code') ); ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php echo esc_attr( get_option('ua_code') ); ?>');
</script>

<?php }
add_action( 'wp_head', 'min_ga', 10 );

add_action('admin_menu', 'min_ga_settings_menu');

function min_ga_settings_menu() {
	add_options_page('Minimalist Google Analytics', 'Min GA', 'manage_options', 'min-ga', 'min_ga_settings_page');
}

add_action('admin_init', 'min_ga_settings');

function min_ga_settings() {
	register_setting('min_ga_settings', 'ua_code');
}

function min_ga_settings_page() { ?>
<div class="wrap">
	<h2>Minimalist Google Analytics</h2>
	<form method="post" action="options.php">
		<?php settings_fields('min_ga_settings'); ?>
		<?php do_settings_sections('min_ga_settings'); ?>
		<table class="form-table">
			<tr>
				<th>Your Google Analytics UA Code</th>
				<td>
					<input type="text" name="ua_code" value="<?php echo esc_attr( get_option('ua_code') ); ?>">
				</td>
			</tr>
		</table>
		<?php submit_button(); ?>
	</form>
</div>
<?php } ?>
