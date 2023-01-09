<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     $this->createUser();
    }

    private function createUser()
    {
    	User::insert([
    		[
    			'id' => 1,
    			'email' => 'customer1@gmail.com',
    			'name' => 'customer1',
    			'password' => Hash::make('customer123')
    		],
    		[
    			'id' => 2,
    			'email' => 'customer2@gmail.com',
    			'name' => 'customer2',
    			'password' => Hash::make('customer123')
    		],
    		[
    			'id' => 3,
    			'email' => 'customer3@gmail.com',
    			'name' => 'customer3',
    			'password' => Hash::make('customer123')
    		],
    	]);
    }
}
