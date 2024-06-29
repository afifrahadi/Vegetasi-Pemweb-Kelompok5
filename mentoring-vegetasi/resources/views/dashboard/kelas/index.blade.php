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
    <x-card title="List Kelas">
        <x-slot:action>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                    data-bs-target="#formModal">Tambah Data</button>
                    <a href="{{ route('dashboard.kelas.export.excel') }}" class="btn btn-sm btn-success">Export to Excel</a>
                    <a href="{{ route('dashboard.kelas.export.pdf') }}" class="btn btn-sm btn-danger">Export to PDF</a>
            </div>
        </x-slot:action>

        <div class="table-responsive mt-4">
            <table class="table table-borderless table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th width="150">Kode Kelas</th>
                        <th width="200">Nama Kelas</th>
                        <th width="500">Deskripsi</th>
                        <th width="250">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classis as $kelas)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $kelas->code }}</td>
                            <td>{{ $kelas->name }}</td>
                            <td>{{ $kelas->description_limit }}</td>
                            <td>
                                <div class="d-flex flex-nowrap gap-2">
                                    <a href="{{ route('dashboard.kelas.show', $kelas->id) }}"
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
    <x-form-modal title="Form Data Kelas" id="formModal" action-route="{{ route('dashboard.kelas.store') }}">
        <div>
            <label for="code" class="form-label">Kode Kelas</label>
            <input type="text" name="code" id="code" class="form-control">
        </div>
        <div>
            <label for="name" class="form-label">Nama Kelas</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div>
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" id="description" rows="3" class="form-control"></textarea>
        </div>

        <x-slot:actions>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </x-slot:actions>
    </x-form-modal>

    @foreach ($classis as $kelas)
        {{-- Edit Modal --}}
        <x-form-modal title="Form Data Kelas" id="formModal-{{ $loop->iteration }}"
            action-route="{{ route('dashboard.kelas.update', $kelas->id) }}">
            @method('PUT')
            <div>
                <label for="code" class="form-label">Kode Kelas</label>
                <input type="text" name="code" id="code" class="form-control" value="{{ $kelas->code}}">
            </div>
            <div>
                <label for="name" class="form-label">Nama Kelas</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $kelas->name}}">
            </div>
            <div>
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" id="description" rows="3" class="form-control">{{ $kelas->description }}</textarea>
            </div>

            <x-slot:actions>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </x-slot:actions>
        </x-form-modal>

        {{-- Delete Modal --}}
        <x-form-modal title="Konfirmasi Penghapusan Data" id="deleteModal-{{ $loop->iteration }}"
            action-route="{{ route('dashboard.kelas.delete', $kelas->id) }}">
            @method('DELETE')
            <h6><b>Apakah Anda ingin menghapus data kelas {{ $kelas->name }}?</b></h6>
            <p class="text-secondary">Seluruh data yang terhubung dengan data kelas akan terhapus.</p>

            <x-slot:actions>
                <button type="button" class="btn btn-soft-secondary" data-bs-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
            </x-slot:actions>
        </x-form-modal>
    @endforeach
@endsection
