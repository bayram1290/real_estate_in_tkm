<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $admin_user = User::create( [
		    'name'           => 'Admin',
		    'email'          => 'admin@admin.com',
		    'password'       => bcrypt('realadmin'),
		    'admin'          => 1,
		    'phone'          => '+993 64 65 64 64',
		    'verified'       => 1,
		    'verification_token' => str_random(20),
		    'remember_token' => str_random( 60 ),
		]);
		
		User::create( [
		    'name'           => 'Agent 1',
		    'email'          => 'agent1@example.com',
		    'password'       => bcrypt('agent1password'),
			'admin'          => 0,
			'agent'          => 0,			
		    'phone'          => '993 12 34 56 78',
		    'verified'       => 1,
		    'verification_token' => str_random(20),
		    'remember_token' => str_random( 60 ),
		]);
		
		User::create( [
		    'name'           => 'Agent 2',
		    'email'          => 'agent2@example.com',
		    'password'       => bcrypt('agent1password'),
			'admin'          => 0,
			'agent'          => 0,			
		    'phone'          => '993 12 34 56 78',
		    'verified'       => 1,
		    'verification_token' => str_random(20),
		    'remember_token' => str_random( 60 ),
	    ]);

	    App\adminProfile::create( [
		    'user_id'    => $admin_user->id,
		    'avatar'     => 'images/dashboard/users/1.jpg',
		    'full_name'  => 'Админ',
		    'username'   => $admin_user->name,
		    'work_phone' => $admin_user->phone,
		    'about'      => 'Информация об администраторе'
		]);

		
		
    }
}
