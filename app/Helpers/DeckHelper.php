<?php

use \App\User;
use \App\Deck;

function getUserName(int $id)
{
    return User::where('id', $id)->first()->name;
}

function getDeckFromName(string $name)
{
    return Deck::where('name', $name)->first();
}