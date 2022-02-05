<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;


class LocationController extends Controller
{
    public function Add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'area' => 'required',

        ]);

        if ($validator->fails()) {
            $errors = $validator->messages();
            return response()->json($errors, 400);
        } else {
            $location = new Location($request->all());
            $location->save();
            return response()->json($location);
        }

    }

    public function Update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'country_id' => 'required',
  'state_id' => 'required',
            'city_id' => 'required',
            'area' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->messages();
            return response()->json($errors, 400);
        } else {

            $location= Location::where('id', $id)->first();
            if ( $location == null) {
                $result = ['Message' => ['location Not Found']];
                return response()->json($result, 404);
            } else {
                $location->update($request->all());
                return response()->json( $location);
            }

        }

    }

    public function Block($id)
    {
        $location = Location::where('id', $id)->first();
        if ( $location == null) {
            $result = ['Message' => ['location Not Found']];
            return response()->json($result, 404);
        } else {
            $location->status = false;
            $location->update();
            return response()->json( $location);
        }
    }

    public function Unblock($id)
    {
        $location = Location::where('id', $id)->first();
        if ($location == null) {
            $result = ['Message' => ['location Not Found']];
            return response()->json($result, 404);
        } else {
            $location->status = true;
            $location->update();
            return response()->json($location);
        }
    }

    public function Get($id)
    {
        $location = Location::where('id', $id)->first();
        if ($location == null) {
            $result = ['Message' => ['location Not Found']];
            return response()->json($result, 404);
        } else {
            return response()->json($location);
        }
    }
    public function GetAll()
    {
        $locations = Location::all();
        return response()->json(['locations'=>$locations]);
    }

    public function GetAllHome()
    {
        $locations = Location::where('status',1)->get();
        return response()->json(['locations'=>$locations]);
    }



    public function LocationsGet()
    {
        $locations = Location::where('status',1)->with('cities')->limit(4)->get();
        return response()->json(['locations'=>$locations]);
    }

      public function GetStates($id)
    {
        $states = DB::table('states')->where('country_id',$id)->get();
        return response()->json(['states'=>$states]);
    }

      public function GetCountries()
    {
        $countries = DB::table('countries')->get();
        return response()->json(['countries'=>$countries]);
    }

      public function GetCities($id)
    {
        $cities = DB::table('cities')->where('state_id',$id)->get();
        return response()->json(['cities'=>$cities]);
    }
}
