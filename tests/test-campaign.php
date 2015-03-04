<?php

class CampaignTest extends WP_UnitTestCase {

	function test_content() {

		// Create post object
		$my_post = array(
		  'post_title'    => 'My post',
		  'post_content'  => 'This is my post.',
		  'post_status'   => 'publish',
		  'post_author'   => 1
		);

		// Insert the post into the database
		wp_insert_post( $my_post );

		//format some content
		$posts = get_posts();
		$content = AC_PrepareCampaignContent( $posts[0], 1);
		$this->assertContains('This is my post', $content['html_main'], true);

	}
}

