@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Penetapan Kelompok Pembimbing') }}
                    <a href="{{ route('council.home') }}" class="btn btn-sm btn-danger float-end">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                        <a href="{{ route('guidegroup.create') }}" class="btn btn-sm btn-primary float-end">+ Tambah Kuota</a>
                        </div>
                    </div>
                    @forelse ($groups as $group)
                    <div class="row mb-3">
                        <h3>Kelompok {{ $group->group }}</h3>
                        @php
                            $guidegroups = App\Models\GuideGroup::join('guide_allocations','guide_groups.guide_allocation_id','=','guide_allocations.id')
                            ->join('users','guide_allocations.lecture_id','=','users.id')
                            ->select('guide_groups.*')
                            ->where([
                                ['guide_groups.group','=',$group->group],
                                ['guide_allocations.year','=',2022],
                            ])
                            ->orderBy('users.name');
                            // ->get();
                        @endphp
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Dosen</th>
                                        <th class="text-end">P1</th>
                                        <th class="text-end">P2</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($guidegroups->get() as $guidegroup)
                                    <tr>
                                        <td><a href="{{ route('guidegroup.edit',$guidegroup) }}" class="btn btn-sm btn-primary">edit</a></td>
                                        <td>{{ $guidegroup->guide_allocation->user->name }}</td>
                                        <td class="text-end">{{ $guidegroup->guide_1 }}</td>
                                        <td class="text-end">{{ $guidegroup->guide_2 }}</td>
                                    </tr>
                                    @empty
                                    Belum ada ajuan judul
                                    @endforelse
                                    <tr class="bg-warning">
                                        <td></td>
                                        <td>TOTAL</td>
                                        <td><b>{{ $guidegroups->sum('guide_groups.guide_1') }}</b></td>
                                        <td><b>{{ $guidegroups->sum('guide_groups.guide_2') }}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @empty
                    <div class="alert alert-info">Data belum ada</div>
                    @endforelse
                    <div class="row mb-3">
                        <div class="col-md-12">
                        <a href="{{ route('guidegroup.create') }}" class="btn btn-sm btn-primary float-end">+ Tambah Kuota</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
