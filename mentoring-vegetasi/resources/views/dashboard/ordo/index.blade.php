@extends('layouts.app')

@section('background_url', '/assets/topographic-5.3.svg')

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
    <x-card title="List Ordo">
        <x-slot:action>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                    data-bs-target="#formModal">Tambah Data</button>
                    <a href="{{ route('dashboard.ordo.export.excel') }}" class="btn btn-sm btn-success">Export to Excel</a>
                    <a href="{{ route('dashboard.ordo.export.pdf') }}" class="btn btn-sm btn-danger">Export to PDF</a>
            </div>
        </x-slot:action>

        <div class="table-responsive mt-4">
            <table class="table table-borderless table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th width="150">Kode Ordo</th>
                        <th width="200">Nama Ordo</th>
                        <th>Deskripsi</th>
                        <th width="250">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Ordos as $ordo)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $ordo->code}}</td>
                            <td>{{ $ordo->nama_ordo }}</td>
                            <td>{{ $ordo->deskripsi }}</td>
                            <td>
                                <div class="d-flex flex-nowrap gap-2">
                                    <a href="{{ route('dashboard.ordo.show', $ordo->id) }}"
                                        class="btn btn-sm btn-soft-info">Detail</a>
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
    <x-form-modal title="Form Data ordo" id="formModal" action-route="{{ route('dashboard.ordo.store') }}">
        <div>
            <label for="code" class="form-label">Kode Ordo</label>
            <input type="text" name="code" id="code" class="form-control">
        </div>
        <div>
            <label for="nama" class="form-label">Nama Ordo</label>
            <input type="text" name="nama_ordo" id="nama_ordo" class="form-control">
        </div>
        <div>
            <label for="fk_id_kelas" class="form-label">Jenis Kelas</label>
            <select name="fk_id_kelas" id="fk_id_kelas" class="form-select">
                <option selected disabled>Pilih Jenis Kelas</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control"></textarea>
        </div>

        <x-slot:actions>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </x-slot:actions>
    </x-form-modal>

    @foreach ($Ordos as $ordo)
        {{-- Edit Modal --}}
        <x-form-modal title="Form Data Ordo" id="formModal-{{ $loop->iteration }}"
            action-route="{{ route('dashboard.ordo.update', $ordo->id) }}">
            @method('PUT')
            <div>
                <label for="code" class="form-label">Kode Ordo</label>
                <input type="text" name="code" id="code" class="form-control" value="{{ $ordo->code }}">
            </div>
            <div>
                <label for="nama_ordo" class="form-label">Nama Ordo</label>
                <input type="text" name="nama_ordo" id="nama_ordo" class="form-control" value="{{ $ordo->nama_ordo }}">
            </div>
            <div>
                <label for="fk_id_kelas" class="form-label">Jenis Kelas</label>
                <select name="fk_id_kelas" id="fk_id_kelas" class="form-select">
                    <option selected disabled>Pilih Jenis Kelas</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ $class->id == $ordo->fk_id_kelas ? 'selected' : '' }}>
                            {{ $class->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control">{{ $ordo->deskripsi }}</textarea>
            </div>

            <x-slot:actions>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </x-slot:actions>
        </x-form-modal>

        {{-- Delete Modal --}}
        <x-form-modal title="Konfirmasi Penghapusan Data" id="deleteModal-{{ $loop->iteration }}"
            action-route="{{ route('dashboard.ordo.delete', $ordo->id) }}">
            @method('DELETE')
            <h6><b>Apakah Anda ingin menghapus data ordo {{ $ordo->nama_ordo }}?</b></h6>
            <p class="text-secondary">Seluruh data yang terhubung dengan data ordo akan terhapus.</p>

            <x-slot:actions>
                <button type="button" class="btn btn-soft-secondary" data-bs-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
            </x-slot:actions>
        </x-form-modal>
    @endforeach
@endsection
