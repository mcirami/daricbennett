<?php

$videoLink = get_field('video_embed_link');

if (strpos($videoLink, "embed") !== false) {
	$str = explode("embed/", $videoLink);
	$embedCode = preg_replace('/\s+/', '', $str[1]);
} elseif (strpos($videoLink, "v=") !== false) {
	$str = explode("v=", $videoLink);
	$embedCode = preg_replace('/\s+/', '', $str[1]);
} elseif (strpos($videoLink, "youtu.be") !== false) {
	$str = explode(".be/", $videoLink);
	$embedCode = preg_replace('/\s+/', '', $str[1]);
} else {
	$embedCode = null;
}


?>

<div class="row full_width">
    <div class="title full_width">
        <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
    </div>
    <div class="columns_wrap">
        <div class="column one">
	        <a href="<?php the_permalink(); ?>">
		        <?php if ($embedCode !== null) : ?>
			        <img class="youtube_img" src="https://img.youtube.com/vi/<?php echo $embedCode; ?>/mqdefault.jpg" />
		        <?php else:  ?>
			        <img class="default" src="<?php echo bloginfo('template_url'); ?>/images/lessons-screenshot.jpg" />
		        <?php endif; ?>
		        <div class="button_wrap full_width">
			        <img src="<?php echo bloginfo( 'template_url' ); ?>/images/play-button.png"/>
		        </div>
	        </a>
        </div>
        <div class="column two">
	        <div class="rumbletalk-handle">
		        <div class="rumbletalk-embed">
			        <meta charset="utf-8">
			        <div class="rumbletalk-archive">
				        <?php the_field('chat_history');?>
			        </div>
		        </div>
	        </div>
        </div>
    </div>

</div>