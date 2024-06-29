@extends('layouts.app')

@section('background_url', '/assets/topographic-5.2.svg')

{{-- @php
    $ordo = [
        'kode' => 'KV',
        'nama' => 'Karnivora',
        'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
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
            <x-card title="Data Ordo">
                <table class="table table-borderless">
                    <tr>
                        <th scope="row" style="white-space: nowrap;">Kode Ordo</th>
                        <td>{{ $ordo->code }}</td>
                    </tr>
                    <tr>
                        <th scope="row" style="white-space: nowrap;">Nama Ordo</th>
                        <td>{{ $ordo->nama_ordo }}</td>
                    </tr>
                    <tr>
                        <th scope="row" style="white-space: nowrap;">Deskripsi</th>
                        <td>{{ $ordo->deskripsi }}</td>
                    </tr>
                </table>
            </x-card>
        </div>
    </div>
@endsection
