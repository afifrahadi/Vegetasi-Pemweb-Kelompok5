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
    <x-card title="List Genus">
        <x-slot:action>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                    data-bs-target="#formModal">Tambah Data</button>
                    <a href="{{ route('dashboard.genus.export.excel') }}" class="btn btn-sm btn-success">Export to Excel</a>
                    <a href="{{ route('dashboard.genus.export.pdf') }}" class="btn btn-sm btn-danger">Export to PDF</a>
            </div>
        </x-slot:action>

        <div class="table-responsive mt-4">
            <table class="table table-borderless table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Genus</th>
                        <th>Nama Genus</th>
                        <th width="500">Deskripsi</th>
                        <th width="250">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Genus as $genus)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $genus->code }}</td>
                            <td>{{ $genus->nama_genus }}</td>
                            <td>{{ $genus->deskripsi }}</td>
                            <td>
                                <div class="d-flex flex-nowrap gap-2">
                                    <a href="{{ route('dashboard.genus.show', $genus->id) }}"
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
    <x-form-modal title="Form Data Genus" id="formModal" action-route="{{ route('dashboard.genus.store') }}">
        <div>
            <label for="code" class="form-label">Kode Genus</label>
            <input type="text" name="code" id="code" class="form-control">
        </div>
        <div>
            <label for="nama_genus" class="form-label">Nama Genus</label>
            <input type="text" name="nama_genus" id="nama_genus" class="form-control">
        </div>
        <div>
            <label for="fk_id_famili" class="form-label">Jenis Familia</label>
            <select name="fk_id_famili" id="fk_id_famili" class="form-select">
                <option selected disabled>Pilih Jenis Familia </option>
                @foreach($Familis as $famili)
                    <option value="{{ $famili->id }}">{{ $famili->nama_famili }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control"></textarea>
        </div>
        <div>
            <label for="photo" class="form-label">Upload Photo</label>
            <input type="file" name="photo" id="photo" class="form-control">
            <div class="form-text">Photo harus berekstensi .jpg | .jpeg | .png <br>Ukuran maksimal 5MB</div>
        </div>

        <x-slot:actions>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </x-slot:actions>
    </x-form-modal>

    @foreach ($Genus as $genus)
        {{-- Edit Modal --}}
        <x-form-modal title="Form Data Genus" id="formModal-{{ $loop->iteration }}"
            action-route="{{ route('dashboard.genus.update', $genus->id) }}">
            @method('PUT')
            <div>
                <label for="code" class="form-label">Kode Genus</label>
                <input type="text" name="code" id="code" class="form-control" value="{{ $genus->code }}">
            </div>
            <div>
                <label for="nama_genus" class="form-label">Nama Genus</label>
                <input type="text" name="nama_genus" id="nama_genus" class="form-control" value="{{ $genus->nama_genus }}">
            </div>
            <div>
                <label for="fk_id_famili" class="form-label">Jenis Familia</label>
                <select name="fk_id_famili" id="fk_id_famili" class="form-select">
                    <option selected disabled>Pilih Jenis Familia</option>
                    @foreach($Familis as $famili)
                        <option value="{{ $famili->id }}" {{ $famili->id == $genus->fk_id_famili ? 'selected' : '' }}>
                            {{ $famili->nama_famili }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control">{{ $genus->deskripsi }}</textarea>
            </div>
            <div>
                <label for="photo" class="form-label">Change Photo</label>
                <input type="file" name="photo" id="photo" class="form-control">
                <div class="form-text">Photo harus berekstensi .jpg | .jpeg | .png <br>Ukuran maksimal 5MB</div>
            </div>

            <x-slot:actions>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </x-slot:actions>
        </x-form-modal>

        {{-- Delete Modal --}}
        <x-form-modal title="Konfirmasi Penghapusan Data" id="deleteModal-{{ $loop->iteration }}"
            action-route="{{ route('dashboard.genus.delete', $genus->id) }}">
            @method('DELETE')
            <h6><b>Apakah Anda ingin menghapus data genus {{ $genus->nama_genus }}?</b></h6>
            <p class="text-secondary">Seluruh data yang terhubung dengan data genus akan terhapus.</p>

            <x-slot:actions>
                <button type="button" class="btn btn-soft-secondary" data-bs-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
            </x-slot:actions>
        </x-form-modal>
    @endforeach
@endsection
