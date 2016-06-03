<?php

use App\InitialProduct;
use Illuminate\Database\Seeder;

/**
 * Seeds initial_products table.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class InitialProductsTableSeeder extends Seeder {

    public function run() {
        $file = file_get_contents('http://bitller.com/nova/products/a');

        $products = json_decode($file);

        foreach ($products as $product) {
            // dd($product);
            InitialProduct::create([
                'name' => $product->Name,
                'code' => $product->Code
            ]);
        }
    }

}
