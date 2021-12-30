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
                            <b>{{ $user->username }}</b>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('email') }}</label>
                        <div class="col-md-6">
                            <b>{{ $user->email }}</b>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('WA') }}</label>
                        <div class="col-md-6">
                            <b>0{{ $user->phone }}</b>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('alamat') }}</label>
                        <div class="col-md-6">
                            <b>{{ $user->address }}</b>
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
                        <b>{{ $submission->title }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Link Dokumen Pendukung') }}</label>
                    <div class="col-md-6">
                        <b><a href="{{ $submission->document ?? "" }}">{{ $submission->document ?? "belum ada" }}</a></b>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="title" class="col-md-4 col-form-label text-md-right">Calon Pembimbing</label>
                    <div class="col-md-6">
                        @forelse ($guidesubmissions as $guidesubmission)
                            {{ $guidesubmission->guide_group->guide_allocation->user->name }}
                            @if (is_null($guidesubmission->is_approve))
                            <span class="badge bg-warning">Menunggu respon...</span>
                            @elseif ($guidesubmission->is_approve)
                            <span class="badge bg-success">Ajuan Diterima</span>
                            @else
                            <span class="badge bg-danger">Ajuan Ditolak</span>
                            @endif
                            <br>
                        @empty
                            Belum ada pengusulan
                        @endforelse
                    </div>
                </div>
                @endif
            </div>
            </div>

        </div>
    </div>
</div>
@endsection
