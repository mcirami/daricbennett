<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<div class="tml tml-profile" id="theme-my-login<?php $template->the_instance(); ?>">
		<?php $template->the_action_template_message( 'profile' ); ?>
		<?php $template->the_errors(); ?>
		<form id="your-profile" class="full_width" action="<?php $template->the_action_url( 'profile', 'login_post' ); ?>" method="post">
			<?php wp_nonce_field( 'update-user_' . $current_user->ID ); ?>

			<input type="hidden" name="from" value="profile" />
			<input type="hidden" name="checkuser_id" value="<?php echo $current_user->ID; ?>" />

            <?php if ( apply_filters( 'show_admin_bar', true ) || has_action( 'personal_options' ) ) : ?>
			    <h3><?php _e( 'Personal Options', 'theme-my-login' ); ?></h3>
	
            <!--	<table class="tml-form-table">
                <?php //if ( apply_filters( 'show_admin_bar', true ) ) : ?>
                    <tr class="tml-user-admin-bar-front-wrap">
                        <th><label for="admin_bar_front"><?php _e( 'Toolbar', 'theme-my-login' )?></label></th>
                        <td>
                            <label for="admin_bar_front"><input type="checkbox" name="admin_bar_front" id="admin_bar_front" value="1"<?php checked( _get_admin_bar_pref( 'front', $profileuser->ID ) ); ?> />
                            <?php //_e( 'Show Toolbar when viewing site', 'theme-my-login' ); ?></label>
                        </td>
                    </tr>
                <?php //endif; ?>
                <?php do_action( 'personal_options', $profileuser ); ?>
                </table>-->
            <?php endif; ?>
	
			<?php do_action( 'profile_personal_options', $profileuser ); ?>
	
			<h3><?php _e( 'Name', 'theme-my-login' ); ?></h3>
			<div class="top_section full_width">
				<div class="image_wrap">
					
					<?php
					        global $current_user;
                            $current_user = wp_get_current_user();
					        echo get_avatar( $current_user->ID, 400 );
					        
					 ?>
					
					<tr class="tml-user-login-wrap">
						<th><label for="user_login"><?php _e( 'Username:', 'theme-my-login' ); ?></label></th>
						<td><input type="text" name="user_login" id="user_login" value="<?php echo esc_attr( $profileuser->user_login ); ?>" disabled="disabled" class="regular-text" /> <span class="description"><?php _e( '(Usernames cannot be changed.)', 'theme-my-login' ); ?></span></td>
					</tr>
				</div>
				
				<table class="tml-form-table user_info">
				
		
					<tr class="tml-first-name-wrap">
						<th><label for="first_name"><?php _e( 'First Name', 'theme-my-login' ); ?></label></th>
						<td><input type="text" name="first_name" id="first_name" value="<?php echo esc_attr( $profileuser->first_name ); ?>" class="regular-text" /></td>
					</tr>
			
					<tr class="tml-last-name-wrap">
						<th><label for="last_name"><?php _e( 'Last Name', 'theme-my-login' ); ?></label></th>
						<td><input type="text" name="last_name" id="last_name" value="<?php echo esc_attr( $profileuser->last_name ); ?>" class="regular-text" /></td>
					</tr>
			
					<tr class="tml-nickname-wrap">
						<th><label for="nickname"><?php _e( 'Nickname', 'theme-my-login' ); ?> <span class="description"><?php _e( '(required)', 'theme-my-login' ); ?></span></label></th>
						<td><input type="text" name="nickname" id="nickname" value="<?php echo esc_attr( $profileuser->nickname ); ?>" class="regular-text" /></td>
					</tr>
					
					<tr class="tml-user-email-wrap">
						<th><label for="email"><?php _e( 'E-mail', 'theme-my-login' ); ?> <span class="description"><?php _e( '(required)', 'theme-my-login' ); ?></span></label></th>
						<td><input type="text" name="email" id="email" value="<?php echo esc_attr( $profileuser->user_email ); ?>" class="regular-text" /></td>
						<?php
						$new_email = get_option( $current_user->ID . '_new_email' );
						if ( $new_email && $new_email['newemail'] != $current_user->user_email ) : ?>
						<div class="updated inline">
						<p><?php
							printf(
								__( 'There is a pending change of your e-mail to %1$s. <a href="%2$s">Cancel</a>', 'theme-my-login' ),
								'<code>' . $new_email['newemail'] . '</code>',
								esc_url( self_admin_url( 'profile.php?dismiss=' . $current_user->ID . '_new_email' ) )
						); ?></p>
						</div>
						<?php endif; ?>
					</tr>
					<tr class="experience">
						<th><label for="experience">Experience</label></th>
						<td>
							<select name="experience" id="experience">
								<option <?php if ($profileuser->experience == "0-2 years") {echo "selected";} ?> >0-2 years</option>
								<option <?php if ($profileuser->experience == "3-5 years") {echo "selected";} ?> >3-5 years</option>
								<option <?php if ($profileuser->experience == "6-10 years") {echo "selected";} ?> >6-10 years</option>
								<option <?php if ($profileuser->experience == "10+ years") {echo "selected";} ?> >10+ years</option>
							</select>
						</td>
						</td>
					<tr>
					
					<tr class="tml-display-name-wrap">
						<th><label for="display_name"><?php _e( 'Display name publicly as', 'theme-my-login' ); ?></label></th>
						<td>
							<select name="display_name" id="display_name">
							<?php
								$public_display = array();
								$public_display['display_nickname']  = $profileuser->nickname;
								$public_display['display_username']  = $profileuser->user_login;
			
								if ( ! empty( $profileuser->first_name ) )
									$public_display['display_firstname'] = $profileuser->first_name;
			
								if ( ! empty( $profileuser->last_name ) )
									$public_display['display_lastname'] = $profileuser->last_name;
			
								if ( ! empty( $profileuser->first_name ) && ! empty( $profileuser->last_name ) ) {
									$public_display['display_firstlast'] = $profileuser->first_name . ' ' . $profileuser->last_name;
									$public_display['display_lastfirst'] = $profileuser->last_name . ' ' . $profileuser->first_name;
								}
			
								if ( ! in_array( $profileuser->display_name, $public_display ) )// Only add this if it isn't duplicated elsewhere
									$public_display = array( 'display_displayname' => $profileuser->display_name ) + $public_display;
			
								$public_display = array_map( 'trim', $public_display );
								$public_display = array_unique( $public_display );
			
								foreach ( $public_display as $id => $item ) {
							?>
								<option <?php selected( $profileuser->user_login, $item ); ?>><?php echo $item; ?></option>
							<?php
								}
							?>
							</select>
						</td>
					</tr>
					<!--
					<tr class="tml-user-url-wrap">
						<th><label for="url"><?php //_e( 'Website', 'theme-my-login' ); ?></label></th>
						<td><input type="text" name="url" id="url" value="<?php //echo esc_attr( $profileuser->user_url ); ?>" class="regular-text code" /></td>
					</tr>
					-->
					<?php
						foreach ( wp_get_user_contact_methods() as $name => $desc ) {
					?>
					<tr class="tml-user-contact-method-<?php echo $name; ?>-wrap">
						<th><label for="<?php echo $name; ?>"><?php echo apply_filters( 'user_'.$name.'_label', $desc ); ?></label></th>
						<td><input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo esc_attr( $profileuser->$name ); ?>" class="regular-text" /></td>
					</tr>
					<?php
						}
					?>
				</table>	
			</div>
	
			<h3><?php _e( 'Contact Info', 'theme-my-login' ); ?></h3>

			<?php do_action( 'show_user_profile', $profileuser ); ?>

			<?php
				$show_password_fields = apply_filters( 'show_password_fields', true, $profileuser );
				if ( $show_password_fields ) :
				?>
				<h3><?php _e( 'Account Management', 'theme-my-login' ); ?></h3>
				<table id="update-password" class="tml-form-table password">
				<tr id="password" class="user-pass1-wrap">
					<th><label for="pass1"><?php _e( 'New Password', 'theme-my-login' ); ?></label></th>
					<td>
						<input class="hidden" value=" " /><!-- #24364 workaround -->
						<button type="button" class="button button-secondary wp-generate-pw hide-if-no-js"><?php _e( 'Update Password', 'theme-my-login' ); ?></button>
						<div class="wp-pwd hide-if-js">
							<span class="password-input-wrapper">
								<input type="password" name="pass1" id="pass1" class="regular-text" value="" autocomplete="off" data-pw="<?php //echo esc_attr( wp_generate_password( 24 ) ); ?>" aria-describedby="pass-strength-result" />
							</span>
							<div style="display:none" id="pass-strength-result" aria-live="polite"></div>
							<div class="full_width">
								<div class="pw-weak">
									<div><?php _e( 'Confirm Password', 'theme-my-login' ); ?></div>
									<div>
										<label>
											<input type="checkbox" name="pw_weak" class="pw-checkbox" />
											<?php _e( 'Confirm use of weak password', 'theme-my-login' ); ?>
										</label>
									</div>
								</div>
								<div class="button_wrap">
									<button type="button" class="button button-secondary wp-hide-pw" data-toggle="0" aria-label="<?php esc_attr_e( 'Hide password', 'theme-my-login' ); ?>">
										<span class="dashicons dashicons-hidden"></span>
										<span class="text"><?php _e( 'Hide', 'theme-my-login' ); ?></span>
									</button>
									<button type="button" class="button button-secondary wp-cancel-pw" data-toggle="0" aria-label="<?php esc_attr_e( 'Cancel password change', 'theme-my-login' ); ?>">
										<span class="text"><?php _e( 'Cancel', 'theme-my-login' ); ?></span>
									</button>
								</div>
							</div>
						</div>
					</td>
				</tr>
				<tr class="user-pass2-wrap">
					<th scope="row"><label for="pass2"><?php _e( 'Repeat New Password', 'theme-my-login' ); ?></label></th>
					<td>
					<input name="pass2" type="password" id="pass2" class="regular-text" value="" autocomplete="off" />
					<p class="description"><?php _e( 'Type your new password again.', 'theme-my-login' ); ?></p>
					</td>
				</tr>
				
				
				<?php endif; ?>
		
				</table>
				
			<h3><?php _e( 'About Yourself', 'theme-my-login' ); ?></h3>
			<table class="tml-form-table description">
			<tr class="bass_wrap half_width">
				<th><label for="bass_guitars"><?php _e( 'Bass Guitar/s', 'theme-my-login' ); ?></label></th>
				<td><input type="text" name="bass_guitars" id="bass_guitars" value="<?php echo esc_attr($profileuser->bass_guitars); ?>" class="regular-text" /></td>
			</tr>
			<tr class="amp_wrap half_width right">
				<th><label for="bass_amps"><?php _e( 'Bass Amp/s', 'theme-my-login' ); ?></label></th>
				<td><input type="text" name="bass_amps" id="bass_amps" value="<?php echo esc_attr($profileuser->bass_amps); ?>" class="regular-text" /></td>
			</tr>
			<tr class="tml-user-description-wrap">
				<th><label for="description"><?php _e( 'About Me', 'theme-my-login' ); ?></label></th>
				<td><textarea name="description" id="description" rows="5" cols="30"><?php echo esc_html( $profileuser->description ); ?></textarea><br />
				<span class="description"><?php _e( 'Tell other members about yourself and your bass playing. This info will be shown in your public Bass Nation Profile.', 'theme-my-login' ); ?></span></td>
			</tr>
	
			</table>
	
			<p class="tml-submit-wrap">
				<input type="hidden" name="action" value="profile" />
				<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
				<input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr( $current_user->ID ); ?>" />
				<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Update Profile', 'theme-my-login' ); ?>" name="submit" id="submit" />
			</p>
		</form>
	</div>

