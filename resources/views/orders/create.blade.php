@extends('layouts.client-frontend')

@section('main-content')
    @include('partials.messages')
    <h1 class="font-weight-bold">Sukurti naują užsakymą</h1>
    <form method="post" action="{{ route('orders.store') }}">
        @csrf
        <div class="form-group">
            <label class="font-weight-bold">Šalis</label>
            <select name="country" class="form-control select2" disabled>
                <option value="Lietuva">Lietuva</option>
            </select>
        </div>
        <div class="form-group">
            <label class="font-weight-bold">Savivaldybė</label>
            <select name="city" class="form-control select2" disabled>
                <option value="Vilnius">Vilnius</option>
            </select>
        </div>
        <div class="form-group">
            <label class="font-weight-bold">Mikrorajonas</label>
        </div>
        <button type="submit" class="btn btn-success">Sukurti užsakymą</button>
    </form>
@endsection
