<?php 
	$confirmLevel = $_GET["level"];
	
	if($confirmLevel == 1) : ?>
		
		
		<!-- Facebook Pixel Code -->
		<script>
		!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
		n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
		document,'script','https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '1092024584249788'); // Insert your pixel ID here.
		fbq('track', 'PageView');
		fbq('track', 'Purchase', {value: '9.99', currency: 'USD'});
		</script>
		<noscript><img height="1" width="1" style="display:none"
		src="https://www.facebook.com/tr?id=1092024584249788&ev=PageView&noscript=1"
		/></noscript>
		<!-- DO NOT MODIFY -->
		<!-- End Facebook Pixel Code -->
 
 <?php elseif ($confirmLevel == 2) : ?>
  		
  		<!-- Facebook Pixel Code -->
		<script>
		!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
		n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
		document,'script','https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '1092024584249788'); // Insert your pixel ID here.
		fbq('track', 'PageView');
		fbq('track', 'Purchase', {value: '28.99', currency: 'USD'});
		</script>
		<noscript><img height="1" width="1" style="display:none"
		src="https://www.facebook.com/tr?id=1092024584249788&ev=PageView&noscript=1"
		/></noscript>
		<!-- DO NOT MODIFY -->
		<!-- End Facebook Pixel Code -->
		
<?php elseif ($confirmLevel == 3) : ?>
		<!-- Facebook Pixel Code -->
		<script>
		!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
		n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
		document,'script','https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '1092024584249788'); // Insert your pixel ID here.
		fbq('track', 'PageView');
		fbq('track', 'Purchase', {value: '54.99', currency: 'USD'});
		</script>
		<noscript><img height="1" width="1" style="display:none"
		src="https://www.facebook.com/tr?id=1092024584249788&ev=PageView&noscript=1"
		/></noscript>
		<!-- DO NOT MODIFY -->
		<!-- End Facebook Pixel Code -->

<?php elseif ($confirmLevel == 4) : ?>
		
		<!-- Facebook Pixel Code -->
		<script>
		!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
		n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
		document,'script','https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '1092024584249788'); // Insert your pixel ID here.
		fbq('track', 'PageView');
		fbq('track', 'Purchase', {value: '99.99', currency: 'USD'});
		</script>
		<noscript><img height="1" width="1" style="display:none"
		src="https://www.facebook.com/tr?id=1092024584249788&ev=PageView&noscript=1"
		/></noscript>
		<!-- DO NOT MODIFY -->
		<!-- End Facebook Pixel Code -->

<?php endif; ?>

	
	<div class="confirmation_page full_width">

		<?php 
			global $wpdb, $current_user, $pmpro_invoice, $pmpro_msg, $pmpro_msgt;
			
			if($pmpro_msg)
			{
			?>
				<div class="pmpro_message <?php echo $pmpro_msgt?>"><?php echo $pmpro_msg?></div>
			<?php
			}
			
			if(empty($current_user->membership_level))
				$confirmation_message = "<p>" . __('Your payment has been submitted. Your membership will be activated shortly.', 'pmpro') . "</p>";
			else
				$confirmation_message = "<p class='heading'>" . sprintf(__('Thank you for joining Daric Bennett\'s Bass Nation. Your membership is <span>now active.</span>', 'pmpro'), get_bloginfo("name"), $current_user->membership_level->name) . "</p>";		
			/*
			//confirmation message for this level
			$level_message = $wpdb->get_var("SELECT l.confirmation FROM $wpdb->pmpro_membership_levels l LEFT JOIN $wpdb->pmpro_memberships_users mu ON l.id = mu.membership_id WHERE mu.status = 'active' AND mu.user_id = '" . $current_user->ID . "' LIMIT 1");
			if(!empty($level_message))
				$confirmation_message .= "\n" . stripslashes($level_message) . "\n";*/
		?>	
		
		<?php if(!empty($pmpro_invoice) && !empty($pmpro_invoice->id)) { ?>		
			
			<?php
				$pmpro_invoice->getUser();
				$pmpro_invoice->getMembershipLevel();			
						
				$confirmation_message .= "<p>" . sprintf(__('Below are details about your Bass Nation membership. An email has also been sent to you confirming your membership.', 'pmpro'), $pmpro_invoice->user->user_email) . "</p>";
				
				//check instructions
				if($pmpro_invoice->gateway == "check" && !pmpro_isLevelFree($pmpro_invoice->membership_level))
					$confirmation_message .= wpautop(pmpro_getOption("instructions"));
				
				/**
				 * All devs to filter the confirmation message.
				 * We also have a function in includes/filters.php that applies the the_content filters to this message.
				 * @param string $confirmation_message The confirmation message.
				 * @param object $pmpro_invoice The PMPro Invoice/Order object.
				 */
				$confirmation_message = apply_filters("pmpro_confirmation_message", $confirmation_message, $pmpro_invoice);				
				
				echo $confirmation_message;
			?>
			
			<!--
			<h3>
				<?php printf(__('Invoice #%s on %s', 'pmpro'), $pmpro_invoice->code, date_i18n(get_option('date_format'), $pmpro_invoice->timestamp));?>		
			</h3>
			
			<a class="pmpro_a-print" href="javascript:window.print()"><?php _e('Print', 'pmpro');?></a>-->
			<ul>
				<?php do_action("pmpro_invoice_bullets_top", $pmpro_invoice); ?>
				<li><p><?php _e('Account', 'pmpro');?>:</p> <span><?php echo $current_user->user_email?></span></li>
				<li><p><?php _e('Membership Level', 'pmpro');?>:</p> <span><?php echo $current_user->membership_level->name?></span></li>
				<!--<?php if($current_user->membership_level->enddate) { ?>
					<li><strong><?php _e('Membership Expires', 'pmpro');?>:</strong> <?php echo date_i18n(get_option('date_format'), $current_user->membership_level->enddate)?></li>
				<?php } ?>
				<?php if($pmpro_invoice->getDiscountCode()) { ?>
					<li><strong><?php _e('Discount Code', 'pmpro');?>:</strong> <?php echo $pmpro_invoice->discount_code->code?></li>
				<?php } ?>
				<?php do_action("pmpro_invoice_bullets_bottom", $pmpro_invoice); ?>
				-->
			</ul>
			<div class="button_wrap full_width">
				<a class="button black" href="/member-home">Go To My Home Page</a>
			</div>
			<!--
			<table id="pmpro_confirmation_table" class="pmpro_invoice" width="100%" cellpadding="0" cellspacing="0" border="0">
				<thead>
					<tr>
						<?php if(!empty($pmpro_invoice->billing->name)) { ?>
						<th><?php _e('Billing Address', 'pmpro');?></th>
						<?php } ?>
						<th><?php _e('Payment Method', 'pmpro');?></th>
						<th><?php _e('Membership Level', 'pmpro');?></th>
						<th><?php _e('Total Billed', 'pmpro');?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php if(!empty($pmpro_invoice->billing->name)) { ?>
						<td>
							<?php echo $pmpro_invoice->billing->name?><br />
							<?php echo $pmpro_invoice->billing->street?><br />						
							<?php if($pmpro_invoice->billing->city && $pmpro_invoice->billing->state) { ?>
								<?php echo $pmpro_invoice->billing->city?>, <?php echo $pmpro_invoice->billing->state?> <?php echo $pmpro_invoice->billing->zip?> <?php echo $pmpro_invoice->billing->country?><br />												
							<?php } ?>
							<?php echo formatPhone($pmpro_invoice->billing->phone)?>
						</td>
						<?php } ?>
						<td>
							<?php if($pmpro_invoice->accountnumber) { ?>
								<?php echo $pmpro_invoice->cardtype?> <?php _e('ending in', 'pmpro');?> <?php echo last4($pmpro_invoice->accountnumber)?><br />
								<small><?php _e('Expiration', 'pmpro');?>: <?php echo $pmpro_invoice->expirationmonth?>/<?php echo $pmpro_invoice->expirationyear?></small>
							<?php } elseif($pmpro_invoice->payment_type) { ?>
								<?php echo $pmpro_invoice->payment_type?>
							<?php } ?>
						</td>
						<td><?php echo $pmpro_invoice->membership_level->name?></td>					
						<td><?php if($pmpro_invoice->total) echo pmpro_formatPrice($pmpro_invoice->total); else echo "---";?></td>
					</tr>
				</tbody>
			</table>		-->
		<?php 
			} 
			else 
			{
				$confirmation_message .= "<p>" . sprintf(__('Below are details about your membership account. A welcome email has been sent to %s.', 'pmpro'), $current_user->user_email) . "</p>";
				
				/**
				 * All devs to filter the confirmation message.
				 * Documented above.
				 * We also have a function in includes/filters.php that applies the the_content filters to this message.		 
				 */
				$confirmation_message = apply_filters("pmpro_confirmation_message", $confirmation_message, false);
				
				echo $confirmation_message;
			?>	
			<ul>
				<li><?php _e('Account', 'pmpro');?>:<?php echo $current_user->display_name?> (<?php echo $current_user->user_email?>)</li>
				<li><?php _e('Membership Level', 'pmpro');?>: <?php if(!empty($current_user->membership_level)) echo $current_user->membership_level->name; else _e("Pending", "pmpro");?></li>
			</ul>
			<div class="button_wrap full_width">
				<a class="button black" href="/member-home">Go To My Home Page</a>
			</div>
			
		<?php 
			} 
		?>  
		<!--
		<nav id="nav-below" class="navigation" role="navigation">
			<div class="nav-next alignright">
				<?php if(!empty($current_user->membership_level)) { ?>
					<a href="<?php echo pmpro_url("account")?>"><?php _e('View Your Membership Account &rarr;', 'pmpro');?></a>
				<?php } else { ?>
					<?php _e('If your account is not activated within a few minutes, please contact the site owner.', 'pmpro');?>
				<?php } ?>
			</div>
		</nav>
		-->
	</div><!-- confirmation_page -->


<script>
	
	createCookie("subscribed-member", "success", 5000);
	
	function createCookie(name, value, days) {
	    var expires;
	    if (days) {
	        var date = new Date();
	        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
	        expires = "; expires=" + date.toGMTString();
	    }
	    else {
	        expires = "";
	    }
	    document.cookie = name + "=" + value + expires + "; path=/";
	}
</script>
