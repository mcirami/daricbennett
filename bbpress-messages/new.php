<?php global $bbpm_bases, $bbpm_recipient, $bbpm_search, $bbpm_chat_id;

?>

<div class="bbpm-new">
    <?php if ( !empty( $bbpm_recipient->ID ) ) : ?>

        <form method="post" action="<?php echo bbpm_messages_url('send'); ?>">

            <div class="recipient-avatar">
                <a href="<?php echo bbpm_messages_url($bbpm_chat_id); ?>"><?php echo get_avatar($bbpm_recipient->ID, 99); ?></a>
                <h3><?php printf( __('Send a new message to %s:', BBP_MESSAGES_DOMAIN), $bbpm_recipient->display_name ); ?></h3>
            </div>

            <p>&nbsp;</p>

            <p class="form-section<?php echo bbpm_has_errors('message') ? ' has-errors' : ''; ?>">
                <label for="message"><?php _e('Type a message:', BBP_MESSAGES_DOMAIN); ?></label>
                <?php echo bbpm_message_field(bbpm_old('message', true)); ?>

                <?php if ( bbpm_has_errors('message') ) : ?>
                    <?php bbpm_print_error( 'message' ); ?>
                <?php endif; ?>
            </p>

            <p class="form-submit">
                <?php wp_nonce_field('send_message', 'bbpm_nonce'); ?>
                <input type="hidden" name="chat_id" value="<?php echo $bbpm_chat_id; ?>" />
                <input type="submit" name="send_message" value="<?php esc_attr_e('Send', BBP_MESSAGES_DOMAIN); ?>" />
                <a href="<?php echo bbpm_messages_url(); ?>"><?php _e('Cancel', BBP_MESSAGES_DOMAIN); ?></a>
            </p>

        </form>

    <?php else : ?>

        <form method="post" action="<?php echo bbpm_messages_url($bbpm_bases['new']); ?>">

            <p class="form-section<?php echo bbpm_has_errors('search') ? ' has-errors' : ''; ?>">

                <label for="search"><?php _e('Search and select a contact:', BBP_MESSAGES_DOMAIN); ?></label>

                <input type="text" name="search" value="<?php bbpm_old('search'); ?>" placeholder="<?php esc_attr_e('Search', BBP_MESSAGES_DOMAIN); ?>" id="search" />

                <?php if ( bbpm_has_errors('search') ) : ?>
                    <?php bbpm_print_error( 'search' ); ?>
                <?php endif; ?>
            
            </p>

            <?php if ( isset($bbpm_search) ) { ?>

                <?php if ( $bbpm_search ) : ?>
                    <ul class="bbpm-results">
                    <?php foreach ( $bbpm_search as $user ) : ?>

                        <li>
                            <label>
                                <input type="radio" name="u" value="<?php echo $user->ID; ?>" <?php checked(bbpm_old('u',1), $user->ID); ?>/>
                                <?php echo get_avatar($user->ID, 22); ?>
                                <?php echo $user->display_name; ?>
                            </label>
                        </li>

                    <?php endforeach; ?>
                    </ul>
                <?php else : ?>

                    <p><?php _e('No users have matched your search query.', BBP_MESSAGES_DOMAIN); ?></p>

                <?php endif; ?>

            <?php } ?>

            <p class="form-submit">
                <?php wp_nonce_field('bbpm_nonce', 'bbpm_nonce'); ?>
                <input type="submit" name="select_recipient" value="<?php esc_attr_e('Select recipient', BBP_MESSAGES_DOMAIN); ?>" />
                <a href="<?php echo bbpm_messages_url(); ?>"><?php _e('Cancel', BBP_MESSAGES_DOMAIN); ?></a>
            </p>

        </form>

    <?php endif; ?>
</div>