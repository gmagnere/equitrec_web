<?php

namespace App\Http\Controllers;

use App\Models\Championship;
use App\Models\ChampionshipHasTrials;
use App\Models\Trial;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChampionShipController extends Controller
{
    public function index (Request $request){

        $championships = Championship::query();

        $trials = Trial::get();

        return Inertia::render('Championship/Index',[
            'championships' => $championships->paginate()->withQueryString(),
            'trials' => $trials,
        ]);
    }

    public function submit (Request $request) {
        //dd($request);

        $championship = Championship::create([
            'name' => request('name'),
            'place'=> request('place'),
            'dateStart'=> request('dateStart'),
            'dateEnd'=> request('dateEnd'),
        ]);


        $championship->save();
        //dd($championship->id);
        $hasTrial = ChampionshipHasTrials::create([
            'id_trial' => request('trial')['id'],
            'id_championship' => $championship->id,
        ]);

        $hasTrial->save();

        return redirect('/championship');
    }

    public function delete (Request $request) {
        //dd(request('championship')['id']);

        $championship = Championship::where('id', request('championship')['id'])
            ->delete();

        return redirect('/championship');
    }
}
