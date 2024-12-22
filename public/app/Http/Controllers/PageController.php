<?php

namespace App\Http\Controllers;

use App\Models\Bet;
use App\Models\Lot;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class PageController extends Controller
{
    public function index() {


        $lots = Lot::orderBy('id','desc')->take(6)->get();

        return view('pages.index', ['lots' => $lots]);
    }

    public function single($id){


        $lot = Lot::findOrFail($id);
        $bets = Bet::where('lot_id', $id)->get();
        $lastBet = Bet::where('lot_id', $id)->get()->last();

        return view('pages.single-lot', [ 'lot' => $lot, 'bets' => $bets, 'lastBet' => $lastBet]);
    }

    public function signup() {
        return view('pages.sign-up');
    }

    public function login() {
        return view('pages.login');
    }

    public function addlot(){
        return view('pages.add-lot');
    }

    public function profile(){
        Carbon::setLocale('ru');
        $user = Auth::user();
        $bets = $user->bets()->get();
        return view('pages.profile', compact('bets'));
    }


}
