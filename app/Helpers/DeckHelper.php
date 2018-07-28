<?php

use \App\User;
use \App\Deck;
use Illuminate\Support\Facades\Auth;

function getUserName(int $id)
{
    return User::where('id', $id)->first()->name;
}

function getDeckFromName(string $name)
{
    return Deck::where('name', $name)->first();
}

function getCurrentUser()
{
    return Auth::user();
}

function getFavoriteDeckId($user_id)
{
    $decks = Deck::where('user_id', $user_id)->get();

    $favorite = $decks[0]->id ?? 0;
    $highest = 0;

    foreach($decks as $deck)
    {
        if(getTotalDuelCount($deck->id) > $highest)
        {
            $favorite = $deck->id;
            $highest = getTotalDuelCount($deck->id);
        }
    }

    if($highest < 5)
    {
        $favorite = -1;
    }

    return $favorite;
}