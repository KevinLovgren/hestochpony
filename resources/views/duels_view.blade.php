@extends('layouts.app')

@section('content')
@if(isset($winner))
<div class="container" style="float:right">
    <form action="{{ route('duels_undo') }}" method="POST" autocomplete="off">
        @csrf
        <input type="hidden" name="winner" value="{{$winner}}">
        <input type="hidden" name="first_deck" value="{{$first_deck->name}}">
        <input type="hidden" name="second_deck" value="{{$second_deck->name}}">
        <button type="submit" class="btn btn-light" style="float:right">Undo</button>
    </form>
</div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div style="width:100%;text-align:center;margin:20px">
            <h2 class="display-5">Duel Count: </br> {{ getDuelCount($first_deck->id, $second_deck->id) }}</h2>
            <h6 class="display-6" style="color:#6f6f70">{{ getVsDuelCount($first_deck->user_id, $second_deck->user_id) }}</h6>
            <form action="{{ route('duels_submit_winner') }}" method="POST" autocomplete="off">
                    @csrf
                        <div class="container" style="max-width:300px;">
                            <select class="form-control" name="winner">
                                <option value=''>The winner is...</option>
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
                        <li class="list-group-item">Player Win Percent:<p style="text-align:center">{{ asPercent(getVsWinrate($first_deck->user_id, $second_deck->user_id)) }}</p></li>
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
                        <li class="list-group-item">Player Win Percent:<p style="text-align:center">{{ asPercent(getVsWinrate($second_deck->user_id, $first_deck->user_id)) }}</p></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
