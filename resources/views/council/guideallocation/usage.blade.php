@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Sisa Kuota Dosen Pembimbing') }}
                    <a href="{{ route('council.home') }}" class="btn btn-sm btn-danger float-end">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Dosen</th>
                                        <th class="text-end">P1</th>
                                        <th class="text-end">P2</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($guideallocations as $guideallocation)
                                    <tr>
                                        <td>{{ $guideallocation['name'] }}</td>
                                        <td class="text-end">
                                            <span class="badge bg-primary">kuota: {{ $guideallocation['guide_1_allocation'] }}</span>
                                            <span class="badge bg-info">sisa: {{ $guideallocation['guide_1_remain'] }}</span>
                                            <span class="badge bg-secondary">ajuan: {{ $guideallocation['guide_1_submission'] }}</span>
                                            <span class="badge bg-success">terima: {{ $guideallocation['guide_1_accept'] }}</span>
                                            <span class="badge bg-danger">tolak: {{ $guideallocation['guide_1_decline'] }}</span>
                                        </td>
                                        <td class="text-end">
                                            <span class="badge bg-primary">kuota: {{ $guideallocation['guide_2_allocation'] }}</span>
                                            <span class="badge bg-info">sisa: {{ $guideallocation['guide_2_remain'] }}</span>
                                            <span class="badge bg-secondary">ajuan: {{ $guideallocation['guide_2_submission'] }}</span>
                                            <span class="badge bg-success">terima: {{ $guideallocation['guide_2_accept'] }}</span>
                                            <span class="badge bg-danger">tolak: {{ $guideallocation['guide_2_decline'] }}</span>
                                        </td>
                                    </tr>
                                    @empty
                                        Belum ada ajuan judul
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
