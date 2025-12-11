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
            <li>
                <a href="<?= site_url('dashboard/dashboard_siswa'); ?>" 
                class="text-blue-500 flex items-center p-3 rounded-md text-2xl font-bold ml-3"><i class="fas fa-book-reader mr-3"></i>EduManage</a></li>
                </a>
            </li>
            <li>
                <a href="<?= site_url('dashboard/dashboard_siswa'); ?>" 
                class="flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md">
                <i class="fas fa-home mr-3"></i>Dashboard
                </a>
            </li>
            <li>
                <a href="<?= isset($kelas) && !empty($kelas) ? site_url('jurnal/detail_siswa/' . $kelas->id) : 'javascript:void(0)'; ?>" 
                class="flex items-center p-3 rounded-md 
                        <?= isset($kelas) && !empty($kelas) ? 'text-blue-500 hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white' : 'text-gray-500 cursor-not-allowed'; ?>">
                <i class="fas fa-book mr-3"></i>Jurnal Kelas
                </a>
            </li>
            <li>
                <a href="<?= site_url('pembayaran/upload_bukti'); ?>" 
                class="flex items-center hover:bg-gradient-to-r from-blue-500 to-indigo-400 hover:text-white p-3 rounded-md">
                <i class="fas fa-credit-card mr-3"></i>Pembayaran
                </a>
            </li>
            </ul>
        </div>


        <div class="flex-1 p-8 space-y-6 transition-all duration-300" id="content">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">
                <?= $kelas->tingkat . '-' . $kelas->jurusan . '-' . $kelas->nama_kelas; ?>
            </h1>

            <h1 class="text-3xl font-bold text-gray-800">Daftar Mata Pelajaran</h1>

            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <table class="min-w-full table-auto border-collapse">
                    <thead class="bg-gradient-to-r from-blue-500 to-indigo-400 text-white">
                        <tr>
                            <th class="py-3 px-6 text-left">No</th>
                            <th class="py-3 px-6 text-left">Nama Mata Pelajaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($mata_pelajaran as $mp): ?>
                            <tr class="hover:bg-gradient-to-r from-blue-200 to-indigo-200">
                                <td class="py-2 px-6"><?= $no++; ?></td>
                                <td class="py-2 px-6"><?= $mp->nama_mata_pelajaran; ?></td>
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


</body>
</html>
