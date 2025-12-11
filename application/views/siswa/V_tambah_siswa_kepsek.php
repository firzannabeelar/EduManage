<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-blue-50 font-sans">

    <!-- Sidebar -->
    <div class="flex" id="app">
        <div class="bg-white text-gray-800 w-64 h-screen p-5 space-y-6 transition-all duration-300" id="sidebar">
            <ul class="space-y-4">
                <li><a href="<?= site_url('dashboard/dashboard_kepsek'); ?>" class="text-blue-500 flex items-center p-3 rounded-md text-2xl font-bold ml-3"><i class="fas fa-book-reader mr-3"></i>EduManage</a></li>
                <li><a href="<?= site_url('dashboard/dashboard_kepsek'); ?>" class="flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md"><i class="fas fa-home mr-3"></i>Dashboard</a></li>
                <li><a href="<?= site_url('jurnal/jurnal_kepsek'); ?>" class="flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md"><i class="fas fa-book mr-3"></i>Jurnal Kelas</a></li>
                <li><a href="<?= site_url('absensi/absensi_kepsek'); ?>" class="flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md"><i class="fas fa-calendar-check mr-3"></i>Absensi</a></li>
                <li><a href="<?= site_url('siswa/siswa_kepsek'); ?>" class="text-blue-500 flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md"><i class="fas fa-users mr-3"></i>Pengelolaan Data Siswa</a></li>
                <li><a href="<?= site_url('admin/admin_kepsek'); ?>" class="flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md"><i class="fas fa-chalkboard-teacher mr-3"></i>Pengelolaan Data Guru</a></li>
            </ul>
        </div>

        <div class="flex-1 p-8 space-y-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Tambah Siswa</h1>
            </div>

            <form action="<?= site_url('siswa/simpan_kepsek'); ?>" method="POST">
                <div class="space-y-4">
                    <!-- Input NISN -->
                    <div>
                        <label for="nisn" class="block text-gray-800 font-bold">NISN</label>
                        <input type="text" name="nisn" id="nisn" class="p-2 border rounded-md w-full" required>
                    </div>

                    <!-- Input Nama -->
                    <div>
                        <label for="nama" class="block text-gray-800 font-bold">Nama</label>
                        <input type="text" name="nama" id="nama" class="p-2 border rounded-md w-full" required>
                    </div>

                    <!-- Input Angkatan -->
                    <div>
                        <label for="angkatan" class="block text-gray-800 font-bold">Angkatan</label>
                        <input type="text" name="angkatan" id="angkatan" class="p-2 border rounded-md w-full" required>
                    </div>

                    <!-- Dropdown Kelas -->
                    <?php if (isset($kelas) && !empty($kelas)): ?>
                        <div>
                            <label for="kelas" class="block text-gray-800 font-bold">Kelas</label>
                            <select name="kelas" id="kelas" class="p-2 border rounded-md w-full" required>
                                <option value="">Pilih Kelas</option>
                                <?php foreach ($kelas as $item): ?>
                                    <option value="<?= $item->id; ?>"><?= $item->tingkat . '-' . $item->jurusan . '-' . $item->nama_kelas; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php else: ?>
                        <p>Data kelas tidak ditemukan. </p>
                    <?php endif; ?>

                    <button type="submit" class="bg-blue-500 text-white font-bold p-3 rounded-md inline-block transform transition-transform duration-300 hover:scale-110 hover:bg-gradient-to-r from-blue-500 to-indigo-500">Simpan Siswa</button>
                </div>
            </form>

        </div>
    </div>

</body>
</html>
                        