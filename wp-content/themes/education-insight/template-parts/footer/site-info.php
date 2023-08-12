<?php
/**
 * Displays footer site info
 *
 * @subpackage Education Insight
 * @since 1.0
 * @version 1.4
 */

?>

<div class="site-info">
	 <?php
        echo esc_html( get_theme_mod( 'education_insight_footer_text' ) );
        printf(
            /* translators: %s: Education WordPress Theme. */
            '<a href="' . esc_attr__( 'https://www.ovationthemes.com/wordpress/free-education-wordpress-theme/', 'education-insight' ) . '"> %s</a>',
            esc_html__( 'Education WordPress Theme', 'education-insight' )
        );
    ?>
</div>
