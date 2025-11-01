<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ImageResource;
use App\Messages;
use App\Models\Product;
use App\Models\Product_Image;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
use Messages;
 public  function index(Product $product)
 {
     $images=$product->load('images');

     return $this->success_message(new ImageResource($images),'images retrieved successfully',200);

 }
 public static function store($product,$images)
 {
     foreach($images as $image)
     {

         $product->images()->create
         ([
             'name'=>$image,
         ]);
     }
 }
 public static function update( $product,$images)
 {
     foreach($images as $image){
         $product->images()->update([
             'name'=>$image,
         ]);
     }

 }
 }

