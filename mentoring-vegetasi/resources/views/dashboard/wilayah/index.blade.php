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
    <x-card title="List Wilayah">
        <x-slot:action>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                    data-bs-target="#formModal">Tambah Data</button>
                    <a href="{{ route('dashboard.wilayah.export.excel') }}" class="btn btn-sm btn-success">Export to Excel</a>
                    <a href="{{ route('dashboard.wilayah.export.pdf') }}" class="btn btn-sm btn-danger">Export to PDF</a>
            </div>
        </x-slot:action>

        <div class="table-responsive mt-4">
            <table class="table table-borderless table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Wilayah</th>
                        <th>Nama Wilayah</th>
                        <th>Luas Wilayah (km)</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wilayahs as $wilayah)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $wilayah->code }}</td>
                            <td>{{ $wilayah->name }}</td>
                            <td>{{ $wilayah->area }}</td>
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
    <x-form-modal title="Form Data Wilayah" id="formModal" action-route="{{ route('dashboard.wilayah.store') }}">
        <div>
            <label for="kode" class="form-label">Kode Wilayah</label>
            <input type="text" name="code" id="code" class="form-control">
        </div>
        <div>
            <label for="nama" class="form-label">Nama Wilayah</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div>
            <label for="luas" class="form-label">Luas Wilayah(km)</label>
            <input type="number" name="area" id="area" class="form-control">
        </div>

        <x-slot:actions>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </x-slot:actions>
    </x-form-modal>

    @foreach ($wilayahs as $wilayah)
        {{-- Edit Modal --}}
        <x-form-modal title="Form Data Wilayah" id="formModal-{{ $loop->iteration }}"
            action-route="{{ route('dashboard.wilayah.update', $wilayah->id) }}">
            @method('PUT')
            <div>
                <label for="code" class="form-label">Kode Wilayah</label>
                <input type="text" name="code" id="code" class="form-control" value="{{ $wilayah->code }}">
            </div>
            <div>
                <label for="name" class="form-label">Nama Wilayah</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $wilayah->name }}">
            </div>
            <div>
                <label for="area" class="form-label">Luas Wilayah (km)</label>
                <input type="number" name="area" id="area" class="form-control" value="{{ $wilayah->area }}">
            </div>

            <x-slot:actions>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </x-slot:actions>
        </x-form-modal>

        {{-- Delete Modal --}}
        <x-form-modal title="Konfirmasi Penghapusan Data" id="deleteModal-{{ $loop->iteration }}"
            action-route="{{ route('dashboard.wilayah.delete', $wilayah->id) }}">
            @method('DELETE')
            <h6><b>Apakah Anda ingin menghapus data wilayah {{ $wilayah->name }}?</b></h6>
            <p class="text-secondary">Seluruh data yang terhubung dengan data wilayah akan terhapus.</p>

            <x-slot:actions>
                <button type="button" class="btn btn-soft-secondary" data-bs-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
            </x-slot:actions>
        </x-form-modal>
    @endforeach
@endsection
