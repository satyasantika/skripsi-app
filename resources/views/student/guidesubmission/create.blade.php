@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Form Usulan Pembimbing') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('guidesubmission.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="guide_group_id" class="col-md-4 col-form-label text-md-right">{{ __('Pembimbing ').$order }}</label>

                            <div class="col-md-8">
                                <select id="guide_group_id" name="guide_group_id" class="form-select" aria-label="Default select example" required>
                                    @foreach ($guides as $guide)
                                    @php
                                        $booking = App\Models\Guide::where('guide_group_id',$guide->id)->count();
                                        $remaining_guide_1 = $guide->guide_1 - $booking;
                                        $remaining_guide_2 = $guide->guide_2 - $booking;
                                    @endphp
                                        <option value="{{ $guide->id }}">
                                            {{ $guide->name }} (
                                                @if ($order ==  1)
                                                    {{ $remaining_guide_1 == 0 ? 'kuota habis' : 'tersedia '.$remaining_guide_1 }}
                                                @else
                                                    {{ $remaining_guide_2 == 0 ? 'kuota habis' : 'tersedia '.$remaining_guide_2 }}
                                                @endif
                                                )
                                        </option>
                                    @endforeach
                                </select>
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
