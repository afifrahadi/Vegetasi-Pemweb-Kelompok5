@extends('layouts.app')

@section('background_url', '/assets/topographic-5.1.svg')

@section('alert')
    @parent

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

@section('content')
    <x-card title="List Vegetasi">
        <x-slot:action>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                    data-bs-target="#formModal">Tambah Data</button>
                    <a href="{{ route('dashboard.vegetasi.export.excel') }}" class="btn btn-sm btn-success">Export to Excel</a>
                    <a href="{{ route('dashboard.vegetasi.export.pdf') }}" class="btn btn-sm btn-danger">Export to PDF</a>
            </div>
        </x-slot:action>

        <div class="table-responsive mt-4">
            <table class="table table-borderless table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Vegetasi</th>
                        <th>Nama Vegetasi</th>
                        <th>Kode Warna</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vegetasis as $vegetasi)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $vegetasi->code }}</td>
                            <td>{{ $vegetasi->nama_vegetasi }}</td>
                            <td>{{ $vegetasi->hex_code }}</td>
                            <td>
                                <div class="d-flex flex-nowrap gap-2">
                                    <a href="#" role="button" class="btn btn-sm btn-soft-warning"
                                        data-bs-toggle="modal" data-bs-target="#formModal-{{ $loop->iteration }}">Ubah</a>
                                    <button class="btn btn-sm btn-soft-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal-{{ $loop->iteration }}">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-card>
@endsection

@section('modal')
    {{-- Tambah Modal --}}
    <x-form-modal title="Form Data Vegetasi" id="formModal" action-route="{{ route('dashboard.vegetasi.store') }}">
        <div>
            <label for="kode" class="form-label">Kode Vegetasi</label>
            <input type="text" name="code" id="code" class="form-control">
        </div>
        <div>
            <label for="nama_vegetasi" class="form-label">Nama Vegetasi</label>
            <input type="text" name="nama_vegetasi" id="nama_vegetasi" class="form-control">
        </div>
        <div>
            <label for="hex_code" class="form-label">Kode Warna</label>
            <input type="color" name="hex_code" id="hex_code" class="form-control">
        </div>

        <x-slot:actions>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </x-slot:actions>
    </x-form-modal>

    @foreach ($vegetasis as $vegetasi)
        {{-- Edit Modal --}}
        <x-form-modal title="Form Data Vegetasi" id="formModal-{{ $loop->iteration }}"
            action-route="{{ route('dashboard.vegetasi.update', $vegetasi->id) }}">
            @method('PUT')
            <div>
                <label for="code" class="form-label">Kode Vegetasi</label>
                <input type="text" name="code" id="code" class="form-control"
                value="{{ $vegetasi->code }}">
            </div>
            <div>
                <label for="nama_vegetasi" class="form-label">Nama Vegetasi</label>
                <input type="text" name="nama_vegetasi" id="nama_vegetasi" class="form-control"
                value="{{ $vegetasi->nama_vegetasi }}">
            </div>
            <div>
                <label for="hex_code" class="form-label">Kode Warna</label>
                <input type="color" name="hex_code" id="hex_code" class="form-control"
                value="{{ $vegetasi->hex_code }}">
            </div>

            <x-slot:actions>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </x-slot:actions>
        </x-form-modal>

        {{-- Delete Modal --}}
        <x-form-modal title="Konfirmasi Penghapusan Data" id="deleteModal-{{ $loop->iteration }}"
            action-route="{{ route('dashboard.vegetasi.delete', $vegetasi->id) }}">
            @method('DELETE')
            <h6><b>Apakah Anda ingin menghapus data vegetasi {{ $vegetasi->nama_vegetasi }}?</b></h6>
            <p class="text-secondary">Seluruh data yang terhubung dengan data vegatasi akan terhapus.</p>

            <x-slot:actions>
                <button type="button" class="btn btn-soft-secondary" data-bs-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
            </x-slot:actions>
        </x-form-modal>
    @endforeach
@endsection
