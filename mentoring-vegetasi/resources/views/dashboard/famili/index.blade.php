@extends('layouts.app')

@section('background_url', '/assets/topographic-5.2.svg')

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
    <x-card title="List Famili">
        <x-slot:action>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                    data-bs-target="#formModal">Tambah Data</button>
                    <a href="{{ route('dashboard.famili.export.excel') }}" class="btn btn-sm btn-success">Export to Excel</a>
                    <a href="{{ route('dashboard.famili.export.pdf') }}" class="btn btn-sm btn-danger">Export to PDF</a>
            </div>
        </x-slot:action>

        <div class="table-responsive mt-4">
            <table class="table table-borderless table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Famili</th>
                        <th widht="200">Nama Famili</th>
                        <th>Deskripsi</th>
                        <th width="250">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Familis as $famili)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $famili->code }}</td>
                            <td>{{ $famili->nama_famili }}</td>
                            <td>{{ $famili->deskripsi }}</td>
                            <td>
                                <div class="d-flex flex-nowrap gap-2">
                                    <a href="{{ route('dashboard.famili.show', $famili->id) }}"
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
    <x-form-modal title="Form Data Famili" id="formModal" action-route="{{ route('dashboard.famili.store') }}">
        <div>
            <label for="code" class="form-label">Kode Famili</label>
            <input type="text" name="code" id="code" class="form-control">
        </div>
        <div>
            <label for="nama_famili" class="form-label">Nama Famili</label>
            <input type="text" name="nama_famili" id="nama_famili" class="form-control">
        </div>
        <div>
            <label for="fk_id_ordo" class="form-label">Jenis Ordo</label>
            <select name="fk_id_ordo" id="fk_id_ordo" class="form-select">
                <option selected disabled>Pilih Jenis Ordo</option>
                    @foreach($Ordos as $ordo)
                        <option value="{{ $ordo->id }}">{{ $ordo->nama_ordo }}</option>
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

    @foreach ($Familis as $famili)
        {{-- Edit Modal --}}
        <x-form-modal title="Form Data Famili" id="formModal-{{ $loop->iteration }}"
            action-route="{{ route('dashboard.famili.update', $famili->id) }}">
            @method('PUT')
            <div>
                <label for="code" class="form-label">Kode Famili</label>
                <input type="text" name="code" id="code" class="form-control" value="{{ $famili->code }}" readonly>
            </div>
            <div>
                <label for="nama_famili" class="form-label">Nama Famili</label>
                <input type="text" name="nama_famili" id="nama_famili" class="form-control" value="{{ $famili->nama_famili }}">
            </div>
            <div>
                <label for="fk_id_ordo" class="form-label">Jenis Ordo</label>
                <select name="fk_id_ordo" id="fk_id_ordo" class="form-select">
                    <option selected disabled>Pilih Jenis Ordo</option>
                    @foreach($Ordos as $ordo)
                        <option value="{{ $ordo->id }}" {{ $ordo->id == $famili->fk_id_ordo ? 'selected' : '' }}>
                            {{ $ordo->nama_ordo }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control">{{ $famili->deskripsi }}</textarea>
            </div>

            <x-slot:actions>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </x-slot:actions>
        </x-form-modal>

        {{-- Delete Modal --}}
        <x-form-modal title="Konfirmasi Penghapusan Data" id="deleteModal-{{ $loop->iteration }}"
            action-route="{{ route('dashboard.famili.delete', $famili->id) }}">
            @method('DELETE')
            <h6><b>Apakah Anda ingin menghapus data famili {{ $famili->nama_famili }}?</b></h6>
            <p class="text-secondary">Seluruh data yang terhubung dengan data famili akan terhapus.</p>

            <x-slot:actions>
                <button type="button" class="btn btn-soft-secondary" data-bs-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
            </x-slot:actions>
        </x-form-modal>
    @endforeach
@endsection
