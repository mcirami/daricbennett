<?php global $bbpm_chat; $chat = (object) $bbpm_chat;
?>

<li class="bbpm-item bbpm-chat <?php echo implode(' ', $chat->classes); ?>" data-chatid="<?php echo $chat->chat_id; ?>">
    <h2>This shit work too?</h2>
    <div class="bbpm-icon">
        <img src="<?php echo esc_url($chat->avatar); ?>" alt="<?php esc_attr_e('Chat icon', BBP_MESSAGES_DOMAIN); ?>" height="66" width="66" data-chatid="<?php echo $chat->chat_id; ?>" />
    </div>

    <div class="bbpm-details">
        
        <span class="bbpm-left">
                
            <h3 class="bbpm-heading" data-chatid="<?php echo $chat->chat_id; ?>"><?php echo esc_attr($chat->name); ?></h3>

            <span class="bbpm-excerpt" data-chatid="<?php echo $chat->chat_id; ?>">
                <?php echo bbpm_profile_linkit($chat->sender, esc_attr(get_current_user_id()!= $chat->sender ? $chat->sender_name : __('You', BBP_MESSAGES_DOMAIN))); ?>:
                <?php echo apply_filters('bbpm_excerpt', $chat->excerpt, $chat); ?>
            </span>

        </span>

        <span class="bbpm-right">
            
            <span class="bbpm-time" title="<?php echo bbpm_date($chat->date); ?>"><?php echo bbpm_time_diff($chat->date, null, null); ?></span>
            <?php if ( in_array('unread', $chat->classes) && (int) $chat->unread_count ) : ?>
                <span class="bbpm-count">+<?php echo $chat->unread_count; ?></span>
            <?php endif; ?>

        </span>

    </div>

    <noscript>
        <a href="<?php echo esc_url(bbpm_messages_url($chat->chat_id)); ?>" class="bbpm-read">
            <?php esc_attr_e('View chat', BBP_MESSAGES_DOMAIN); ?>
        </a>
    </noscript>
</li>