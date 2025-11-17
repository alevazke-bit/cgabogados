<?php
/**
 * @Packge     : Ensaf
 * @Version    : 1.0
 * @Author    : Themeholy
 * @Author URI: https://themeforest.net/user/themeholy
 *
*/

    // Block direct access
    if( ! defined( 'ABSPATH' ) ){
        exit();
    }

    if ( post_password_required() ) {
        return;
    }


    if( have_comments() ) :
?>
<!-- Comments -->
<div class="th-comments-wrap">
    <h2 class="blog-inner-title h4">
        <?php printf( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'ensaf' ), number_format_i18n( get_comments_number() ) ); ?>
    </h2>
    <ul class="comment-list">
        <?php
            the_comments_navigation();
                wp_list_comments( array(
                    'style'       => 'ul',
                    'short_ping'  => true,
                    'avatar_size' => 100,
                    'callback'    => 'ensaf_comment_callback'
                ) );
            the_comments_navigation();
        ?>
    </ul>
</div>

<!-- End of Comments -->
<?php
    endif;
?>
<?php 
add_filter( 'comment_form_fields', 'move_comment_field' );
function move_comment_field( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
?>

<?php
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? "required" : '' );
    $consent = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
    $fields =  array(
        'author'  => '<div class="row"><div class="col-md-6 form-group"><input class="form-control" type="text" name="author" placeholder="'. esc_attr__( 'Your Name', 'ensaf' ) .'" value="'. esc_attr( $commenter['comment_author'] ).'" '.esc_attr( $aria_req ).'><i class="fas fa-user"></i></div>',
        'email'   => '<div class="col-md-6 form-group"><input class="form-control" type="email" name="email"  value="' . esc_attr(  $commenter['comment_author_email'] ) .'" placeholder="'. esc_attr__( 'Your Email', 'ensaf' ) .'" '.esc_attr( $aria_req ).'><i class="fas fa-envelope"></i></div></div>',
        'url'     => '<div class="row"><div class="col-12 form-group"><input type="text" placeholder="'. esc_attr__( 'Website', 'ensaf' ) .'" value="'. esc_attr( $commenter['comment_author_url'] ).'" class="form-control"> <i class="fas fa-globe"></i></div></div>',
  
        'cookies' => '',
    );

    $args = array(
        'fields'                => $fields,
        'comment_field'   =>'<div class="row"><div class="col-md-12 form-group"><textarea class="form-control" name="comment" placeholder="'. esc_attr__( 'Write Your Comment', 'ensaf' ) .'" '.esc_attr( $aria_req ).'></textarea><i class="fas fa-pencil"></i></div></div>',
        'class_form'            => 'comment-form',
        'title_reply'           => esc_html__( 'Leave a Comment', 'ensaf' ),
        'title_reply_before'    => '<div class=""><h3 class="blog-inner-title h4 mb-2">',
        'title_reply_after'     => '</h3></div>',
        'comment_notes_before'  => '<p class="form-text">'.esc_html__('Your email address will not be published. Required fields are marked *','ensaf').'</p>',
        'logged_in_as'          => '<p class="form-text">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','ensaf' ), admin_url( 'profile.php' ), esc_attr( $user_identity ), wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
        'class_submit'          => 'th-btn style2 w-100',
        'submit_field'          => '<div class="col-12 form-group mb-0">%1$s %2$s</div>',
        'submit_button'         => '<button type="submit" name="%1$s" id="%2$s" class="%3$s">'.esc_html__('Post Comment','ensaf').'<i class="fa-regular fa-arrow-right-long"></i></button>',
        
       
    );

    if(  comments_open() ) {
        echo '<!-- Comment Form -->';
        echo '<div id="comments" class="th-comment-form blog-comment-wrap">';
            comment_form( $args );
        echo '</div>';
        echo '<!-- End of Comment Form -->';
    }