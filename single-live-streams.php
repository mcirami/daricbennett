<?php

get_header();

?>

<div class="full_width page_content <?php if (is_user_logged_in()){ echo "member";} ?>">
    <header class="sub_header full_width">
        <div class="container">
            <h1>Live Stream</h1>
        </div><!-- .container -->
    </header>

    <div class="full_width live_stream">
        <div class="container">

            <?php if (pmpro_hasMembershipLevel()) :

                while ( have_posts() ) : the_post();

                    get_template_part( 'content', 'single-live-stream' );

                endwhile; // end of the loop.

            else :

                get_template_part( 'content', 'not-member' );

            endif; ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>