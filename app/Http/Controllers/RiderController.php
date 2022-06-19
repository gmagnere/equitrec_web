<?php

namespace App\Http\Controllers;


use App\Models\Championship;
use App\Models\Rider;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RiderController extends Controller
{
    public function index(Request $request) {

        $riders = Rider::query()->with('championShipFromRider');

        $championships = Championship::get();

        return Inertia::render('Rider/Index', [
            'riders' => $riders->paginate()->withQueryString(),
            'championships' => $championships,
        ]);
    }

    public function Submit (Request $request) {
        //dd($request);

        $rider = Rider::create([
            'name' => request('name'),
            'surname' => request('surname'),
            'bib_number' => request('bib_number'),
            'id_championship' => request('championship')['id'],
        ]);

        $rider->save();

        return redirect('/rider');
    }

    public function delete (Request $request) {
        //dd(request('rider')['id']);

        $rider = Rider::where('id', request('rider')['id'])
            ->delete();

        return redirect('/rider');
    }
}
