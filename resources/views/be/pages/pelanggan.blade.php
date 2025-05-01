@extends('be.layouts.app')

@section('content')
<div class="page-content" style="padding: 24px;">
    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1800
            });
        </script>
    @endif
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h5 mb-0">Pelanggan List</h2>
        <form method="GET" action="" class="form-inline" style="max-width: 300px;">
            <div class="input-group w-100">
                <input type="text" name="search" class="form-control" placeholder="Cari pelanggan..." value="{{ request('search') }}">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover mb-0">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>No Telp</th>
                    <th>Alamat 1</th>
                    <th>Kota 1</th>
                    <th>Propinsi 1</th>
                    <th>Kodepos 1</th>
                    <th>Alamat 2</th>
                    <th>Kota 2</th>
                    <th>Propinsi 2</th>
                    <th>Kodepos 2</th>
                    <th>Alamat 3</th>
                    <th>Kota 3</th>
                    <th>Propinsi 3</th>
                    <th>Kodepos 3</th>
                    <th>Foto</th>
                    <th>URL KTP</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pelanggan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_pelanggan }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->katakunci }}</td>
                    <td>{{ $item->no_telp }}</td>
                    <td>{{ $item->alamat1 }}</td>
                    <td>{{ $item->kota1 }}</td>
                    <td>{{ $item->propinsi1 }}</td>
                    <td>{{ $item->kodepos1 }}</td>
                    <td>{{ $item->alamat2 }}</td>
                    <td>{{ $item->kota2 }}</td>
                    <td>{{ $item->propinsi2 }}</td>
                    <td>{{ $item->kodepos2 }}</td>
                    <td>{{ $item->alamat3 }}</td>
                    <td>{{ $item->kota3 }}</td>
                    <td>{{ $item->propinsi3 }}</td>
                    <td>{{ $item->kodepos3 }}</td>
                    <td>
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="foto" width="40">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        @if($item->url_ktp)
                            <a href="{{ asset('storage/' . $item->url_ktp) }}" target="_blank">Lihat KTP</a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="21" class="text-center">Belum ada pelanggan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
