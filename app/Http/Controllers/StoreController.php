<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function index(){
        // $store = DB::select('CALL storesList()');
        // dd($store);
        return view('store');
    }


        public function getData(){
            $store = DB::select('CALL storesList()');

            return response()->json($store);
        }

    public function createOrEdit(Store $store = null)
    {
        return view('stores.create_edit', compact('store'));
    }

    public function store(Request $request)
    {
        dd(($request->all()));
        $request->validate([
            'name' => 'required|string|max:255',
            // Add validation rules for other fields as needed
        ]);

      

        return redirect()->route('stores.index')->with('success', 'Store created successfully.');
    }

    public function update(Request $request, Store $store)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // Add validation rules for other fields as needed
        ]);

        $store->update($request->all());

        return redirect()->route('stores.index')->with('success', 'Store updated successfully.');
    }
}
