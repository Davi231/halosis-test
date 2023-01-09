<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createProduct();
    }

    public function createProduct()
    {

    	Product::insert([
          [
            'id' => 1,
            'category_product_id' => 1,
            'product_name' => 'T-Shirt 1',
            'stock' => 10,
            'price' => 105000,
            
          ],
          [
            'id' => 2,
            'category_product_id' => 1,
            'product_name' => 'T-Shirt 2',
            'stock' => 15,
            'price' => 120000,
            
          ],
          [
            'id' => 3,
            'category_product_id' => 2,
            'product_name' => 'Jacket 1',
            'stock' => 5,
            'price' => 300000,  
          ],
          [
            'id' => 4,
            'category_product_id' => 2,
            'product_name' => 'Jacket 2',
            'stock' => 20,
            'price' => 250000,
            
          ],
          [
            'id' => 5,
            'category_product_id' => 3,
            'product_name' => 'Pants 1',
            'stock' => 5,
            'price' => 300000,
            
          ],
          [
            'id' => 6,
            'category_product_id' => 3,
            'product_name' => 'Pants 2',
            'stock' => 10,
            'price' => 350000,
            
          ],
          [
            'id' => 7,
            'category_product_id' => 4,
            'product_name' => 'Hat 1',
            'stock' => 15,
            'price' => 60000,
            
          ],
          [
            'id' => 8,
            'category_product_id' => 4,
            'product_name' => 'Hat 2',
            'stock' => 15,
            'price' => 70000,
            
          ],
          [
            'id' => 9,
            'category_product_id' => 5,
            'product_name' => 'Mask 1',
            'stock' => 10,
            'price' => 5000,
            
          ],
          [
            'id' => 10,
            'category_product_id' => 5,
            'product_name' => 'Mask 2',
            'stock' => 10,
            'price' => 10000,
            
          ]
      ]);

    }
}
