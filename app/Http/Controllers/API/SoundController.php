<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Sound;
use App\Models\SoundUpload;
use App\Models\Upvote;
use App\Models\SaveSound;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Carbon\Carbon;
class SoundController extends Controller
{
    // index for front end only show those sound where status is true
    public function front()
    {
        $sound = Sound::where('status',1)->where('sound_status','Approved')->get();
        return response()->json($sound, 200);

    }
    // add sound admin or User for both
    public function Add_Sound(Request $request)
    {

       $validator = Validator::make($request->all(),
       [
            'name' => 'required',
            'location_id' => 'required',
            'tag_id' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'duration' => 'required',
            'description' => 'required',
            'information' => 'required',
            'song' => 'required',

        ]);
        if ($validator->fails()) {
            $errors =$validator->messages();
            return response()->json($errors ,400);
        }
        else
        {
            $id = Auth::user()->id;
            $data = $request->all();
            unset($data['song']);
            $sound = new Sound ($data);
            $file = $request->song;

            $format= $file->getClientOriginalExtension(); //check audio file extension
            if($format == "audio" || $format == "mpeg" || $format == "mpga"|| $format == "mp3"|| $format == "wav" || $format == "aac" || $format == "m4a")
            {
                $name = $file->getClientOriginalName();
                $name = rand(0,1000).'_'.$name;
                $destinationPath = public_path('/sounds/');
                $file->move($destinationPath, $name); 
                $sound->song =$name;
                $sound->user_id = $id;
                $sound->duration = $request->duration;
                $sound->format = $format;
                $date=date("M-Y");
                $sound->uploaded_date = $date;
            }
            else
            {
                $message = ['Message',['Sound Must Be Audio File!']];
                return response()->json($message, 400);
            }

            $sound->save();
            return response()->json($sound);
        }
    }
    // update sound
    public function Update_Sound(Request $request,$id)
    {

        $validator = Validator::make($request->all(), [
        'name' => 'required',
        'location_id' => 'required',
        'tag_id' => 'required',
        'category_id' => 'required',
        'sub_category_id' => 'required',
        'duration' => 'required',

        ]);
        if ($validator->fails()) {
             $errors =$validator->messages();
             return response()->json($errors ,400);
         }
        else
        {
            $sound = Sound::where('id',$id)->first();
            if($sound == null)
            {
                $result =['Message'=>['Sound Not Found']];
                return response()->json($result ,404);
            }
            else
            {
                $data= $request->all();

                if($request->hasFile('name'))
                {
                    $file = $request->name;
                    $format= $file->getClientOriginalExtension();
                    if($format == "audio" || $format == "mpeg" || $format == "mpga"|| $format == "mp3"|| $format == "wav" || $format == "aac")
                    {
                         // song uploaded code
                         $name = $file->getClientOriginalName();
                         $name = rand(0,1000).'_'.$name;
                         $destinationPath = public_path('/sounds/');
                         $file->move($destinationPath, $name);
                         unset($data['name']);
                         $sound->name =$name;

                    }
                    else
                    {
                        $message = ['Message',['Sound Must Be Audio File!']];
                        return response()->json($message, 400);
                    }

                }
                $sound->user_id = Auth::user()->id;
                $sound->duration = $request->duration;
               
                $sound->format = $format;
            }
            $sound->update($data);

            $message = ['Message',['Sound Updated Successfully!']];
            return response()->json($sound, 200);
        }
    
    }
    // get sound by id
    public function Get_Sound($id)
    {
        $sound = Sound::where('id',$id)->first();
       if($sound == null)
       {
        $message = ['Message',['Sound Not Found']];
        return response()->json($message, 404);
       }
       else
       {
        return response()->json($sound, 200);
       }
    }
    //get all sound for admin and user
    public function Get_All()
    {
        $sound = Sound::all();
        return response()->json($sound, 200);
    }
    // this route only for admin
    //block sound
    public function Block($id)
    {
        $sound = Sound::where('id',$id)->first();
        if($sound == null)
        {
            $message = ['Message',['Sound Not Found']];
            return response()->json($message ,400);
        }
        else
        {
            if($sound == true)
            {
                $sound->status = false;
            }

        }
        $sound->update();
        $message = ['Message',['Status Updated Successfully']];
        return response()->json($sound ,200);

    }
    // unblock sound
    public function UnBlock($id)
    {
        $sound = Sound::where('id',$id)->first();
        if($sound == null)
        {
            $message = ['Message',['Sound Not Found']];
            return response()->json($message ,400);
        }
        else
        {
            if($sound->status == false)
            {
                $sound->status = true;
            }
        }
        $sound->update();
        $message = ['Message',['Status Updated Successfully']];
        return response()->json($sound ,200);
    }

   //count totle song
    public function Count_totle()
    {
        $sound = Sound::with('User','locations','tags','Category','SubCategory')->where('status',true)->where('sound_status','Approved')->count();
        return response()->json($sound);
    }

    // save sound
    public function Save_Sound($id)
    {

        $sound = Sound::with('User','locations','tags','Category','SubCategory')->where('id',$id)->first();
        if($sound == null)
        {

            $error = ['Message',['No Record Found!']];
            return response()->json($error, 404);
        }
        else
        {
            $user_id = Auth::user()->id;
            $check = SaveSound::where('user_id',$user_id)->where('sound_id',$id)->first();
            if($check == null)
            {
                $save_sound = new SaveSound ();
                $save_sound->user_id = $user_id;
                $save_sound->sound_id = $id;
                $save_sound->save();
                $message = 'Sound Saved Successfully';
            }
            else
            {
                if($check->status == true)
                {
                    $check->delete();
                    $message = 'Sound UnSaved Successfully';
                }
            }
        }
        return response()->json($message, 200);
    }

    // get auth user saved song
    public function Get_My_Saved_Song()
    {

        $user_id = Auth::user()->id;

        $sound = SaveSound::with('Sound')->where('sound_status','Approved')->where('user_id',$user_id)->get();
        // dd($sound);
        if($sound == null)
        {
            $error = ['Message',['No Record Found!']];
            return response()->json($error, 404);
        }
        return response()->json($sound, 200);
    }

   // upvote the song
    public function Upvote($id)
    {
        $sound = Sound::with('User','locations','tags','Category','SubCategory')->where('id',$id)->first();
        if($sound == null)
        {
            $error = ['Message',['No Record Found!']];
            return response()->json($error, 404);
        }
        else
        {
            $user_id = Auth::user()->id;
            $check = Upvote::where('user_id',$user_id)->where('sound_id',$id)->first();

            if($check == null)
            {
                $upvote = new Upvote();
                $upvote->user_id = $user_id;
                $upvote->sound_id = $id;
                $sound->upvote += 1;
                $upvote->save();
            }
            else
            {
                if($check->status == true)
                {

                    $sound->upvote -= 1;
                    $check->status = false;
                }
                else
                {
                    $sound->upvote += 1;
                    $check->status = true;
                }

                $check->update();
            }

            $sound->update();
            return response()->json($sound, 200);
        }
    }
     // delete song
    public function Delete_Song($id)
    {

        $user_id =  Auth::user()->id;
        $sound = Sound::where('user_id',$user_id)->where('id',$id)->first();
        if($sound == null)
        {
            $result =['Message'=>['Sorry! you are unauthorized to Remove this song.']];
            return response()->json($result ,400);
        }
        else
        {
            $sound->delete();
            return response()->json($sound ,200);
        }
    }


    //for admin
        public function Delete($id)
        {
            $sound = Sound::where('id',$id)->first();
            $sound->delete();
            return response()->json($sound ,200);
        }

           //for admin
        public function Rejected()
        {
            $sound = Sound::where('sound_status','Rejected')->get();
            return response()->json($sound ,200);
        }


                 //for admin
        public function Approved()
        {

            $sound = Sound::where('sound_status','Approved')->where('status',1)->get();
            return response()->json($sound ,200);
        }

}
