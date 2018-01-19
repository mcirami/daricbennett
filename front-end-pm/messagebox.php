<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

echo fep_info_output();

if( ! $total_message ) {
	echo "<div class='fep-error'>".apply_filters('fep_filter_messagebox_empty', __("No messages found.", 'front-end-pm'), $action)."</div>";
	return;
}

do_action('fep_display_before_messagebox', $action);
	  
	  	?><div class="fep-messagebox-search-form-div">
			<form id="fep-messagebox-search-form" action="">
			<input type="hidden" name="fepaction" value="messagebox" />
			<input type="search" name="fep-search" class="fep-messagebox-search-form-field" value="<?php isset( $_GET["fep-search"] ) ? esc_attr_e( $_GET["fep-search"] ): ""; ?>" placeholder="<?php _e("Search Messages", "front-end-pm"); ?>" />
			<input type="hidden" name="feppage" value="1" />
			</form>
		</div>
	  	<form class="fep-message-table form" method="post" action="">
		<div class="fep-table fep-action-table">
			<div>
				<div class="fep-bulk-action">
					<select name="fep-bulk-action">
						<option value=""><?php _e('Bulk action', 'front-end-pm'); ?></option>
						<?php foreach( Fep_Message::init()->get_table_bulk_actions() as $bulk_action => $bulk_action_display ) { ?>
						<option value="<?php echo $bulk_action; ?>"><?php echo $bulk_action_display; ?></option>
						<?php } ?>
					</select>
                    <div>
                        <input type="hidden" name="token"  value="<?php echo fep_create_nonce('bulk_action'); ?>"/>
                        <button type="submit" class="fep-button" name="fep_action" value="bulk_action"><?php _e('Apply', 'front-end-pm'); ?></button>
                    </div>
				</div>
				<div class="fep-loading-gif-div">
				</div>
				<div class="fep-filter">
					<select onchange="if (this.value) window.location.href=this.value">
						<?php foreach( Fep_Message::init()->get_table_filters() as $filter => $filter_display ) { ?>
						<option value="<?php echo esc_url( add_query_arg( array('fep-filter' => $filter, 'feppage' => false ) ) ); ?>" <?php selected($g_filter, $filter);?>><?php echo $filter_display; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
		<?php if( $messages->have_posts() ) { ?>
		<div id="fep-table" class="fep-table fep-odd-even"><?php
			while ( $messages->have_posts() ) { 
				$messages->the_post(); ?>
					<div id="fep-message-<?php the_ID(); ?>" class="fep-table-row"><?php
						foreach ( Fep_Message::init()->get_table_columns() as $column => $display ) { ?>
							<div class="fep-column fep-column-<?php echo $column; ?>"><?php Fep_Message::init()->get_column_content($column); ?></div>
						<?php } ?>
					</div>
				<?php
			} //endwhile
			?></div><?php
			echo fep_pagination();
		} else {
			?><div class="fep-error"><?php _e('No messages found. Try different filter.', 'front-end-pm'); ?></div><?php 
		}
		?></form><?php 
	wp_reset_postdata();
