<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
Use Image;
Use DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::all();
        return response()->json($employee);
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
            'name' =>'required|unique:employees|max:255',
            'email' =>'required',
            'phone' =>'required|unique:employees',

        ]);
        if($request->photo){
            $image = $request->photo;
            $position = strpos($request->photo,';');
            $sub = substr($request->photo,0,$position);
            $ext = explode('/',$sub)[1];
            $name = time().".".$ext;
            $img = Image::make($image)->resize(200,200);
            $upload_path = 'backend/employee/';
            $image_url = $upload_path.$name;
            $img->save($image_url);

            $employee = new Employee;
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->nid = $request->nid;
            $employee->joining_date = $request->joining_date;
            $employee->photo = $image_url;
            $employee->save();

        }
        else{

            $employee = new Employee;
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->nid = $request->nid;
            $employee->joining_date = $request->joining_date;
            $employee->save();
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
        $employee = DB::table('employees')->where('id',$id)->first();
        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $data['salary'] = $request->salary;
        $data['nid'] = $request->nid;
        $data['joining_date'] = $request->joining_date;
        

        if($request->newphoto)
        {

            $image = $request->newphoto;
            $position = strpos($request->newphoto,';');
            $sub = substr($request->newphoto, 0 ,$position);            
            $ext = explode('/',$sub)[1];
            $name = time().".".$ext;
            $img = Image::make($image)->resize(200,200);
            $upload_path = 'backend/employee/';
            $image_url = $upload_path.$name;
            $success =  $img->save($image_url);
            if($success)
            {
              $img = Employee::findorfail($id);
              $image_path = $img->photo;

              if($image_path){
                 unlink($image_path);
                $data['photo'] = $image_url;
                $user = Employee::findorfail($id)->update($data);


              }
              else{

                $img = Employee::findorfail($id);
                $image_path = $img->photo;

              
                $data['photo'] = $image_url;
                $user = Employee::findorfail($id)->update($data); $user = Employee::findorfail($id)->update($data);

              }
              
            }
           
        }
         else
         {

               $oldlogo = $request->photo;
                $data['photo']= $oldlogo;
                $user = Employee::findorfail($id)->update($data);
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
       $employee = Employee::findorfail($id)->first();
       //return response()->json($employee);
       if($employee->photo){
        unlink($employee->photo);
        $employee->delete();

       }
       else{
        return "unlink else";
        $employee = Employee::findorfail($id)->delete();

       }
    }
}
