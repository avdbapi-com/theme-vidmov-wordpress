<?php
if(post_password_required()){
	return;
}
?>

<div id="comments" class="comments-area">
	
	<?php
	$args = array(
		'label_submit' 			=> esc_attr__('Post comment', 'vidmov'),
		'title_reply'  			=> esc_html__('Leave your comment', 'vidmov'),
		'title_reply_to'		=> esc_html__('Leave a reply to %s', 'vidmov'),
		'comment_field' 		=> '<p class="comment-form-comment"><textarea id="comment" name="comment" required="required" placeholder="'.esc_attr__('Your comment *', 'vidmov').'"></textarea></p>',
		'title_reply_before'	=> '<h2 id="reply-title" class="comment-reply-title">',
		'title_reply_after'		=> '</h2>',
	);
	
	comment_form($args);
	
	if ( have_comments() ) : ?>
		<h2 class="comments-title h2">
			<?php
			$comment_count = get_comments_number();
			if ( 1 == $comment_count ) {				
				echo esc_html($comment_count).' '.esc_html__( 'Comment', 'vidmov');				
			} else {
				echo esc_html($comment_count).' '.esc_html__( 'Comments', 'vidmov');					
			}
			?>
		</h2>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
					'format'     => 'html5',
					'avatar_size'=> 61,
				) );
			?>
		</ol>

		<?php	
		if (get_comment_pages_count() > 1 && get_option( 'page_comments' )):
			echo '<div class="pag-comment-bottom">';	
				the_comments_navigation(array(
					'prev_text' =>  esc_html__('Older Comments', 'vidmov'),
					'next_text' =>  esc_html__('Newer Comments', 'vidmov'),
				));
			echo '</div>';
		endif;
		
		if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'vidmov'); ?></p>
		<?php
		endif;

	endif;	
	?>

</div>