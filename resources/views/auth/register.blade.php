@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="level_id" class="col-md-4 col-form-label text-md-end">{{ __('Level') }}</label>

                            <div class="col-md-6">
                                <select name="type" id="type" class="form-control @error('level_id') is-invalid @enderror">
                                    <option value="">- Level -</option>
                                    <option value="admin">Admin</option>
                                    <option value="pelayanan">Pelayanan</option>
                                    <option value="kredit">Kredit</option>
                                    <option value="akunting">Akunting</option>
                                    <option value="umum">Umum</option>
                                    <option value="bisnis">Bisnis Pusat</option>
                                    <option value="skai">SKAI</option>
                                    <option value="sdm">SDM</option>
                                </select>
                                @error('level_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kantor_id" class="col-md-4 col-form-label text-md-end">{{ __('Kantor') }}</label>

                            <div class="col-md-6">
                                <select name="kantor_id" id="kantor_id" class="form-control required">
                                    <option value="">- Pilih Kantor -</option>
                                    <option value="1">001 - Pusat</option>
                                    <option value="2">002 - Cab. Cisalak</option>
                                    <option value="3">003 - Cab. KPO</option>
                                    <option value="4">004 - Cab. Subang</option>
                                    <option value="5">004 - Cab. Purwadadi</option>
                                    <option value="6">006 - Cab. Pamanukan</option>
                                    <option value="7">007 - Cab. Majalengka</option>
                                    <option value="8">008 - Cab. Panyingkiran</option>
                                    <option value="9">009 - Cab. Banjaran</option>
                                    <option value="10">010 - Cab. Cingambul</option>
                                    <option value="11">011 - Cab. Bekasi</option>
                                    <option value="12">012 - Cab. Pondokgede</option>
                                    <option value="13">013 - Cab. Cibitung</option>
                                    <option value="14">014 - Cab. Setu</option>
                                    <option value="15">015- Cab. Cibarusah</option>
                                    <option value="16">016 - Cab. Sukatani</option>
                                    <option value="17">017 - Cab. Cimerak</option>
                                    <option value="18">018 - Cab. Ciamis</option>
                                </select>
                                @error('level_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
