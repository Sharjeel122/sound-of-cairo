<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function Add(Request $request)
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
           $category= new Category($data);
            $file = $request->image;
            $name = $file->getClientOriginalName();
            $name = rand(0,1000).'_'.$name;
            $destinationPath = public_path('/user_images/');
            $file->move($destinationPath, $name);
            unset($data['image'] );
            $category->image= $name;
            $category->save();
            return response()->json($category);
        }

    }

    public function Update(Request $request,$id)
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
            $category= Category::where('id',$id)->first();
            if($category == null)
            {
                $result =['Message'=>['Category Not Found']];
                return response()->json($result ,404);
            }
            else
            {
                
              $data= $request->all();
              if($request->hasFile('image'))
              {
                unset($data['image'] );
                $file = $request->image;
                $name = $file->getClientOriginalName();
                $name = rand(0,1000).'_'.$name;
                $destinationPath = public_path('/user_images/');
                $file->move($destinationPath, $name);
                $category->image= $name;
              }
               
              $category->update($data);
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

   public function FeaturedOne($id)
    {
        $category= Category::where('id',$id)->first();
        if($category == null)
        {
            $result =['Message'=>['Category Not Found']];
            return response()->json($result ,404);
        }
        else
        {
            $category->featured_one= true;
            $category->featured_two= false;
            $category->update();
            return response()->json($category);
        }
    }

   public function FeaturedTwo($id)
    {
        $category= Category::where('id',$id)->first();
        if($category == null)
        {
            $result =['Message'=>['Category Not Found']];
            return response()->json($result ,404);
        }
        else
        {
            $category->featured_two= true;
             $category->featured_one= false;
            $category->update();
            return response()->json($category);
        }
    }

 public function UnFeatured($id)
    {
        $category= Category::where('id',$id)->first();
        if($category == null)
        {
            $result =['Message'=>['Category Not Found']];
            return response()->json($result ,404);
        }
        else
        {
            $category->featured_one= false;
            $category->featured_two= false;
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
    public function Get($id)
    {
        $category = Category::where('id', $id)->first();
        if ($category  == null) {
            $result = ['Message' => ['Category Not Found']];
            return response()->json($result, 404);
        } else {
            return response()->json($category );
        }
    }

    public function GetFeaturedOne()
    {
        $categories = Category::where('featured_one',true)->where('status',true)->limit(2)->get();
        return response()->json(['ocategories'=>$categories]);
    }

    public function GetFeaturedTwo()
    {
        $categories = Category::where('featured_two',true)->where('status',true)->limit(4)->get();
        return response()->json(['tcategories'=>$categories]);
    }

    public function GetAll()
    {
        $categories  = Category::all();
        return response()->json(['categories'=>$categories]);
    }
}
