@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register deck</div>

                <div class="card-body">
                    <form action="{{ route('decks_register_submit') }}" method="POST" autocomplete="off">
                    @csrf
                        <div class="form-group">
                            <label for="name">{{__('Deck Name')}}</label>
                            @if ($errors->has('name'))
                                <input type="text" class="form-control is-invalid" name="name" placeholder="OP Deskbots" value="{!! old('name') !!}">
                            @else
                                <input type="text" class="form-control" name="name" placeholder="OP Deskbots">
                            @endif
                            @include('form-error-message', ['fieldName' => 'name'])
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
