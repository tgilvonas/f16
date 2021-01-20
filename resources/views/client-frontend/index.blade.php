@extends('layouts.client-frontend')

@section('main-content')
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">F16</h1>
        <p class="lead">Mes kuriame ekologiškas reklamines skrajutes.</p>
    </div>
    <div class="card-deck mb-3 text-center">
        <div class="card">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Prisijungti</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input type="email" id="inputEmail" class="form-control" placeholder="El. paštas" required autofocus>
                </div>
                <div class="form-group">
                    <input type="password" id="inputPassword" class="form-control" placeholder="Slaptažodis" required>
                </div>
                <div class="form-group checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Prisiminti mane
                    </label>
                </div>
                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Prisijungti</button>
                </div>
                <div class="form-group">
                    Neturite paskyros? <a href="/registracija">Registruokitės</a>
                </div>
            </div>
        </div>
    </div>
@endsection
