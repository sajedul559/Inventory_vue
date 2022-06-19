<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Cart;
use App\Models\Vat;



class CartController extends Controller
{
    public function addToCart(Request $request,$id)
    {

        $product = DB::table('products')->where('id',$id)->first();
        $check = DB::table('carts')->where('pro_id',$id)->first();
        if($check){
            $increment =  DB::table('carts')->where('pro_id',$id)->increment('pro_quantity');
          $cart_product = DB::table('carts')->where('pro_id',$id)->first();
         $subtotal = $cart_product->pro_quantity * $cart_product->product_price;
         DB::table('carts')->where('pro_id',$id)->update(['sub_total' => $subtotal]);


        }
        else{
            $data=array();
            $data['pro_id']= $id;
            $data['pro_name'] = $product->product_name;
            $data['pro_quantity'] =1;
            $data['product_price'] = $product->selling_price;
            $data['sub_total'] = $product->selling_price;
            DB::table('carts')->insert($data);
            return response()->json('done');
        }
       

    }

    public function cartProduct()
    {
        $cart = DB::table('carts')->get();
        return response()->json($cart);
    }
    public function removeCart($id)
    {
      $cart = Cart::findorfail($id);
      $cart->delete();
    }

    public function incrementCart($id)
    {
       $quantity =   DB::table('carts')->where('id',$id)->increment('pro_quantity');
       $product = DB::table('carts')->where('id',$id)->first();
       $subtotal = $product->pro_quantity * $product->product_price;
       DB::table('carts')->where('id',$id)->update(['sub_total' => $subtotal]);

    }
    public function decrementCart($id)
    {
        $quantity =   DB::table('carts')->where('id',$id)->decrement('pro_quantity');
        $product = DB::table('carts')->where('id',$id)->first();
        $subtotal = $product->pro_quantity * $product->product_price;
        DB::table('carts')->where('id',$id)->update(['sub_total' => $subtotal]);
    }

    public function vats()
    {
       $vat = DB::table('extras')->first();
       return response()->json($vat);
    }
    public function cartQuantity()
    {
        $quantity = DB::table('carts')->sum('pro_quantity');
        return response()->json($quantity);
    }
    public function cartSubTotal()
    {
        $subtotal = DB::table('carts')->sum('sub_total');
        return response()->json($subtotal);
    }
    
}
