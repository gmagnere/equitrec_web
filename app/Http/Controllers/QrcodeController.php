<?php

namespace App\Http\Controllers;

use App\Models\Championship;
use App\Models\Contract;
use App\Models\Obstacle;
use App\Models\Pace;
use App\Models\Penalities;
use App\Models\Rider;
use App\Models\Style;
use App\Models\Trial;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrcodeController extends Controller
{
    public function index (Request $request){

        return Inertia::render('Qrcode/Index',[
        ]);
    }

    public function generate (Request $request){
        //dd($request);

        $judges = User::where('id_role', 5)->get(['id', 'name']);

        $obstacles = Obstacle::get(['libelleObstacle', 'noteMax']);

        $championships = Championship::get(['id', 'name', 'dateStart', 'dateEnd']);

        $riders = Rider::get(['id', 'name', 'surname', 'bib_number']);

        $trials = Trial::get(['id', 'libelleTrial']);

        $style = Style::get(['id', 'mark', 'libelleAppreciation']);
        $pace = Pace::get(['id', 'mark', 'libellePace']);
        $contract = Contract::get(['id', 'mark', 'mistake']);
        $penalty = Penalities::get(['id', 'penalty', 'libellePenalty']);

//        dd($judges->toJson().$obstacles->toJson()
//            .$championships->toJson()
//            .$riders->toJson()
//            .$trials->toJson()
//            .$style->toJson()
//            .$pace->toJson()
//            .$contract->toJson()
//            .$penalty->toJson());
        return QrCode::size(300)->generate($judges->toJson().$obstacles->toJson()
            .$championships->toJson()
            .$riders->toJson()
            .$trials->toJson()
            .$style->toJson()
            .$pace->toJson()
            .$contract->toJson()
            .$penalty->toJson());
    }
}
