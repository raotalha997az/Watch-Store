<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Store;
use App\Models\Country;
use App\Models\AreaLandmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function index(){
        // $store = DB::select('CALL storesList()');
        // dd($store);
        $city = DB::select('CALL GetCities()');
        $country = DB::select('CALL GetCountries()');
        $landMark = DB::select('CALL GetArea()');
        return view('store' , compact('city', 'country', 'landMark'));
    }


        public function getData(){
            $store = DB::select('CALL sp_select_store_data()');

            return response()->json($store);
        }

    // public function createOrEdit(Request $request)
    // {
    //     $store = null;
    //     if ($request->id) {
    //        $store_id = $request->id;
    //         $store = DB::select('CALL editStore(?)', [$store_id]);
    //         return response()->json($store);
    //     }

    // }

    public function createOrEdit(Request $request)
    {
        $store = null;
        if ($request->id) {
           $store_id = $request->id;
            $store = Store::find($store_id);
            return response()->json($store);
        }

    }


    public function store(Request $request)
    {
        // dd(($request->all()));
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'city_id' => 'required|string|max:255',
            'country_id' => 'required|string|max:255',
            'landmark_id' => 'required|string|max:255',
        ]);

        if($request->id){
            $store = Store::find($request->id);
            $store->update($request->all());
        }else{
            $store = Store::create($request->all());
        }



        return redirect()->route('stores.index')->with('success', 'Store created successfully.');
    }



    public function getCityData(Request $request){
        $city = City::where('country_id', $request->country_id)->get();
        return response()->json($city);
    }

    public function getLandMark(Request $request){
        $landMark = AreaLandmark::where('city_id', $request->city_id)->get();
        return response()->json($landMark);
    }

    // public function storeArea(Request $request){
    //     $city_id = $request->city_id;
    //     $name = $request->name;
    //     $area = DB::select('CALL InsertLandmark(?, ?)', [$city_id, $name]);
    //     $landMark = DB::select('CALL GetArea()')->orderby('id', 'desc')->first();
    //     return response()->json(['success' => $landMark]);
    // }

    public function storeArea(Request $request){
        $city_id = $request->city_id;
        $name = $request->name;


        $area = DB::select('CALL InsertLandmark(?, ?)', [$city_id, $name]);
        $landMark = DB::select('CALL GetLatestArea()');
        if ($landMark) {
            return response()->json(['success' => $landMark]);
        } else {
            return response()->json(['error' => 'Failed to retrieve the latest landmark.']);
        }
    }


    public function storeDelete(Request $request)
    {
        $storeId = $request->input('id');

        DB::select('CALL DeleteStore(?)', [$storeId]);
        return response()->json(['success' => true]);
    }


}
