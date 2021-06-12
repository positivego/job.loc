<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Console\Command;

class get_data extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get_data:get {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'received data from json';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $file = $this->argument('file');

        $res = file_get_contents($file . '.json');
        print_r($res);

        $data = json_decode($res, true);
        $params = [];

        if($file === 'categories') {

            foreach ($data as $item) {

                $s = Category::where('name', $item['name'])->first();
                $params = [
                    'name' => $item['name'], 
                    'parent_id' => 0, 
                    'external_id' => $item['external_id'],
                ];

                if(empty($s)) {

                    Category::create($params);

                } else {

                    $s->update($params);

                }

            }

        }

        if($file === 'products') {

            foreach ($data as $item) {

                $s = Product::where('name', $item['name'])->first();
                $params = [
                    'name' => $item['name'], 
                    'description' => 'texttezttextsad',
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'parent_id' => 0, 
                    'external_id' => $item['external_id'],
                ];

                if(empty($s)) {

                    $model = Product::create($params);

                    foreach($item['category_id'] as $category) 
                    {
                        CategoryProduct::create(
                            [
                                'category_id' => $category,
                                'product_id' => $model->id,
                            ]
                        );
                    }

                } else {

                    $s->update($params);

                    CategoryProduct::where('product_id', '=', $s->id)->delete();

                    foreach($item['category_id'] as $category) 
                    {
                        CategoryProduct::create(
                            [
                                'category_id' => $category,
                                'product_id' => $s->id,
                            ]
                        );
                    }
                }
            }



        }

    }
}
