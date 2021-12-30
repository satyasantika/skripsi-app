@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Usulan Penelitian Anda') }}
                    <a href="{{ route('submission.edit',$submission) }}" class="btn btn-sm btn-primary float-end">Edit</a>
                </div>
                <div class="card-body">
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
                    {{-- Pilih Pembimbing --}}
                    <div class="row mb-3">
                        <div class="col-md-auto">
                            Pembimbing 1:<br>
                            @if (is_null($guide1))
                            {{-- Jika belum memilih pembimbing 1 --}}
                            <a href="{{ route('guidesubmission.createGuideSubmission',1) }}" class="btn btn-primary">Pilih Pembimbing 1</a>
                            @else
                            {{-- jika sudah memilih pembimbing 1 --}}
                            @if ($guide1->is_approve)
                            <a class="btn btn-sm btn-outline-success">OK</a>
                            @else
                            <a href="{{ route('guidesubmission.edit',$guide1) }}" class="btn btn-sm btn-primary">Edit</a>
                            @endif
                            {{ $guide1->guide_group->guide_allocation->user->name }}
                                @if (is_null($guide1->is_approve))
                                <span class="badge bg-warning">Menunggu respon...</span>
                                @elseif ($guide1->is_approve)
                                <span class="badge bg-success">Ajuan Diterima</span>
                                @else
                                <span class="badge bg-danger">Ajuan Ditolak</span>
                                @endif
                            @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-auto">
                            Pembimbing 2:<br>
                            @if (is_null($guide2))
                            {{-- Jika belum memilih pembimbing 2 --}}
                            <a href="{{ route('guidesubmission.createGuideSubmission',2) }}" class="btn btn-primary">Pilih Pembimbing 2</a>
                            @else
                            {{-- jika sudah memilih pembimbing 2 --}}
                            @if ($guide2->is_approve)
                            <a class="btn btn-sm btn-outline-success">OK</a>
                            @else
                            <a href="{{ route('guidesubmission.edit',$guide2) }}" class="btn btn-sm btn-primary">Edit</a>
                            @endif
                            {{ $guide2->guide_group->guide_allocation->user->name }}
                                @if (is_null($guide2->is_approve))
                                <span class="badge bg-warning">Menunggu respon...</span>
                                @elseif ($guide2->is_approve)
                                <span class="badge bg-success">Ajuan Diterima</span>
                                @else
                                <span class="badge bg-danger">Ajuan Ditolak</span>
                                @endif
                            @endif
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
