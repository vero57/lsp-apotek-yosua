
        // Data contoh (dalam aplikasi nyata, ini akan diambil dari server)
        // const userData = {
        //     id: "ID00789",
        //     nama_pelanggan: "Jane Marcopolo",
        //     email: "jane.marcopolo@email.com",
        //     no_telp: "089876543210",
        //     alamat1: "Jl. Cendrawasih No. 45",
        //     kota1: "Yogyakarta",
        //     propinsi1: "DI Yogyakarta",
        //     kodepos1: "55281",
        //     alamat2: "Perumahan Griya Indah Blok C2/10",
        //     kota2: "Semarang",
        //     propinsi2: "Jawa Tengah",
        //     kodepos2: "50132",
        //     alamat3: "", // Contoh alamat kosong
        //     kota3: "",
        //     propinsi3: "",
        //     kodepos3: "",
        //     foto: "https://placehold.co/150x150/28a745/FFFFFF?text=JP" // URL foto profil contoh
        // };

        // Fungsi untuk mengisi data ke halaman
        function populateProfileData(data) {
            document.getElementById('idPelanggan').textContent = data.id || 'Tidak ada data';
            document.getElementById('namaPelanggan').textContent = data.nama_pelanggan || 'Tidak ada data';
            document.getElementById('email').textContent = data.email || 'Tidak ada data';
            document.getElementById('noTelp').textContent = data.no_telp || 'Tidak ada data';
            // Kata sandi biasanya tidak ditampilkan atau diubah langsung di sini
            document.getElementById('katakunci').textContent = '••••••••';

            document.getElementById('alamat1').textContent = data.alamat1 || 'Tidak ada data';
            document.getElementById('kota1').textContent = data.kota1 || 'Tidak ada data';
            document.getElementById('propinsi1').textContent = data.propinsi1 || 'Tidak ada data';
            document.getElementById('kodepos1').textContent = data.kodepos1 || 'Tidak ada data';

            document.getElementById('alamat2').textContent = data.alamat2 || 'Tidak ada data';
            document.getElementById('kota2').textContent = data.kota2 || 'Tidak ada data';
            document.getElementById('propinsi2').textContent = data.propinsi2 || 'Tidak ada data';
            document.getElementById('kodepos2').textContent = data.kodepos2 || 'Tidak ada data';

            document.getElementById('alamat3').textContent = data.alamat3 || 'Tidak ada data';
            document.getElementById('kota3').textContent = data.kota3 || 'Tidak ada data';
            document.getElementById('propinsi3').textContent = data.propinsi3 || 'Tidak ada data';
            document.getElementById('kodepos3').textContent = data.kodepos3 || 'Tidak ada data';

            const fotoProfilElement = document.getElementById('fotoProfil');
            // const fotoPlaceholderIcon = document.getElementById('fotoPlaceholderIcon');

            if (data.foto) {
                fotoProfilElement.src = data.foto;
                fotoProfilElement.style.display = 'block';
                // fotoPlaceholderIcon.style.display = 'none';
            } else {
                // Jika tidak ada foto, gunakan placeholder default atau ikon
                fotoProfilElement.src = 'https://placehold.co/150x150/ced4da/6c757d?text=Foto';
                // fotoProfilElement.style.display = 'none';
                // fotoPlaceholderIcon.style.display = 'block';
            }
        }

        // Fungsi untuk mengganti elemen <p> menjadi <input> untuk mode edit
        function enableEditMode() {
            const fieldsToEdit = [
                'namaPelanggan', 'email', 'noTelp',
                'alamat1', 'kota1', 'propinsi1', 'kodepos1',
                'alamat2', 'kota2', 'propinsi2', 'kodepos2',
                'alamat3', 'kota3', 'propinsi3', 'kodepos3'
            ];

            fieldsToEdit.forEach(id => {
                const pElement = document.getElementById(id);
                if (pElement) {
                    const currentValue = pElement.textContent;
                    const inputElement = document.createElement('input');
                    inputElement.type = 'text';
                    inputElement.className = 'form-control'; // Kelas Bootstrap untuk input
                    inputElement.value = currentValue === 'Tidak ada data' ? '' : currentValue;
                    inputElement.id = `input-${id}`; // Beri ID unik untuk input
                    pElement.parentNode.replaceChild(inputElement, pElement);
                }
            });

            // Khusus untuk email, bisa gunakan type="email"
            const emailInput = document.getElementById('input-email');
            if(emailInput) emailInput.type = 'email';

            // Khusus untuk noTelp, bisa gunakan type="tel"
            const telInput = document.getElementById('input-noTelp');
            if(telInput) telInput.type = 'tel';


            document.getElementById('editButton').style.display = 'none';
            document.getElementById('saveButton').style.display = 'inline-block';
        }

        // Fungsi untuk mengambil data dari <input> dan kembali ke mode tampilan
        function saveChangesAndDisableEditMode() {
            const updatedData = {
                id: userData.id, // ID biasanya tidak diubah
                foto: document.getElementById('fotoProfil').src // Ambil URL foto saat ini
            };

            const fieldsToSave = [
                'namaPelanggan', 'email', 'noTelp',
                'alamat1', 'kota1', 'propinsi1', 'kodepos1',
                'alamat2', 'kota2', 'propinsi2', 'kodepos2',
                'alamat3', 'kota3', 'propinsi3', 'kodepos3'
            ];

            fieldsToSave.forEach(id => {
                const inputElement = document.getElementById(`input-${id}`);
                if (inputElement) {
                    const newValue = inputElement.value;
                    updatedData[id.replace('input-', '')] = newValue; // Simpan data yang diperbarui

                    const pElement = document.createElement('p');
                    pElement.id = id.replace('input-', '');
                    pElement.className = 'form-control-plaintext info-value';
                    pElement.textContent = newValue || 'Tidak ada data';
                    inputElement.parentNode.replaceChild(pElement, inputElement);
                }
            });

            // Di sini Anda akan mengirim `updatedData` ke server
            console.log("Data yang akan disimpan:", updatedData);
            // Untuk demo, kita perbarui objek userData lokal dan muat ulang
            Object.assign(userData, updatedData); // Perbarui data lokal
            // populateProfileData(userData); // Tidak perlu populate lagi karena sudah diganti manual

            document.getElementById('editButton').style.display = 'inline-block';
            document.getElementById('saveButton').style.display = 'none';

            alert("Perubahan telah disimpan (simulasi)!");
        }

        // Event listener untuk tombol edit
        document.getElementById('editButton').addEventListener('click', enableEditMode);

        // Event listener untuk tombol simpan
        document.getElementById('saveButton').addEventListener('click', saveChangesAndDisableEditMode);

        // Event listener untuk upload foto
        document.getElementById('fotoUpload').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('fotoProfil').src = e.target.result;
                    // Jika menggunakan objek userData, perbarui juga di sana
                    userData.foto = e.target.result;
                    // Di sini Anda juga bisa menambahkan logika untuk mengunggah file ke server
                    console.log("Foto profil baru dipilih, URL sementara:", e.target.result);
                }
                reader.readAsDataURL(file);
            }
        });


        // Panggil fungsi untuk mengisi data saat halaman dimuat
        window.onload = function() {
            populateProfileData(userData);
        };