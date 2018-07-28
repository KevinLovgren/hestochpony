<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deck;
use App\User;
use App\Duel;

use Validator;
use Illuminate\Support\Facades\Auth;

class YugiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view_decks()
    {
        $decks = Deck::All();
        $users = User::All();
        return view('decks', ['deckList' => $decks, 'users' => $users]);
    }

    public function register_deck(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
        ]);

        $validator->validate();

        if(Deck::where('name', $request->name)->first() != null)
        {
            return back()->with('danger','Name already registered!');
        }

        $deck = new Deck;

        $deck->name = $request->name;
        $deck->user_id = Auth::User()->id;

        $deck->save();

        return back()->with('success','Deck registered!');
    }

    public function select_duels()
    {
        $decks = Deck::All();
        $users = User::All();
        $duels = Deck::All();
        return view('duels_select', ['decks' => $decks, 'users' => $users, 'duels' => $duels]);
    }

    public function select_duels_submit(Request $request)
    {
        $decks = Deck::All();
        $users = User::All();
        $duels = Deck::All();
        return view('duels_view', ['decks' => $decks, 'users' => $users, 'duels' => $duels, 'first_deck' => getDeckFromName($request->first_deck), 'second_deck' => getDeckFromName($request->second_deck)]);
    }

    public function duels_submit_winner(Request $request)
    {
        $decks = Deck::All();
        $users = User::All();
        $duels = Deck::All();

        if($request->winner == "")
        {
            return view('duels_view', ['decks' => $decks, 'users' => $users, 'duels' => $duels, 'first_deck' => getDeckFromName($request->first_deck), 'second_deck' => getDeckFromName($request->second_deck)]);
        }

        $duel = getDuel(getDeckFromName($request->first_deck)->id, getDeckFromName($request->second_deck)->id);
        $winner = getDeckFromName($request->winner);

        if($duel->first_deck_id == $winner->id)
        {
            $duel->first_wins += 1;
        }
        else if($duel->second_deck_id == $winner->id)
        {
            $duel->second_wins += 1;
        }
        $duel->save();

        return view('duels_view', ['decks' => $decks, 'users' => $users, 'duels' => $duels, 'first_deck' => getDeckFromName($request->first_deck), 'second_deck' => getDeckFromName($request->second_deck)])->with('success', 'Win registered!');
    }
}
