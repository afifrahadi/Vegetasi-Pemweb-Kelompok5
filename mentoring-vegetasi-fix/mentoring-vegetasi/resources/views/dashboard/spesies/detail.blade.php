@extends('layouts.app')

@section('background_url', '/assets/topographic-5.3.svg')

@section('content')
    <a href="{{ url()->previous() }}" class="btn btn-sm btn-soft-primary">&leftarrow; Kembali</a>
    <div class="row mt-3">
        <div class="col-md-4">
            <x-card>
                @if ($spesies->foto)
                    <img src="{{ $spesies->foto }}" alt="foto tanaman" class="rounded img-fluid">
                @else
                    <span>Photo belum diupload</span>
                @endif
            </x-card>
        </div>
        <div class="col-md-8">
            <x-card title="Data Spesies">
                <table class="table table-borderless">
                    <tr>
                        <th scope="row" style="white-space: nowrap;">Kode Spesies</th>
                        <td>{{ $spesies->code }}</td>
                    </tr>
                    <tr>
                        <th scope="row" style="white-space: nowrap;">Nama Spesies</th>
                        <td>{{ $spesies->nama_spesies }}</td>
                    </tr>
                    <tr>
                        <th scope="row" style="white-space: nowrap;">Tinggi</th>
                        <td>{{ $spesies->tinggi }}M</td>
                    </tr>
                    <tr>
                        <th scope="row" style="white-space: nowrap;">Diameter</th>
                        <td>{{ $spesies->diameter }}Cm</td>
                    </tr>
                    <tr>
                        <th scope="row" style="white-space: nowrap;">Warna Daun</th>
                        <td>{{ $spesies->warna_daun }}</td>
                    </tr>
                    <tr>
                        <th scope="row" style="white-space: nowrap;">Koordinat</th>
                        <td>{{ $spesies->latitude }}; {{ $spesies->longitude }}</td>
                    </tr>
                    <tr>
                        <th scope="row" style="white-space: nowrap;">Genus</th>
                        <td><a href="{{route('dashboard.genus.show', $spesies->genus->id)}}">{{ $spesies->genus->nama_genus }}</a></td>
                    </tr>
                    <tr>
                        <th scope="row" style="white-space: nowrap;">Famili</th>
                        <td><a href="{{route('dashboard.famili.show', $spesies->genus->familis->id)}}">{{ $spesies->genus->familis->nama_famili }}</a></td>
                    </tr>
                    <tr>
                        <th scope="row" style="white-space: nowrap;">Ordo</th>
                        <td><a href="{{route('dashboard.ordo.show', $spesies->genus->familis->ordos->id)}}">{{ $spesies->genus->familis->ordos->nama_ordo }}</a></td>
                    </tr>
                    <tr>
                        <th scope="row" style="white-space: nowrap;">Kelas</th>
                        <td><a href="{{route('dashboard.kelas.show', $spesies->genus->familis->ordos->classis->id)}}">{{ $spesies->genus->familis->ordos->classis->name }}</a></td>
                    </tr>
                    <tr>
                        <th scope="row" style="white-space: nowrap;">Vegetasi</th>
                        <td>{{ $spesies->vegetasis->nama_vegetasi }}</td>
                    </tr>
                    <tr>
                        <th scope="row" style="white-space: nowrap;">Wilayah</th>
                        <td>{{ $spesies->wilayahs->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row" style="white-space: nowrap;">Deskripsi</th>
                        <td>{{ $spesies->deskripsi }}</td>
                    </tr>
                </table>
            </x-card>
        </div>
    </div>
@endsection
