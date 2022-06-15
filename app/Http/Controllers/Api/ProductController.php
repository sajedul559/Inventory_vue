<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use App\Models\Product;
use DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return response()->json($product);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_code' =>'required|unique:products|max:255',
            
        ]);
        if($request->image){
            $image = $request->image;
            $position = strpos($image,';');
            $sub = substr($request->image,0,$position);
            $ext = explode('/',$sub)[1];
            $name = time().".".$ext;
            $img = Image::make($image)->resize(200,200);
            $upload_path = 'backend/product/';
            $image_url = $upload_path.$name;
            $img->save($image_url);

            $product = new Product;
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->category_id = $request->category_id;
            $product->supplier_id = $request->supplier_id;
            $product->root = $request->root;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->buying_date = $request->buying_date;
            $product->product_quantity = $request->product_quantity;           
            $product->image = $image_url;
            $product->save();

        }
        else{

            $product = new Product;
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->category_id = $request->category_id;
            $product->supplier_id = $request->supplier_id;
            $product->root = $request->root;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->buying_date = $request->buying_date;
            $product->product_quantity = $request->product_quantity;           
            $product->save();

        }
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = DB::table('products')->where('id',$id)->first();
        return response()->json($product);
    }


   
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['category_id'] = $request->category_id;
        $data['supplier_id'] = $request->supplier_id;
        $data['root'] = $request->root;
        $data['buying_price'] = $request->buying_price;
        $data['selling_price'] = $request->selling_price;
        $data['buying_date'] = $request->buying_date;
        $data['product_quantity'] = $request->product_quantity; 

        if($request->newphoto)
        {

            $image = $request->newphoto;
            $position = strpos($request->newphoto,';');
            $sub = substr($request->newphoto, 0 ,$position);            
            $ext = explode('/',$sub)[1];
            $name = time().".".$ext;
            $img = Image::make($image)->resize(200,200);
            $upload_path = 'backend/product/';
            $image_url = $upload_path.$name;
            $success =  $img->save($image_url);
            if($success)
            {
              $img = Product::findorfail($id);
              $image_path = $img->image;

              if($image_path){
                 unlink($image_path);
                $data['image'] = $image_url;
                $user = Product::findorfail($id)->update($data);


              }
              else{

                $img = Product::findorfail($id);
                $image_path = $img->image; 

              
                $data['image'] = $image_url;
                $user = Product::findorfail($id)->update($data); 

              }
              
            }
           
        }
         else
         {

               $oldlogo = $request->image;
                $data['image']= $oldlogo;
                $user = Product::findorfail($id)->update($data);
            }

        
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::findorfail($id)->first();
        //return response()->json($product);
        if($product->image){
         unlink($product->image);
         $product->delete();
 
        }
        else{
         $product = Product::findorfail($id)->delete();
 
        }
     }
 }
 