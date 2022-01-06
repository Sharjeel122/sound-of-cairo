<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Hash;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function IndexPage() {
    return view('welcome');
}
    public function Register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
            'profession' => 'required',
            'password' => 'required',
            'date_of_birth'=>'required',
            'agree_on_terms' => 'required|boolean'
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
            $user->first_name= $request->first_name;
            $user->last_name= $request->last_name;
            $user->email= $request->email;
            $user->date_of_birth= $request->date_of_birth;
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
        $user = User::with('get_user_profile')->where('email', $request->email)->first();
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

    public function GetAll($pageNum)
    {
        $users = User::with('get_user_profile')->where('status',1)->paginate(2, ['*'], 'page', $pageNum);
        return response()->json(['users'=>$users]);
    }

    public function Get($id)
    {
        $user = User::with('get_user_profile')->where('id',$id)->first();
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
        $user =  User::with('get_user_profile')->where('id',$id)->first();
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
        $user = User::with('get_user_profile')->where('id',$id)->first();
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
