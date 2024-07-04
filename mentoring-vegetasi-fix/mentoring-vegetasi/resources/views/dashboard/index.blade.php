@extends('layouts.app')

@section('background_url', '/assets/topographic-5.svg')

@section('content')
    <div class="card shadow-sm py-4 px-3">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h5 class="card-title fw-semibold">List asdjkh</h5>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">Tambah</button>
            </div>

            <div class="table-responsive mt-4">
                <table class="table table-borderless table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>asdsadas</th>
                            <th>asdasdasdas</th>
                            <th>alhdjk</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Lorem, ipsum dolor.</td>
                            <td>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugiat quae debitis necessitatibus
                                dolor natus culpa ratione itaque labore facere eum.</td>
                            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium, natus?</td>
                            <td>
                                <div class="d-flex flex-nowrap gap-2">
                                    <a href="#" class="btn btn-sm btn-soft-warning">Ubah</a>
                                    <button class="btn btn-sm btn-soft-danger">Hapus</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Lorem, ipsum dolor.</td>
                            <td>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugiat quae debitis necessitatibus
                                dolor natus culpa ratione itaque labore facere eum.</td>
                            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium, natus?</td>
                            <td>
                                <div class="d-flex flex-nowrap gap-2">
                                    <a href="#" class="btn btn-sm btn-soft-info">Detail</a>
                                    <a href="#" class="btn btn-sm btn-soft-warning">Ubah</a>
                                    <button class="btn btn-sm btn-soft-danger">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('modal')
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
@endsection
