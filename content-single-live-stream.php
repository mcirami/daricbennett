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
	    <?php if(get_field('chat_embed_link')) :?>
	        <?php the_field('chat_embed_link');?>
	    <?php else: ?>
		    <div class="rumbletalk-handle">
			    <div class="rumbletalk-embed">
				    <meta charset="utf-8">
				    <div class="rumbletalk-archive">
					    <?php the_field('chat_history');?>
				    </div>
			    </div>
		    </div>
	    <?php endif; ?>
    </div>
</div>