@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Kuota Pembimbing') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('allocation.update',$allocation) }}">
                        @method('PUT')
                        @csrf

                        <div class="row mb-3">
                            <label for="lecture_id" class="col-md-4 col-form-label text-md-right">{{ __('Nama lecture') }}</label>

                            <div class="col-md-6">
                                <select id="lecture_id" name="lecture_id" class="form-select" aria-label="Default select example" required>
                                    @foreach ($lectures as $lecture)
                                        <option value="{{ $lecture->id }}" {{ $lecture->id === $allocation->lecture_id ? 'selected' : '' }}>{{ $lecture->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="guide_1" class="col-md-4 col-form-label text-md-right">{{ __('Pembimbing 1') }}</label>
                            <div class="col-md-6">
                                <input id="guide_1" type="number" class="form-control" name="guide_1" min="0" value="{{ $allocation->guide_1 }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="guide_2" class="col-md-4 col-form-label text-md-right">{{ __('Pembimbing 2') }}</label>
                            <div class="col-md-6">
                                <input id="guide_2" type="number" class="form-control" name="guide_2" min="0" value="{{ $allocation->guide_2 }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="examinator" class="col-md-4 col-form-label text-md-right">{{ __('Penguji') }}</label>
                            <div class="col-md-6">
                                <input id="examinator" type="number" class="form-control" name="examinator" min="0" value="{{ $allocation->examinator }}">
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
                    <form action="{{ route('allocation.destroy',$allocation) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger float-end">
                            {{ __('Hapus') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
