<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
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

        <div class="flex-1 p-8 space-y-6 transition-all duration-300" id="content">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Data Siswa</h1>
                <a href="<?= site_url('siswa/tambah_kepsek'); ?>" class="bg-blue-500 font-bold text-white p-3 rounded-md inline-block transform transition-transform duration-300 hover:scale-110 hover:bg-gradient-to-r from-blue-500 to-indigo-500">
                    <i class="fas fa-plus mr-2 "></i>Tambah Siswa
                </a>
            </div>

            <!-- Search and Filter -->
            <div class="flex space-x-4 mb-6">
                <form action="<?= site_url('siswa'); ?>" method="GET" class="flex space-x-2">
                    <input type="text" name="search" placeholder="Nama Siswa" class="p-2 border rounded-md" value="<?= isset($search) ? $search : ''; ?>">
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded-md inline-block transform transition-transform duration-300 hover:scale-110 hover:bg-gradient-to-r from-blue-500 to-indigo-500">
                        <i class="fas fa-search"></i>
                    </button>
                </form>

                <form action="<?= site_url('siswa'); ?>" method="GET" class="flex space-x-2">
                    <select name="filter" class="p-2 border rounded-md">
                        <option value="">Filter Jurusan</option>
                        <option value="MIPA" <?= isset($filter) && $filter == 'MIPA' ? 'selected' : ''; ?>>MIPA</option>
                        <option value="IPS" <?= isset($filter) && $filter == 'IPS' ? 'selected' : ''; ?>>IPS</option>
                    </select>
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded-md inline-block transform transition-transform duration-300 hover:scale-110 hover:bg-gradient-to-r from-blue-500 to-indigo-500">
                        <i class="fas fa-filter"></i>
                    </button>
                </form>
            </div>

            <!-- Table -->
            <div class="bg-white to-indigo-400 shadow-md rounded-lg overflow-x-auto">
                <table class="table-auto w-full border-collapse">
                    <thead class="bg-gradient-to-r from-blue-500 to-indigo-400 text-white">
                        <tr>
                            <th class="p-4 border-b text-left">No</th>
                            <th class="p-4 border-b text-left">NISN</th>
                            <th class="p-4 border-b text-left">Nama</th>
                            <th class="p-4 border-b text-left">Angkatan</th>
                            <th class="p-4 border-b text-left">Jurusan</th>
                            <th class="p-4 border-b text-left">Kelas</th>
                            <th class="p-4 border-b text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($siswa as $s): ?>
                            <tr class="hover:bg-gradient-to-r from-blue-200 to-indigo-200">
                                <td class="py-2 px-4"><?= $no++; ?></td>
                                <td class="py-2 px-4"><?= $s->nisn; ?></td>
                                <td class="py-2 px-4"><?= $s->nama; ?></td>
                                <td class="py-2 px-4"><?= $s->angkatan; ?></td>
                                <td class="py-2 px-4"><?= $s->jurusan; ?></td>
                                <td class="py-2 px-4"><?= $s->tingkat . '-' . $s->jurusan . '-' . $s->nama_kelas; ?></td>
                                <td class="py-2 px-4">
                                    <a href="<?= site_url('siswa/edit_kepsek/'.$s->nisn); ?>" class="text-blue-500 font-bold inline-block transform transition-transform duration-300 hover:scale-110">Edit</a> |
                                    <a href="<?= site_url('siswa/hapus_kepsek/'.$s->nisn); ?>" class="text-red-500 font-bold inline-block transform transition-transform duration-300 hover:scale-110">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>
</html>
