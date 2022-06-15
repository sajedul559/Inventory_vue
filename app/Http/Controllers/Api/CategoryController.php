<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;
use Image;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Categorie::all();
        return response()->json($category);
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateDate = $request->validate([

        'category_name' => 'required|unique:categories',
        ]);

        $category = new Categorie();
        $category->category_name = $request->category_name;
        $category->save();

        //Query Builder
        // $data=array();
        // $data['category_name'] = $request->caregory_name;
        // DB::table('categories')->insert($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Categorie::findorfail($id);
        return response()->json($category);

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

        $category = Categorie::findorfail($id);
        $category->category_name = $request->category_name;

        $category->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('categories')->where('id',$id)->delete();
    }
}
