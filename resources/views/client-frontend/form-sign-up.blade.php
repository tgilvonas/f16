@extends('layouts.client-frontend')

@section('main-content')
    <div class="pricing-header px-3 py-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4">F16</h1>
        <p class="lead">Mes kuriame ekologiškas reklamines skrajutes.</p>
    </div>
    <div class="card-deck mb-3">
        <div class="card">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Registruotis</h4>
            </div>
            <form class="card-body" method="POST" action="{{ route('register') }}">
                @csrf

                @include('partials.messages')

                <div class="form-group">
                    <label class="font-weight-bold">Vardas, pavardė</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Vardas, pavardė" required autofocus>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">El. paštas</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="El. paštas" required autofocus>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Telefonas</label>
                    <input type="text" name="telephone" id="telephone" class="form-control" placeholder="Telefonas" required autofocus>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Slaptažodis</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Slaptažodis" required>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Pakartokite slaptažodį</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Pakartokite slaptažodį" required>
                </div>
                <div class="form-group checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Prisiminti mane
                    </label>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-lg btn-primary" type="submit">Registruotis</button>
                </div>
            </form>
        </div>
    </div>
@endsection
