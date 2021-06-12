<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Throwable;

class MainController extends Controller
{
    public function index(Request $request) 
    {
        try {

            if($request->has('filter') && !empty($request['filter'])) {

                //Знаю что есть адекватные решения по фильтрам, но я думаю что важнее показать свой уровень умений нежели решение из гугла, даже если он такой вот

                if($request['filter'] === 'price_down') {
                    $products = Product::orderByDesc('price')->simplePaginate(50);
                }

                if($request['filter'] === 'price_up') {
                    $products = Product::orderBy('price')->simplePaginate(50);
                }

                if($request['filter'] === 'time_up') {
                    $products = Product::orderByDesc('updated_at')->simplePaginate(50);
                }

                if($request['filter'] === 'time_down') {
                    $products = Product::orderBy('updated_at')->simplePaginate(50);
                }

            } else {

                $products = Product::simplePaginate(50);

            }

            return view('index', compact('products'));

        } catch (Throwable $e) {

            dump($e);
            return false;

        }
    }

    public function getCategoryProducts(Request $request) 
    {
        try {

            $products = Product::join('category_product', 'products.id', '=', 'category_product.product_id')
                                ->where('category_id', intval($request->category))
                                ->simplePaginate(10);


            return view('category', compact('products'));

        } catch (Throwable $e) {

            dump($e);
            return false;

        }

    }

    public function getProduct(Request $request)
    {
        try {

            $product = $request->product;

            $product = Product::where('id', $product)->first();

            return view('product', compact('product'));

        } catch (Throwable $e) {

            dump($e);
            return false;

        }
    }

}
