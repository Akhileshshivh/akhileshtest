
Url:https://stackoverflow.com/questions/28528963/custom-success-message-after-submitting-comment-on-wordpress

add_action( 'set_comment_cookies', function( $comment, $user ) {
    setcookie( 'ta_comment_wait_approval', '1', 0, '/' );
}, 10, 2 );

add_action( 'init', function() {
    if( isset( $_COOKIE['ta_comment_wait_approval'] ) && $_COOKIE['ta_comment_wait_approval'] === '1' ) {
        setcookie( 'ta_comment_wait_approval', '0', 0, '/' );
        add_action( 'comment_form_before', function() {
            echo "<p id='wait_approval' style='padding-top: 40px;'><strong>Your comment has been sent successfully lepide.</strong></p>";
        });
    }
});

add_filter( 'comment_post_redirect', function( $location, $comment ) {
    $location = get_permalink( $comment->comment_post_ID ) . '#wait_approval';
    return $location;
}, 10, 2 );