<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurnal Kelas</title>
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
                <li><a href="<?= site_url('jurnal/jurnal_kepsek'); ?>" class="text-blue-500 flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md"><i class="fas fa-book mr-3"></i>Jurnal Kelas</a></li>
                <li><a href="<?= site_url('absensi/absensi_kepsek'); ?>" class="flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md"><i class="fas fa-calendar-check mr-3"></i>Absensi</a></li>
                <li><a href="<?= site_url('siswa/siswa_kepsek'); ?>" class="flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md"><i class="fas fa-users mr-3"></i>Pengelolaan Data Siswa</a></li>
                <li><a href="<?= site_url('admin/admin_kepsek'); ?>" class="flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md"><i class="fas fa-chalkboard-teacher mr-3"></i>Pengelolaan Data Guru</a></li>
            </ul>
        </div>

        <div class="flex-1 p-8 space-y-6 transition-all duration-300" id="content">
            <div class="">
                <h1 class="text-3xl font-bold text-gray-800">Kelas</h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php foreach ($kelas as $k): ?>
                <a href="<?= site_url('jurnal/detail_kepsek/' . $k->id); ?>" 
                class="bg-gradient-to-r from-indigo-600 to-blue-500 shadow-md rounded-lg p-10 text-center text-white transform transition-transform duration-300 hover:scale-105 cursor-pointer">
                    <div class="text-3xl font-bold">
                        <?= $k->tingkat . '-' . $k->jurusan . '-' . $k->nama_kelas; ?>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>

            <div class="grid grid-cols-1 mt-6">
                <form action="<?= site_url('jurnal/tambah_kelas_kepsek'); ?>" method="POST" class="bg-gradient-to-r from-blue-600 to-blue-500 shadow-md rounded-lg p-6 text-center text-white transform transition-transform duration-300 hover:scale-105 hover:bg-violet-600 cursor-pointer">
                    <div class="text-xl font-semibold">Tambah Kelas</div>
                    <div class="mt-4">
                        <input type="text" name="nama_kelas" placeholder="Nama Kelas" class="p-2 rounded-md text-black w-full mb-2" required>
                        <select name="jurusan" class="p-2 rounded-md text-black w-full mb-2" required>
                            <option value="MIPA">MIPA</option>
                            <option value="IPS">IPS</option>
                        </select>
                        <select name="tingkat" class="p-2 rounded-md text-black w-full mb-2" required>
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                        </select>
                        <button type="submit" class="mt-2 bg-white text-blue-500 px-4 py-2 rounded-md hover:bg-gradient-to-r from-blue-500 to-violet-500 hover:text-white transition-colors duration-300 font-bold">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</body>
</html>
