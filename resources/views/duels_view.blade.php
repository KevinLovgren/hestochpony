@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div style="width:100%;text-align:center;margin:20px">
            <h2 class="display-5">Duel Count: </br> {{ getDuelCount($first_deck->id, $second_deck->id) }}</h2> </br>
            <form action="{{ route('duels_submit_winner') }}" method="POST" autocomplete="off">
                    @csrf
                        <div class="container" style="max-width:300px;">
                            <select class="form-control" name="winner">
                                <option>The winner is...</option>
                                <option>{{$first_deck->name}}</option>
                                <option>{{$second_deck->name}}</option>
                            </select>
                            <input type="hidden" name="first_deck" value="{{$first_deck->name}}">
                            <input type="hidden" name="second_deck" value="{{$second_deck->name}}">
                        </div>
                        <button type="submit" class="btn btn-primary" style="width:150px;margin:10px;">Register winner</button>
                    </form>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header" style="text-align:center">{{$first_deck->name}}</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Win Percent:<p style="text-align:center">{{ asPercent(getWinrate($first_deck->id,$second_deck->id)) }}</p></li>
                        <li class="list-group-item">Total Win Percent:<p style="text-align:center">{{ asPercent(getTotalWinrate($first_deck->id)) }}</p></li>
                        <li class="list-group-item">Total Duel Count:<p style="text-align:center">{{ getTotalDuelCount($first_deck->id) }}</p></li>
                        <li class="list-group-item">Player:<p style="text-align:center">{{ getUserName($first_deck->user_id) }}</p></li>
                        <li class="list-group-item">Player Total Win Percent:<p style="text-align:center">{{ asPercent(getUserWinrate($first_deck->user_id)) }}</p></li>
                        <li class="list-group-item">Player Total Duel Count:<p style="text-align:center">{{ getUserDuelCount($first_deck->user_id) }}</p></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header" style="text-align:center">{{$second_deck->name}}</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Win Percent:<p style="text-align:center">{{ asPercent(getWinrate($second_deck->id,$first_deck->id)) }}</p></li>
                        <li class="list-group-item">Total Win Percent:<p style="text-align:center">{{ asPercent(getTotalWinrate($second_deck->id)) }}</p></li>
                        <li class="list-group-item">Total Duel Count:<p style="text-align:center">{{ getTotalDuelCount($second_deck->id) }}</p></li>
                        <li class="list-group-item">Player:<p style="text-align:center">{{ getUserName($second_deck->user_id) }}</p></li>
                        <li class="list-group-item">Player Total Win Percent:<p style="text-align:center">{{ asPercent(getUserWinrate($second_deck->user_id)) }}</p></li>
                        <li class="list-group-item">Player Total Duel Count:<p style="text-align:center">{{ getUserDuelCount($second_deck->user_id) }}</p></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
