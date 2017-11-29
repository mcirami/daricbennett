<?php

/**
 * User Details
 *
 * @package bbPress
 * @subpackage Theme
 */

	$url = $_SERVER["REQUEST_URI"]; 
	$isMailbox = strpos($url, 'mailbox');
	$current_user = wp_get_current_user();
	$username = $current_user->user_login;
	$isCurrentUser = strpos($url, $username);
?>

	<?php do_action( 'bbp_template_before_user_details' ); ?>

	<div id="bbp-single-user-details">
		<div class="forums_home full_width">
			<a href="/forums">Forums Home</a>
		</div>
		<div id="bbp-user-navigation">
			
			
			<div class="nav_wrap <?php if ($isCurrentUser) { echo "current_user";}?>">
				<div class="user_mobile_nav">
					<p>Forum Menu <span>+</span></p>
				</div>
				<ul>
					<li class="<?php if ( bbp_is_single_user_profile() && ($isMailbox == false)) :?>current<?php endif; ?>">
						<span class="vcard bbp-user-profile-link">
							<a class="url fn n" href="<?php bbp_user_profile_url(); ?>" title="<?php printf( esc_attr__( "%s's Profile", 'bbpress' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>" rel="me"><?php _e( 'Profile', 'bbpress' ); ?></a>
						</span>
					</li>
					<li class="BPT-tab tab-messages">
						<span></span>
					</li>
					<!--
					<?php if ($isCurrentUser) { ?>
						<li class="inbox <?php if ($isMailbox !== false) {echo "current";} ?>">
							<span class="vcard bbp-user-profile-link">
								<a href="<?php echo "/forums/users/" . $username . "/mailbox" ?>">Inbox</a>
							</span>
						</li>
					<?php } ?>
					-->
					<li class="<?php if ( bbp_is_single_user_topics() ) :?>current<?php endif; ?>">
						<span class='bbp-user-topics-created-link'>
							<a href="<?php bbp_user_topics_created_url(); ?>" title="<?php printf( esc_attr__( "%s's Topics Started", 'bbpress' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><?php if ($isCurrentUser) { _e( 'My Topics', 'bbpress' ); } else {  _e( 'Topics Started', 'bbpress' ); } ?></a>
						</span>
					</li>
	
					<li class="<?php if ( bbp_is_single_user_replies() ) :?>current<?php endif; ?>">
						<span class='bbp-user-replies-created-link'>
							<a href="<?php bbp_user_replies_created_url(); ?>" title="<?php printf( esc_attr__( "%s's Replies Created", 'bbpress' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><?php if ($isCurrentUser) { _e( 'My Replies', 'bbpress' ); } else {  _e( 'Replies Created', 'bbpress' ); } ?></a>
						</span>
					</li>
	
					<?php if ( bbp_is_favorites_active() ) : ?>
						<li class="<?php if ( bbp_is_favorites() ) :?>current<?php endif; ?>">
							<span class="bbp-user-favorites-link">
								<a href="<?php bbp_favorites_permalink(); ?>" title="<?php printf( esc_attr__( "%s's Favorites", 'bbpress' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><?php _e( 'Favorites', 'bbpress' ); ?></a>
							</span>
						</li>
					<?php endif; ?>
	
					<?php //if ( bbp_is_user_home() || current_user_can( 'edit_users' ) ) : ?>
	
						<?php if ( bbp_is_subscriptions_active() ) : ?>
							<li class="<?php if ( bbp_is_subscriptions() ) :?>current<?php endif; ?>">
								<span class="bbp-user-subscriptions-link">
									<a href="<?php bbp_subscriptions_permalink(); ?>" title="<?php printf( esc_attr__( "%s's Subscriptions", 'bbpress' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><?php if ($isCurrentUser) { _e( 'Subscribed', 'bbpress' ); } else {  _e( 'Subscriptions', 'bbpress' ); } ?></a>
								</span>
							</li>
						<?php endif; ?>
						<!--
						<li class="<?php if ( bbp_is_single_user_edit() ) :?>current<?php endif; ?>">
							<span class="bbp-user-edit-link">
								<a href="<?php bbp_user_profile_edit_url(); ?>" title="<?php printf( esc_attr__( "Edit %s's Profile", 'bbpress' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><?php _e( 'Edit', 'bbpress' ); ?></a>
							</span>
						</li>
						-->
					<?php //endif; ?>
	
				</ul>
			</div>
		</div><!-- #bbp-user-navigation -->
		
		<?php if ( bbp_is_single_user_profile() && $isMailbox == false) : ?>
			<div id="bbp-user-avatar">
	
				<span class='vcard'>
					<a class="url fn n" href="<?php bbp_user_profile_url(); ?>" title="<?php bbp_displayed_user_field( 'display_name' ); ?>" rel="me">
						<?php echo get_avatar( bbp_get_displayed_user_field( 'user_email', 'raw' ), apply_filters( 'bbp_single_user_details_avatar_size', 150 ) ); ?>
					</a>
				</span>
	
			</div><!-- #author-avatar -->
		<?php endif; ?>
	
		<div id="bbp-user-body" class="<?php if ( bbp_is_single_user_profile() ) { echo "profile_body"; } if ($isMailbox !== false) { echo " mailbox"; } ?>">
			<?php if ( bbp_is_favorites()                 ) bbp_get_template_part( 'user', 'favorites'       ); ?>
			<?php if ( bbp_is_subscriptions()             ) bbp_get_template_part( 'user', 'subscriptions'   ); ?>
			<?php if ( bbp_is_single_user_topics()        ) bbp_get_template_part( 'user', 'topics-created'  ); ?>
			<?php if ( bbp_is_single_user_replies()       ) bbp_get_template_part( 'user', 'replies-created' ); ?>
			<?php if ( bbp_is_single_user_edit()          ) bbp_get_template_part( 'form', 'user-edit'       ); ?>
			<?php if ( bbp_is_single_user_profile()       ) bbp_get_template_part( 'user', 'profile'         ); ?>
		</div>
			

		
		
	</div><!-- #bbp-single-user-details -->

	<?php do_action( 'bbp_template_after_user_details' ); ?>
