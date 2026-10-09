@extends('layouts.admin')

@section('title', 'Kelola User - Admin Berkah Sari')
@section('page-title', 'Kelola User')

@section('content')

@if(session('sukses'))
<div class="alert alert-success alert-dismissible fade show py-2 px-3 mb-3" role="alert" style="font-size:0.85rem;">
    <i class="fas fa-check-circle me-2"></i>{{ session('sukses') }}
    <button type="button" class="btn-close py-2" data-bs-dismiss="alert"></button>
</div>
@endif
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show py-2 px-3 mb-3" role="alert" style="font-size:0.85rem;">
    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
    <button type="button" class="btn-close py-2" data-bs-dismiss="alert"></button>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show py-2 px-3 mb-3" style="font-size:0.85rem;">
    <ul class="mb-0">
        @foreach($errors->all() as $err)
        <li>{{ $err }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close py-2" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="section-card mb-4">
    <div class="p-3 border-bottom d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div class="d-flex align-items-center gap-2 flex-grow-1" style="max-width: 480px;">
            <form method="GET" action="{{ route('admin.kelola-user') }}" id="formFilter" class="d-flex gap-2 w-100">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white text-muted border-end-0"><i class="fas fa-search"></i></span>
                    <input type="text" name="cari" id="cariUser" class="form-control border-start-0"
                        placeholder="Cari nama atau username..."
                        value="{{ request('cari') }}">
                </div>
            </form>
        </div>

        <div class="d-flex align-items-center gap-2 flex-wrap">
            <form method="GET" action="{{ route('admin.kelola-user') }}" id="formFilterDropdown">
                @if(request('cari'))
                    <input type="hidden" name="cari" value="{{ request('cari') }}">
                @endif
                <div class="d-flex gap-2">
                    <select class="form-select form-select-sm" name="role" id="filterRole" onchange="this.form.submit()" style="width:140px;">
                        <option value="">Semua Role</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="pengurus" {{ request('role') == 'pengurus' ? 'selected' : '' }}>Pengurus</option>
                        <option value="petugas" {{ request('role') == 'petugas' ? 'selected' : '' }}>Petugas Input</option>
                    </select>
                    <select class="form-select form-select-sm" name="status" id="filterStatus" onchange="this.form.submit()" style="width:130px;">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
            </form>

            <button type="button"
                class="btn btn-sm py-1 px-3"
                data-bs-toggle="modal"
                data-bs-target="#modalTambahUser"
                style="background-color:#348E38; color:#fff; font-family:'Jost',sans-serif; font-weight:600; font-size:0.82rem; border:none;">
                <i class="fas fa-user-plus me-1"></i> Tambah User
            </button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle admin-table" id="tabelUser">
            <thead>
                <tr>
                    <th style="width:50px;">No</th>
                    <th>User</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th style="width:140px; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $i => $user)
                @php
                    $avatarStyle = match($user->role) {
                        'admin'    => 'background:#E8F5E9; color:#348E38;',
                        'pengurus' => 'background:#fef3c7; color:#b45309;',
                        default    => 'background:#dcfce7; color:#15803d;',
                    };
                    $inisial = strtoupper(substr($user->name, 0, 1));
                @endphp
                <tr>
                    <td>{{ $users->firstItem() + $i }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:32px; height:32px; border-radius:50%; {{ $avatarStyle }} font-weight:700; display:flex; align-items:center; justify-content:center; font-size:0.8rem;">
                                {{ $inisial }}
                            </div>
                            <div>
                                <div style="font-weight:600; color:var(--dark);">{{ $user->username }}</div>
                            </div>
                        </div>
                    </td>
                    <td><code>{{ $user->username ?? '-' }}</code></td>
                    <td>
                        @if($user->role == 'admin')
                            <span class="badge" style="background:#0F4229; color:#fff; font-weight:500;">Admin</span>
                        @elseif($user->role == 'pengurus')
                            <span class="badge bg-warning text-dark" style="font-weight:500;">Pengurus</span>
                        @else
                            <span class="badge bg-success" style="font-weight:500;">Petugas Input</span>
                        @endif
                    </td>
                    <td>
                        @if($user->status == 'aktif')
                            <span class="status-badge badge-selesai">Aktif</span>
                        @else
                            <span class="status-badge badge-batal">Nonaktif</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($user->role != 'admin')
                            <button type="button" class="btn btn-sm btn-light border py-1 px-2 btn-edit" title="Edit"
                                data-id="{{ $user->id }}"
                                data-username="{{ $user->username }}"
                                data-role="{{ $user->role }}"
                                data-status="{{ $user->status }}">
                                <i class="fas fa-pencil-alt text-primary"></i>
                            </button>

                            <form method="POST" action="{{ route('admin.kelola-user.toggle-status', $user) }}" style="display:inline;">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-light border py-1 px-2"
                                    title="{{ $user->status == 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}">
                                    @if($user->status == 'aktif')
                                        <i class="fas fa-toggle-on" style="color:#348E38;"></i>
                                    @else
                                        <i class="fas fa-toggle-off text-muted"></i>
                                    @endif
                                </button>
                            </form>

                            <button type="button" class="btn btn-sm btn-light border py-1 px-2 btn-hapus" title="Hapus"
                                data-id="{{ $user->id }}"
                                data-username="{{ $user->username }}">
                                <i class="fas fa-trash-alt text-danger"></i>
                            </button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">
                        <i class="fas fa-users fa-2x mb-2 d-block"></i>
                        Belum ada data user.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-3 border-top d-flex align-items-center justify-content-between flex-wrap gap-2">
        @if($users->hasPages())
            <small class="text-muted">
                Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }} data user
            </small>
        @else
            <small class="text-muted">{{ $users->total() }} data user</small>
        @endif

        <ul class="pagination pagination-sm mb-0">
            <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $users->previousPageUrl() }}">Sebelumnya</a>
            </li>
            @foreach($users->getUrlRange(1, $users->lastPage()) as $page => $url)
            <li class="page-item {{ $page == $users->currentPage() ? 'active' : '' }}">
                <a class="page-link {{ $page == $users->currentPage() ? 'bg-success border-success' : '' }}" href="{{ $url }}">{{ $page }}</a>
            </li>
            @endforeach
            <li class="page-item {{ !$users->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $users->nextPageUrl() }}">Selanjutnya</a>
            </li>
        </ul>
    </div>
</div>


<div class="modal fade" id="modalTambahUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0" style="background:transparent; box-shadow:none;">
            <div class="bg-light rounded p-4 p-sm-5 position-relative">

                <button type="button" class="btn-close position-absolute" data-bs-dismiss="modal"
                    style="top:16px; right:16px;"></button>

                <h4 style="font-family:'Jost',sans-serif; font-weight:700; color:var(--dark); margin-bottom:1.5rem;">
                    Tambah User Baru
                </h4>

                <form method="POST" action="{{ route('admin.kelola-user.store') }}">
                    @csrf
                    <div class="row g-3">

                        <div class="col-sm-6">
                            <div class="form-floating">
                                <input type="text" name="username" id="tambahUsername"
                                    class="form-control bg-white border-0"
                                    placeholder="Username"
                                    value="{{ old('username') }}" required>
                                <label for="tambahUsername">Username</label>
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="form-floating">
                                <select name="role" id="tambahRole"
                                    class="form-select bg-white border-0" required>
                                    <option value="">Pilih Role...</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="pengurus" {{ old('role') == 'pengurus' ? 'selected' : '' }}>Pengurus</option>
                                    <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' }}>Petugas Input</option>
                                </select>
                                <label for="tambahRole">Role</label>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-floating">
                                <input type="password" name="password" id="tambahPassword"
                                    class="form-control bg-white border-0"
                                    placeholder="Password" required>
                                <label for="tambahPassword">Password</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating">
                                <input type="password" name="password_confirmation" id="tambahPasswordConf"
                                    class="form-control bg-white border-0"
                                    placeholder="Konfirmasi Password" required>
                                <label for="tambahPasswordConf">Konfirmasi Password</label>
                            </div>
                        </div>

                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-primary py-3 px-4">
                                Simpan User
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalEditUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" style="font-family:'Jost',sans-serif; font-weight:600; color:var(--dark);">
                    <i class="fas fa-user-edit text-primary me-2"></i> Edit Data User
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" id="formEditUser">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Username</label>
                        <input type="text" name="username" id="editUsername" class="form-control form-control-sm" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Role</label>
                        <select name="role" id="editRole" class="form-select form-select-sm" required>
                            <option value="admin">Admin</option>
                            <option value="pengurus">Pengurus</option>
                            <option value="petugas">Petugas Input</option>
                        </select>
                    </div>
                    <div class="border-top pt-2 mt-1">
                        <small class="text-muted d-block mb-2">Kosongkan jika tidak ingin mengganti password</small>
                        <label class="form-label small fw-bold">Password Baru</label>
                        <input type="password" name="password" class="form-control form-control-sm" placeholder="Password baru">
                    </div>
                </div>
                <div class="modal-footer py-2">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm" style="background:#348E38; color:#fff;">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modalHapusUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center p-4">
                <i class="fas fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                <h6 style="font-family:'Jost',sans-serif; font-weight:600; color:var(--dark);">Hapus User?</h6>
                <p class="small text-muted mb-3">User <b id="hapusUsername"></b> akan dihapus dari sistem. Tindakan ini tidak bisa dibatalkan.</p>
                <form method="POST" id="formHapusUser">
                    @csrf @method('DELETE')
                    <div class="d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-danger px-3">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.querySelectorAll('.btn-edit').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var id = this.dataset.id;

            document.getElementById('editUsername').value = this.dataset.username;
            document.getElementById('editRole').value = this.dataset.role;

            var baseUrl = "{{ url('admin/kelola-user') }}";
            document.getElementById('formEditUser').action = baseUrl + '/' + id;

            new bootstrap.Modal(document.getElementById('modalEditUser')).show();
        });
    });

    document.querySelectorAll('.btn-hapus').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var id = this.dataset.id;
            var username = this.dataset.username;

            document.getElementById('hapusUsername').innerText = username;

            var baseUrl = "{{ url('admin/kelola-user') }}";
            document.getElementById('formHapusUser').action = baseUrl + '/' + id;

            new bootstrap.Modal(document.getElementById('modalHapusUser')).show();
        });
    });

    var timer;
    document.getElementById('cariUser').addEventListener('keyup', function() {
        clearTimeout(timer);
        var val = this.value;
        timer = setTimeout(function() {
            document.getElementById('formFilter').submit();
        }, 500);
    });

    @if($errors->any() && old('name'))
    window.addEventListener('DOMContentLoaded', function() {
        new bootstrap.Modal(document.getElementById('modalTambahUser')).show();
    });
    @endif
</script>
@endpush
