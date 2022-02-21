<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Sound;
use App\Models\Collection;
use App\Models\SoundCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Carbon\Carbon;
class CollectionController extends Controller
{
  
     // save sound
    public function Save_Collection( Request $request)
    {

$validator = Validator::make($request->all(),
       [
            'name' => 'required'

        ]);

        if ($validator->fails()) {
            $errors =$validator->messages();
            return response()->json($errors ,400);
        }
        else
        {
                $user_id = Auth::user()->id;
                $check = Collection::where('user_id',$user_id)->where('name',$request->name)->first();
                if($check == null)
                {
                    $collect = new Collection();
                    $collect->user_id = $user_id;
                    $collect->name= $request->name;
                    $collect->save();
                    $message = 'Collection Saved Successfully';
                }
                else
                {
                    
                    $message = 'You have Already this Collection ';
                    
                }
                
                return response()->json($message, 200);
         }
    }

    // get auth user collection song
    public function Get_Collections()
    {

        $user_id = Auth::user()->id;
        $collections = Collection::with('Sound')->where('user_id',$user_id)->get();
        // dd($sound);
        if($collections == null)
        {
            $error = ['Message',['No Record Found!']];
            return response()->json($error, 404);
        }
        return response()->json($collections, 200);
    }

   
     // delete song
    public function Delete($id)
    {

        $user_id =  Auth::user()->id;
        $collection = Collection::where('user_id',$user_id)->where('sound_id',$id)->first();
        if($collection == null)
        {
            $result =['Message'=>['Sorry! you are unauthorized to Remove this song.']];
            return response()->json($result ,400);
        }
        else
        {
            $collection->delete();
            return response()->json(true ,200);
        }
    }


      // save sound
    public function CollectionAdd( $id, $soundId)
    {


            $user_id = Auth::user()->id;
            $check = SoundCollection::where('user_id',$user_id)->where('collection_id',$id)->where('sound_id',$soundId)->first();
            if($check == null)
            {
                $collect = new SoundCollection();
                $collect->user_id = $user_id;
                $collect->collection_id= $id;
                $collect->sound_id=$soundId;
                $collect->save();
                $message = 'Collection Saved Successfully';
            }
            else
            {
            
                $message = 'You have Already this Collection ';
            }
            
            return response()->json($message, 200);
         
    }


    public function CollectionSound()
    {
         $user_id = Auth::user()->id;
        $collections = SoundCollection::with('Sound')->where('user_id',$user_id)->get();
        // dd($sound);
        if($collections == null)
        {
            $error = ['Message',['No Record Found!']];
            return response()->json($error, 404);
        }
        return response()->json($collections, 200);
    }



}
