<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class SubCategoryController extends Controller
{

    // add sub category
    public function add(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
            'image' => 'required|image'
        ]);
        if ($validator->fails())
        {

            $errors =$validator->messages();
            return response()->json($errors ,400);
        }
        else
        {

            $check = Category::where('id',$request->category_id)->first();
            if($check == null)
            {
                $errors = ['Message'=>['Invalid main category id']];
                return response()->json($errors,404);
            }
            $data= $request->all();
            unset($data['image'] );
            $sub_category= new SubCategory($data);
            $file = $request->image;
            $name = $file->getClientOriginalName();
            $name = rand(0,1000).'_'.$name;
            $destinationPath = public_path('/sub_images/');
            $file->move($destinationPath, $name);
            $sub_category->image= $name;
            $sub_category->save();
            return response()->json($sub_category);
        }

    }

    // update sub category
    public function  update_sub(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required|image'
        ]);
        if ($validator->fails()) {
            $errors =$validator->messages();
            return response()->json($errors ,400);
        }
        else
        {
            $data= $request->all();
            $SubCategory= SubCategory::where('id',$id)->first();
            if($SubCategory == null)
            {
                $result =['Message'=>['Category Not Found']];
                return response()->json($result ,404);
            }
            else
            {
                if($request->hasFile('image'))
                {
                    unset($data['image'] );
                    $file = $request->image;
                    $name = $file->getClientOriginalName();
                    $name = rand(0,1000).'_'.$name;
                    $destinationPath = public_path('/sub_images/');
                    $file->move($destinationPath, $name);
                    $SubCategory->image= $name;
                }

                $SubCategory->update($data);
                return response()->json($SubCategory);
            }

        }
    }
    // block sub category
    public function sub_block($id)
    {
        $data = SubCategory::where('id',$id)->first();
        if($data == null)
        {
            $errors = ['Message'=>['Data not found']];
            return response()->json($errors, 404);
        }
        else
        {
            $data->status= false;
            $data->update();
            return response()->json($data);
        }
    }
    // unblock sub category
    public function sub_unblock($id)
    {
        $data = SubCategory::where('id',$id)->first();
        if($data == null)
        {
            $errors = ['Message'=>['Data not found']];
            return response()->json($errors, 404);
        }
        else
        {
            $data->status= true;
            $data->update();
            return response()->json($data);
        }
    }
    // admin can get one sub category by id
    public function get_sub($id)
    {
        $data = SubCategory::where('id',$id)->first();
        if($data == null)
        {
            $errors = ['Message'=>['Data not found']];
            return response()->json($errors,404);
        }
        else
        {
            return response()->json($data, 200);
        }
    }
    // get all sub category its for all auth and unauthuriized both can access
    public function get_sub_category()
    {
        $data = SubCategory::where('status',true)->get();
        if($data == null)
        {
            $errors = ['Message'=>['Data not found']];
            return response()->json($errors, 404);
        }
        else
        {
            return response()->json($data,200);
        }
    }

    // get all sub category its for all auth and unauthuriized both can access
    public function sub_cat_admin()
    {
         $data = SubCategory::all();
          return response()->json($data,200);
    }

public function Subcat_of_category($id)
{
       $cat = Category::where('id',$id)->where('status',true)->first();
        if($cat == null)
        {
            $errors = ['Message'=>['Data not found']];
            return response()->json($errors, 404);
        }
        else
        {
          $data = SubCategory::where('category_id',$id)->where('status',true)->get();
            return response()->json($data,200);
        }
}

}
