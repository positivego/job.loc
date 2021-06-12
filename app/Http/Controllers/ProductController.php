<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Response;
use Throwable;

class ProductController extends Controller
{
    public function index() 
    {
        $products = Product::simplePaginate(10);

        return view('dashboard.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::get();
        
        return view('dashboard.products.create', compact('categories'));
    }

    public function store(ProductRequest $request) 
    {
        try {

            $params = $request->only(
                'name',
                'description',
                'price',
                'quantity',
                'parent_id',
                'external_id',
            );

            $model = Product::create($params);

            foreach($request->categories as $category) 
            {
                CategoryProduct::create(
                    [
                        'category_id' => $category,
                        'product_id' => $model->id,
                    ]
                );
            }

            return Response::json(['success' => true, "id" => [$model->id]], 200);

        } catch (Throwable $e) {

            dump($e);
            return Response::json(['success' => false, "errors" => ['ошибка']], 201);

        }
    }

    public function edit(Product $product) 
    {
        $categories = Category::get();
        
        return view('dashboard.products.create', compact('product','categories'));
    }

    public function update(ProductRequest $request, Product $product) 
    {
        try {

            $params = $request->only(
                'name',
                'description',
                'price',
                'quantity',
                'parent_id',
                'external_id',
            );

            $product->update($params);

            CategoryProduct::where('product_id', '=', $product->id)->delete();

            foreach($request->categories as $category) 
            {
                CategoryProduct::create(
                    [
                        'category_id' => $category,
                        'product_id' => $product->id,
                    ]
                );
            }

            return Response::json(['success' => true, "id" => [$product->id]], 200);

        } catch (Throwable $e) {

            dump($e);
            return Response::json(['success' => false, "errors" => ['ошибка']], 201);

        }
    }

    public function destroy(Product $product)
    {
        try {

            CategoryProduct::where('product_id', '=', $product->id)->delete();
            $product->delete();

            return Response::json(['success' => true, "delete" => 'ok'], 200);

        } catch (Throwable $e) {

            dump($e);
            return Response::json(['success' => false, "errors" => ['ошибка']], 201);

        }
    }
}
