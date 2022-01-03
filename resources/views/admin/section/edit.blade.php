@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Ganti Sesi Pemilihan Pembimbing') }}
                    <a href="{{ route('admin.home') }}" class="btn btn-sm btn-danger float-end">Kembali</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.section.update') }}">
                        @method('PUT')
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Pilih Sesi') }}</label>

                            <div class="col-md-6">
                                @foreach ([1,2,3] as $section)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="name" id="flexRadioDefault{{ $section }}" value="{{ $section }}" {{ \App\Models\Section::first()->name == $section ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexRadioDefault{{ $section }}">
                                        Tahap {{ $section }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
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
