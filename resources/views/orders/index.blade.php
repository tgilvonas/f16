@extends('layouts.client-frontend')

@section('main-content')
    @include('partials.messages')
    <h1 class="font-weight-bold">Užsakymų sąrašas</h1>
    <div>
        <a href="{{ route('orders.create') }}" class="btn btn-success">Sukurti naują užsakymą</a>
    </div>
@endsection
