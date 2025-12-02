<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mitra - Portal Kerja POLINDRA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-900 via-indigo-800 to-purple-900 py-12 px-4">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
    </div>

    <div class="relative max-w-3xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8 animate-fade-in">
            <div class="inline-block p-4 bg-white/10 backdrop-blur-md rounded-2xl mb-4">
                <i class="fas fa-building text-5xl text-white"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Pendaftaran Mitra Perusahaan</h1>
            <p class="text-blue-200">Bergabunglah dengan UPA Kerjasama POLINDRA</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-2xl p-8 backdrop-blur-lg animate-slide-up">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Formulir Pendaftaran</h2>
                <p class="text-gray-600">Isi data perusahaan Anda dengan lengkap. Tim kami akan meninjau dan menghubungi Anda segera.</p>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 rounded-lg p-4">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3 text-xl"></i>
                        <div>
                            <p class="font-semibold text-green-800">Pendaftaran Berhasil!</p>
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 rounded-lg p-4">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-circle text-red-500 mr-3 text-xl mt-0.5"></i>
                        <div>
                            <p class="font-semibold text-red-800 mb-2">Terdapat kesalahan:</p>
                            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('mitra.register.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Nama Perusahaan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-building text-gray-400 mr-2"></i>Nama Perusahaan *
                    </label>
                    <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}" required
                           class="w-full px-4 py-3 border-2 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all outline-none @error('nama_perusahaan') border-red-500 @else border-gray-200 @enderror"
                           placeholder="PT. Contoh Perusahaan">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-envelope text-gray-400 mr-2"></i>Email Perusahaan *
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full px-4 py-3 border-2 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all outline-none @error('email') border-red-500 @else border-gray-200 @enderror"
                               placeholder="info@perusahaan.com">
                    </div>

                    <!-- Telepon -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-phone text-gray-400 mr-2"></i>Nomor Telepon *
                        </label>
                        <input type="tel" name="telepon" value="{{ old('telepon') }}" required
                               class="w-full px-4 py-3 border-2 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all outline-none @error('telepon') border-red-500 @else border-gray-200 @enderror"
                               placeholder="021-12345678">
                    </div>
                </div>

                <!-- Alamat -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>Alamat Lengkap *
                    </label>
                    <textarea name="alamat" rows="3" required
                              class="w-full px-4 py-3 border-2 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all outline-none @error('alamat') border-red-500 @else border-gray-200 @enderror"
                              placeholder="Jl. Contoh No. 123, Kota, Provinsi">{{ old('alamat') }}</textarea>
                </div>

                <!-- Bidang Usaha -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-industry text-gray-400 mr-2"></i>Bidang Usaha / Sektor Industri *
                    </label>
                    <select name="bidang_usaha" required
                            class="w-full px-4 py-3 border-2 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all outline-none @error('bidang_usaha') border-red-500 @else border-gray-200 @enderror">
                        <option value="">Pilih Bidang Usaha</option>
                        <option value="Teknologi Informasi" {{ old('bidang_usaha') == 'Teknologi Informasi' ? 'selected' : '' }}>Teknologi Informasi</option>
                        <option value="Manufaktur" {{ old('bidang_usaha') == 'Manufaktur' ? 'selected' : '' }}>Manufaktur</option>
                        <option value="Perdagangan" {{ old('bidang_usaha') == 'Perdagangan' ? 'selected' : '' }}>Perdagangan</option>
                        <option value="Jasa" {{ old('bidang_usaha') == 'Jasa' ? 'selected' : '' }}>Jasa</option>
                        <option value="Konstruksi" {{ old('bidang_usaha') == 'Konstruksi' ? 'selected' : '' }}>Konstruksi</option>
                        <option value="Pertanian" {{ old('bidang_usaha') == 'Pertanian' ? 'selected' : '' }}>Pertanian</option>
                        <option value="Pendidikan" {{ old('bidang_usaha') == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                        <option value="Kesehatan" {{ old('bidang_usaha') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                        <option value="Lainnya" {{ old('bidang_usaha') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-file-alt text-gray-400 mr-2"></i>Deskripsi Perusahaan
                    </label>
                    <textarea name="deskripsi" rows="4"
                              class="w-full px-4 py-3 border-2 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all outline-none @error('deskripsi') border-red-500 @else border-gray-200 @enderror"
                              placeholder="Ceritakan tentang perusahaan Anda, visi, misi, dan mengapa ingin bermitra dengan POLINDRA...">{{ old('deskripsi') }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">Opsional - Informasi ini akan membantu kami memahami perusahaan Anda lebih baik</p>
                </div>

                <!-- Dokumen Pendukung -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-paperclip text-gray-400 mr-2"></i>Dokumen Pendukung (Opsional)
                    </label>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-blue-500 transition">
                        <input type="file" name="dokumen" id="dokumen" accept=".pdf,.jpg,.jpeg,.png" class="hidden" onchange="displayFileName(this)">
                        <label for="dokumen" class="cursor-pointer">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                            <p class="text-sm text-gray-600">Klik untuk upload atau drag & drop</p>
                            <p class="text-xs text-gray-500 mt-1">PDF, JPG, PNG (Max 5MB)</p>
                            <p class="text-xs text-gray-500">SIUP, NIB, atau dokumen legalitas lainnya</p>
                        </label>
                        <p id="file-name" class="mt-3 text-sm font-medium text-blue-600"></p>
                    </div>
                </div>

                <!-- Terms & Conditions -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                    <label class="flex items-start cursor-pointer group">
                        <input type="checkbox" name="terms" required class="mt-1 w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500">
                        <span class="ml-3 text-sm text-gray-700">
                            Saya menyatakan bahwa data yang saya berikan adalah benar dan saya setuju dengan 
                            <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">syarat dan ketentuan</a> 
                            yang berlaku. *
                        </span>
                    </label>
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="{{ route('mitra.login') }}" 
                       class="flex-1 px-6 py-3.5 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition text-center">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                    <button type="submit" 
                            class="flex-1 px-6 py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all">
                        <i class="fas fa-paper-plane mr-2"></i>Kirim Pendaftaran
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Box -->
        <div class="mt-6 bg-white/10 backdrop-blur-md rounded-xl p-6 text-white">
            <h3 class="font-semibold mb-2 flex items-center">
                <i class="fas fa-info-circle mr-2"></i>Informasi Penting
            </h3>
            <ul class="text-sm text-blue-100 space-y-1">
                <li>• Pendaftaran akan diproses dalam 1-3 hari kerja</li>
                <li>• Anda akan menerima email notifikasi setelah pendaftaran disetujui</li>
                <li>• Pastikan email yang Anda daftarkan aktif dan dapat menerima email</li>
            </ul>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slide-up {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }
        .animate-slide-up {
            animation: slide-up 0.6s ease-out;
        }
    </style>

    <script>
        function displayFileName(input) {
            const fileName = input.files[0]?.name;
            const fileNameDisplay = document.getElementById('file-name');
            if (fileName) {
                fileNameDisplay.innerHTML = `<i class="fas fa-file mr-2"></i>${fileName}`;
            }
        }
    </script>
</body>
</html>
