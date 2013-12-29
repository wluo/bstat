<?php

// don't show this panel if there's only one author
$authors = $this->top_authors();
if ( 2 > count( $authors ) )
{
	return;
}

// for sanity, limit this to just the top 100 authors
$authors = array_slice( $authors, 0, 100 );

$total_activity = 0;
foreach ( $authors as $author )
{
	$total_activity += $author->hits;
}

echo '<h2>Authors, by total activity</h2>';
echo '<p>Showing ' . count( $authors ) . ' authors with ' . $total_activity . ' total actions.</p>';
echo '<ol>';
foreach ( $authors as $author )
{
	$user = new WP_User( $author->post_author );
	if ( ! isset( $user->display_name ) )
	{
		continue;
	}

	$posts = $this->get_posts( $this->top_posts(), array( 'author' => $author->post_author, 'posts_per_page' => 3, 'post_type' => 'any' ) );

	// it appears WP's get_the_author() emits the author display name with no sanitization
	echo '<li>' . $user->display_name . ' (' . (int) $author->hits . ' hits)';
	echo '<ol>';
	foreach ( $posts as $post )
	{
		echo '<li ' . get_post_class( '', $post->ID ) . '>' . get_the_title( $post->ID ) . ' (' . (int) $post->hits . ' hits)</li>';
	}
	echo '</ol></li>';


}
echo '</ol>';