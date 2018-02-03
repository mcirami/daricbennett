<?php 
global $wpdb, $pmpro_msg, $pmpro_msgt, $current_user;

$pmpro_levels = pmpro_getAllLevels(false, true);
$pmpro_level_order = pmpro_getOption('level_order');

if(!empty($pmpro_level_order))
{
	$order = explode(',',$pmpro_level_order);

	//reorder array
	$reordered_levels = array();
	foreach($order as $level_id) {
		foreach($pmpro_levels as $key=>$level) {
			if($level_id == $level->id)
				$reordered_levels[] = $pmpro_levels[$key];
		}
	}

	$pmpro_levels = $reordered_levels;
}

$pmpro_levels = apply_filters("pmpro_levels_array", $pmpro_levels);

if($pmpro_msg)
{
?>
<div class="pmpro_message <?php echo $pmpro_msgt?>"><?php echo $pmpro_msg?></div>
<?php
}
?>
<div id="pmpro_levels_table" class="pmpro_checkout">
 <!-- <div class="full_width heading">
	  <div class="first_column">
		  <h3><?php _e('Level', 'pmpro');?></h3>
	  </div>
	  <div class="second_column">
		  <h3><?php _e('Price', 'pmpro');?></h3>
	  </div>
  </div>
-->
	<?php	
	$count = 0;
	//$days = NULL;
	foreach($pmpro_levels as $level)
	{
	  if(isset($current_user->membership_level->ID))
		  $current_level = ($current_user->membership_level->ID == $level->id);
	  else
		  $current_level = false;
	?>
	<div class="column">
		<div class="full_width <?php if($count++ % 2 == 0) { ?>odd<?php } ?><?php if($current_level == $level) { ?> active<?php } ?>">
			<?php if ($level->id == 4) : ?>
				<div class="highlight">
					<img src="<?php echo bloginfo('template_url'); ?>/images/bass-clef.png" /><p>Most Bass For Your Buck!</p>
				</div>
			<?php endif; ?>
			<div class="column_heading full_width">
				<!--<h2><?php /*echo $current_level ? "<strong>{$level->name}</strong>" : $level->name*/?></h2>-->
				<?php if ($level->id == 1) :
					//$days = 3;
				?>
					<!--<p>With FREE 3-Day Trial</p>-->
                    <h2>FREE 3 Day Trial</h2>
                    <p>then only $9.99/month</p>
				<?php elseif ($level->id == 2 ) :
					//$days = 5;
				?>
					<!--<p>With FREE 5-Day Trial</p>-->
                    <h2>FREE 3 Day Trial</h2>
                    <p>then only $28.99/3 months</p>
				<?php elseif ($level->id == 3) :
					//$days = 7;
				?>
					<!--<p>With FREE 7-Day Trial</p>-->
                    <h2>FREE 3 Day Trial</h2>
                    <p>then only $54.99/6 months</p>
				<?php elseif ($level->id == 4) :
					//$days = 14;
				?>
					<!--<p>14 Day Free Trial!</p>-->
                    <h2>FREE 3 Day Trial</h2>
                    <p>then only $99.99/year</p>
				<?php endif; ?>
			</div>
			<!--
				<p>
					<?php 
						if(pmpro_isLevelFree($level))
							$cost_text = "<strong>" . __("Free", "pmpro") . "</strong>";
						else
							$cost_text = pmpro_getLevelCost($level, true, true); 
						$expiration_text = pmpro_getLevelExpiration($level);
						if(!empty($cost_text) && !empty($expiration_text))
							echo $cost_text . "<br />" . $expiration_text;
						elseif(!empty($cost_text))
							echo $cost_text;
						elseif(!empty($expiration_text))
							echo $expiration_text;
					?>
			</p>
			-->
		</div>
		<div class="full_width cost">
			<!--<h3><?php /*echo $level->billing_amount; */?></h3>-->
            <?php if ($level->id == 1) : ?>
                <h3>Monthly</h3>
            <?php elseif ($level->id == 2 ) :?>
                <h3>3 Months</h3>
            <?php elseif ($level->id == 3) : ?>
                <h3>6 Months</h3>
            <?php elseif ($level->id == 4) : ?>
                <h3>Annual</h3>
            <?php endif; ?>
			<p>Recurring</p>
			<p>Bass Nation Membership</p>
			<div class="button_wrap full_width">
			<?php if(empty($current_user->membership_level->ID)) { ?>
				<a class="pmpro_btn pmpro_btn-select button round_button" href="<?php echo pmpro_url("checkout", "?level=" . $level->id, "https")?>"><?php _e('GET STARTED!', 'pmpro');?></a>
			<?php } elseif ( !$current_level ) { ?>                	
				<a class="pmpro_btn pmpro_btn-select button round_button" href="<?php echo pmpro_url("checkout", "?level=" . $level->id, "https")?>"><?php _e('GET STARTED!', 'pmpro');?></a>
			<?php } elseif($current_level) { ?>
				
				<?php
					//if it's a one-time-payment level, offer a link to renew				
					if( pmpro_isLevelExpiringSoon( $current_user->membership_level) && $current_user->membership_level->allow_signups ) {
						?>
							<a class="pmpro_btn pmpro_btn-select button round_button" href="<?php echo pmpro_url("checkout", "?level=" . $level->id, "https")?>"><?php _e('Renew', 'pmpro');?></a>
						<?php
					} else {
						?>
							<a class="pmpro_btn disabled button round_button" href="<?php echo pmpro_url("account")?>"><?php _e('Your&nbsp;Level', 'pmpro');?></a>
						<?php
					}
				?>
				
			<?php } ?>
			</div><!-- button wrap -->
		</div> <!-- cost -->
		<div class="description full_width">
			<ul>
				<li><p>FREE for 3 days</p></li>
				<li><p>ALL Complete Lessons</p></li>
				<li><p>Lesson Commenting</p></li>
				<li><p>Bass Nation Forum Access</p></li>
				<li><p>Member Directory</p></li>
				<li><p>Messaging System</p></li>
			</ul>
		</div>
	</div><!-- row -->
	<?php
	}
	?>

</div> <!-- pmpro_levels_table -->
<!--
<nav id="nav-below" class="navigation" role="navigation">
	<div class="nav-previous alignleft">
		<?php if(!empty($current_user->membership_level->ID)) { ?>
			<a href="<?php echo pmpro_url("account")?>"><?php _e('&larr; Return to Your Account', 'pmpro');?></a>
		<?php } else { ?>
			<a href="<?php echo home_url()?>"><?php _e('&larr; Return to Home', 'pmpro');?></a>
		<?php } ?>
	</div>
</nav>
-->