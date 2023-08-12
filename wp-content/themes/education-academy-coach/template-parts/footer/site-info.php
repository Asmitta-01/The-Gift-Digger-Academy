<?php
/**
 * Displays footer site info
 *
 * @subpackage Education Academy Coach
 * @since 1.0
 * @version 1.4
 */

?>
<div class="site-info py-4 text-center">
    <p class="mb-0">
      <?php
        echo esc_html( get_theme_mod( 'education_insight_footer_text' ) );
        printf(
            /* translators: %s: Education WordPress Theme. */
            '<a href="' . esc_attr__( 'https://www.ovationthemes.com/wordpress/free-academy-wordpress-theme/', 'education-academy-coach' ) . '"> %s</a>',
            esc_html__( 'Education WordPress Theme', 'education-academy-coach' )
        );
    ?>
  </p>
</div>
