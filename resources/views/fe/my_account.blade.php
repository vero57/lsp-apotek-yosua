<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Akun</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fe/css/myaccount.css') }}">
</head>
<body>

    @php
        // Ambil data pelanggan dari database berdasarkan session user_id
        $pelanggan = \App\Models\Pelanggan::find(session('user_id'));
    @endphp

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="profile-card">
                    <div class="profile-header">
                        <h2>Profil Akun</h2>
                    </div>
                    <form id="formEditProfil" action="{{ route('fe.my_account.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-picture-container">
                            <img id="fotoProfil"
                                src="{{ $pelanggan && $pelanggan->foto ? asset('storage/' . $pelanggan->foto) : 'https://placehold.co/150x150/007bff/FFFFFF?text=Foto' }}"
                                alt="Foto Profil"
                                class="profile-picture"
                                onerror="this.src='https://placehold.co/150x150/ced4da/6c757d?text=Error'; this.classList.add('profile-picture-placeholder-icon'); this.alt='Gagal memuat gambar';">
                        </div>
                        <div class="text-center mb-3">
                            <label for="fotoUpload" class="upload-button-label rounded-md">
                                <i class="fas fa-camera"></i> Ganti Foto
                            </label>
                            <input type="file" id="fotoUpload" name="foto" accept="image/*">
                        </div>
                        <div class="info-section">
                            <h5>Informasi Dasar</h5>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label info-label">ID Pelanggan:</label>
                                <div class="col-sm-8">
                                    <p class="form-control-plaintext info-value">
                                        {{ $pelanggan ? 'ID' . $pelanggan->id : '-' }}
                                    </p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label info-label">Nama Pelanggan:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nama_pelanggan" class="form-control info-value" value="{{ $pelanggan->nama_pelanggan ?? '' }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label info-label">Email:</label>
                                <div class="col-sm-8">
                                    <input type="email" name="email" class="form-control info-value" value="{{ $pelanggan->email ?? '' }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label info-label">Kata Sandi:</label>
                                <div class="col-sm-8">
                                    <input type="password" name="katakunci" class="form-control info-value" placeholder="Isi untuk mengganti password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label info-label">No. Telepon:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="no_telp" class="form-control info-value" value="{{ $pelanggan->no_telp ?? '' }}">
                                </div>
                            </div>
                            <h5 class="mt-4">Alamat Pengiriman Utama</h5>
                            <div class="address-block rounded-lg p-4">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label info-label">Alamat 1:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="alamat1" class="form-control info-value" value="{{ $pelanggan->alamat1 ?? '' }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label info-label">Kota 1:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="kota1" class="form-control info-value" value="{{ $pelanggan->kota1 ?? '' }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label info-label">Provinsi 1:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="propinsi1" class="form-control info-value" value="{{ $pelanggan->propinsi1 ?? '' }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label info-label">Kode Pos 1:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="kodepos1" class="form-control info-value" value="{{ $pelanggan->kodepos1 ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <h5 class="mt-4">Alamat Pengiriman Alternatif 1</h5>
                            <div class="address-block rounded-lg p-4">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label info-label">Alamat 2:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="alamat2" class="form-control info-value" value="{{ $pelanggan->alamat2 ?? '' }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label info-label">Kota 2:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="kota2" class="form-control info-value" value="{{ $pelanggan->kota2 ?? '' }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label info-label">Provinsi 2:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="propinsi2" class="form-control info-value" value="{{ $pelanggan->propinsi2 ?? '' }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label info-label">Kode Pos 2:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="kodepos2" class="form-control info-value" value="{{ $pelanggan->kodepos2 ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <h5 class="mt-4">Alamat Pengiriman Alternatif 2</h5>
                            <div class="address-block rounded-lg p-4">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label info-label">Alamat 3:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="alamat3" class="form-control info-value" value="{{ $pelanggan->alamat3 ?? '' }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label info-label">Kota 3:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="kota3" class="form-control info-value" value="{{ $pelanggan->kota3 ?? '' }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label info-label">Provinsi 3:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="propinsi3" class="form-control info-value" value="{{ $pelanggan->propinsi3 ?? '' }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label info-label">Kode Pos 3:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="kodepos3" class="form-control info-value" value="{{ $pelanggan->kodepos3 ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-5 mb-3">
                                <button type="submit" class="btn btn-primary btn-lg rounded-md shadow-md">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                                <a href="{{ route('fe.index') }}" class="btn btn-secondary btn-lg rounded-md shadow-md" style="vertical-align:middle;">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-lg rounded-md shadow-md" style="vertical-align:middle;">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        // Preview foto sebelum submit
        document.getElementById('fotoUpload').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('fotoProfil').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('fe/js/myaccount.js') }}"></script>



</body>
