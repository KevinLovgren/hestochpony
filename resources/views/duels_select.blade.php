@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <form action="{{ route('duels_select_submit') }}" method="POST" autocomplete="off" class="container" style="margin:10px">
            @csrf
            <div class="row">

                <div class="col">
                    <div class="form-group">
                        <select class="form-control" name="first_deck">
                            @foreach ($users as $user)
                                <optgroup label="{{ $user->name }}">
                                    @foreach ($decks as $deck)
                                    @if ($deck->user_id == $user->id)
                                        <option>{{$deck->name}}</option>
                                    @endif
                                    @endforeach
                                <optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-w-2">
                    -vs-
                </div>

                <div class="col">
                    <div class="form-group">
                        <select class="form-control" name="second_deck">
                            @foreach ($users as $user)
                                <optgroup label="{{ $user->name }}">
                                    @foreach ($decks as $deck)
                                    @if ($deck->user_id == $user->id)
                                        <option>{{$deck->name}}</option>
                                    @endif
                                    @endforeach
                                <optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div style="text-align:center;margin:20px">
                <button type="submit" class="btn btn-primary" style="width:150px">Duel</button>
            </div>
        </form>
    </div>
</div>
@endsection
