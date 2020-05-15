<?php
	//echo pmpro_shortcode_account('');


global $wpdb, $pmpro_msg, $pmpro_msgt, $pmpro_levels, $current_user, $levels, $atts;
	
	// $atts    ::= array of attributes
	// $content ::= text within enclosing form of shortcode element
	// $code    ::= the shortcode found, when == callback name
	// examples: [pmpro_account] [pmpro_account sections="membership,profile"/]

	extract(shortcode_atts(array(
		'section' => '',
		'sections' => 'membership,profile,invoices,links'		
	), $atts));
	
	//did they use 'section' instead of 'sections'?
	if(!empty($section))
		$sections = $section;

	//Extract the user-defined sections for the shortcode
	$sections = array_map('trim',explode(",",$sections));	
	ob_start();
	
	//if a member is logged in, show them some info here (1. past invoices. 2. billing information with button to update.)
	if(pmpro_hasMembershipLevel())
	{
		$ssorder = new MemberOrder();
		$ssorder->getLastMemberOrder();
		$mylevels = pmpro_getMembershipLevelsForUser();
		$pmpro_levels = pmpro_getAllLevels(false, true); // just to be sure - include only the ones that allow signups
		$invoices = $wpdb->get_results("SELECT *, UNIX_TIMESTAMP(timestamp) as timestamp FROM $wpdb->pmpro_membership_orders WHERE user_id = '$current_user->ID' AND status NOT IN('refunded', 'review', 'token', 'error') ORDER BY timestamp DESC LIMIT 6");
		?>	

		
	
		<div id="pmpro_account">		
			
			<?php if(in_array('profile', $sections)) { ?>
				<div id="pmpro_account-profile" class="pmpro_box">
					
					<?php wp_get_current_user(); ?> 
					<h3><?php _e("My Account", "pmpro");?></h3>
					<div class="content_wrap full_width">
						<?php if($current_user->user_firstname) { ?>
							<p><?php echo $current_user->user_firstname?> <?php echo $current_user->user_lastname?></p>
						<?php } ?>
						<ul>
							<?php do_action('pmpro_account_bullets_top');?>
							<li><strong><?php _e("Username", "pmpro");?>:</strong> <?php echo $current_user->user_login?></li>
							<li><strong><?php _e("Email", "pmpro");?>:</strong> <?php echo $current_user->user_email?></li>
							<?php do_action('pmpro_account_bullets_bottom');?>
						</ul>
					</div><!-- content_wrap -->
					<div class="pmpro_actionlinks">
						<a class="button black" href="<?php echo home_url()?>/membership-account/your-profile/"><?php _e("Edit Profile", "pmpro");?></a>
						<a class="button yellow" href="<?php echo home_url()?>/reset-password/"><?php _e('Change Password', 'pmpro');?></a>
					</div>
				</div> <!-- end pmpro_account-profile -->
			<?php } ?>
			<?php if(in_array('membership', $sections) || in_array('memberships', $sections)) { ?>
				<div id="pmpro_account-membership" class="pmpro_box">
					
					<h3><?php _e("My Membership", "pmpro");?></h3>
					<div class="content_wrap full_width <?php if(!$current_user->user_firstname){ echo "noname";} ?>">
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<!--	<thead>
								<tr>
									<th><?php _e("Level", "pmpro");?></th>
									<th><?php _e("Billing", "pmpro"); ?></th>
									<th><?php _e("Expiration", "pmpro"); ?></th>
								</tr>
							</thead>-->
							<tbody>
								<?php
									foreach($mylevels as $level) {
								?>
								<tr>
									<!--td class="pmpro_account-membership-levelname">
										<?php echo $level->name?>
									</td>-->
									<td class="status_row">
										<p class="label">Status:</p>
										<p class="status">Active</p>
									</td>
									<td class="pmpro_account-membership-levelfee">
										<p class="label"><?php _e("Billing", "pmpro"); ?>:</p>
										<?php $levelCost = pmpro_getLevelCost($level, true, true);
										
											if (strpos($levelCost, 'your payment will be ')) :
												$levelCost = strstr($levelCost, 'your payment will be '); 
										?>
												<p class="cost"><?php echo str_replace("your payment will be ", "", $levelCost); ?></p>
											<?php else : ?>
												
												<p class="cost"><?php echo $levelCost; ?></p>
											<?php endif; ?>
												
									</td>
									<!--<td class="pmpro_account-membership-expiration">
									<?php 
										if($level->enddate) 
											echo date(get_option('date_format'), $level->enddate);
										else
											echo "---";
									?>
									</td>-->
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div><!-- cotent_wrap -->
					<div class="pmpro_actionlinks">
						<?php do_action("pmpro_member_action_links_before"); ?>
						
						<?php if( array_key_exists($level->id, $pmpro_levels) && pmpro_isLevelExpiringSoon( $level ) ) { ?>
							<a href="<?php echo pmpro_url("checkout", "?level=" . $level->id, "https")?>"><?php _e("Renew", "pmpro");?></a>
						<?php } ?>

						<?php //if((isset($ssorder->status) && $ssorder->status == "success") && (isset($ssorder->gateway) && in_array($ssorder->gateway, array("authorizenet", "paypal", "stripe", "braintree", "payflow", "cybersource")))) { ?>
						<a class="button black" href="<?php echo pmpro_url("billing", "", "https")?>"><?php _e("Update Billing Info", "pmpro"); ?></a>
						<?php //} ?>
						
						<?php
							//To do: Only show CHANGE link if this level is in a group that has upgrade/downgrade rules
							if(count($pmpro_levels) > 1 && !defined("PMPRO_DEFAULT_LEVEL")) { 
								
								if ($level->id < 4) {
							?>
								<a class="button yellow" href="<?php echo pmpro_url("levels")?>"><?php _e("Upgrade", "pmpro");?></a>
						
						<?php   }
							} ?>
						<a class="button red" href="<?php echo pmpro_url("cancel", "?levelstocancel=" . $level->id)?>"><?php _e("Cancel", "pmpro");?></a>
						<?php do_action("pmpro_member_action_links_after"); ?>
					</div> <!-- end pmpro_actionlinks -->
					<?php //Todo: If there are multiple levels defined that aren't all in the same group defined as upgrades/downgrades ?>
					<!--<div class="pmpro_actionlinks">
						<a href="<?php echo pmpro_url("levels")?>"><?php _e("View all Membership Options", "pmpro");?></a>
					</div>-->
	
				</div> <!-- end pmpro_account-membership -->
			<?php } ?>
		<!--
			<?php if(in_array('invoices', $sections) && !empty($invoices)) { ?>		
			<div id="pmpro_account-invoices" class="pmpro_box">
				<h3><?php _e("Past Invoices", "pmpro");?></h3>
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<thead>
						<tr>
							<th><?php _e("Date", "pmpro"); ?></th>
							<th><?php _e("Level", "pmpro"); ?></th>
							<th><?php _e("Amount", "pmpro"); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$count = 0;
						foreach($invoices as $invoice) 
						{ 
							if($count++ > 4)
								break;
	
							//get an member order object
							$invoice_id = $invoice->id;
							$invoice = new MemberOrder;
							$invoice->getMemberOrderByID($invoice_id);
							$invoice->getMembershipLevel();						
							?>
							<tr id="pmpro_account-invoice-<?php echo $invoice->code; ?>">
								<td><a href="<?php echo pmpro_url("invoice", "?invoice=" . $invoice->code)?>"><?php echo date(get_option("date_format"), $invoice->timestamp)?></td>
								<td><?php if(!empty($invoice->membership_level)) echo $invoice->membership_level->name; else echo __("N/A", "pmpro");?></td>
								<td><?php echo pmpro_formatPrice($invoice->total)?></td>
							</tr>
							<?php 
						}
					?>
					</tbody>
				</table>						
				<?php if($count == 6) { ?>
					<div class="pmpro_actionlinks"><a href="<?php echo pmpro_url("invoice"); ?>"><?php _e("View All Invoices", "pmpro");?></a></div>
				<?php } ?>
			</div> <!-- end pmpro_account-invoices -->
			<?php } ?>
			
			<?php /*if(in_array('links', $sections) && (has_filter('pmpro_member_links_top') || has_filter('pmpro_member_links_bottom'))) { */?><!--
			<div id="pmpro_account-links" class="pmpro_box">
				<h3><?php /*_e("Member Links", "pmpro");*/?></h3>
				<ul>
					<?php /*
						do_action("pmpro_member_links_top");
					*/?>
					
					<?php /*
						do_action("pmpro_member_links_bottom");
					*/?>
				</ul>
			</div> <!-- end pmpro_account-links -->
			<?php /*} */?>
		</div> <!-- end pmpro_account -->

	<?php
	}

?>