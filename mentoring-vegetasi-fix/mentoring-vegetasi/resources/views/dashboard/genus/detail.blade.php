@extends('layouts.app')

@section('background_url', '/assets/topographic-5.2.svg')

@section('content')
    <a href="{{ url()->previous() }}" class="btn btn-sm btn-soft-primary">&leftarrow; Kembali</a>
    <div class="row mt-3">
        <div class="col-md-4">
            <x-card>
                @if ($genus->photo_path)
                    <img src="{{ $genus->photo_path }}" alt="foto tanaman" class="rounded img-fluid">
                @else
                    <span>Photo belum diupload</span>
                @endif
            </x-card>
        </div>
        <div class="col-md-8">
            <x-card title="Data Genus">
                <table class="table table-borderless">
                    <tr>
                        <th scope="row" style="white-space: nowrap;">Kode Genus</th>
                        <td>{{ $genus->code }}</td>
                    </tr>
                    <tr>
                        <th scope="row" style="white-space: nowrap;">Nama Genus</th>
                        <td>{{ $genus->nama_genus }}</td>
                    </tr>
                    <tr>
                        <th scope="row" style="white-space: nowrap;">Deskripsi</th>
                        <td>{{ $genus->deskripsi }}</td>
                    </tr>
                </table>
            </x-card>
        </div>
    </div>
@endsection
