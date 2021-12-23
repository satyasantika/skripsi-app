@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Profil --}}
            <div class="card">
                <div class="card-header">{{ __('Dashboard Mahasiswa') }}</div>
                <div class="card-body">
                    <div class="row mb-2">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>
                        <div class="col-md-6">
                            <b>{{ $user->name }}</b>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('NPM') }}</label>
                        <div class="col-md-6">
                            {{ $user->username }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('email') }}</label>
                        <div class="col-md-6">
                            {{ $user->email }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('WA') }}</label>
                        <div class="col-md-6">
                            <a href="https://wa.me/62{{ $user->phone }}">0{{ $user->phone }}</a>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('alamat') }}</label>
                        <div class="col-md-6">
                            {{ $user->address }}
                        </div>
                    </div>
                </div>
            </div>
            {{-- Ajuan Judul Penelitian --}}
            <div class="card mt-2">
                <div class="card-header">
                    {{ __('Usulan Penelitian Anda') }}
                    <a href="{{ route('submission.index') }}" class="btn btn-sm btn-primary float-end">Edit Usulan</a>
                </div>
                <div class="card-body">
                @if ($submission==null)
                <a href="{{ route('submission.index') }}" class="btn btn-primary mt-2">Usulkan Judul</a>
                @else
                <div class="row mb-3">
                    <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Judul Penelitian') }}</label>
                    <div class="col-md-6">
                        {{ $submission->title }}
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Link Dokumen Pendukung') }}</label>
                    <div class="col-md-6">
                        <a href="{{ $submission->document ?? "" }}">{{ $submission->document ?? "belum ada" }}</a>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="title" class="col-md-4 col-form-label text-md-right"></label>
                    <div class="col-md-6">

                    </div>
                </div>
                @endif
            </div>
            </div>

        </div>
    </div>
</div>
@endsection
