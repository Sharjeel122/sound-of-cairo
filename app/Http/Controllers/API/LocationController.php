<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LocationController extends Controller
{
    public function Add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
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
            'name' => 'required',
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
    public function GetAll($pageNum)
    {
        $locations = Location::where('status',1)->paginate(2, ['*'], 'page', $pageNum);
        return response()->json(['users'=>$locations]);
    }
}
