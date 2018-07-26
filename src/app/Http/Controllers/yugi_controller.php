<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\YugiRepository;

class YugiController extends Controller
{
    //

    function index(YugiRepository $yugi_repository)
    {
        $names = $yugi_repository();
        return view('yugi_start', ['names' => $names]);
    }
}
