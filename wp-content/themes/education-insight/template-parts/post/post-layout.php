<?php
/**
 * Template part for post layout
 *
 * @subpackage Education Insight
 * @since 1.0
 */
?>
<?php
$education_insight_post_option = get_theme_mod( 'education_insight_post_option','two_column');
if($education_insight_post_option == 'two_column'){ ?>
<div class="content_area col-lg-8 col-md-8">
    <section id="post_section">
        <div class="row">
            <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/post/content',get_post_format()  );
                    endwhile;
                else :
                    get_template_part( 'template-parts/post/content', 'none' );
                endif;
            ?>
        </div>
        <div class="navigation">
            <?php
            the_posts_pagination( array(
                'prev_text'          => __( 'Previous page', 'education-insight' ),
                'next_text'          => __( 'Next page', 'education-insight' ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'education-insight' ) . ' </span>',
            ) );
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
</div>
<div id="sidebar" class="col-lg-4 col-md-4"><?php dynamic_sidebar('sidebar-1'); ?></div>
<?php }
else if($education_insight_post_option == 'one_column'){ ?>
<div class="content_area col-lg-12 col-md-12">
    <section id="post_section">
        <div class="row">
            <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/post/content',get_post_format()  );
                    endwhile;
                else :
                    get_template_part( 'template-parts/post/content', 'none' );
                endif;
            ?>
        </div>
        <div class="navigation">
            <?php
            the_posts_pagination( array(
                'prev_text'          => __( 'Previous page', 'education-insight' ),
                'next_text'          => __( 'Next page', 'education-insight' ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'education-insight' ) . ' </span>',
            ) );
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
</div>
<?php }
else if($education_insight_post_option == 'three_column'){ ?>
<div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-3'); ?></div>
<div class="content_area col-lg-6 col-md-6">
    <section id="post_section">
        <div class="row">
            <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/post/content',get_post_format()  );
                    endwhile;
                else :
                    get_template_part( 'template-parts/post/content', 'none' );
                endif;
            ?>
        </div>
        <div class="navigation">
            <?php
            the_posts_pagination( array(
                'prev_text'          => __( 'Previous page', 'education-insight' ),
                'next_text'          => __( 'Next page', 'education-insight' ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'education-insight' ) . ' </span>',
            ) );
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
</div>
<div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-1'); ?></div>
<?php }
else if($education_insight_post_option == 'four_column'){ ?>
<div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-3'); ?></div>
<div class="content_area col-lg-3 col-md-3">
    <section id="post_section">
        <div class="row">
            <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/post/content',get_post_format()  );
                    endwhile;
                else :
                    get_template_part( 'template-parts/post/content', 'none' );
                endif;
            ?>
        </div>
        <div class="navigation">
            <?php
            the_posts_pagination( array(
                'prev_text'          => __( 'Previous page', 'education-insight' ),
                'next_text'          => __( 'Next page', 'education-insight' ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'education-insight' ) . ' </span>',
            ) );
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
</div>
<div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-2'); ?></div>
<div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-1'); ?></div>
<?php }
else if($education_insight_post_option == 'grid_sidebar'){ ?>
<div class="content_area col-lg-8 col-md-8">
    <section id="post_section">
        <div class="row">
            <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/post/grid',get_post_format()  );
                    endwhile;
                else :
                    get_template_part( 'template-parts/post/content', 'none' );
                endif;
            ?>
        </div>
        <div class="navigation">
            <?php
            the_posts_pagination( array(
                'prev_text'          => __( 'Previous page', 'education-insight' ),
                'next_text'          => __( 'Next page', 'education-insight' ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'education-insight' ) . ' </span>',
            ) );
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
</div>
<div id="sidebar" class="col-lg-4 col-md-4"><?php dynamic_sidebar('sidebar-1'); ?></div>
<?php }
if($education_insight_post_option == 'grid_post'){ ?>
<div class="content_area col-lg-12 col-md-12">
    <section id="post_section">
        <div class="row">
            <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/post/grid',get_post_format()  );
                    endwhile;
                else :
                    get_template_part( 'template-parts/post/content', 'none' );
                endif;
            ?>
        </div>
        <div class="navigation">
            <?php
            the_posts_pagination( array(
                'prev_text'          => __( 'Previous page', 'education-insight' ),
                'next_text'          => __( 'Next page', 'education-insight' ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'education-insight' ) . ' </span>',
            ) );
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
</div>
<?php }