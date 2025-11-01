<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Files\FileController;
use App\Http\Controllers\Files\ImageController;
use App\Http\Requests\Product\StoreproductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Messages;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\Image;

class ProductController extends Controller
{
use Messages;
    public function index()
    {

        $products = Product::with('images')->lazy();
      return $this->success_message( ProductResource::collection($products), 'products retrieved successfully', 200);
    }


    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $data['image']=FileController::storeFile($request->file('main_image'),'images/products');



        $product = Product::create($data);
        if($request->hasFile('images'))
        {
            $images=FileController::storeMultiple($request->file('images'),'images/products');
            ProductImageController::store($product,$images);
        }

       $product->load('images');
       return $this->success_message(new ProductResource($product), 'product created successfully', 201);
    }


    public function show(Product $product)
    {

         $product->load('images');
        return $this->success_message(new ProductResource($product),'product found successfully',200);
    }


    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();



           $data['image']=FileController::updateFile($request->file('main_image'),$product->image,'images/products');
           if($request->hasFile('images')){
               $oldImages=  ProductImageController::LoadProductImages($product);
               $images=FileController::updateMultiple($request->file('images'),
                 $oldImages
                   ,'images/products');
               ProductImageController::update($product,$images);
           }

        $product->update($data);



        return $this->success_message(new ProductResource($product), 'product updated successfully', 200);
    }


    public function destroy(Product $product)
    {

        $images= ProductImageController::LoadProductImages($product);
        $product->delete();
        FileController::deleteFile($product->image,'images/products');//delete the main image
        FileController::deleteAllFiles($images,'images/products');//delete the sub images
       return $this->success_message(null, 'product deleted successfully', 200);
    }
}
