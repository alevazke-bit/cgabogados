<?php
/**
 * @Packge     : Ensaf
 * @Version    : 1.0
 * @Author    : Themeholy
 * @Author URI: https://themeforest.net/user/themeholy
 *
*/

// Block direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
    
    /**
    *
    * Hook for Footer Content
    *
    * Hook ensaf_footer_content
    *
    * @Hooked ensaf_footer_content_cb 10
    *
    */
    do_action( 'ensaf_footer_content' );

    echo '<!-- Smoother -->';
            echo '</div>';
        echo '</div>';
    echo '<!-- Smoother -->';

    /**
    *
    * Hook for Back to Top Button
    *
    * Hook ensaf_back_to_top
    *
    * @Hooked ensaf_back_to_top_cb 10
    *
    */
    do_action( 'ensaf_back_to_top' );

    /**
    *
    * ensaf grid lines
    *
    * Hook ensaf_grid_lines
    *
    * @Hooked ensaf_grid_lines_cb 10
    *
    */
    do_action( 'ensaf_grid_lines' );

    wp_footer();
    ?>
</body>
</html>