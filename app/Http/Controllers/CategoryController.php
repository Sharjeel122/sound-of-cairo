<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function Add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            $errors =$validator->messages();
            return response()->json($errors ,400);
        }
        else
        {
            $category= new Category($request->all());
            $category->save();
            return response()->json($category);
        }

    }

    public function Update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            $errors =$validator->messages();
            return response()->json($errors ,400);
        }
        else
        {
            $category= Category::where('id',$id)->first();
            if($category == null)
            {
                $result =['Message'=>['Category Not Found']];
                return response()->json($result ,404);
            }
            else
            {
                $category->update($request->all());
                return response()->json($category);
            }

        }

    }

    public function Block($id)
    {
        $category= Category::where('id',$id)->first();
        if($category == null)
        {
            $result =['Message'=>['Category Not Found']];
            return response()->json($result ,404);
        }
        else
        {
            $category->status= false;
            $category->update();
            return response()->json($category);
        }
    }
    public function Unblock($id)
    {
        $category= Category::where('id',$id)->first();
        if($category == null)
        {
            $result =['Message'=>['Category Not Found']];
            return response()->json($result ,404);
        }
        else
        {
            $category->status= true;
            $category->update();
            return response()->json($category);
        }
    }
}
