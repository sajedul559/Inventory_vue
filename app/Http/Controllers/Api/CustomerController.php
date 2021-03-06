<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;
use App\Models\Customer;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::all();
        return response()->json($customer);
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
            'name' =>'required|unique:customers|max:255',
            'email' =>'required',
            'phone' =>'required|unique:customers',

        ]);
        if($request->photo){
            $image = $request->photo;
            $position = strpos($image,';');
            $sub = substr($request->photo,0,$position);
            $ext = explode('/',$sub)[1];
            $name = time().".".$ext;
            $img = Image::make($image)->resize(200,200);
            $upload_path = 'backend/customer/';
            $image_url = $upload_path.$name;
            $img->save($image_url);

            $customer = new Customer;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->photo = $image_url;
            $customer->save();

        }
        else{

            $customer = new Customer;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->save();
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
        $customer = DB::table('customers')->where('id',$id)->first();
        return response()->json($customer);
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
        // return $request->all();
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;

        if($request->newphoto)
        {

            $image = $request->newphoto;
            $position = strpos($request->newphoto,';');
            $sub = substr($request->newphoto, 0 ,$position);            
            $ext = explode('/',$sub)[1];
            $name = time().".".$ext;
            $img = Image::make($image)->resize(200,200);
            $upload_path = 'backend/customer/';
            $image_url = $upload_path.$name;
            $success =  $img->save($image_url);
            if($success)
            {
              $img = Customer::findorfail($id);
              $image_path = $img->photo;

              if($image_path){
                 unlink($image_path);
                $data['photo'] = $image_url;
                $user = Customer::findorfail($id)->update($data);


              }
              else{

                $img = Customer::findorfail($id);
                $image_path = $img->photo; 

              
                $data['photo'] = $image_url;
                $user = Customer::findorfail($id)->update($data); 

              }
              
            }
           
        }
         else
         {

                $oldlogo = $request->photo;
                $data['photo']= $oldlogo;
                $user = Customer::findorfail($id)->update($data);
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
        $customer = Customer::findorfail($id)->first();
        //return response()->json($customer);
        if($customer->photo){
         unlink($customer->photo);
         $customer->delete();
 
        }
        else{
         $customer = Customer::findorfail($id)->delete();
 
        }
     }
 }
 