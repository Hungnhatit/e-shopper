<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\RateBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BlogRateController extends Controller
{
    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $rates = RateBlog::all();
        $isRate = true;
        foreach ($rates as $rate) {
            if ($rate->id_user == $userId) {
                $isRate = false;
            }
        }
        if ($isRate) {
            RateBlog::create($request->all());
        }
    }
}
