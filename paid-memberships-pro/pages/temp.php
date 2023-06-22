<?php
/**
 * Template: Checkout
 *
 * See documentation for how to override the PMPro templates.
 * @link https://www.paidmembershipspro.com/documentation/templates/
 *
 * @version 2.0
 *
 * @author Paid Memberships Pro
 */

global $gateway, $pmpro_review, $skip_account_fields, $pmpro_paypal_token, $wpdb, $current_user, $pmpro_msg, $pmpro_msgt, $pmpro_requirebilling, $pmpro_level, $pmpro_levels, $tospage, $pmpro_show_discount_code, $pmpro_error_fields;
global $discount_code, $username, $password, $password2, $bfirstname, $blastname, $baddress1, $baddress2, $bcity, $bstate, $bzipcode, $bcountry, $bphone, $bemail, $bconfirmemail, $CardType, $AccountNumber, $ExpirationMonth,$ExpirationYear;

/**
 * Filter to set if PMPro uses email or text as the type for email field inputs.
 *
 * @since 1.8.4.5
 *
 * @param bool $use_email_type, true to use email type, false to use text type
 */
$pmpro_email_field_type = apply_filters('pmpro_email_field_type', true);

// Set the wrapping class for the checkout div based on the default gateway;
$default_gateway = pmpro_getOption( 'gateway' );
if ( empty( $default_gateway ) ) {
	$pmpro_checkout_gateway_class = 'pmpro_checkout_gateway-none';
} else {
	$pmpro_checkout_gateway_class = 'pmpro_checkout_gateway-' . $default_gateway;
}

$checkoutLevel = $_GET["level"];

$protocol = $_SERVER['HTTPS'] == '' ? 'http://' : 'https://';
$webroot = $protocol . $_SERVER['HTTP_HOST'] . '/';

?>
<div class="form_wrapper full_width">
	<div class="column">
		<div class="top_section full_width">
			<h2>Ready to join Bass Nation?</h2>
			<div class="list full_width">
				<p><span>1</span>Join RISK FREE with our 3-Day Free Trial Offer!</p>
				<?php if ($checkoutLevel == 1) : ?>
					<p><span>2</span>Then Only $9.99/mo to keep your Membership!</p>
					<p><span>3</span>Skyrocket your bass playing for less than $0.35/day!</p>
				<?php elseif ($checkoutLevel == 2) : ?>
					<p><span>2</span>Then Only $28.99/3 months to keep your Membership!</p>
					<p><span>3</span>Skyrocket your bass playing for less than $0.33/day!</p>
				<?php elseif ($checkoutLevel == 3) : ?>
					<p><span>2</span>Then Only $54.99/6 months to keep your Membership!</p>
					<p><span>3</span>Skyrocket your bass playing for less than $0.31/day!</p>
				<?php elseif ($checkoutLevel == 4) : ?>
					<p><span>2</span>Then Only $99.99/yr to keep your Membership!</p>
					<p><span>3</span>Skyrocket your bass playing for less than $0.28/day!</p>
				<?php endif; ?>
			</div>
		</div>
		<div id="left_checkout_column" class="column_content full_width">
			<h3>Check Out Everything Included In Your Membership</h3>
			<div class="row_wrap">
				<div class="row full_width">
					<div class="image_wrap">
						<img src="<?php  echo esc_url( get_template_directory_uri() ); ?>/images/icon-form-advanced-new.png" alt="">
					</div>
					<div class="copy">
						<h3>NEW Advanced Lesson Every Week</h3>
						<p>Each week Daric will release a brand new Full Lesson for every member of Bass Nation!</p>
					</div>
				</div><!-- row -->
				<div class="row full_width">
					<div class="image_wrap">
						<img src="<?php  echo esc_url( get_template_directory_uri() ); ?>/images/icon-form-forum.png" alt="">
					</div>
					<div class="copy">
						<h3>BASS NATION FORUM ACCESS</h3>
						<p>Full access to discuss bass with Daric and all other members of Bass Nation!</p>
					</div>
				</div><!-- row -->
			</div><!-- row_wrap -->
			<div class="row_wrap">
				<div class="row full_width">
					<div class="image_wrap">
						<img class="throwdown" src="<?php  echo esc_url( get_template_directory_uri() ); ?>/images/icon-form-throwdown.png" alt="">
					</div>
					<div class="copy">
						<h3>Daric's Throwdown</h3>
						<p>Groove and lick challenges that will help you get your chops up and stay up!</p>
					</div>
				</div><!-- row -->
				<div class="row full_width">
					<div class="image_wrap">
						<img src="<?php  echo esc_url( get_template_directory_uri() ); ?>/images/icon-form-free.png" />
					</div>
					<div class="copy">
						<h3>Full Lessons By Level</h3>
						<p>Get every complete lesson organized for you by skill level.</p>
					</div>
				</div><!-- row -->
			</div>
			<div class="row_wrap">
				<div class="row full_width">
					<div class="image_wrap">
						<img class="advanced" src="<?php  echo esc_url( get_template_directory_uri() ); ?>/images/icon-form-advanced.png" />
					</div>
					<div class="copy">
						<h3>Full Lessons By Date</h3>
						<p>Get every complete lesson organized for you by it's weekly release date.</p>
					</div>
				</div><!-- row -->
				<div class="row full_width">
					<div class="image_wrap">
						<img class="library" src="<?php  echo esc_url( get_template_directory_uri() ); ?>/images/icon-form-library.png" />
					</div>
					<div class="copy">
						<h3>Full Live Library</h3>
						<p>Watch all of Daric's live sessions in one place in chronological order.</p>
					</div>
				</div><!-- row -->
			</div>
			<div class="row_wrap">
				<div class="row full_width">
					<div class="image_wrap">
						<img class="army" src="<?php  echo esc_url( get_template_directory_uri() ); ?>/images/icon-form-throwdown-army.png" alt="">
					</div>
					<div class="copy">
						<h3>Bass Nation Throwdown</h3>
						<p>Want Daric and others to critique and jam on your grooves? Here's your chance to Throwdown!</p>
					</div>
				</div><!-- row -->
				<div class="row full_width">
					<div class="image_wrap">
						<img src="<?php  echo esc_url( get_template_directory_uri() ); ?>/images/icon-form-advanced-live.png" alt="">
					</div>
					<div class="copy">
						<h3>Live Advanced Lesson Review</h3>
						<p>Each week Daric will review the previous weeks lesson live in a Q&A session.</p>
					</div>
				</div><!-- row -->
			</div>
			<div class="row_wrap">
				<div class="row full_width">
					<div class="image_wrap">
						<img src="<?php  echo esc_url( get_template_directory_uri() ); ?>/images/icon-form-advanced-downloads.png" alt="">
					</div>
					<div class="copy">
						<h3>Forum Video Uploads</h3>
						<p>Upload any videos in forums to have your bass lines reviewed by Daric and the entire Bass Nation Community.</p>
					</div>
				</div><!-- row -->
			</div><!-- row_wrap -->
		</div><!-- column_content -->
		<div class="bottom_section full_width">
			<p>You owe it to yourself to take the next step and watch your playing skyrocket to the next level!</p>
		</div>
	</div><!-- column -->
	<div class="column">

		<div class="top_section full_width">
			<?php if ($checkoutLevel == 1) : ?>
				<h2>Free for 3 days - then only $9.99/mo!</h2>
			<?php elseif ($checkoutLevel == 2) : ?>
				<h2>Free for 3 days - then only $28.99/3 months!</h2>
			<?php elseif ($checkoutLevel == 3) : ?>
				<h2>Free for 3 days - then only $54.99/6 months!</h2>
			<?php elseif ($checkoutLevel == 4) : ?>
				<h2>Free for 3 days - then only $99.99/yr!</h2>
			<?php endif; ?>

			<div class="white_box full_width">
				<p>" Thanks in advance for starting your free trial! I look forward to learning, growing and sharing with you and everyone else in our amazing Bass Nation community! "</p>
			</div>
			<div class="sig full_width">
				<p>Daric Bennett, Bassist & Founder</p>
				<div class="image_wrap">
					<img src="<?php  echo esc_url( get_template_directory_uri() ); ?>/images/icon-form-daric.png" />
				</div>
			</div>
		</div><!-- top_section -->

		<?php do_action('pmpro_checkout_before_form'); ?>

		<div id="pmpro_level-<?php echo $pmpro_level->id; ?>" class="<?php echo pmpro_get_element_class( $pmpro_checkout_gateway_class, 'pmpro_level-' . $pmpro_level->id ); ?>">
			<form id="pmpro_form" class="<?php echo pmpro_get_element_class( 'pmpro_form', 'checkout_page' ); ?>" action="<?php if(!empty($_REQUEST['review'])) echo pmpro_url("checkout", "?level=" . $pmpro_level->id); ?>" method="post">
				<input type="hidden" id="level" name="level" value="<?php echo esc_attr($pmpro_level->id) ?>" />
				<input type="hidden" id="checkjavascript" name="checkjavascript" value="1" />
				<div class="red_border_wrap full_width">
					<?php if ($discount_code && $pmpro_review) { ?>
						<input class="<?php echo pmpro_get_element_class( 'input pmpro_alter_price', 'discount_code' ); ?>" id="discount_code" name="discount_code" type="hidden" size="20" value="<?php echo esc_attr($discount_code) ?>" />
					<?php } ?>

					<?php if($pmpro_msg) { ?>
						<div id="pmpro_message" class="<?php echo pmpro_get_element_class( 'pmpro_message ' . $pmpro_msgt, $pmpro_msgt ); ?>">
							<?php echo apply_filters( 'pmpro_checkout_message', $pmpro_msg, $pmpro_msgt ) ?>
						</div>
					<?php } else { ?>
						<div id="pmpro_message" class="<?php echo pmpro_get_element_class( 'pmpro_message' ); ?>" style="display: none;"></div>
					<?php } ?>

					<?php if($pmpro_review) { ?>
						<p><?php _e('Almost done. Review the membership information and pricing below then <strong>click the "Complete Payment" button</strong> to finish your order.', 'paid-memberships-pro' );?></p>
					<?php } ?>

					<?php
					$include_pricing_fields = apply_filters( 'pmpro_include_pricing_fields', true );
					if ( $include_pricing_fields ) {
						?>
						<div id="pmpro_pricing_fields" class="<?php echo pmpro_get_element_class( 'pmpro_checkout', 'pmpro_pricing_fields' ); ?>">
							<h3>
								<span class="<?php echo pmpro_get_element_class( 'pmpro_checkout-h3-name' ); ?>"><?php _e('Membership Level', 'paid-memberships-pro' );?></span>
								<?php if(count($pmpro_levels) > 1) { ?><span class="<?php echo pmpro_get_element_class( 'pmpro_checkout-h3-msg' ); ?>"><a href="<?php echo pmpro_url("levels"); ?>"><?php _e('change', 'paid-memberships-pro' );?></a></span><?php } ?>
							</h3>
							<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-fields' ); ?>">
								<p class="no_show">
									<?php printf(__('You have selected the <strong>%s</strong> membership level.', 'paid-memberships-pro' ), $pmpro_level->name);?>
								</p>

								<?php
								/**
								 * All devs to filter the level description at checkout.
								 * We also have a function in includes/filters.php that applies the the_content filters to this description.
								 * @param string $description The level description.
								 * @param object $pmpro_level The PMPro Level object.
								 */
								$level_description = apply_filters('pmpro_level_description', $pmpro_level->description, $pmpro_level);
								if ( ! empty( $level_description ) ) { ?>
									<div class="<?php echo pmpro_get_element_class( 'pmpro_level_description_text' );?>">
										<?php echo $level_description; ?>
									</div>
									<?php
								}
								?>


								<div id="pmpro_level_cost">
									<?php if($discount_code && pmpro_checkDiscountCode($discount_code)) { ?>
										<?php printf(__('<p class="' . pmpro_get_element_class( 'pmpro_level_discount_applied' ) . '">The <strong>%s</strong> code has been applied to your order.</p>', 'paid-memberships-pro' ), $discount_code);?>
									<?php } ?>
									<?php
									$level_cost_text = pmpro_getLevelCost( $pmpro_level );
									if ( ! empty( $level_cost_text ) ) { ?>
										<div class="<?php echo pmpro_get_element_class( 'pmpro_level_cost_text' );?>">
											<?php echo wpautop( $level_cost_text ); ?>
										</div>
									<?php }
									?>

									<?php
									$level_expiration_text = pmpro_getLevelExpiration( $pmpro_level );
									if ( ! empty( $level_expiration_text ) ) { ?>
										<div class="<?php echo pmpro_get_element_class( 'pmpro_level_expiration_text' );?>">
											<?php echo wpautop( $level_expiration_text ); ?>
										</div>
									<?php }
									?>
								</div> <!-- end #pmpro_level_cost -->

								<?php do_action("pmpro_checkout_after_level_cost"); ?>

								<div class="discount_form">
									<?php if($pmpro_show_discount_code) { ?>

										<?php if($discount_code && !$pmpro_review) { ?>
											<p id="other_discount_code_p" class="<?php echo pmpro_get_element_class( 'pmpro_small', 'other_discount_code_p' ); ?>"><a id="other_discount_code_a" href="#discount_code"><?php _e('Click here to change your discount code.', 'paid-memberships-pro' );?></a></p>
										<?php } elseif(!$pmpro_review) { ?>
											<p id="other_discount_code_p" class="<?php echo pmpro_get_element_class( 'pmpro_small', 'other_discount_code_p' ); ?>"><?php _e('Do you have a discount code?', 'paid-memberships-pro' );?> <a id="other_discount_code_a" href="#discount_code"><?php _e('Click here to enter your discount code', 'paid-memberships-pro' );?></a>.</p>
										<?php } elseif($pmpro_review && $discount_code) { ?>
											<p><strong><?php _e('Discount Code', 'paid-memberships-pro' );?>:</strong> <?php echo $discount_code?></p>
										<?php } ?>

									<?php } ?>

									<?php if($pmpro_show_discount_code) { ?>

										<div id="other_discount_code_tr" style="display: none;">
											<label for="other_discount_code"><?php _e('Discount Code', 'paid-memberships-pro' );?></label>
											<input id="other_discount_code" name="other_discount_code" type="text" class="<?php echo pmpro_get_element_class( 'input pmpro_alter_price', 'other_discount_code' ); ?>" size="20" value="<?php echo esc_attr($discount_code); ?>" />
											<input type="button" name="other_discount_code_button" id="other_discount_code_button" value="<?php _e('Apply', 'paid-memberships-pro' );?>" />
										</div>

									<?php } ?>
								</div><!-- end discount_form -->
							</div> <!-- end pmpro_checkout-fields -->
						</div> <!-- end pmpro_pricing_fields -->
						<?php
					} // if ( $include_pricing_fields )
					?>

					<?php
					do_action('pmpro_checkout_after_pricing_fields');
					?>

					<?php if(!$skip_account_fields && !$pmpro_review) { ?>

						<?php
						// Get discount code from URL parameter, so if the user logs in it will keep it applied.
						$discount_code_link = !empty( $discount_code) ? '&discount_code=' . $discount_code : '';
						?>
						<div id="pmpro_user_fields" class="<?php echo pmpro_get_element_class( 'pmpro_checkout', 'pmpro_user_fields' ); ?>">

							<h3>
								<span class="<?php echo pmpro_get_element_class( 'pmpro_checkout-h3-name' ); ?>"><?php _e('Account Information', 'paid-memberships-pro' );?></span>
								<span class="<?php echo pmpro_get_element_class( 'pmpro_checkout-h3-msg' ); ?>"><?php _e('Already have an account?', 'paid-memberships-pro' );?> <a href="<?php echo wp_login_url( apply_filters( 'pmpro_checkout_login_redirect', pmpro_url("checkout", "?level=" . $pmpro_level->id . $discount_code_link) ) ); ?>"><?php _e('Log in here', 'paid-memberships-pro' );?></a></span>
							</h3>
							<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-fields' ); ?> user_info">
								<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-field pmpro_checkout-field-username', 'pmpro_checkout-field-username' ); ?>">
									<label for="username"><?php _e('Username', 'paid-memberships-pro' );?></label>
									<input id="username" name="username" type="text" class="<?php echo pmpro_get_element_class( 'input', 'username' ); ?>" size="30" value="<?php echo esc_attr($username); ?>" />
								</div> <!-- end pmpro_checkout-field-username -->

								<?php
								do_action('pmpro_checkout_after_username');
								?>

								<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-field pmpro_checkout-field-password', 'pmpro_checkout-field-password' ); ?>">
									<label for="password"><?php _e('Password', 'paid-memberships-pro' );?></label>
									<input id="password" name="password" type="password" class="<?php echo pmpro_get_element_class( 'input', 'password' ); ?>" size="30" value="<?php echo esc_attr($password); ?>" />
								</div> <!-- end pmpro_checkout-field-password -->

								<?php
								$pmpro_checkout_confirm_password = apply_filters("pmpro_checkout_confirm_password", true);
								if($pmpro_checkout_confirm_password) { ?>
									<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-field pmpro_checkout-field-password2', 'pmpro_checkout-field-password2' ); ?>">
										<label for="password2"><?php _e('Confirm Password', 'paid-memberships-pro' );?></label>
										<input id="password2" name="password2" type="password" class="<?php echo pmpro_get_element_class( 'input', 'password2' ); ?>" size="30" value="<?php echo esc_attr($password2); ?>" />
									</div> <!-- end pmpro_checkout-field-password2 -->
								<?php } else { ?>
									<input type="hidden" name="password2_copy" value="1" />
								<?php }
								?>

								<?php
								do_action('pmpro_checkout_after_password');
								?>

								<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-field pmpro_checkout-field-bemail', 'pmpro_checkout-field-bemail' ); ?>">
									<label for="bemail"><?php _e('Email Address', 'paid-memberships-pro' );?></label>
									<input id="bemail" name="bemail" type="<?php echo ($pmpro_email_field_type ? 'email' : 'text'); ?>" class="<?php echo pmpro_get_element_class( 'input', 'bemail' ); ?>" size="30" value="<?php echo esc_attr($bemail); ?>" />
								</div> <!-- end pmpro_checkout-field-bemail -->

								<?php
								$pmpro_checkout_confirm_email = apply_filters("pmpro_checkout_confirm_email", true);
								if($pmpro_checkout_confirm_email) { ?>
									<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-field pmpro_checkout-field-bconfirmemail', 'pmpro_checkout-field-bconfirmemail' ); ?>">
										<label for="bconfirmemail"><?php _e('Confirm Email Address', 'paid-memberships-pro' );?></label>
										<input id="bconfirmemail" name="bconfirmemail" type="<?php echo ($pmpro_email_field_type ? 'email' : 'text'); ?>" class="<?php echo pmpro_get_element_class( 'input', 'bconfirmemail' ); ?>" size="30" value="<?php echo esc_attr($bconfirmemail); ?>" />
									</div> <!-- end pmpro_checkout-field-bconfirmemail -->
								<?php } else { ?>
									<input type="hidden" name="bconfirmemail_copy" value="1" />
								<?php }
								?>

								<?php
								do_action('pmpro_checkout_after_email');
								?>

								<div class="<?php echo pmpro_get_element_class( 'pmpro_hidden' ); ?>">
									<label for="fullname"><?php _e('Full Name', 'paid-memberships-pro' );?></label>
									<input id="fullname" name="fullname" type="text" class="<?php echo pmpro_get_element_class( 'input', 'fullname' ); ?>" size="30" value="" autocomplete="off"/> <strong><?php _e('LEAVE THIS BLANK', 'paid-memberships-pro' );?></strong>
								</div> <!-- end pmpro_hidden -->

							</div>  <!-- end pmpro_checkout-fields -->
						</div> <!-- end pmpro_user_fields -->
					<?php } elseif($current_user->ID && !$pmpro_review) { ?>
						<div id="pmpro_account_loggedin" class="<?php echo pmpro_get_element_class( 'pmpro_message pmpro_alert', 'pmpro_account_loggedin' ); ?>">
							<?php printf(__('You are logged in as <strong>%s</strong>. If you would like to use a different account for this membership, <a href="%s">log out now</a>.', 'paid-memberships-pro' ), $current_user->user_login, wp_logout_url($_SERVER['REQUEST_URI'])); ?>
						</div> <!-- end pmpro_account_loggedin -->
					<?php } ?>

					<?php
					do_action('pmpro_checkout_after_user_fields');
					?>

					<?php
					do_action('pmpro_checkout_boxes');
					?>

					<?php if(pmpro_getGateway() == "paypal" && empty($pmpro_review) && true == apply_filters('pmpro_include_payment_option_for_paypal', true ) ) { ?>
						<div id="pmpro_payment_method" class="<?php echo pmpro_get_element_class( 'pmpro_checkout', 'pmpro_payment_method' ); ?>" <?php if(!$pmpro_requirebilling) { ?>style="display: none;"<?php } ?>>
							<hr />
							<h3>
								<span class="<?php echo pmpro_get_element_class( 'pmpro_checkout-h3-name' ); ?>"><?php _e('Choose your Payment Method', 'paid-memberships-pro' ); ?></span>
							</h3>
							<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-fields' ); ?>">
						<span class="<?php echo pmpro_get_element_class( 'gateway_paypal' ); ?>">
							<input type="radio" name="gateway" value="paypal" <?php if(!$gateway || $gateway == "paypal") { ?>checked="checked"<?php } ?> />
							<a href="javascript:void(0);" class="<?php echo pmpro_get_element_class( 'pmpro_radio' ); ?>"><?php _e('Check Out with a Credit Card Here', 'paid-memberships-pro' );?></a>
						</span>
								<span class="<?php echo pmpro_get_element_class( 'gateway_paypalexpress' ); ?>">
							<input type="radio" name="gateway" value="paypalexpress" <?php if($gateway == "paypalexpress") { ?>checked="checked"<?php } ?> />
							<a href="javascript:void(0);" class="<?php echo pmpro_get_element_class( 'pmpro_radio' ); ?>"><?php _e('Check Out with PayPal', 'paid-memberships-pro' );?></a>
						</span>
							</div> <!-- end pmpro_checkout-fields -->
						</div> <!-- end pmpro_payment_method -->
					<?php } ?>

					<?php
					$pmpro_include_billing_address_fields = apply_filters('pmpro_include_billing_address_fields', true);
					if($pmpro_include_billing_address_fields) { ?>
						<div id="pmpro_billing_address_fields" class="<?php echo pmpro_get_element_class( 'pmpro_checkout', 'pmpro_billing_address_fields' ); ?>" <?php if(!$pmpro_requirebilling || apply_filters("pmpro_hide_billing_address_fields", false) ){ ?>style="display: none;"<?php } ?>>
							<hr />
							<h3>
								<span class="<?php echo pmpro_get_element_class( 'pmpro_checkout-h3-name' ); ?>"><?php _e('Billing Address', 'paid-memberships-pro' );?></span>
							</h3>
							<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-fields' ); ?>">
								<div class="half_width">
									<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-field pmpro_checkout-field-bfirstname', 'pmpro_checkout-field-bfirstname' ); ?>">
										<label for="bfirstname"><?php _e('First Name', 'paid-memberships-pro' );?></label>
										<input id="bfirstname" name="bfirstname" type="text" class="<?php echo pmpro_get_element_class( 'input', 'bfirstname' ); ?>" size="30" value="<?php echo esc_attr($bfirstname); ?>" />
									</div> <!-- end pmpro_checkout-field-bfirstname -->
								</div>
								<div class="half_width right">
									<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-field pmpro_checkout-field-blastname', 'pmpro_checkout-field-blastname' ); ?>">
										<label for="blastname"><?php _e('Last Name', 'paid-memberships-pro' );?></label>
										<input id="blastname" name="blastname" type="text" class="<?php echo pmpro_get_element_class( 'input', 'blastname' ); ?>" size="30" value="<?php echo esc_attr($blastname); ?>" />
									</div> <!-- end pmpro_checkout-field-blastname -->
								</div>
								<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-field pmpro_checkout-field-baddress1', 'pmpro_checkout-field-baddress1' ); ?>">
									<label for="baddress1"><?php _e('Address 1', 'paid-memberships-pro' );?></label>
									<input id="baddress1" name="baddress1" type="text" class="<?php echo pmpro_get_element_class( 'input', 'baddress1' ); ?>" size="30" value="<?php echo esc_attr($baddress1); ?>" />
								</div> <!-- end pmpro_checkout-field-baddress1 -->
								<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-field pmpro_checkout-field-baddress2', 'pmpro_checkout-field-baddress2' ); ?>">
									<label for="baddress2"><?php _e('Address 2', 'paid-memberships-pro' );?></label>
									<input id="baddress2" name="baddress2" type="text" class="<?php echo pmpro_get_element_class( 'input', 'baddress2' ); ?>" size="30" value="<?php echo esc_attr($baddress2); ?>" />
								</div> <!-- end pmpro_checkout-field-baddress2 -->
								<?php
								$longform_address = apply_filters("pmpro_longform_address", true);
								if($longform_address) { ?>
									<div class="half_width">
										<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-field pmpro_checkout-field-bcity', 'pmpro_checkout-field-bcity' ); ?>">
											<label for="bcity"><?php _e('City', 'paid-memberships-pro' );?></label>
											<input id="bcity" name="bcity" type="text" class="<?php echo pmpro_get_element_class( 'input', 'bcity' ); ?>" size="30" value="<?php echo esc_attr($bcity); ?>" />
										</div> <!-- end pmpro_checkout-field-bcity -->
									</div>
									<div class="half_width right">
										<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-field pmpro_checkout-field-bstate', 'pmpro_checkout-field-bstate' ); ?>">
											<label for="bstate"><?php _e('State', 'paid-memberships-pro' );?></label>
											<input id="bstate" name="bstate" type="text" class="<?php echo pmpro_get_element_class( 'input', 'bstate' ); ?>" size="30" value="<?php echo esc_attr($bstate); ?>" />
										</div> <!-- end pmpro_checkout-field-bstate -->
									</div>
									<div class="half_width">
										<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-field pmpro_checkout-field-bzipcode', 'pmpro_checkout-field-bzipcode' ); ?>">
											<label for="bzipcode"><?php _e('Postal Code', 'paid-memberships-pro' );?></label>
											<input id="bzipcode" name="bzipcode" type="text" class="<?php echo pmpro_get_element_class( 'input', 'bzipcode' ); ?>" size="30" value="<?php echo esc_attr($bzipcode); ?>" />
										</div> <!-- end pmpro_checkout-field-bzipcode -->
									</div>
								<?php } else { ?>
									<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-field pmpro_checkout-field-bcity_state_zip', 'pmpro_checkout-field-bcity_state_zip' ); ?>">
										<label for="bcity_state_zip' ); ?>"><?php _e('City, State Zip', 'paid-memberships-pro' );?></label>
										<input id="bcity" name="bcity" type="text" class="<?php echo pmpro_get_element_class( 'input', 'bcity' ); ?>" size="14" value="<?php echo esc_attr($bcity); ?>" />,
										<?php
										$state_dropdowns = apply_filters("pmpro_state_dropdowns", false);
										if($state_dropdowns === true || $state_dropdowns == "names") {
											global $pmpro_states;
											?>
											<select name="bstate" class="<?php echo pmpro_get_element_class( '', 'bstate' ); ?>">
												<option value="">--</option>
												<?php
												foreach($pmpro_states as $ab => $st) { ?>
													<option value="<?php echo esc_attr($ab);?>" <?php if($ab == $bstate) { ?>selected="selected"<?php } ?>><?php echo $st;?></option>
												<?php } ?>
											</select>
										<?php } elseif($state_dropdowns == "abbreviations") {
											global $pmpro_states_abbreviations;
											?>
											<select name="bstate" class="<?php echo pmpro_get_element_class( '', 'bstate' ); ?>">
												<option value="">--</option>
												<?php
												foreach($pmpro_states_abbreviations as $ab)
												{
													?>
													<option value="<?php echo esc_attr($ab);?>" <?php if($ab == $bstate) { ?>selected="selected"<?php } ?>><?php echo $ab;?></option>
												<?php } ?>
											</select>
										<?php } else { ?>
											<input id="bstate" name="bstate" type="text" class="<?php echo pmpro_get_element_class( 'input', 'bstate' ); ?>" size="2" value="<?php echo esc_attr($bstate); ?>" />
										<?php } ?>
										<input id="bzipcode" name="bzipcode" type="text" class="<?php echo pmpro_get_element_class( 'input', 'bzipcode' ); ?>" size="5" value="<?php echo esc_attr($bzipcode); ?>" />
									</div> <!-- end pmpro_checkout-field-bcity_state_zip -->
								<?php } ?>
								<div class="half_width right">
									<div id="country_drop"></div>
								</div>
								<?php
								$show_country = apply_filters("pmpro_international_addresses", true);
								if($show_country) { ?>
									<div class="half_width right">
										<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-field pmpro_checkout-field-bcountry', 'pmpro_checkout-field-bcountry' ); ?>">
											<label for="bcountry"><?php _e('Country', 'paid-memberships-pro' );?></label>
											<select name="bcountry" id="bcountry" class="<?php echo pmpro_get_element_class( '', 'bcountry' ); ?>">
												<?php
												global $pmpro_countries, $pmpro_default_country;
												if(!$bcountry) {
													$bcountry = $pmpro_default_country;
												}
												foreach($pmpro_countries as $abbr => $country) { ?>
													<option value="<?php echo $abbr?>" <?php if($abbr == $bcountry) { ?>selected="selected"<?php } ?>><?php echo $country?></option>
												<?php } ?>
											</select>
										</div> <!-- end pmpro_checkout-field-bcountry -->
									</div>
								<?php } else { ?>
									<input type="hidden" name="bcountry" value="US" />
								<?php } ?>
								<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-field pmpro_checkout-field-bphone', 'pmpro_checkout-field-bphone' ); ?>">
									<label for="bphone"><?php _e('Phone', 'paid-memberships-pro' );?></label>
									<input id="bphone" name="bphone" type="text" class="<?php echo pmpro_get_element_class( 'input', 'bphone' ); ?>" size="30" value="<?php echo esc_attr(formatPhone($bphone)); ?>" />
								</div> <!-- end pmpro_checkout-field-bphone -->
								<?php if($skip_account_fields) { ?>
									<?php
									if($current_user->ID) {
										if(!$bemail && $current_user->user_email) {
											$bemail = $current_user->user_email;
										}
										if(!$bconfirmemail && $current_user->user_email) {
											$bconfirmemail = $current_user->user_email;
										}
									}
									?>
									<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-field pmpro_checkout-field-bemail', 'pmpro_checkout-field-bemail' ); ?>">
										<label for="bemail"><?php _e('Email Address', 'paid-memberships-pro' );?></label>
										<input id="bemail" name="bemail" type="<?php echo ($pmpro_email_field_type ? 'email' : 'text'); ?>" class="<?php echo pmpro_get_element_class( 'input', 'bemail' ); ?>" size="30" value="<?php echo esc_attr($bemail); ?>" />
									</div> <!-- end pmpro_checkout-field-bemail -->
									<?php
									$pmpro_checkout_confirm_email = apply_filters("pmpro_checkout_confirm_email", true);
									if($pmpro_checkout_confirm_email) { ?>
										<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-field pmpro_checkout-field-bconfirmemail', 'pmpro_checkout-field-bconfirmemail' ); ?>">
											<label for="bconfirmemail"><?php _e('Confirm Email', 'paid-memberships-pro' );?></label>
											<input id="bconfirmemail" name="bconfirmemail" type="<?php echo ($pmpro_email_field_type ? 'email' : 'text'); ?>" class="<?php echo pmpro_get_element_class( 'input', 'bconfirmemail' ); ?>" size="30" value="<?php echo esc_attr($bconfirmemail); ?>" />
										</div> <!-- end pmpro_checkout-field-bconfirmemail -->
									<?php } else { ?>
										<input type="hidden" name="bconfirmemail_copy" value="1" />
									<?php } ?>
								<?php } ?>
							</div> <!-- end pmpro_checkout-fields -->
						</div> <!--end pmpro_billing_address_fields -->
					<?php } ?>

					<?php do_action("pmpro_checkout_after_billing_fields"); ?>

					<?php
					$pmpro_accepted_credit_cards = pmpro_getOption("accepted_credit_cards");
					$pmpro_accepted_credit_cards = explode(",", $pmpro_accepted_credit_cards);
					$pmpro_accepted_credit_cards_string = pmpro_implodeToEnglish($pmpro_accepted_credit_cards);
					?>

					<?php
					$pmpro_include_payment_information_fields = apply_filters("pmpro_include_payment_information_fields", true);
					if($pmpro_include_payment_information_fields) { ?>
						<div id="pmpro_payment_information_fields" class="<?php echo pmpro_get_element_class( 'pmpro_checkout', 'pmpro_payment_information_fields' ); ?>" <?php if(!$pmpro_requirebilling || apply_filters("pmpro_hide_payment_information_fields", false) ) { ?>style="display: none;"<?php } ?>>
							<hr />
							<h3>
								<span class="<?php echo pmpro_get_element_class( 'pmpro_checkout-h3-name' ); ?>"><?php _e('Payment Information', 'paid-memberships-pro' );?></span>
								<span class="<?php echo pmpro_get_element_class( 'pmpro_checkout-h3-msg' ); ?>"><?php printf(__('We Accept %s', 'paid-memberships-pro' ), $pmpro_accepted_credit_cards_string);?></span>
							</h3>
							<?php $sslseal = pmpro_getOption("sslseal"); ?>
							<?php if(!empty($sslseal)) { ?>
							<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-fields-display-seal' ); ?>">
								<?php } ?>
								<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-fields' ); ?>">
									<?php
									$pmpro_include_cardtype_field = apply_filters('pmpro_include_cardtype_field', false);
									if($pmpro_include_cardtype_field) { ?>
										<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-field pmpro_payment-card-type', 'pmpro_payment-card-type' ); ?>">
											<label for="CardType"><?php _e('Card Type', 'paid-memberships-pro' );?></label>
											<select id="CardType" name="CardType" class="<?php echo pmpro_get_element_class( '', 'CardType' ); ?>">
												<?php foreach($pmpro_accepted_credit_cards as $cc) { ?>
													<option value="<?php echo $cc; ?>" <?php if($CardType == $cc) { ?>selected="selected"<?php } ?>><?php echo $cc; ?></option>
												<?php } ?>
											</select>
										</div>
									<?php } else { ?>
										<input type="hidden" id="CardType" name="CardType" value="<?php echo esc_attr($CardType);?>" />
									<?php } ?>
									<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-field pmpro_payment-account-number', 'pmpro_payment-account-number' ); ?>">
										<label for="AccountNumber"><?php _e('Card Number', 'paid-memberships-pro' );?></label>
										<input id="AccountNumber" name="AccountNumber" class="<?php echo pmpro_get_element_class( 'input', 'AccountNumber' ); ?>" type="text" size="30" value="<?php echo esc_attr($AccountNumber); ?>" data-encrypted-name="number" autocomplete="off" />
									</div>
									<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-field pmpro_payment-expiration', 'pmpro_payment-expiration' ); ?>">
										<label for="ExpirationMonth"><?php _e('Expiration Date', 'paid-memberships-pro' );?></label>
										<select id="ExpirationMonth" name="ExpirationMonth" class="<?php echo pmpro_get_element_class( '', 'ExpirationMonth' ); ?>">
											<option value="01" <?php if($ExpirationMonth == "01") { ?>selected="selected"<?php } ?>>01</option>
											<option value="02" <?php if($ExpirationMonth == "02") { ?>selected="selected"<?php } ?>>02</option>
											<option value="03" <?php if($ExpirationMonth == "03") { ?>selected="selected"<?php } ?>>03</option>
											<option value="04" <?php if($ExpirationMonth == "04") { ?>selected="selected"<?php } ?>>04</option>
											<option value="05" <?php if($ExpirationMonth == "05") { ?>selected="selected"<?php } ?>>05</option>
											<option value="06" <?php if($ExpirationMonth == "06") { ?>selected="selected"<?php } ?>>06</option>
											<option value="07" <?php if($ExpirationMonth == "07") { ?>selected="selected"<?php } ?>>07</option>
											<option value="08" <?php if($ExpirationMonth == "08") { ?>selected="selected"<?php } ?>>08</option>
											<option value="09" <?php if($ExpirationMonth == "09") { ?>selected="selected"<?php } ?>>09</option>
											<option value="10" <?php if($ExpirationMonth == "10") { ?>selected="selected"<?php } ?>>10</option>
											<option value="11" <?php if($ExpirationMonth == "11") { ?>selected="selected"<?php } ?>>11</option>
											<option value="12" <?php if($ExpirationMonth == "12") { ?>selected="selected"<?php } ?>>12</option>
										</select><select id="ExpirationYear" name="ExpirationYear" class="<?php echo pmpro_get_element_class( '', 'ExpirationYear' ); ?>">
											<?php
											$num_years = apply_filters( 'pmpro_num_expiration_years', 10 );

											for($i = date_i18n("Y"); $i < intval( date_i18n("Y") ) + intval( $num_years ); $i++)
											{
												?>
												<option value="<?php echo $i?>" <?php if($ExpirationYear == $i) { ?>selected="selected"<?php } ?>><?php echo $i?></option>
												<?php
											}
											?>
										</select>
									</div>
									<?php
									$pmpro_show_cvv = apply_filters("pmpro_show_cvv", true);
									if($pmpro_show_cvv) { ?>
										<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-field pmpro_payment-cvv', 'pmpro_payment-cvv' ); ?>">
											<label for="CVV"><?php _e('Security Code (CVC)', 'paid-memberships-pro' );?></label>
											<input id="CVV" name="CVV" type="text" size="4" value="<?php if(!empty($_REQUEST['CVV'])) { echo esc_attr($_REQUEST['CVV']); }?>" class="<?php echo pmpro_get_element_class( 'input', 'CVV' ); ?>" />  <small>(<a href="javascript:void(0);" onclick="javascript:window.open('<?php echo pmpro_https_filter(PMPRO_URL); ?>/pages/popup-cvv.html','cvv','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=600, height=475');"><?php _e("what's this?", 'paid-memberships-pro' );?></a>)</small>
										</div>
									<?php } ?>
									<?php if($pmpro_show_discount_code) { ?>

										<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-field pmpro_payment-discount-code', 'pmpro_payment-discount-code' ); ?>">
											<label for="discount_code"><?php _e('Discount Code', 'paid-memberships-pro' );?></label>
											<input class="<?php echo pmpro_get_element_class( 'input pmpro_alter_price', 'discount_code' ); ?>" id="discount_code" name="discount_code" type="text" size="10" value="<?php echo esc_attr($discount_code); ?>" />
											<input type="button" id="discount_code_button" name="discount_code_button" value="<?php _e('Apply', 'paid-memberships-pro' );?>" />
											<p id="discount_code_message" class="<?php echo pmpro_get_element_class( 'pmpro_message', 'discount_code_message' ); ?>" style="display: none;"></p>
										</div>

									<?php } ?>
								</div> <!-- end pmpro_checkout-fields -->
								<?php if(!empty($sslseal)) { ?>
								<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-fields-rightcol pmpro_sslseal', 'pmpro_sslseal' ); ?>"><?php echo stripslashes($sslseal); ?></div>
							</div> <!-- end pmpro_checkout-fields-display-seal -->
						<?php } ?>
						</div> <!-- end pmpro_payment_information_fields -->
					<?php } ?>

					<?php do_action('pmpro_checkout_after_payment_information_fields'); ?>

					<?php if($tospage && !$pmpro_review) { ?>
						<div id="pmpro_tos_fields" class="<?php echo pmpro_get_element_class( 'pmpro_checkout', 'pmpro_tos_fields' ); ?>">
							<hr />
							<h3>
								<span class="<?php echo pmpro_get_element_class( 'pmpro_checkout-h3-name' ); ?>"><?php echo esc_html( $tospage->post_title );?></span>
							</h3>
							<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-fields' ); ?>">
								<div id="pmpro_license" class="<?php echo pmpro_get_element_class( 'pmpro_checkout-field', 'pmpro_license' ); ?>">
									<?php
									/**
									 * Hook to run formatting filters before displaying the content of your "Terms of Service" page at checkout.
									 *
									 * @since 2.4.1
									 *
									 * @param string $pmpro_tos_content The content of the post assigned as the Terms of Service page.
									 * @param string $tospage The post assigned as the Terms of Service page.
									 *
									 * @return string $pmpro_tos_content
									 */
									$pmpro_tos_content = apply_filters( 'pmpro_tos_content', do_shortcode( $tospage->post_content ), $tospage );
									echo $pmpro_tos_content;
									?>
								</div> <!-- end pmpro_license -->
								<?php
								if ( isset( $_REQUEST['tos'] ) ) {
									$tos = intval( $_REQUEST['tos'] );
								} else {
									$tos = "";
								}
								?>
								<label class="<?php echo pmpro_get_element_class( 'pmpro_label-inline pmpro_clickable', 'tos' ); ?>" for="tos">
									<input type="checkbox" name="tos" value="1" id="tos" <?php checked( 1, $tos ); ?> />
									<?php printf(__('I agree to the %s', 'paid-memberships-pro' ), $tospage->post_title);?>
								</label>
								<?php
								/**
								 * Allow adding text or more checkboxes after the Tos checkbox
								 * This is NOT intended to support multiple Tos checkboxes
								 *
								 * @since 2.8
								 */
								do_action( "pmpro_checkout_after_tos" );
								?>
							</div> <!-- end pmpro_checkout-fields -->
						</div> <!-- end pmpro_tos_fields -->
						<?php
					}
					?>

					<?php do_action("pmpro_checkout_after_tos_fields"); ?>

					<div class="<?php echo pmpro_get_element_class( 'pmpro_checkout-field pmpro_captcha', 'pmpro_captcha' ); ?>">
						<?php
						global $recaptcha, $recaptcha_publickey;
						if ( $recaptcha == 2 || $recaptcha == 1 ) {
							echo pmpro_recaptcha_get_html($recaptcha_publickey, NULL, true);
						}
						?>
					</div> <!-- end pmpro_captcha -->

					<?php
					do_action('pmpro_checkout_after_captcha');
					?>

				</div> <!-- red_border_wrap -->

				<?php do_action("pmpro_checkout_before_submit_button"); ?>

				<div class="<?php echo pmpro_get_element_class( 'pmpro_submit' ); ?>">

					<?php if ( $pmpro_msg ) { ?>
						<div id="pmpro_message_bottom" class="<?php echo pmpro_get_element_class( 'pmpro_message ' . $pmpro_msgt, $pmpro_msgt ); ?>"><?php echo $pmpro_msg; ?></div>
					<?php } else { ?>
						<div id="pmpro_message_bottom" class="<?php echo pmpro_get_element_class( 'pmpro_message' ); ?>" style="display: none;"></div>
					<?php } ?>

					<?php if($pmpro_review) { ?>

						<span id="pmpro_submit_span">
						<input type="hidden" name="confirm" value="1" />
						<input type="hidden" name="token" value="<?php echo esc_attr($pmpro_paypal_token); ?>" />
						<input type="hidden" name="gateway" value="<?php echo esc_attr($gateway); ?>" />
						<input type="submit" id="pmpro_btn-submit" class="<?php echo pmpro_get_element_class( 'pmpro_btn pmpro_btn-submit-checkout', 'pmpro_btn-submit-checkout' ); ?> button red" value="<?php _e('Complete Payment', 'paid-memberships-pro' );?> &raquo;" />
					</span>

					<?php } else { ?>

					<?php
					$pmpro_checkout_default_submit_button = apply_filters('pmpro_checkout_default_submit_button', true);
					if($pmpro_checkout_default_submit_button)
					{
					?>
						<span id="pmpro_submit_span">
							<input type="hidden" name="submit-checkout" value="1" />
							<input type="submit"  id="pmpro_btn-submit" class="<?php echo pmpro_get_element_class(  'pmpro_btn pmpro_btn-submit-checkout', 'pmpro_btn-submit-checkout' ); ?> button red" value="<?php if($pmpro_requirebilling) { _e('Submit and Check Out', 'paid-memberships-pro' ); } else { _e('Submit and Confirm', 'paid-memberships-pro' );}?>" />
						</span>
						<p class="terms">By clicking "Start Your Free Trial Today!" you agree to our <a target="_blank" href="<?php echo $webroot; ?>privacy">Privacy Policy</a>, <a target="_blank" href="<?php echo $webroot?>terms-of-use">Terms of Service</a> and <a target="_blank" href="<?php echo $webroot?>terms-of-use/#refund">Refund Policy</a>.
						<?php
						}
						?>

						<?php } ?>

						<span id="pmpro_processing_message" style="visibility: hidden;">
					<?php
					$processing_message = apply_filters("pmpro_processing_message", __("Processing...", 'paid-memberships-pro' ));
					echo $processing_message;
					?>
				</span>
				</div>
			</form>

			<?php do_action('pmpro_checkout_after_form'); ?>
		</div> <!-- end pmpro_level-ID -->
	</div>
</div><!-- form_wrapper -->