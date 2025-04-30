<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <thead class="thead-light">
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Jenis</th>
                <th>Deskripsi Jenis</th>
                <th>Image</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jenisObat as $jenis)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $jenis->id }}</td>
                <td>{{ $jenis->jenis }}</td>
                <td>{{ $jenis->deskripsi_jenis }}</td>
                <td>
                    @if($jenis->image_url)
                        <img src="{{ asset('storage/' . $jenis->image_url) }}" alt="image" width="40">
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td>{{ $jenis->created_at }}</td>
                <td>{{ $jenis->updated_at }}</td>
                <td>
                    <a href="#" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('be.admin.products.destroyjenis', $jenis->id) }}" method="POST" class="d-inline delete-jenis-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-danger btn-delete-jenis">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">Belum ada jenis obat.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-delete-jenis').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Hapus Jenis Obat?',
                text: 'Apakah anda yakin ingin menghapus jenis obat ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Tidak',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    btn.closest('form').submit();
                }
            });
        });
    });
});
</script>
@if(session('success_jenis'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success_jenis') }}',
        showConfirmButton: false,
        timer: 1800
    });
</script>
@endif
