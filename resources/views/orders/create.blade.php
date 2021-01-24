@extends('layouts.client-frontend')

@section('main-content')

    <script type="text/javascript">
        dataOfCoefficients = {
            districts: {!! json_encode($districts) !!},
            amounts: {!! json_encode($amounts) !!},
            printFormats: {!! json_encode($printFormats) !!},
            printTypes: {!! json_encode($printTypes) !!}
        };
    </script>

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
            <select name="districts[]" multiple class="form-control select2">
                @foreach($districts as $district)
                    <option value="{{ $district->id }}" @if(in_array($district->id, old('districts', []))) selected @endif >
                        {{ $district->name }}, auditorija: {{ $district->population }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="font-weight-bold">Kiekis</label>
            <select name="amount" class="form-control select2">
                @foreach($amounts as $amount)
                    <option value="{{ $amount->id }}" @if(old('amount')==$amount->id) selected @endif >
                        {{ $amount->amount }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <div class="font-weight-bold">Skrajutės formatas</div>
            @foreach($printFormats as $printFormat)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="print_format" value="{{ $printFormat->id }}" @if(old('print_format') == $printFormat->id) checked @endif id="print_format_{{ $printFormat->id }}">
                    <label class="form-check-label" for="print_format_{{ $printFormat->id }}">
                        {{ $printFormat->title }} ({{ $printFormat->measurements }})
                    </label>
                </div>
            @endforeach
        </div>
        <div class="form-group">
            <div class="font-weight-bold">Spaudos tipas</div>
            @foreach($printTypes as $printType)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="print_type" value="{{ $printType->id }}" @if(old('print_type') == $printType->id) checked @endif id="print_type_{{ $printType->id }}">
                    <label class="form-check-label" for="print_type_{{ $printType->id }}">
                        {{ $printType->title }}
                    </label>
                </div>
            @endforeach
        </div>
        <div class="form-group">
            <span class="font-weight-bold">Suma: <span class="total_sum">0.00</span>&euro;</span>
        </div>
        <button type="submit" class="btn btn-success">Sukurti užsakymą</button>
    </form>
@endsection
