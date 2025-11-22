<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItem\StoreCartItemRequest;
use App\Http\Requests\CartItem\UpdateCartItemRequest;
use App\Http\Resources\CartItemResource;
use App\Messages;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    use Messages;
    public function __construct(){
        $this->middleware('auth:sanctum');
    }
    public function index(Request $request)
    {
        $cart=Auth::user()->cart_item()->with('product')->get();

      return $this->success_message(CartItemResource::collection($cart),'carts retrieved successfully',200);
    }
    //private
    private  function _GetCartItem($product)
    {

       return Auth::user()->cart_item()->where('product_id',$product)->first();

    }
    private function _CheckStock($stock,$newQuantity)
    {
        return $newQuantity>$stock;
    }



    /**
     * Show the form for creating a new resource.
     */
    public function store(StoreCartItemRequest $request)
    {
        $data = $request->validated();

        $product = Product::findOrFail($request->product_id);
        $product_id=$request->product_id;
        $cartItem = $this->_GetCartItem($product_id);

        if ($cartItem)
        {
            $totalQuantity = $cartItem->quantity/*current quantity*/ + $request->quantity/*new quantity*/;

            if ($totalQuantity > $product->stock)
            {
                return self::error_message(null, 'Total quantity exceeds available stock', 422);
            }

            $cartItem->update(['quantity' => $totalQuantity]);


            $cartItem->load('product');
            return $this->success_message(new CartItemResource($cartItem), 'Item quantity updated', 200);
        }


        if ($request->quantity > $product->stock) {
            return self::error_message(null, 'Requested quantity exceeds available stock', 422);
        }
        $items = Auth::user()->cart_item()->create($data);

        $items->load('product');
        return $this->success_message(new CartItemResource($items), 'Cart Item Created', 201);


    }




    /**
     * Display the specified resource.
     */
    public function show(CartItem $cart)
    {
        $cart->load('product');
        return $this->success_message(new CartItemResource($cart),'items retrieved successfully',200);
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartItemRequest $request, CartItem $cart)
    {
        if($request->quantity>$cart->product->stock){
            return response()->json(['data'=>null,'message'=>'quantity exceeds the product stock']);
        }
        $this->authorize('update', $cart);
        $cart->update($request->validated());
        $cart->load('product');
        return $this->success_message(new CartItemResource($cart),'item updated successfully',200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartItem $cart)
    {
        $this->authorize('delete',$cart);
        $cart->delete();
        return $this->success_message(null,'item deleted successfully',200);
    }
}
