@extends('layouts.app')

{{-- [TAMBAH] Sisipkan CSS DataTables di sini --}}
@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">
    {{-- Tambah SweetAlert2 CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">User Management</div>

                {{-- ...existing code... --}}
                <div class="card-header">
                    @can('manage users')
                        <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah User</a>
                    @endcan
                </div>
                {{-- ...existing code... --}}
                {{-- Hapus alert Bootstrap lama; notifikasi akan ditangani oleh SweetAlert2 --}}
                {{-- ...existing code... --}}

                    <table class="table table-bordered table-hover" id="users-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                                {{-- Data akan diisi oleh DataTables --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>

    {{-- Tambah SweetAlert2 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <script>
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('users.data') }}',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'role', name: 'roles.name', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            // Tampilkan SweetAlert berdasarkan session flash dari server (create/edit/delete)
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: {!! json_encode(session('success')) !!},
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: {!! json_encode(session('error')) !!}
                });
            @endif

            // Konfirmasi sebelum delete
            // Tombol/href delete sebaiknya memiliki class .btn-delete dan berada di dalam form atau memiliki data-url
            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();
                var $btn = $(this);
                var $form = $btn.closest('form');
                var url = $form.attr('action') || $btn.data('url');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        if ($form.length) {
                            $form.submit();
                        } else if (url) {
                            // fallback jika tombol adalah link
                            window.location.href = url;
                        }
                    }
                });
            });
        });
    </script>
@endpush