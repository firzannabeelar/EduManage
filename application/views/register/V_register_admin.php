<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 font-sans">
  <div class="flex justify-center items-center h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-sm w-full space-y-6">
      <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Daftar Admin</h2>
      <form id="registerForm" action="<?= site_url('loginregister/register_admin'); ?>" method="POST" novalidate>
        <div class="space-y-4">
          <div>
            <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Username</label>
            <input type="text" id="username" name="username" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan Username" required />
          </div>
          <div>
            <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
            <input type="text" id="nama" name="nama" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan Nama" required />
          </div>
          <div>
            <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
            <input type="text" id="jabatan" name="jabatan" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan Jabatan" required />
          </div>
          <div>
            <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
            <input 
                type="text" 
                id="telepon" 
                name="telepon" 
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                placeholder="Masukkan Nomor Telepon" 
                required 
            />
            <p id="teleponError" class="text-red-500 text-sm mt-1 hidden">Nomor telepon harus hanya angka dan 10–13 digit.</p>
          </div>
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
            <input type="password" id="password" name="password" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan Password" required />
          </div>
          <div>
            <button type="submit" class="w-full text-white p-3 mt-3 rounded-lg font-semibold bg-gradient-to-r from-indigo-600 to-blue-500 shadow-md transform transition-transform duration-300 hover:scale-105 cursor-pointer">
              Daftar
            </button>
          </div>
        </div>
      </form>
      <div class="text-center">
        <p class="text-sm text-gray-600">Sudah punya akun? <a href="<?= site_url('loginregister/login_admin'); ?>" class="text-blue-500 font-bold inline-block transform transition-transform duration-300 hover:scale-110">Login</a></p>
      </div>
    </div>
  </div>

  <script>
  const teleponInput = document.getElementById('telepon');
  const errorText = document.getElementById('teleponError');
  const form = document.getElementById('registerForm');

  form.addEventListener('submit', function (e) {
    const val = teleponInput.value.trim();
    const digitOnly = val.replace(/\D/g, ''); // Hanya angka

    if (!/^\d{10,13}$/.test(digitOnly)) {
      e.preventDefault();
      errorText.classList.remove('hidden');
      teleponInput.classList.add('border-red-500');
    } else {
      errorText.classList.add('hidden');
      teleponInput.classList.remove('border-red-500');
    }
  });
</script>
</body>
</html>
