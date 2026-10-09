@extends('layouts.admin')

@section('title', 'Akun Saya - Admin')

@section('content')
<div class="container-fluid py-2">
    
    <div class="mb-4">
        <h4 style="font-family:'Jost', sans-serif; font-weight:600; color:var(--dark);">Akun Saya</h4>
        <p class="text-muted small">Kelola informasi profil dan keamanan akun kamu di sini.</p>
    </div>

    <ul class="nav nav-tabs border-bottom-0 mb-4" style="gap: 15px;">
        <li class="nav-item">
            <a class="nav-link active" href="#" style="border:none; border-bottom: 2px solid var(--primary); color:var(--primary); font-weight:600; padding: 8px 4px; background:transparent;">Profil Detail</a>
        </li>
    </ul>

    <div class="card border-0 shadow-sm" style="border-radius:12px;">
        <div class="card-body p-0">
            
            <form action="{{ route('admin.kelola-user.update', auth()->user()->id) }}" method="POST" class="p-4 p-md-5">
                @csrf
                @method('PUT')
                
                <input type="hidden" name="role" value="{{ auth()->user()->role }}">
                
                @if(session('sukses'))
                    <div class="alert alert-success py-2">{{ session('sukses') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger py-2">
                        <ul class="mb-0">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="mb-5 pb-4 border-bottom">
                    <div class="mb-4">
                        <h6 style="font-weight:600; color:var(--dark);">Foto Profil</h6>
                        <p class="text-muted small mb-0" style="font-size:0.8rem;">Ini akan ditampilkan di profil kamu.</p>
                    </div>
                    
                    <div class="d-flex flex-column flex-sm-row align-items-center gap-4">
                        <div style="width:80px; height:80px; border-radius:50%; background:#E8F5E9; color:#348E38; font-weight:bold; font-size:2rem; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            {{ strtoupper(substr(auth()->user()->name ?? auth()->user()->username, 0, 1)) }}
                        </div>
                        
                        <div class="w-100 p-4 text-center" style="border-radius:12px; border: 1px dashed #c0d4c1; cursor:pointer;" onclick="alert('pura puranya ini file manager upload')">
                            <div style="width:40px; height:40px; border-radius:50%; background:#f5f8f5; color:var(--primary); display:flex; align-items:center; justify-content:center; margin:0 auto 10px;">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <p class="mb-1 small"><span style="color:var(--primary); font-weight:600;">Klik untuk upload</span> atau drag and drop kesini</p>
                            <p class="text-muted mb-0" style="font-size:0.75rem;">SVG, PNG, JPG (maksimal 800x400px)</p>
                        </div>
                    </div>
                </div>

                <div class="mb-5 pb-4 border-bottom">
                    <div class="mb-4">
                        <h6 style="font-weight:600; color:var(--dark);">Info Personal</h6>
                        <p class="text-muted small mb-0" style="font-size:0.8rem;">Perbarui detail informasi dasar kamu.</p>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small">Username</label>
                            <input type="text" name="username" class="form-control" value="{{ auth()->user()->username }}" style="border-radius:8px;" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small">Role Akun</label>
                            <input type="text" class="form-control" value="{{ ucfirst(auth()->user()->role) }}" style="border-radius:8px; background-color:#f9f9f9;" disabled>
                        </div>
                    </div>
                </div>
                
                <div class="mb-5 pb-2">
                    <div class="mb-4">
                        <h6 style="font-weight:600; color:var(--dark);">Keamanan</h6>
                        <p class="text-muted small mb-0" style="font-size:0.8rem;">Ganti password lama kamu dengan yang baru biar makin aman.</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted small">Password Baru</label>
                        <input type="password" name="password" class="form-control" placeholder="Kosongin aja kalo ga mau ganti" style="border-radius:8px;">
                        <small class="text-muted" style="font-size:0.75rem;">Pastiin pake password yang gampang diinget.</small>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end gap-3 pt-4 border-top">
                    <button type="button" class="btn btn-light px-4 border" style="border-radius:8px; font-weight:500;" onclick="window.history.back()">Batal</button>
                    <button type="submit" class="btn btn-primary px-4" style="border-radius:8px; background-color:#348E38; border:none; font-weight:500;">Simpan Perubahan</button>
                </div>
                
            </form>
            
        </div>
    </div>
    
</div>
@endsection
