<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Address;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createAddress();
    }

    public function createAddress()
    {

    	Address::insert([
          [
            'id' => 1,
            'user_id' => 1,
            'address' => 'Bogor',
            'is_active' => 1,
            
          ],
          [
            'id' => 2,
            'user_id' => 2,
            'address' => 'Bandung',
            'is_active' => 1,
            
          ],
          [
            'id' => 3,
            'user_id' => 3,
            'address' => 'Surabaya',
            'is_active' => 0,
            
          ]
      ]);

    }
}
