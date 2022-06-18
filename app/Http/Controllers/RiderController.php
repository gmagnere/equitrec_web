<?php

namespace App\Http\Controllers;


use App\Models\Championship;
use App\Models\Rider;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RiderController extends Controller
{
    public function index(Request $request) {

        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name, surname']
        ]);

        $riders = Rider::query();

        $championships = Championship::get();

        if (request('search')) {
            $riders->where('name', 'LIKE', '%'.request('search').'%');
        }

        if (request()->has(['field', 'direction'])) {
            $riders->orderBy(request('field'), request('direction'));
        }

        return Inertia::render('Rider/Index', [
            'riders' => $riders->paginate()->withQueryString(),
            'filters' => request()->all(['search', 'field', 'direction']),
            'championships' => $championships,
        ]);
    }

    public function Submit (Request $request) {
        dd($request);

        $rider = Rider::create([
            'name' => request('name'),
            'surname' => request('surname'),
            'bib_number' => request('bib-number')
        ]);

        $rider->save();
    }
}
