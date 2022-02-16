<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Sound;
use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Carbon\Carbon;
class DownloadController extends Controller
{
   
   public function download($id)
    {
        $sound = Sound::where('id',$id)->first();
        if($sound->is_downloadable == true)
        {   $user_id = Auth::user()->id;
            $check= Download::where('user_id',$user_id)->first();

           $today = date('Y-m-d');
           $a = strtotime($today);
           $b = strtotime("+7 day", $a);
           $week = date('Y -m-d', $b);
 
	           if($check == null)
	           {
		            $download = new Download();
		            $download->user_id = $user_id;
		            $download->sound_id = $id;
		            $download->today_date= $today;
		            $download->week_date = $week;
		            $download->limit = 1;
		            $download->save();
		            return $download;
	            }
	            else
	            {
                    
                    if($check->limit <  4 )
                    {
	                    $check->today_date= $today;
			            $check->week_date = $week;
			            $check->limit = $check->limit+1;
			            $check->update();
			            return $check;
                    }
                    else
                    {
                    	// dd($today."------".$check->week_date);

                    	if(strtotime($check->today_date) >=  strtotime($check->week_date))
                    	{
                            $check->today_date= $today;
				            $check->week_date = $week;
				            $check->limit = 1;
				            $check->update();
				            return $check;
                    	}
                    	else
                    	{
                    		$result = ['Message' => ['Please contact to Sound Of Cairo To Download File']];
                            return response()->json($result, 400);
                    	}
                    }
		           

	            }
        }
    }

}
