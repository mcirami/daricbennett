<?php

   // $domain = (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME']);

?>
<div class="title">
    <h3><?php the_title(); ?></h3>
</div>

<div class="columns_wrap">
    <div class="column one">
        <div class="video_wrapper">
            <iframe src="<?php the_field('video_embed_link'); ?>/?playsinline=1" frameborder="0"></iframe>
        </div>
    </div>
    <div class="column two">

        <!--<div class="live_chat">
            <iframe src="<?php /*the_field('chat_embed_link'); */?>" frameborder="0" ></iframe>
        </div>
-->
        <div id="live_comments">
            <?php
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
            ?>
        </div>
    </div>
</div>
