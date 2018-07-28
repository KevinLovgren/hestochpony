@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                                    <div style="float:left">
                                        <div style="text-align:center;margin:10px;">Vs You</div>
                                        <div style="text-align:center;margin:10px;">Winrate: {{asPercent(getVsWinrate($user->id, getCurrentUser()->id))}} | Duels: {{getVsDuelCount($user->id, getCurrentUser()->id)}}</div>
                                    </div>
                                    <div style="float:right">
                                        <div style="text-align:center;margin:10px;">Total</div>
                                        <div style="text-align:center;margin:10px;">Winrate: {{asPercent(getUserWinrate($user->id))}} | Duels: {{getUserDuelCount($user->id)}}</div>
                                    </div>

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
                                    <td>{{ $deck->name }}
                                    @if (getTotalDuelCount($deck->id) >= 10 && getTotalWinrate($deck->id) >= 0.8)
                                    <span class="badge badge-danger">OP</span>
                                    @endif
                                    @if (getTotalDuelCount($deck->id) >= 10 && getTotalWinrate($deck->id) <= 0.2)
                                    <span style="font-size:18px">💩</span>
                                    @endif
                                    @if (getFavoriteDeckId($deck->user_id) == $deck->id)
                                    <span style="font-size:18px">⭐️</span>
                                    @endif
                                    </td>
                                    <td>{{ getTotalDuelCount($deck->id) }}</td>
                                    <td>{{ asPercent(getTotalWinrate($deck->id)) }}</td>
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
