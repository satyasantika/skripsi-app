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
                                Pembimbing 1:
                                @if ($guide1)
                                {{ $guide1->guide_group->guide_allocation->user->name }}
                                <a href="{{ route('guidesubmission.edit',$guide1) }}" class="btn btn-sm btn-primary float-end">Edit</a>
                                @else
                                <a href="{{ route('guidesubmission.createGuideSubmission',1) }}" class="btn btn-primary">Pilih Pembimbing 1</a>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-auto">
                                Pembimbing 2:
                                @if ($guide2)
                                {{ $guide2->guide_group->guide_allocation->user->name }}
                                <a href="{{ route('guidesubmission.edit',$guide2) }}" class="btn btn-sm btn-primary float-end">Edit</a>
                                @else
                                <a href="{{ route('guidesubmission.createGuideSubmission',2) }}" class="btn btn-primary">Pilih Pembimbing 2</a>
                                @endif
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
