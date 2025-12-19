@extends('layouts.main')

@section('page-title', 'Profil Saya')

@section('content')
<div class="admin-content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Profil Saya</h3>
        </div>
        <div class="card-body">
            
            <!-- Form Update Profile -->
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <!-- Avatar Section -->
                    <div class="col-md-3 text-center">
                        <div class="mb-3">
                            <div class="avatar-display mb-3" style="width: 120px; height: 120px; border-radius: 50%; background: #007bff; color: white; display: flex; align-items: center; justify-content: center; font-size: 36px; font-weight: bold; margin: 0 auto;">
                                {{ strtoupper(substr(auth()->user()->nama, 0, 2)) }}
                            </div>
                            <div class="form-group">
                                <label for="avatar" class="form-label">Ganti Foto Profil</label>
                                <input type="file" name="avatar" id="avatar" class="form-control" accept="image/*">
                                <small class="text-muted">Max: 2MB (JPG, PNG, GIF)</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Form Fields -->
                    <div class="col-md-9">
                        <div class="form-group mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" class="form-control" 
                                   value="{{ old('nama', auth()->user()->nama) }}" required>
                            @error('nama')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" 
                                   value="{{ old('email', auth()->user()->email) }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input type="text" name="phone" id="phone" class="form-control" 
                                   value="{{ old('phone', auth()->user()->phone) }}">
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
            
            <hr class="my-4">
            
            <!-- Change Password Form -->
            <h5 class="mb-3">Ubah Password</h5>
            <form action="{{ route('admin.profile.password') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="current_password" class="form-label">Password Saat Ini</label>
                            <input type="password" name="current_password" id="current_password" 
                                   class="form-control" required>
                            @error('current_password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="new_password" class="form-label">Password Baru</label>
                            <input type="password" name="new_password" id="new_password" 
                                   class="form-control" required>
                            @error('new_password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" 
                                   id="new_password_confirmation" class="form-control" required>
                        </div>
                        
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-key"></i> Ubah Password
                        </button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection