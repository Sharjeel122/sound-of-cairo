<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use File;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    public function add( Request $request , $id)
    {

        $validator = Validator::make($request->all(), [
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            $errors =$validator->messages();
            return response()->json($errors ,400);
        }
        else
        {
            $user = User::where('id',$id)->first();
            if($user == null)
            {
                $result =['Message'=>['User Not Found']];
                return response()->json($result ,404);
            }
            else
            {
                $file = $request->image;
                $name = $file->getClientOriginalName();
                $name = rand(0,1000).'_'.$name;
                $destinationPath = public_path('/user_images/');
                $file->move($destinationPath, $name);
                $data= $request->all();
                unset($data['image'] );
                $Userprofile = new UserProfile($data);
                $Userprofile->image= $name;
                $Userprofile->user_id=$id;
                $Userprofile->save();
                $userWithProfile = User::where('id',$id)->with('get_user_profile')->first();
                return response()->json($userWithProfile);
            }
        }
    }

    public function update( Request $request , $id)
    {

        $user = User::where('id',$id)->first();
        $userProfile = UserProfile::where('user_id',$id)->first();
        if($user == null || $userProfile == null)
            {
                $result =['Message'=>['User Profile Not Found']];
                return response()->json($result ,404);
            }
            else
            {
                $data= $request->all();
                if(!$request->image == null)
                {
                    $file = $request->image;
                    $name = $file->getClientOriginalName();
                    $name = rand(0,1000).'_'.$name;
                    $destinationPath = public_path('/user_images/');
                    $file->move($destinationPath, $name);
                    unset($data['image'] );
                    $userProfile->image = $name;
                }
                $userProfile->update($data);
                $userWithProfile = User::where('id',$id)->with('get_user_profile')->first();
                return response()->json($userWithProfile);
            }

    }


    public function delete($id)
    {
        $user = User::where('id',$id)->first();
        $userProfile = UserProfile::where('user_id',$id)->first();
        if($user == null || $userProfile == null)
        {
            $result =['Message'=>['User Profile Not Found']];
            return response()->json($result ,404);
        }
        else
        {
           $userProfile->status=false;
           $userProfile->update();
            $userWithProfile = User::where('id',$id)->with('get_user_profile')->first();
            return response()->json($userWithProfile);

        }
    }
}
