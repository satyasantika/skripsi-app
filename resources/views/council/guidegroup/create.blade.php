@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Form Penambahan Kelompok Pembimbing') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('guidegroup.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="guide_allocation_id" class="col-md-4 col-form-label text-md-right">{{ __('Nama Dosen') }}</label>

                            <div class="col-md-8">
                                <select id="guide_allocation_id" name="guide_allocation_id" class="form-select" aria-label="Default select example" required>
                                    @foreach ($lectures as $lecture)
                                        <option value="{{ $lecture->id }}">{{ $lecture->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="guide_1" class="col-md-4 col-form-label text-md-right">{{ __('Pembimbing 1') }}</label>
                            <div class="col-md-3">
                                <input id="guide_1" type="number" class="form-control" name="guide_1" min="0">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="guide_2" class="col-md-4 col-form-label text-md-right">{{ __('Pembimbing 2') }}</label>
                            <div class="col-md-3">
                                <input id="guide_2" type="number" class="form-control" name="guide_2" min="0">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="group" class="col-md-4 col-form-label text-md-right">{{ __('Kelompok') }}</label>
                            <div class="col-md-3">
                                <input id="group" type="number" class="form-control" name="group" min="0">
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
