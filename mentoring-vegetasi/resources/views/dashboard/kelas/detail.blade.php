@extends('layouts.app')

@section('background_url', '/assets/topographic-5.1.svg')

@section('content')
    <a href="{{ url()->previous() }}" class="btn btn-sm btn-soft-primary">&leftarrow; Kembali</a>
    <div class="row mt-3">
        {{-- <div class="col-md-4">
            <x-card>
                <img src="{{ asset('assets/forest.png') }}" alt="foto tanaman" class="rounded img-fluid">
            </x-card>
        </div> --}}
        <div class="d-flex justify-content-center">
            <div class="col-md-8 center">
                <x-card title="Data Kelas">
                    <table class="table table-borderless">
                        <tr>
                            <th scope="row" style="white-space: nowrap;">Kode Kelas</th>
                            <td>{{ $classis->code }}</td>
                        </tr>
                        <tr>
                            <th scope="row" style="white-space: nowrap;">Nama Kelas</th>
                            <td>{{ $classis->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row" style="white-space: nowrap;">Deskripsi</th>
                            <td>{{ $classis->description }}</td>
                        </tr>
                    </table>
                </x-card>
            </div>
        </div>
    </div>
@endsection
