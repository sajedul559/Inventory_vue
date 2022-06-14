<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Image;
use DB;

class SupplierController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('JWT', ['except' => ['login','signup']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supllier = Supplier::all();
        return response()->json($supllier);
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
            'name' =>'required|unique:suppliers|max:255',
            'email' =>'required',
            'phone' =>'required|unique:suppliers',

        ]);
        if($request->photo){
            $image = $request->photo;
            $position = strpos($image,';');
            $sub = substr($request->photo,0,$position);
            $ext = explode('/',$sub)[1];
            $name = time().".".$ext;
            $img = Image::make($image)->resize(200,200);
            $upload_path = 'backend/supplier/';
            $image_url = $upload_path.$name;
            $img->save($image_url);

            $supplier = new Supplier;
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;      
            $supplier->photo = $image_url;
            $supplier->shopname = $request->shopname;

            $supplier->save();

        }
        else{

            $supplier = new Supplier;
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->salary = $request->salary;
            $supplier->shopname = $request->shopname;
            $supplier->save();
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
        $supplier = DB::table('suppliers')->where('id',$id)->first();
        return response()->json($supplier);
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
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['shopname'] = $request->shopname;
        

        if($request->newphoto)
        {

            $image = $request->newphoto;
            $position = strpos($request->newphoto,';');
            $sub = substr($request->newphoto, 0 ,$position);            
            $ext = explode('/',$sub)[1];
            $name = time().".".$ext;
            $img = Image::make($image)->resize(200,200);
            $upload_path = 'backend/supplier/';
            $image_url = $upload_path.$name;
            $success =  $img->save($image_url);
            if($success)
            {
              $img = Supplier::findorfail($id);
              $image_path = $img->photo;

              if($image_path){
                 unlink($image_path);
                $data['photo'] = $image_url;
                $user = Supplier::findorfail($id)->update($data);


              }
              else{

                $img = Supplier::findorfail($id);
                $image_path = $img->photo; 

              
                $data['photo'] = $image_url;
                $user = Supplier::findorfail($id)->update($data); 

              }
              
            }
           
        }
         else
         {

               $oldlogo = $request->photo;
                $data['photo']= $oldlogo;
                $user = Supplier::findorfail($id)->update($data);
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
       $supplier = Supplier::findorfail($id)->first();
       //return response()->json($employee);
       if($supplier->photo){
        unlink($supplier->photo);
        $supplier->delete();

       }
       else{
        $supplier = Supplier::findorfail($id)->delete();

       }
    }
}


