@if ($errors->has($fieldName))
<div class="invalid-feedback">
    @foreach ($errors->get($fieldName) as $error)
        {{ $error }} </br>
    @endforeach
</div>
@endif