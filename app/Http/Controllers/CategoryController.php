<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Response;
use Throwable;

class CategoryController extends Controller
{
    public function index() 
    {
        $categories = Category::simplePaginate(10);

        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(CategoryRequest $request) 
    {
        try {

            $params = $request->only('name', 'parent_id', 'external_id');

            $model = Category::create($params);

            return Response::json(['success' => true, "id" => [$model->id]], 200);

        } catch (Throwable $e) {

            dump($e);
            return Response::json(['success' => false, "errors" => ['ошибка']], 201);

        }
    }

    public function edit(Category $category) 
    {
        return view('dashboard.categories.create', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category) 
    {
        try {

            $params = $request->only('name', 'parent_id', 'external_id');

            $category->update($params);

            return Response::json(['success' => true, "id" => [$category->id]], 200);

        } catch (Throwable $e) {

            dump($e);
            return Response::json(['success' => false, "errors" => ['ошибка']], 201);

        }
    }

    public function destroy(Category $category)
    {
        try {

            $category->delete();

            return Response::json(['success' => true, "delete" => 'ok'], 200);

        } catch (Throwable $e) {

            dump($e);
            return Response::json(['success' => false, "errors" => ['ошибка']], 201);

        }
    }

}
