<?php

namespace App\Http\Controllers;


use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;

use App\Messages;
use App\Models\Category;
use Illuminate\Support\Str;

use App\Http\Controllers\Files\ImageController;

class CategoryController extends Controller
{
   use Messages;


    public function index()
    {
        $categories = Category::with('parent','children')->paginate(10);
        return $this->success_message(CategoryResource::collection($categories),
            'Categories retrieved successfully.',200);
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {

            $data['image'] =  ImageController::store($request->file('image'), 'categories');
        }

        $data['slug'] = Str::slug($data['name']);


        $category = Category::create($data);

        return $this->success_message(new CategoryResource($category), 'Category created successfully.', 201);
    }

    public function show(Category $category)
    {

        $category->load('parent','children');
        return $this->success_message(new CategoryResource($category), 'Category retrieved successfully.',200);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();


        if ($request->hasFile('image')) {

            $data['image'] = ImageController::updateImage($request->file('image'), $category->image, 'categories');
        }

        if ($request->has('name')) {
            $data['slug'] = Str::slug($data['name']);
        }


        $category->update($data);

        return $this->success_message(new CategoryResource($category), 'Category updated successfully.',200);
    }

    public function destroy(Category $category)
    {

        if ($category->image) {
            ImageController::deleteImage($category->image, 'categories');

        }


        $category->delete();

        return $this->success_message(null, 'Category deleted successfully.',200);
    }
    private function find($id)
    {
        return Category::find($id);
    }
}
