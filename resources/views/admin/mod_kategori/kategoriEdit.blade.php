@extends('admin.layouts.app')

@section('title', 'Edit Kategori Berita')

@section('content')
    <div class="container-fluid px-4">
        <div class="card my-4">
            <div class="card-header bg-gradient-success text-white">
                <h6 class="text-capitalize mb-0">Edit Kategori Berita</h6>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <form action="{{ route('update.kategoriBerita', $kategori->id_kategori) }}" method="POST">
                    @csrf

                    <table class="table table-condensed table-bordered">
                        <tbody>
                            <tr>
                                <th style="font-weight: bold; color: black;">Nama Kategori</th>
                                <td>
                                    <input type="text" name="nama_kategori" class="form-control"
                                        value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
                                </td>
                            </tr>

                            <tr>
                                <th style="font-weight: bold; color: black;">Status Aktif</th>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="aktif" id="aktif_y"
                                            value="Y" {{ $kategori->aktif == 'Y' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="aktif_y">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="aktif" id="aktif_n"
                                            value="N" {{ $kategori->aktif == 'N' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="aktif_n">Tidak</label>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th style="font-weight: bold; color: black;">Tampilkan di Sidebar</th>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sidebar" id="sidebar_1"
                                            value="1" {{ $kategori->sidebar == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sidebar_1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sidebar" id="sidebar_0"
                                            value="0" {{ $kategori->sidebar == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sidebar_0">Tidak</label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <button type="submit" name="submit" class="btn btn-info">Update</button> <a
                        href="{{ route('kategoriberita') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
