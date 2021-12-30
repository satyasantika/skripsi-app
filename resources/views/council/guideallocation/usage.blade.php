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
                                    @php
                                        $guidegroup_1 = App\Models\GuideGroup::where('guide_allocation_id',$guideallocation->id)
                                                                                ->where('guide_1','>',0)
                                                                                ->get()->pluck('id');
                                        $guidegroup_2 = App\Models\GuideGroup::where('guide_allocation_id',$guideallocation->id)
                                                                                ->where('guide_2','>',0)
                                                                                ->get()->pluck('id');
                                        $guide_1 = App\Models\Guide::whereIn('guide_group_id',$guidegroup_1)->count();
                                        $guide_2 = App\Models\Guide::whereIn('guide_group_id',$guidegroup_2)->count();
                                        $order = $guideallocation->guide_1 == 0 ? 2 : 1;
                                    @endphp
                                    <tr>
                                        <td>{{ $guideallocation->user->name }}</td>
                                        <td class="text-end">{{ $guideallocation->guide_1 - $guide_1 }}</td>
                                        <td class="text-end">{{ $guideallocation->guide_2 - $guide_2 }}</td>
                                    </tr>
                                    @empty
                                        Belum ada ajuan judul
                                    @endforelse
                                </tbody>
                            </table>
                            <a href="{{ route('guideallocation.create') }}" class="btn btn-sm btn-primary">+ Tambah Kuota</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
