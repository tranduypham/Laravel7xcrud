<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            // DB::table('products')->insert([
            //     'product_name' => Str::random(10),
            //     'product_desc' => Str::random(10),
            //     'product_quantity' => rand(0, 500),
            //     'product_price' => rand(0, 500),
            //     'product_image' => "rỗng",
            //     'product_publish' => date("Y-m-d H:i:s",rand(1262055681,1262055681)),
            // ]);
            DB::table('catagory')->insert([
                'catagory_name' => Str::random(10),
                'catagory_slug' => Str::random(10),
                'catagory_desc' => Str::random(10),
                'catagory_image' => "",
            ]);
        }
    }
}
