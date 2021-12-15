<?php

namespace App\Http\Controllers;
use App\Models\User;
use Hash;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function Register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users',
            'name' => 'required',
            'profession' => 'required',
            'password' => 'required',
            'agree_on_terms' => 'required'
        ]);

        if ($validator->fails()) {
            $errors =$validator->messages();
            return response()->json($errors ,400);
        }
        elseif($request->agree_on_terms  == false){
            $result =['Message'=>['Must agree with terms of services']];
            return response()->json($result ,400);
        }
        else
        {
            $user = new User();
            $user->name= $request->name;
            $user->email= $request->email;
            $user->profession= $request->profession;
            $user->status= true;
            $user->agree_on_terms= true;
            $user->password= Hash::make($request->password);
            $user->save();
            return response()->json($user);
        }

    }

    public function Login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password))
        {
            $result =['Message'=>['Bad username or password']];
            return response()->json($result ,400);
        }
        else
        {
            unset($user['password']);
            $token = $user->createToken('my-app-token')->plainTextToken;
            $userArr = $user->toArray();
            $userArr['token'] = $token;
            return response()->json($userArr);
        }
    }

    public function Logout(Request $request)
    {

            $id = $request->user('sanctum')->id;
            $user = User::findOrFail($id);
            $user->tokens()->delete();
            $result =['Message'=>['Logout Successfully']];
            return response()->json($result  ,200);

    }

    public function GetAll()
    {
        $users = User::where('status',1)->get();
        return response()->json(['users'=>$users]);
    }

    public function Get($id)
    {
        $user = User::where('id',$id)->first();
        if($user != null)
        {
            return response()->json(['user'=>$user]);
        }
        else
        {
            $result =['Message'=>['User Not Found']];
            return response()->json($result ,404);
        }

    }

    public function Block($id)
    {
        $user =  User::where('id',$id)->first();
        if($user != null)
        {
            $user->status = false ;
            $user->update();
            return response()->json(['user'=>$user]);
        }
        else
        {
            $result =['Message'=>['User Not Found']];
            return response()->json($result ,404);
        }

    }
    public function UnBlock($id)
    {
        $user = User::where('id',$id)->first();
        if($user != null)
        {
            $user->status = true ;
            $user->update();
            return response()->json(['user'=>$user]);
        }
        else
        {
            $result =['Message'=>['User Not Found']];
            return response()->json($result ,404);
        }

    }

}
