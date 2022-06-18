<?php

namespace App\Http\Controllers;


use App\Models\Rider;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RiderController extends Controller
{
    public function index(Request $request) {

        $riders = Rider::get();

        return Inertia::render('Rider/Index', [
            'riders' => $riders,
        ]);
    }
}
