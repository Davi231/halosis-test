<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CategoryProduct;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->createCategoryProduct();
    }

    public function createCategoryProduct()
    {

    	CategoryProduct::insert([
    		[
    			'id' => 1,
    			'category' => 'T-Shirt',
    		],
    		[
    			'id' => 2,
    			'category' => 'Jacket',
    		],
    		[
    			'id' => 3,
    			'category' => 'Pants',
    		],
    		[
    			'id' => 4,
    			'category' => 'Hat',
    		],
    		[
    			'id' => 5,
    			'category' => 'Mask',
    		],
    	]);
    }
}
