@extends('layouts.app')

@section('background_url', '/assets/topographic-5.4.svg')

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
    <x-card title="List Spesies">
        <x-slot:action>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                    data-bs-target="#formModal">Tambah Data</button>
                    <a href="{{ route('dashboard.spesies.export.excel') }}" class="btn btn-sm btn-success">Export to Excel</a>
                    <a href="{{ route('dashboard.spesies.export.pdf') }}" class="btn btn-sm btn-danger">Export to PDF</a>
            </div>
        </x-slot:action>

        <div class="table-responsive mt-4">
            <table class="table table-borderless table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Spesies</th>
                        <th>Nama Spesies</th>
                        <th>Tinggi(m)</th>
                        <th width="250">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Spesies as $spesies)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $spesies->code }}</td>
                            <td>{{ $spesies->nama_spesies }}</td>
                            <td>{{ $spesies->tinggi }}</td>
                            <td>
                                <div class="d-flex flex-nowrap gap-2">
                                    <a href="{{ route('dashboard.spesies.show', $spesies->id) }}"
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
    <x-form-modal title="Form Data spesies" id="formModal" action-route="{{ route('dashboard.spesies.store') }}">
        <div>
            <label for="code" class="form-label">Kode Spesies</label>
            <input type="text" name="code" id="code" class="form-control">
        </div>
        <div>
            <label for="nama_spesies" class="form-label">Nama Spesies</label>
            <input type="text" name="nama_spesies" id="nama_spesies" class="form-control">
        </div>
        <div>
            <label for="foto" class="form-label">Foto</label>
            <input type="file" name="foto" id="foto" class="form-control">
        </div>
        <div>
            <label for="tinggi" class="form-label">Tinggi</label>
            <div class="input-group">
                <input type="number" name="tinggi" id="tinggi" class="form-control">
                <span class="input-group-text">m</span>
            </div>
        </div>
        <div>
            <label for="diameter" class="form-label">Diameter</label>
            <div class="input-group">
                <input type="number" name="diameter" id="diameter" class="form-control">
                <span class="input-group-text">cm</span>
            </div>
        </div>
        <div>
            <label for="warna_daun" class="form-label">Warna Daun</label>
            <input type="text" name="warna_daun" id="warna_daun" class="form-control">
        </div>
        <div>
            <label for="latitude" class="form-label">Latitude</label>
            <div class="input-group">
                <input type="text" name="latitude" id="latitude" class="form-control" step="any">
                <span class="input-group-text">lat</span>
            </div>
        </div>
        <div>
            <label for="longitude" class="form-label">Longitude</label>
            <div class="input-group">
                <input type="text" name="longitude" id="longitude" class="form-control" step="any">
                <span class="input-group-text">long</span>
            </div>
        </div>
        <div>
            <label for="fk_id_genus" class="form-label">Kategori Genus</label>
            <select name="fk_id_genus" id="fk_id_genus" class="form-select">
                <option selected disabled>Pilih kategori</option>
                @foreach($Genus as $genus)
                    <option value="{{ $genus->id }}">{{ $genus->nama_genus }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="fk_id_wilayah" class="form-label">Kategori Wilayah</label>
            <select name="fk_id_wilayah" id="fk_id_wilayah" class="form-select">
                <option selected disabled>Pilih kategori</option>
                @foreach($Wilayahs as $wilayah)
                    <option value="{{ $wilayah->id }}">{{ $wilayah->name }}</option>
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

    @foreach ($Spesies as $spesies)
        {{-- Edit Modal --}}
        <x-form-modal title="Form Data Spesies" id="formModal-{{ $loop->iteration }}"
            action-route="{{ route('dashboard.spesies.update', $spesies->id) }}">
            @method('PUT')
            <div>
                <label for="code" class="form-label">Kode Spesies</label>
                <input type="text" name="code" id="code" class="form-control" value="{{ $spesies->code }}">
            </div>
            <div>
                <label for="nama_spesies" class="form-label">Nama Spesies</label>
                <input type="text" name="nama_spesies" id="nama_spesies" class="form-control"
                    value="{{ $spesies->nama_spesies }}">
            </div>
            <div>
                <label for="foto" class="form-label">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control"
                    value="{{ $spesies->foto }}">
            </div>
            <div>
                <label for="tinggi" class="form-label">Tinggi</label>
                <div class="input-group">
                    <input type="number" name="tinggi" id="tinggi" class="form-control"
                        value="{{ $spesies->tinggi }}">
                    <span class="input-group-text">m</span>
                </div>
            </div>
            <div>
                <label for="diameter" class="form-label">Diameter</label>
                <div class="input-group">
                    <input type="number" name="diameter" id="diameter" class="form-control"
                        value="{{ $spesies->diameter }}">
                    <span class="input-group-text">cm</span>
                </div>
            </div>
            <div>
                <label for="warna_daun" class="form-label">Warna Daun</label>
                <input type="text" name="warna_daun" id="warna_daun" class="form-control" value="{{ $spesies->warna_daun }}">
            </div>
            <div>
                <label for="latitude" class="form-label">Latitude</label>
                <input type="text" name="latitude" id="latitude" class="form-control" value="{{ $spesies->latitude }}" step="any">
            </div>
            <div>
                <label for="longitude" class="form-label">Longitude</label>
                <input type="text" name="longitude" id="longitude" class="form-control" value="{{ $spesies->longitude }}" step="any">
            </div>
            <div>
                <label for="fk_id_genus" class="form-label">Kategori Genus</label>
                <select name="fk_id_genus" id="fk_id_genus" class="form-select" >
                    <option selected disabled>Pilih kategori</option>
                    @foreach($Genus as $genus)
                        <option value="{{ $genus->id }}" {{ $genus->id == $spesies->fk_id_genus ? 'selected' : '' }}>
                            {{ $genus->nama_genus }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="fk_id_wilayah" class="form-label">Kategori Wilayah</label>
                <select name="fk_id_wilayah" id="fk_id_wilayah" class="form-select" >
                    <option selected disabled>Pilih wilayah</option>
                    @foreach($Wilayahs as $wilayah)
                        <option value="{{ $wilayah->id }}" {{ $wilayah->id == $spesies->fk_id_wilayah ? 'selected' : '' }}>
                            {{ $wilayah->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control">{{ $spesies->deskripsi }}</textarea>
            </div>

            <x-slot:actions>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </x-slot:actions>
        </x-form-modal>

        {{-- Delete Modal --}}
        <x-form-modal title="Konfirmasi Penghapusan Data" id="deleteModal-{{ $loop->iteration }}"
            action-route="{{ route('dashboard.spesies.delete', $spesies->id) }}">
            @method('DELETE')
            <h6><b>Apakah Anda ingin menghapus data spesies {{ $spesies['nama'] }}?</b></h6>
            <p class="text-secondary">Seluruh data yang terhubung dengan data spesies akan terhapus.</p>

            <x-slot:actions>
                <button type="button" class="btn btn-soft-secondary" data-bs-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
            </x-slot:actions>
        </x-form-modal>
    @endforeach
@endsection
