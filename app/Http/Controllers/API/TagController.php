<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    public function Add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->messages();
            return response()->json($errors, 400);
        } else {
            $tag = new Tag($request->all());
            $tag->save();
            return response()->json($tag);
        }

    }

    public function Update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->messages();
            return response()->json($errors, 400);
        } else {
            $tag= Tag::where('id', $id)->first();
            if ( $tag == null) {
                $result = ['Message' => ['Tag Not Found']];
                return response()->json($result, 404);
            } else {
                $tag->update($request->all());
                return response()->json( $tag);
            }

        }

    }

    public function Block($id)
    {
        $tag = Tag::where('id', $id)->first();
        if ( $tag == null) {
            $result = ['Message' => ['Tag Not Found']];
            return response()->json($result, 404);
        } else {
            $tag->status = false;
            $tag->update();
            return response()->json( $tag);
        }
    }

    public function Unblock($id)
    {
        $tag = Tag::where('id', $id)->first();
        if ($tag == null) {
            $result = ['Message' => ['Tag Not Found']];
            return response()->json($result, 404);
        } else {
            $tag->status = true;
            $tag->update();
            return response()->json($tag);
        }
    }

    public function Get($id)
    {
        $tag = Tag::where('id', $id)->first();
        if ($tag == null) {
            $result = ['Message' => ['Tag Not Found']];
            return response()->json($result, 404);
        } else {
            return response()->json($tag);
        }
    }
    public function GetAll($pageNum)
    {
        $tags = Tag::all();
        return response()->json(['tags'=>$tags]);
    }
    public function GetAllHome()
    {
        $tags = Tag::where('status',1)->get();
        return response()->json(['tags'=>$tags]);
    }
}
