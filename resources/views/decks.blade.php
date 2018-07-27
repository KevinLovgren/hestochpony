@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <a class="btn btn-primary" style="float:right;margin:10px;" href="{{ route('decks_register') }}">Register new deck</a>
            <div class="card">
                <div class="card-header">Decks</div>

                <div class="card-body">

                @foreach ($users as $user)
                        <div class="card" style="margin:10px;clear:both;">
                            <div class="card-header" id="header{{$user->id}}">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#card{{$user->id}}" aria-expanded="false" aria-controls="card{{$user->id}}">
                                    <b> {{$user->name}} </b>
                                </button>
                            </div>

                            <div id="card{{$user->id}}" class="collapse" aria-labelledby="header{{$user->id}}">
                            <div class="card-body">

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Duels</th>
                                        <th scope="col">Winrate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($deckList as $deck)
                                @if ($deck->user_id == $user->id)
                                <tr>
                                    <td>{{ $deck->name }}</td>
                                    <td>10</td>
                                    <td>50%</td>
                                </tr>
                                @endif
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
