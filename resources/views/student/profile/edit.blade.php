@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Profil Mahasiswa') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('studentprofile.update',$studentprofile) }}">
                        @method('PUT')
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>
                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $studentprofile->name }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $studentprofile->email }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('No. WA') }}</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">+62</span>
                                    <input id="phone" type="text" class="form-control" name="phone" value="{{ $studentprofile->phone }}">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <span class="text-muted">tuliskan alamat tinggal sekarang (selengkap mungkin)</span>
                            <div class="form-floating">
                                <textarea class="form-control col-md-12" placeholder="alamat Anda ..." id="document" style="height: 100px" name="address" >{{ $studentprofile->address }}</textarea>
                                <label for="address" class="col-md-4 col-form-label text-md-right">&nbsp;&nbsp;Alamat</label>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary float-end">
                                    {{ __('Simpan') }}
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
