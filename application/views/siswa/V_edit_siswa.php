<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-blue-50 font-sans">

    <!-- Sidebar -->
    <div class="flex" id="app">
        <div class="bg-white text-gray-800 w-64 min-h-screen p-5 space-y-6">
            <ul class="space-y-4">
                <li><a href="<?= site_url('dashboard'); ?>" class="text-blue-500 flex items-center p-3 rounded-md text-2xl font-bold ml-3"><i class="fas fa-book-reader mr-3"></i>EduManage</a></li>
                <li><a href="<?= site_url('dashboard'); ?>" class="flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md"><i class="fas fa-home mr-3"></i>Dashboard</a></li>
                <li><a href="<?= site_url('jurnal'); ?>" class="flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md"><i class="fas fa-book mr-3"></i>Jurnal Kelas</a></li>
                <li><a href="<?= site_url('pembayaran'); ?>" class="flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md"><i class="fas fa-credit-card mr-3"></i>Pembayaran</a></li>
                <li><a href="<?= site_url('absensi'); ?>" class="flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md"><i class="fas fa-calendar-check mr-3"></i>Absensi</a></li>
                <li><a href="<?= site_url('siswa'); ?>" class="text-blue-500 flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md"><i class="fas fa-users mr-3"></i>Pengelolaan Data Siswa</a></li>
                <li><a href="<?= site_url('admin'); ?>" class="flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md"><i class="fas fa-chalkboard-teacher mr-3"></i>Pengelolaan Data Guru</a></li>
            </ul>
        </div>

        <div class="flex-1 p-8 space-y-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Edit Siswa</h1>
            </div>

            <form action="<?= site_url('siswa/update/' . $siswa->nisn); ?>" method="POST">
                <div class="space-y-4">
                    <div>
                        <label for="nisn" class="block text-gray-800 font-bold">NISN</label>
                        <input type="text" name="nisn" id="nisn" class="p-2 border rounded-md w-full" value="<?= $siswa->nisn; ?>" readonly>
                    </div>

                    <div>
                        <label for="nama" class="block text-gray-800 font-bold">Nama</label>
                        <input type="text" name="nama" id="nama" class="p-2 border rounded-md w-full" value="<?= $siswa->nama; ?>" required>
                    </div>

                    <div>
                        <label for="angkatan" class="block text-gray-800 font-bold">Angkatan</label>
                        <input type="text" name="angkatan" id="angkatan" class="p-2 border rounded-md w-full" value="<?= $siswa->angkatan; ?>" required>
                        <p id="angkatanError" class="text-red-500 text-sm mt-1 hidden">Angkatan harus terdiri dari 4 digit angka.</p>
                    </div>

                    <?php if (isset($kelas) && !empty($kelas)): ?>
                        <div>
                            <label for="kelas" class="block text-gray-800 font-bold">Kelas</label>
                            <select name="kelas_id" id="kelas" class="p-2 border rounded-md w-full" required>
                                <option value="">Pilih Kelas</option>
                                <?php foreach ($kelas as $item): ?>
                                    <option value="<?= $item->id; ?>" <?= $siswa->kelas_id == $item->id ? 'selected' : ''; ?>>
                                        <?= $item->tingkat . '-' . $item->jurusan . '-' . $item->nama_kelas; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php else: ?>
                        <p>Data kelas tidak ditemukan.</p>
                    <?php endif; ?>

                    <button type="submit" class="bg-blue-500 text-white font-bold p-3 rounded-md inline-block transform transition-transform duration-300 hover:scale-110 hover:bg-gradient-to-r from-blue-500 to-indigo-500">Simpan Perubahan</button>
                </div>
            </form>

        </div>
    </div>

    <script>
        const form = document.querySelector('form');
        const angkatanInput = document.getElementById('angkatan');
        const angkatanError = document.getElementById('angkatanError');

        form.addEventListener('submit', function(e) {
            const angkatan = angkatanInput.value.trim();
            let valid = true;

            // Validasi Angkatan (4 digit angka)
            if (!/^\d{4}$/.test(angkatan)) {
                angkatanError.classList.remove('hidden');
                angkatanInput.classList.add('border-red-500');
                valid = false;
            } else {
                angkatanError.classList.add('hidden');
                angkatanInput.classList.remove('border-red-500');
            }

            if (!valid) e.preventDefault();
        });
    </script>


</body>
</html>
