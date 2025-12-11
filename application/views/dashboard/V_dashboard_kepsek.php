<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kepsek</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-blue-50 font-sans">

    <!-- Sidebar -->
    <div class="flex" id="app">
        <div class="bg-white text-gray-800 w-64 h-screen p-5 space-y-6 transition-all duration-300" id="sidebar">
            <ul class="space-y-4">
                <li><a href="<?= site_url('dashboard/dashboard_kepsek'); ?>" class="text-blue-500 flex items-center p-3 rounded-md text-2xl font-bold ml-3"><i class="fas fa-book-reader mr-3"></i>EduManage</a></li>
                <li><a href="<?= site_url('dashboard/dashboard_kepsek'); ?>" class="text-blue-500 flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md"><i class="fas fa-home mr-3"></i>Dashboard</a></li>
                <li><a href="<?= site_url('jurnal/jurnal_kepsek'); ?>" class="flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md"><i class="fas fa-book mr-3"></i>Jurnal Kelas</a></li>
                <li><a href="<?= site_url('absensi/absensi_kepsek'); ?>" class="flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md"><i class="fas fa-calendar-check mr-3"></i>Absensi</a></li>
                <li><a href="<?= site_url('siswa/siswa_kepsek'); ?>" class="flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md"><i class="fas fa-users mr-3"></i>Pengelolaan Data Siswa</a></li>
                <li><a href="<?= site_url('admin/admin_kepsek'); ?>" class="flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md"><i class="fas fa-chalkboard-teacher mr-3"></i>Pengelolaan Data Guru</a></li>
            </ul>
        </div>

        <!-- Content Area -->
        <div class="flex-1 p-8 space-y-6 transition-all duration-300" id="content">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gradient-to-r from-indigo-600 to-blue-500 shadow-md rounded-lg p-6 text-center text-white">
                    <div class="text-xl font-semibold flex items-center justify-center mt-5">
                        <i class="fas fa-user-graduate mr-3"></i>Jumlah Siswa
                    </div>
                    <div class="text-3xl font-bold mt-2 mb-5"><?= $jumlah_siswa; ?></div>
                </div>
                <div class="bg-gradient-to-r from-green-600 to-teal-500 shadow-md rounded-lg p-6 text-center text-white">
                    <div class="text-xl font-semibold flex items-center justify-center mt-5">
                        <i class="fas fa-chalkboard-teacher mr-3"></i>Jumlah Kelas
                    </div>
                    <div class="text-3xl font-bold mt-2 mb-5"><?= $jumlah_kelas; ?></div>
                </div>
                <div class="bg-gradient-to-r from-red-500 to-orange-500 shadow-md rounded-lg p-6 text-center text-white">
                    <div class="text-xl font-semibold flex items-center justify-center mt-5">
                        <i class="fas fa-user-tie mr-3"></i>Pengajar Aktif
                    </div>
                    <div class="text-3xl font-bold mt-2 mb-5"><?= $jumlah_admin; ?></div>
                </div>
            </div>

            <!-- More Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div class="bg-gradient-to-r from-purple-500 to-pink-400 shadow-md rounded-lg p-6 text-center text-white">
                    <div class="text-xl font-semibold flex items-center justify-center mt-8">
                        <i class="fas fa-calendar-day mr-3"></i>Total Kehadiran Hari Ini
                    </div>
                    <div class="text-3xl font-bold mt-2"><?= $kehadiran_hari_ini; ?></div>
                    <p class="mt-2 mb-8">Siswa hadir</p>
                </div>
                <div class="bg-gradient-to-r from-pink-400 to-purple-500 shadow-md rounded-lg p-6 text-center text-white">
                    <div class="text-xl font-semibold flex items-center justify-center mt-12">
                        <i class="fas fa-wallet mr-3"></i>Jumlah Siswa Lunas
                    </div>
                    <div class="text-3xl font-bold mt-2 mb-8"><?= $jumlah_siswa_lunas; ?></div>
                </div>
            </div>

            <h2 class="text-xl font-bold text-gray-800">Riwayat Pembayaran SPP Terakhir</h2>

            <div class="bg-white to-indigo-400 shadow-md rounded-lg overflow-x-auto">
                <table class="table-auto w-full border-collapse">
                    <thead class="bg-gradient-to-r from-blue-500 to-indigo-400 text-white">
                        <tr>
                            <th class="p-4 border-b text-left">No</th>
                            <th class="p-4 border-b text-left">Nama Siswa</th>
                            <th class="p-4 border-b text-left">Bukti Transfer</th>
                            <th class="p-4 border-b text-left">Status</th>
                            <th class="p-4 border-b text-left">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($riwayat_pembayaran)) : ?>
                            <?php foreach ($riwayat_pembayaran as $key => $pembayaran) : ?>
                                <tr class="hover:bg-gradient-to-r from-blue-200 to-indigo-200">
                                    <td class="py-2 px-4"><?= $key + 1; ?></td>
                                    <td class="py-2 px-4"><?= $pembayaran->nama; ?></td>
                                    <td class="py-2 px-4">
                                        <?php if ($pembayaran->bukti_transfer) : ?>
                                            <a href="<?= base_url('uploads/bukti_transfer/' . $pembayaran->bukti_transfer); ?>" target="_blank" class="text-blue-500 font-bold inline-block transform transition-transform duration-300 hover:scale-110">Lihat Bukti</a>
                                        <?php else : ?>
                                            Tidak Ada
                                        <?php endif; ?>
                                    </td>
                                    <td class="py-2 px-4"><?= ucfirst($pembayaran->status); ?></td>
                                    <td class="py-2 px-4"><?= date('d M Y, H:i', strtotime($pembayaran->created_at)); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5" class="py-3 px-4 text-center text-gray-500">Tidak ada riwayat pembayaran.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>


        </div>
    </div>

</body>
</html>
