<?php

use App\Deck;
use App\User;
use App\Duel;

function getDuel($firstID, $secondId)
{
    $duel = Duel::where('first_deck_id', $firstID)->where('second_deck_id', $secondId)->first();

    if($duel == null)
    {
        $duel = Duel::where('first_deck_id', $secondId)->where('second_deck_id', $firstID)->first();
    }

    if($duel == null)
    {
        $duel = new Duel();
        $duel->first_deck_id = $firstID;
        $duel->second_deck_id = $secondId;
        $duel->save();
    }

    return $duel;
}

function getWinrate($firstId, $secondId)
{
    $duel = getDuel($firstId, $secondId);

    $winrate = calculateWinrate($duel->first_wins, $duel->second_wins);

    if ($firstId != $duel->first_deck_id)
    {
        $winrate = 1 - $winrate;
    }

    if($duel->first_wins == 0 && $duel->second_wins == 0)
    {
        $winrate = 0;
    }

    return $winrate;
}

function getDuelCount($firstId, $secondId)
{
    $duel = getDuel($firstId, $secondId);

    return $duel->first_wins + $duel->second_wins;
}

function getTotalWinrate($id)
{
    $first_duels = Duel::where('first_deck_id', $id)->get();
    $second_duels = Duel::where('second_deck_id', $id)->get();
    $wins = 0;
    $loses = 0;

    foreach($first_duels as $duel)
    {
        $wins += $duel->first_wins;
        $loses += $duel->second_wins;
    }

    foreach($second_duels as $duel)
    {
        $wins += $duel->second_wins;
        $loses += $duel->first_wins;
    }

    $winrate = calculateWinrate($wins, $loses);

    return $winrate;
}

function getTotalDuelCount($id)
{
    $first_duels = Duel::where('first_deck_id', $id)->get();
    $second_duels = Duel::where('second_deck_id', $id)->get();

    $duel_count= 0;

    foreach($first_duels as $duel)
    {
        $duel_count += $duel->first_wins;
        $duel_count += $duel->second_wins;
    }

    foreach($second_duels as $duel)
    {
        $duel_count += $duel->second_wins;
        $duel_count += $duel->first_wins;
    }

    return $duel_count;
}

function getUserWinrate($userid)
{
    $decks = Deck::where('user_id', $userid)->get();

    $winrate = 0;

    foreach($decks as $deck)
    {
        $winrate += (getTotalWinrate($deck->id) * getTotalDuelCount($deck->id));
    }

    if($winrate != 0)
    {
        $winrate = $winrate / getUserDuelCount($userid);
    }

    return $winrate;
}

function getUserDuelCount($userid)
{
    $decks = Deck::where('user_id', $userid)->get();

    $duel_count = 0;

    foreach($decks as $deck)
    {
        $duel_count += getTotalDuelCount($deck->id);
    }

    return $duel_count;
}

function calculateWinrate($wins, $loses)
{
    $winrate = 0;

    if($wins == 0)
    {
            $winrate = 0;
    }
    else if ($loses == 0)
    {
        $winrate = 1;
    }
    else
    {
        $winrate = ($wins / ($wins + $loses));
    }

    return $winrate;
}

function asPercent($val)
{
    return round($val * 100, 0) . '%';
}