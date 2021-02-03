@extends('layouts.client-frontend')

@section('main-content')
    @include('partials.messages')

    <h1>Užsakymo #{{ $order->id }} peržiūra</h1>

    <div class="row">
        <div class="col-xl-6 font-weight-bold">
            Užsakymo būsena
        </div>
        <div class="col-xl-6">
            <span class="badge badge-primary">
                {{ $order->order_status }}
            </span>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 font-weight-bold">
            Kontaktinis el. paštas
        </div>
        <div class="col-xl-6">
            {{ $order->user_email }}
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 font-weight-bold">
            Mikrorajonai, kuriuose bus platinama
        </div>
        <div class="col-xl-6">
            @if(count($order->districts)>0)
                <ul>
                    @foreach($order->districts as $district)
                        <li>{{ $district->name }}, auditorija: {{ $district->population }} žm., plotas: {{ $district->area_size }}km<sup>2</sup></li>
                    @endforeach
                </ul>
            @else
                Dėmesio! Pasimetė informacija, kuriuose rajonuose bus plantinamos Jūsų skrajutės, arba Jūs rajonų neįvedėte! Susisiekite su mumis.
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 font-weight-bold">
            Spausdinimo formatas
        </div>
        <div class="col-xl-6">
            {{ $order->print_format_title }}, {{ $order->print_format_measurements }}mm
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 font-weight-bold">
            Spaudos tipas
        </div>
        <div class="col-xl-6">
            {{ $order->print_type_title }}
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 font-weight-bold">
            Ar reikalingas maketavimas
        </div>
        <div class="col-xl-6">
            @if($order->design_needed==1)
                Taip
            @else
                Ne
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 font-weight-bold">
            Ar reikalinga sąskaita-faktūra
        </div>
        <div class="col-xl-6">
            @if($order->invoice_needed==1)
                Taip
            @else
                Ne
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 font-weight-bold">
            Kiekis
        </div>
        <div class="col-xl-6 font-weight-bold">
            {{ $order->amount }} vnt.
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 font-weight-bold">
            Užsakymo suma
        </div>
        <div class="col-xl-6 font-weight-bold">
            {{ number_format($order->total) }} &euro;
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 font-weight-bold">
            Įkelti failai
        </div>
        @if($order->design_needed==1)
            <div class="col-xl-12">Logotipas</div>
            <div class="col-xl-12">
                @if(isset($flyerLogos) && isset($flyerLogos[0]) && is_object($flyerLogos[0]))
                    @if(strpos($flyerLogos[0]->file_name_for_user, '.jpg') !== false || strpos($flyerLogos[0]->file_name_for_user, '.jpeg') !== false || strpos($flyerLogos[0]->file_name_for_user, '.png') !== false)
                        <img src="{{ '/uploads/'.$order->id.'/'.$flyerLogos[0]->system_file_name }}" alt="" />
                    @else
                        <a href="{{ '/uploads/'.$order->id.'/'.$flyerLogos[0]->system_file_name }}" target="_blank">
                            {{ $flyerLogos[0]->file_name_for_user }}
                        </a>
                    @endif
                @endif
            </div>
            @if(isset($additionalFiles) && count($additionalFiles)>0)
                <div class="col-xl-12">Papildomi failai</div>
                @foreach($additionalFiles as $additionalFile)
                    <div class="col-xl-12">
                        <a href="{{ '/uploads/'.$order->id.'/'.$additionalFile->system_file_name }}" target="_blank">
                            {{ $additionalFile->file_name_for_user }}
                        </a>
                    </div>
                @endforeach
            @endif
            <div class="col-xl-12 font-weight-bold">Papildomas tekstas:</div>
            <div class="col-xl-12">
                {!! $order->flyer_text !!}
            </div>
        @else
            <div class="col-xl-12">Maketo failas</div>
            <div class="col-xl-12">
                @if(isset($flyerLayoutFiles) && isset($flyerLayoutFiles[0]) && is_object($flyerLayoutFiles[0]))
                    <a href="{{ '/uploads/'.$order->id.'/'.$flyerLayoutFiles[0]->system_file_name }}" target="_blank">
                        {{ $flyerLayoutFiles[0]->file_name_for_user }}
                    </a>
                @endif
            </div>
        @endif
    </div>

@endsection
