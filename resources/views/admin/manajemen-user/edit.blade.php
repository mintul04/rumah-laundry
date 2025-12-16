@extends('layouts.main')

@section('title', 'Edit User')

@section('content')
<div class="card shadow">
    <div class="card-header bg-white">
        <h4 class="mb-0">
            <i class="fas fa-user-edit me-2"></i>Edit User: {{ $manajemenUser->nama }}
        </h4>
    </div>
    <div class="card-body">
        <form action="{{ route('manajemen-user.update', $manajemenUser->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Form sama dengan create, tapi dengan value $user -->
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap *</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                               id="nama" name="nama" value="{{ old('nama', $manajemenUser->nama) }}" required>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username *</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" 
                               id="username" name="username" value="{{ old('username', $manajemenUser->username) }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email', $manajemenUser->email) }}">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password (Kosongkan jika tidak diubah)</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="level" class="form-label">Level *</label>
                        <select class="form-select @error('level') is-invalid @enderror" 
                                id="level" name="level" required>
                            <option value="admin" {{ old('level', $manajemenUser->level) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="karyawan" {{ old('level', $manajemenUser->level) == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin *</label>
                        <select class="form-select @error('jenis_kelamin') is-invalid @enderror" 
                                id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="Laki-laki" {{ old('jenis_kelamin', $manajemenUser->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $manajemenUser->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto Profil</label>
                @if($manajemenUser->foto)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $manajemenUser->foto) }}" 
                             alt="Foto saat ini" width="100" class="rounded-circle">
                    </div>
                @endif
                <input type="file" class="form-control @error('foto') is-invalid @enderror" 
                       id="foto" name="foto" accept="image/*">
                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('manajemen-user.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Update User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection