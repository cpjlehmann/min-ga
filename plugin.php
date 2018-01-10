<?php 
/*	
Plugin Name: Minimalist Google Analytics
Description: Minimalist Google Analytics plugin.
Author: Christopher Lehmann
Version: 1.0
*/

function min_ga() { ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', '<?php echo esc_attr( get_option('ua_code') ); ?>', 'auto');
  ga('send', 'pageview');
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
