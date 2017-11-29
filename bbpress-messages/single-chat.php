<?php global $bbpm_inbox_ids, $bbpm_pagination, $bbpm_bases, $bbpm_chat_id, $bbpm_message, $bbpm_recipient, $bbpm_chat;

?>

<?php do_action('bbpm_single_before_content'); ?>

<div class="bbpm-messages bbpm-items <?php echo implode(' ', apply_filters('bbpm_single_chat_classes', array())); ?>">

    <div class="bbpm-head">
        <span class="bbpm-left">
            <?php do_action('bbpm_single_before_chat_icon'); ?>

            <img src="<?php echo esc_url($bbpm_chat->avatar); ?>" alt="<?php esc_attr_e('Chat icon', BBP_MESSAGES_DOMAIN); ?>" height="<?php echo apply_filters('bbpm_single_chat_icon_size', 44); ?>" width="<?php echo apply_filters('bbpm_single_chat_icon_size', 44); ?>" />

            <?php do_action('bbpm_single_before_chat_name'); ?>

            <h3 class="bbpm-heading"><?php echo esc_attr($bbpm_chat->name); ?></h3>

            <br/>

            <?php do_action('bbpm_single_chat_links'); ?>

            <a href="<?php echo bbpm_messages_url(); ?>" class="bbpm-helper" title="<?php _e('Back to chats', BBP_MESSAGES_DOMAIN); ?>">&laquo;</a>

            <?php do_action('bbpm_single_chat_options_link'); ?>

            <a href="<?php echo bbpm_messages_url(sprintf('%s/%s/', $bbpm_chat_id, $bbpm_bases['settings_base'])); ?>" class="bbpm-helper" title="<?php _e('Chat options', BBP_MESSAGES_DOMAIN); ?>"><?php _e('Options', BBP_MESSAGES_DOMAIN); ?></a>

            <?php do_action('bbpm_single_after_links'); ?>
        </span>

        <?php do_action('bbpm_single_before_search'); ?>

        <form method="get" action="<?php echo bbpm_messages_url($bbpm_chat_id); ?>">
            <input type="text" name="search" value="<?php echo esc_attr(bbpm_search_query()); ?>" placeholder="<?php esc_attr_e('Search', BBP_MESSAGES_DOMAIN); ?>" />
        </form>

        <?php do_action('bbpm_single_after_search'); ?>
    </div>

    <div class="bbpm-body">

        <?php do_action('bbpm_single_before_body'); ?>

        <?php if ( bbpm_search_query() ) : ?>
            <p><?php printf(__('Showing search results for "%s":', BBP_MESSAGES_DOMAIN), bbpm_search_query()); ?></p>
        <?php endif; ?>
        
        <form action="<?php echo bbpm_messages_url(sprintf('%s/actions/', $bbpm_chat_id)); ?>" method="post">

            <?php if ( $bbpm_inbox_ids ) : ?>
    
                <?php do_action('bbpm_single_before_list'); ?>

                <ul class="bbpm-list">
                    
                    <?php foreach ( $bbpm_inbox_ids as $bbpm_message ) : ?>

                        <?php bbpm_load_template('messages/loop-message.php'); ?>

                    <?php endforeach; ?>

                </ul>

                <?php do_action('bbpm_single_after_list'); ?>

                <div class="bbpm-actions-cont">
                    <?php do_action('bbpm_single_before_actions'); ?>

                    <?php if ( isset($bbpm_chat->can_mark_unread) && $bbpm_chat->can_mark_unread ) : ?>
                        <div class="bbpm-mark-unread">
                            <button name="mark_unread"><?php _e('Mark Unread', BBP_MESSAGES_DOMAIN); ?></button>
                        </div>
                    <?php endif;?>

                    <?php do_action('bbpm_single_before_actions_menu'); ?>

                    <div class="bbpm-actions">
                        <?php wp_nonce_field("single_actions_{$bbpm_chat_id}", 'bbpm_nonce'); ?>

                        <?php do_action('bbpm_single_before_actions_menu_2'); ?>
                        
                        <select name="action">
                            <option value=""><?php _ex('Bulk Actions', 'bulk actions menu', BBP_MESSAGES_DOMAIN); ?></option>
                            <option value="delete"><?php _ex('Delete', 'bulk actions menu', BBP_MESSAGES_DOMAIN); ?></option>
                            <?php do_action('bbpm_messages_bulk_actions'); ?>
                        </select>

                        <?php do_action('bbpm_single_before_actions_submit'); ?>

                        <input type="submit" name="apply" value="<?php _ex('&check;', 'bulk actions menu', BBP_MESSAGES_DOMAIN); ?>" />

                        <?php do_action('bbpm_single_after_actions_submit'); ?>
                    </div>

                    <?php do_action('bbpm_single_after_actions'); ?>
                </div>

                <?php if ( !empty($bbpm_chat->seen) ) : ?>

                    <?php do_action('bbpm_single_before_chat_read_receipts'); ?>
                
                    <p class="bbpm-read-receipts">
                        <?php _ex('&check; Seen', 'message read receipts', BBP_MESSAGES_DOMAIN); ?>
                        <?php foreach ( $bbpm_chat->seen as $user ) : ?>
                            <span title="<?php printf(__('Seen by %s', BBP_MESSAGES_DOMAIN), $user->display_name); ?>">
                                <?php echo get_avatar($user->ID, 15); ?>
                            </span>
                        <?php endforeach; ?>
                    </p>

                    <?php do_action('bbpm_single_after_chat_read_receipts'); ?>
                
                <?php else : ?>
                    
                    <p>&nbsp;</p>

                <?php endif; ?>

            <?php elseif ( bbpm_search_query() ) : ?>

                <?php do_action('bbpm_single_search_no_results'); ?>

                <p class="bbpm-no-items"><?php _e('No messages have matched your search query, please try again with a different search term', BBP_MESSAGES_DOMAIN); ?></p>

            <?php else : ?>

                <?php do_action('bbpm_single_empty_chat'); ?>

                <p class="bbpm-empty-chat"><?php _e('There are no messages to show.', BBP_MESSAGES_DOMAIN); ?></p>

            <?php endif; ?>

        </form>

        <?php do_action('bbpm_single_after'); ?>

    </div>

    <div class="bbpm-foot">

        <?php do_action('bbpm_single_before_footer_contents'); ?>

        <?php if ( empty($bbpm_recipient->ID) || bbpm_can_contact($bbpm_recipient->ID) ) : ?>

            <form method="post" action="<?php echo bbpm_messages_url('send'); ?>">
                <?php do_action('bbpm_single_before_form_contents'); ?>

                <p>
                    <?php echo bbpm_message_field(); ?>
                </p>

                <?php do_action('bbpm_single_after_form_message_field'); ?>

                <p>
                    <?php wp_nonce_field('send_message', 'bbpm_nonce'); ?>

                    <input type="hidden" name="chat_id" value="<?php echo $bbpm_chat_id; ?>" />
                    
                    <?php do_action('bbpm_single_before_form_submit'); ?>

                    <input type="submit" name="send_message" value="Send" />

                    <?php do_action('bbpm_single_after_form_submit'); ?>
                </p>

                <?php do_action('bbpm_single_after_form_contents'); ?>
            </form>

        <?php endif; ?>

        <div class="bbpm-pagi">
            <?php do_action('bbpm_single_before_pagi_links'); ?>

            <?php echo paginate_links($bbpm_pagination); ?>
        
            <?php do_action('bbpm_single_after_pagi_links'); ?>
        </div>

        <?php do_action('bbpm_single_after_footer_contents'); ?>

    </div>

</div>

<?php do_action('bbpm_single_after_content'); ?>