<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kelas - <?= $kelas->tingkat . '-' . $kelas->jurusan . '-' . $kelas->nama_kelas; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-blue-50 font-sans">

    <!-- Sidebar -->
    <div class="flex" id="app">
        <div class="bg-white text-gray-800 w-64 min-h-screen p-5 space-y-6 transition-all duration-300" id="sidebar">
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
            <h1 class="text-3xl font-bold text-gray-800 mb-4">
                Detail Kelas: <?= $kelas->tingkat . '-' . $kelas->jurusan . '-' . $kelas->nama_kelas; ?>
            </h1>
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Daftar Mata Pelajaran</h1>
                <a href="<?= site_url('jurnal/hapus_kepsek/' . $kelas->id); ?>" 
                class="bg-red-500 font-bold text-white p-3 rounded-md inline-block transform transition-transform duration-300 hover:scale-110 hover:bg-gradient-to-r from-red-500 to-pink-600"
                onclick="return confirm('Apakah Anda yakin ingin menghapus kelas ini?');">
                    <i class="fas fa-trash mr-2"></i>Hapus Kelas
                </a>
            </div>

            <form method="POST" action="<?= site_url('jurnal/tambah_mata_pelajaran/' . $kelas->id); ?>">
                <label for="id_mata_pelajaran">Tambah Mata Pelajaran:</label>
                <select name="id_mata_pelajaran" id="id_mata_pelajaran" class="border rounded p-2">
                    <?php foreach ($all_mata_pelajaran as $mp): ?>
                        <!-- Pastikan mata pelajaran belum ada di kelas ini -->
                        <?php if (!in_array($mp->id_mata_pelajaran, array_column($mata_pelajaran, 'id_mata_pelajaran'))): ?>
                            <option value="<?= $mp->id_mata_pelajaran; ?>"><?= $mp->nama_mata_pelajaran; ?> </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="bg-blue-500 text-white p-2 rounded-md inline-block transform transition-transform duration-300 hover:scale-110 hover:bg-gradient-to-r from-blue-500 to-indigo-500">
                    <i class="fas fa-add"></i>
                </button>
            </form>

            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <table class="min-w-full table-auto border-collapse">
                    <thead class="bg-gradient-to-r from-blue-500 to-indigo-400 text-white">
                        <tr>
                            <th class="py-3 px-6 text-left">No</th>
                            <th class="py-3 px-6 text-left">Nama Mata Pelajaran</th>
                            <th class="py-3 px-6 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($mata_pelajaran as $mp): ?>
                            <tr class="hover:bg-gradient-to-r from-blue-200 to-indigo-200">
                                <td class="py-2 px-6"><?= $no++; ?></td>
                                <td class="py-2 px-6"><?= $mp->nama_mata_pelajaran; ?></td>
                                <td class="py-2 px-6">
                                    <a href="<?= site_url('jurnal/hapus_mata_pelajaran/' . $kelas->id . '/' . $mp->id_mata_pelajaran); ?>" class="text-red-500 font-bold inline-block transform transition-transform duration-300 hover:scale-110" onclick="return confirm('Yakin ingin menghapus mata pelajaran ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Daftar Siswa</h1>
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <table class="min-w-full table-auto border-collapse">
                    <thead class="bg-gradient-to-r from-blue-500 to-indigo-400 text-white">
                        <tr>
                            <th class="py-3 px-6 text-left">No</th>
                            <th class="py-3 px-6 text-left">NISN</th>
                            <th class="py-3 px-6 text-left">Nama Siswa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($siswa as $s): ?>
                            <tr class="hover:bg-gradient-to-r from-blue-200 to-indigo-200">
                                <td class="py-2 px-6"><?= $no++; ?></td>
                                <td class="py-2 px-6"><?= $s->nisn; ?></td>
                                <td class="py-2 px-6"><?= $s->nama; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
