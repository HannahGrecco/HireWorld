<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;


class CountryController extends Controller
{
    public function index (Request $request){
        $search = $request->search;
        $countries = Country::when($search, function($query,$search){
            $query->where('name', 'like', "%{$search}%");
        })->get();
        return view('countries.index', compact('countries'));
    }

}
