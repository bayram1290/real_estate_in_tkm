<?php

use Illuminate\Database\Seeder;
use App\Profile;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

	    Profile::create([
		    'first_name' => 'Eziz',
		    'last_name' => 'Annageldiyev',
		    'add_phone' => '993 65-81-01-43',
		    'about' => 'Описание о пользователе',
		    'user_id' => 2,
		    'avatar'=>'images/dashboard/users/1.jpg'
	    ]);

	    Profile::create([
		    'first_name' => 'Piri',
		    'last_name' => 'Atayew',
		    'add_phone' => '993 61-54-08-83',
		    'about' => 'Описание о пользователе',
		    'user_id' => 3,
		    'avatar'=>'images/dashboard/users/1.jpg'
	    ]);
    }
}
