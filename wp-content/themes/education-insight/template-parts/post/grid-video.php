<?php
/**
 * Template part for displaying posts
 *
 * @subpackage Education Insight
 * @since 1.0
 */
?>

<?php $education_insight_post_option = get_theme_mod( 'education_insight_grid_column','3_column');
    if($education_insight_post_option == '1_column'){ ?>
    <div class="col-lg-12 col-md-12">
<?php }else if($education_insight_post_option == '2_column'){ ?>
    <div class="col-lg-6 col-md-6">
<?php }else if($education_insight_post_option == '3_column'){ ?>
    <div class="col-lg-4 col-md-4">
<?php }else if($education_insight_post_option == '4_column'){ ?>
    <div class="col-lg-3 col-md-3">
<?php }else if($education_insight_post_option == '5_column'){ ?>
    <div class="col-lg-2 col-md-2">
<?php }?>
<?php
  $video = education_insight_get_media(array('video', 'object', 'embed', 'iframe'));
?>
	<div id="Category-section" class="entry-content">
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="postbox smallpostimage">
				<h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
				<?php
      			if ( ! is_single() ) {
        			// If not a single post, highlight the video file.
        			if ( ! empty( $video ) ) {
          				foreach ( $video as $video_html ) {
            				echo '<div class="entry-video">';
              				echo $video_html;
            				echo '</div>';
          				}
        			};
      			};
    			?> 
	        	<div class="overlay">
	        		<div class="date-box">
	        			<?php if( get_option('education_insight_date',false) != '1'){ ?>
	        				<span><i class="far fa-calendar-alt"></i><?php the_time( get_option( 'date_format' ) ); ?></span>
	        			<?php }?>
	        			<?php if( get_option('education_insight_admin',false) != '1'){ ?>
	        				<span class="entry-author"><i class="far fa-user"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?></a></span>
	        			<?php }?>
	        			<?php if( get_option('education_insight_comment',false) != '1'){ ?>
	      					<span class="entry-comments"><i class="fas fa-comments"></i> <?php comments_number( __('0 Comments','education-insight'), __('0 Comments','education-insight'), __('% Comments','education-insight')); ?></span>
	      				<?php }?>
	    			</div>
	        		<p><?php the_excerpt();?></p>
	        	</div>
		      	<div class="clearfix"></div> 
		  	</div>
		</div>
	</div>
</div>