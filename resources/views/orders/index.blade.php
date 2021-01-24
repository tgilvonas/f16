@extends('layouts.client-frontend')

@section('main-content')
    @include('partials.messages')
    <h1 class="font-weight-bold">Užsakymų sąrašas</h1>
    <div class="form-group">
        <a href="{{ route('orders.create') }}" class="btn btn-success">Sukurti naują užsakymą</a>
    </div>
    @if(count($orders)> 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Spaudos tipas</th>
                    <th scope="col">Formatas</th>
                    <th scope="col">Kiekis</th>
                    <th scope="col">Užsakymo suma</th>
                    <th>Sukūrimo data</th>
                    <th>Išplatinimo data</th>
                    <th>Užsakymo būsena</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <th scope="row">{{ $order->id }}</th>
                        <td>{{ $order->print_type_title }}</td>
                        <td>{{ $order->print_format_title }} {{ $order->print_format_measurements }}</td>
                        <td>{{ $order->amount }}</td>
                        <td>{{ number_format($order->total, 2) }}&euro;</td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->distribution_date }}</td>
                        <td>{{ $order->order_status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Jūs užsakymų dar neturite.</p>
    @endif
@endsection
