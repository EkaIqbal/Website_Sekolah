<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login Admin - sekolah</title>
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.js"></script>
    <link rel="icon" type="image/png" href="{{ asset('storage/logo/sd1.png') }}">
    
</head>

<body class="bg-white flex items-center justify-center min-h-screen px-4">

    <div
        class="flex flex-col md:flex-row bg-white rounded-3xl shadow-2xl overflow-hidden border-4 border-gray-600 max-w-4xl w-full">

        <!-- Kotak kiri: Gambar -->
        <div class="hidden md:block md:w-1/2 bg-gradient-to-tr from-gray-700 via-gray-700 to-gray-800 relative">
            <img src="{{ asset('storage/background/logo admin.png') }}" alt="Login Illustration"
                class="h-full w-full object-cover" />
        </div>

        <!-- Kotak kanan: Form login -->
        <div
            class="w-full md:w-1/2 p-10 bg-gradient-to-tr from-gray-700 via-gray-700 to-gray-800 transition-shadow duration-500 hover:shadow-[0_0_25px_5px_rgba(255,183,77,0.75)]">

            <h2 class="text-center text-4xl font-extrabold text-gray-100 mb-8 tracking-wide drop-shadow-md">
                Login Admin
            </h2>

            @if($errors->any())
                <div class="mb-6 bg-red-900 bg-opacity-90 rounded-lg p-5 text-red-300 border border-red-600 shadow-lg">
                    <ul class="list-disc list-inside space-y-2 text-sm font-semibold">
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-6" novalidate>
                @csrf

                <div>
                    <label for="email" class="block mb-2 text-sm font-semibold text-gray-100">Email</label>
                    <input id="email" name="email" type="email" required autofocus autocomplete="email"
                        placeholder="Email" value="{{ old('email') }}" class="w-full rounded-xl border border-gray-900 bg-gray-900 px-5 py-3
                   text-yellow-100 placeholder-yellow-300 shadow-md
                   focus:outline-none focus:ring-4 focus:ring-gray-400 focus:ring-opacity-80
                   transition duration-300 text-base font-medium" />
                </div>

                <div>
                    <label for="password" class="block mb-2 text-sm font-semibold text-gray-100">Password</label>
                    <div class="relative">
                        <input id="password" name="password" type="password" required autocomplete="current-password"
                            placeholder="Password" class="w-full rounded-xl border border-gray-900 bg-gray-900 px-5 py-3
                       text-yellow-100 placeholder-yellow-300 shadow-md
                       focus:outline-none focus:ring-4 focus:ring-gray-400 focus:ring-opacity-80
                       transition duration-300 text-base font-medium pr-14" />
                        <button type="button" id="togglePassword"
                            class="absolute top-1/2 right-4 -translate-y-1/2 text-yellow-400 hover:text-yellow-300 focus:outline-none">
                            <!-- Icon show/hide tetap sama -->
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full py-3 rounded-2xl
               bg-gradient-to-r from-gray-400 via-gray-400 to-gray-500
               text-blue-900 text-lg font-extrabold shadow-lg
               hover:brightness-110 active:scale-95 transition-transform duration-150">
                    Masuk Sekarang
                </button>
            </form>

            <div class="mt-6 text-center text-gray-100 text-xs select-none tracking-wide">
                © 2025 SDN CURAHNONGKO 02. Hak Cipta Dilindungi.
            </div>

        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const iconShow = document.getElementById('iconShow');
        const iconHide = document.getElementById('iconHide');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            iconShow.classList.toggle('hidden');
            iconHide.classList.toggle('hidden');
        });
    </script>

</body>

</html>