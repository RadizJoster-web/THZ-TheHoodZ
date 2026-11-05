@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold text-white mb-1">Manajemen Pengguna & Role</h4>
        <span class="text-muted small">Kelola seluruh akun terdaftar beserta otorisasi hak akses (Admin & Customer).</span>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn btn-sm text-black fw-bold px-3 py-2" style="background-color: #D4FF00; border-radius: 8px;">
        <i class="bi bi-person-plus-fill me-1"></i> Tambah Pengguna
    </a>
</div>

<div class="card card-admin p-4">
    <div class="table-responsive">
        <table class="table table-admin align-middle mb-0" id="usersTable">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Nama Pengguna</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Hak Akses (Role)</th>
                    <th>Bergabung</th>
                    <th class="text-end" style="width: 110px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $idx => $user)
                    <tr>
                        <td>{{ $idx + 1 }}</td>
                        <td class="text-white fw-semibold">
                            {{ $user->name ?: '-' }}
                            @if(auth()->id() === $user->id)
                                <span class="badge bg-secondary ms-1" style="font-size: 0.65rem;">Anda</span>
                            @endif
                        </td>
                        <td class="font-monospace text-emerald">{{ $user->username }}</td>
                        <td class="text-muted">{{ $user->email }}</td>
                        <td>
                            <span class="badge rounded-pill {{ $user->role === 'admin' ? 'bg-danger-subtle text-rose border border-danger-subtle' : 'bg-primary-subtle text-primary border border-primary-subtle' }}">
                                {{ strtoupper($user->role) }}
                            </span>
                        </td>
                        <td class="text-muted small">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-secondary text-white py-1 px-2 rounded-2" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            @if(auth()->id() !== $user->id)
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus akun ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger py-1 px-2 rounded-2" title="Hapus">
                                        <i class="bi bi-trash"></i>
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
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
            language: { search: "Cari Akun:", lengthMenu: "Tampil _MENU_ data" }
        });
    });
</script>
@endpush
