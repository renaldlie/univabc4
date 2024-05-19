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

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
                                    <option value="mahasiswa">Mahasiswa</option>
                                    <option value="dosen">Dosen</option>
                                </select>

                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" id="nim-field" style="display: none;">
                            <label for="nim" class="col-md-4 col-form-label text-md-right">{{ __('NIM') }}</label>

                            <div class="col-md-6">
                                <input id="nim" type="text" class="form-control @error('nim') is-invalid @enderror" name="nim">

                                @error('nim')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" id="angkatan-field" style="display: none;">
                            <label for="angkatan" class="col-md-4 col-form-label text-md-right">{{ __('Angkatan') }}</label>

                            <div class="col-md-6">
                                <input id="angkatan" type="number" class="form-control @error('angkatan') is-invalid @enderror" name="angkatan">

                                @error('angkatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" id="total-sks-field" style="display: none;">
                            <label for="total_sks" class="col-md-4 col-form-label text-md-right">{{ __('Total SKS') }}</label>

                            <div class="col-md-6">
                                <input id="total_sks" type="number" class="form-control @error('total_sks') is-invalid @enderror" name="total_sks">

                                @error('total_sks')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" id="nidn-field" style="display: none;">
                            <label for="nidn" class="col-md-4 col-form-label text-md-right">{{ __('NIDN') }}</label>

                            <div class="col-md-6">
                                <input id="nidn" type="text" class="form-control @error('nidn') is-invalid @enderror" name="nidn">

                                @error('nidn')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var roleSelect = document.getElementById('role');
        var nimField = document.getElementById('nim-field');
        var angkatanField = document.getElementById('angkatan-field');
        var totalSksField = document.getElementById('total-sks-field');
        var nidnField = document.getElementById('nidn-field');

        roleSelect.addEventListener('change', function() {
            if (this.value === 'mahasiswa') {
                nimField.style.display = 'block';
                angkatanField.style.display = 'block';
                totalSksField.style.display = 'block';
                nidnField.style.display = 'none';
            } else if (this.value === 'dosen') {
                nimField.style.display = 'none';
                angkatanField.style.display = 'none';
                totalSksField.style.display = 'none';
                nidnField.style.display = 'block';
            } else {
                nimField.style.display = 'none';
                angkatanField.style.display = 'none';
                totalSksField.style.display = 'none';
                nidnField.style.display = 'none';
            }
        });

        // Check initial value on page load
        if (roleSelect.value === 'mahasiswa') {
            nimField.style.display = 'block';
            angkatanField.style.display = 'block';
            totalSksField.style.display = 'block';
            nidnField.style.display = 'none';
        } else if (roleSelect.value === 'dosen') {
            nimField.style.display = 'none';
            angkatanField.style.display = 'none';
            totalSksField.style.display = 'none';
            nidnField.style.display = 'block';
        } else {
            nimField.style.display = 'none';
            angkatanField.style.display = 'none';
            totalSksField.style.display = 'none';
            nidnField.style.display = 'none';
        }
    });
</script>
@endsection
