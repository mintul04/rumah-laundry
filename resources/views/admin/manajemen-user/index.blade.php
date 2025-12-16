@extends('layouts.main')

@section('title', 'Manajemen User - RumahLaundry')
@section('page-title', 'Daftar User')


@section('content')
    <div class="card shadow">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="fas fa-cog me-2"></i>Manajemen User
            </h4>
            <a href="{{ route('manajemen-user.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Tambah User
            </a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table id="userTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Jenis Kelamin</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($manajemenUsers as $index => $manajemenUser)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $manajemenUser->nama }}</td>
                                <td>{{ $manajemenUser->username }}</td>
                                <td>{{ $manajemenUser->email ?? '-' }}</td>
                                <td>
                                    @if ($manajemenUser->level == 'admin')
                                        <span class="badge bg-danger">Admin</span>
                                    @else
                                        <span class="badge bg-primary">Karyawan</span>
                                    @endif
                                </td>
                                <td>{{ $manajemenUser->jenis_kelamin }}</td>
                                <td>
                                    @if ($manajemenUser->foto)
                                        <img src="{{ asset('storage/' . $manajemenUser->foto) }}" alt="Foto"
                                            width="50" class="rounded-circle">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($manajemenUser->nama) }}&background=random"
                                            alt="Avatar" width="50" class="rounded-circle">
                                    @endif
                                </td>
                                <td>
                                    @if ($manajemenUser->level == 'admin')
                                        <a href="{{ route('manajemen-user.edit', $manajemenUser->id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Ubah
                                        </a>
                                    @else
                                        <a href="{{ route('manajemen-user.edit', $manajemenUser->id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Ubah
                                        </a>
                                        <form action="{{ route('manajemen-user.destroy', $manajemenUser->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Hapus user ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
