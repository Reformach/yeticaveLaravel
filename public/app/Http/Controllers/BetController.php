<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\Lot;
use App\Models\Bet;

use Carbon\Carbon;

class BetController extends Controller
{
    public function placeBet(Request $request, $lotId) {
        $betData = $request->except('_token');
        $lot = Lot::findOrFail($lotId);

        $max_bet_price = Bet::where('lot_id', $lot->id)->orderBy('bet_price', 'desc')->first()->bet_price ?? $lot->price;

        $validator = Validator::make($betData, [
            'bet_price' => 'required|gt:'.(((int)$max_bet_price + (int)$lot->bet_step) - 1),
        ]);

        if($validator->fails()) {
            return redirect(route('lot-page', ['id' => $lotId]))
                ->withErrors($validator)
                ->withInput();
        }

        $bet = new Bet();
        $bet->bet_date = Carbon::now()->timezone('Europe/Moscow');
        $bet->bet_price = request('bet_price');
        $bet->author_id = Auth::user()->id;
        $bet->lot_id = $lotId;
        $bet->save();

        return redirect(route('lot-page', ['id' => $lot->id]));
    }
}
