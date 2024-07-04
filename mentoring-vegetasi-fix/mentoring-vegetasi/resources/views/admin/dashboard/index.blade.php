@extends('admin.layouts.app')

@section('background_url', '/assets/topographic-5.svg')

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
<x-card title="List User">
    {{-- <x-slot:action>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                data-bs-target="#formModal">Tambah Data</button>
                <a href="#" class="btn btn-sm btn-success">Export</a>
                <a href="#" class="btn btn-sm btn-danger">Export to PDF</a>
        </div>
    </x-slot:action> --}}

    <div class="table-responsive mt-4">
        <table class="table table-borderless table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th widht="200">User</th>
                    <th widht="200">Email</th>
                    <th>Role</th>
                    <th width="250">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($User as $user)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
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
    {{-- <x-form-modal title="Form Data Famili" id="formModal" action-route="{{ route('dashboard.famili.store') }}">
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
    </x-form-modal> --}}

    @foreach ($User as $user)
        {{-- Edit Modal --}}
        <x-form-modal title="Form Data Famili" id="formModal-{{ $loop->iteration }}"
            action-route="{{ route('admin.dashboard.update', $user->id) }}">
            @method('PUT')
            <div>
                <label for="name" class="form-label">Nama User</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" readonly>
            </div>
            <div>
                <label for="email" class="form-label">Email User</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}" readonly>
            </div>
            <div>
                <label for="role" class="form-label">Role User</label>
                <select name="role" id="role" class="form-select">
                    <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <x-slot:actions>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </x-slot:actions>
        </x-form-modal>

        {{-- Delete Modal --}}
        <x-form-modal title="Konfirmasi Penghapusan Data" id="deleteModal-{{ $loop->iteration }}"
            action-route="{{ route('admin.dashboard.delete', $user->id) }}">
            @method('DELETE')
            <h6><b>Apakah Anda ingin menghapus data user {{ $user->name }}?</b></h6>
            <p class="text-secondary">Seluruh data yang terhubung dengan data user akan terhapus.</p>

            <x-slot:actions>
                <button type="button" class="btn btn-soft-secondary" data-bs-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
            </x-slot:actions>
        </x-form-modal>
    @endforeach
@endsection


{{-- @section('modal')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
