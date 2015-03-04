<?php

class SyncTest extends WP_UnitTestCase {

	function test_get_syncable_users() {
		//With no roles selected, this should return false
		$this->assertFalse( AC_UsersToSync() );

		//Select administrator role
		update_option( WP88_MC_ROLES, 'administrator');
		$users =  AC_UsersToSync();
		$this->assertEquals( sizeof($users), 1 );

		//insert a few more users into the database
		$test1_id = wp_insert_user( array(
				'user_login'=> 'test1',
				'user_pass' => 'test',
				'role'		=> 'subscriber'
			) );
		$this->assertTrue( is_int( $test1_id ) );
		$this->assertTrue( is_int(
			wp_insert_user( array(
				'user_login'=> 'test2',
				'user_pass' => 'test',
				'role'		=> 'subscriber'
			))
		));

		//check to make sure we still only get one user
		$users =  AC_UsersToSync();
		$this->assertEquals( sizeof($users), 1 );

		//now just subscribers
		update_option( WP88_MC_ROLES,  'subscriber' );
		$users =  AC_UsersToSync();
		$this->assertEquals( sizeof($users), 2 );

		//now all three
		update_option( WP88_MC_ROLES, array( 'administrator', 'subscriber' ) );
		$users =  AC_UsersToSync();
		$this->assertEquals( sizeof($users), 3 );

	}
}

