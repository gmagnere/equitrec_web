<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JudgeController extends Controller
{
    public function index (Request $request){

        $judges = User::query()->where('id_role', 5);

        $roles = Role::get();

        return Inertia::render('Judge/Index',[
            'judges' => $judges->paginate()->withQueryString(),
            'roles' => $roles,
            ]);
    }

    public function submit (Request $request) {
        //dd($request);

        $judge = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'id_role' => request('role')['id'],
            'password' => '1234',
        ]);

        $judge->save();

        return redirect('/judge');
    }

    public function delete (Request $request) {
        //dd(request('judge')['id']);

        $judge = User::where('id', request('judge')['id'])
            ->delete();

        return redirect('/judge');
    }
}
