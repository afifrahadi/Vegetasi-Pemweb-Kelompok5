@extends('layouts.app')

@section('background_url', '/assets/topographic-5.4.svg')

{{-- @php
    $famili = [
        'kode' => 'CF',
        'nama' => 'Canis familiaris',
        'deskripsi' => 'Lorem ipsum dolor sit amet.',
    ];
@endphp --}}

@section('content')
    <a href="{{ url()->previous() }}" class="btn btn-sm btn-soft-primary">&leftarrow; Kembali</a>
    <div class="row mt-3">
        <div class="col-md-4">
            <x-card>
                <img src="{{ asset('assets/forest.png') }}" alt="foto tanaman" class="rounded img-fluid">
            </x-card>
        </div>
        <div class="col-md-8">
            <x-card title="Data Famili">
                <table class="table table-borderless">
                    <tr>
                        <th scope="row" style="white-space: nowrap;">Kode Famili</th>
                        <td>{{ $famili->code }}</td>
                    </tr>
                    <tr>
                        <th scope="row" style="white-space: nowrap;">Nama Famili</th>
                        <td>{{ $famili->nama_famili }}</td>
                    </tr>
                    <tr>
                        <th scope="row" style="white-space: nowrap;">Deskripsi</th>
                        <td>{{ $famili->deskripsi }}</td>
                    </tr>
                </table>
            </x-card>
        </div>
    </div>
@endsection
