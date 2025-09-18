@extends('layouts.auth')

@section('title','Masuk - UPA Kerjasama POLINDRA')

@section('content')
@php
    $bg = null;
    if (file_exists(public_path('images/polindra-building.jpg'))) {
        $bg = asset('images/polindra-building.jpg');
    } elseif (file_exists(public_path('images/polindra-building.png'))) {
        $bg = asset('images/polindra-building.png');
    }
@endphp
<div class="grid md:grid-cols-2 min-h-screen">
    <div class="hidden md:block relative">
        @if ($bg)
            <div class="absolute inset-0 bg-center bg-no-repeat bg-cover" style="background-image: url('{{ $bg }}');"></div>
            <img src="{{ $bg }}" alt="POLINDRA" class="absolute inset-0 h-full w-full object-cover" onerror="this.style.display='none'"/>
        @endif
        <div class="absolute inset-0 bg-black/35"></div>

        <div class="absolute top-4 left-4 z-20 select-none">
            <div class="leading-tight uppercase font-extrabold text-2xl md:text-3xl tracking-wide">
                <span class="text-transparent drop-shadow-[0_0_0_2px_#94A3B8]" style="-webkit-text-stroke:2px #94A3B8;">UPA KERJASAMA</span>
                <br>
                <span class="text-transparent drop-shadow-[0_0_0_2px_#94A3B8]" style="-webkit-text-stroke:2px #94A3B8;">POLINDRA</span>
            </div>
        </div>

        <div class="absolute bottom-6 left-6 text-white max-w-md z-20">
            <p class="text-2xl font-semibold">Dekatkan dirimu dengan kesuksesan</p>
        </div>
    </div>

    <div class="flex items-center justify-center px-6 py-10">
        <div class="w-full max-w-xl">
            <h1 class="text-center font-extrabold leading-tight">
                <span class="block text-2xl md:text-4xl bg-gradient-to-r from-indigo-900 via-indigo-700 to-purple-800 bg-clip-text text-transparent drop-shadow leading-tight tracking-tight pb-1">Selamat datang di Portal Kerja</span>
                <span class="mt-1 block text-3xl md:text-4xl bg-gradient-to-r from-indigo-900 via-indigo-700 to-purple-800 bg-clip-text text-transparent drop-shadow tracking-wide leading-tight">POLINDRA</span>
            </h1>
            <p class="mt-3 text-center text-gray-600">Temukan pekerjaan idamanmu disini!</p>

            <div class="mt-8">
                <div class="grid grid-cols-3 gap-3" id="role-tabs">
                    <button type="button" data-role="mahasiswa" class="role-tab h-12 rounded-xl border border-gray-200 bg-white px-4 text-sm md:text-base font-semibold text-gray-700 shadow-sm">Mahasiswa</button>
                    <button type="button" data-role="alumni" class="role-tab h-12 rounded-xl border border-indigo-200 bg-indigo-50 px-4 text-sm md:text-base font-semibold text-indigo-700 shadow-sm ring-2 ring-indigo-300">Alumni</button>
                    <button type="button" data-role="mitra" class="role-tab h-12 rounded-xl border border-gray-200 bg-white px-4 text-sm md:text-base font-semibold text-gray-700 shadow-sm">Mitra</button>
                </div>

                <form method="POST" action="{{ route('login.post') }}" class="mt-6 space-y-4" id="login-form">
                    @csrf
                    <input type="hidden" name="role" id="role-input" value="alumni"/>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"/>
                    <input type="password" name="password" placeholder="Password" class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"/>
                    <div class="text-sm"><a href="#" class="text-indigo-600 hover:text-indigo-700">Lupa Password?</a></div>
                    @if ($errors->any())
                        <div class="rounded-md bg-red-50 p-3 text-sm text-red-700">{{ $errors->first() }}</div>
                    @endif
                    <button type="submit" class="w-full rounded-xl bg-gradient-to-r from-indigo-700 to-indigo-500 py-3 text-white font-semibold">Masuk</button>
                </form>

                <div class="my-6 flex items-center gap-4">
                    <div class="h-px flex-1 bg-gray-200"></div>
                    <span class="text-gray-500 text-sm">OR</span>
                    <div class="h-px flex-1 bg-gray-200"></div>
                </div>

                <button type="button" class="w-full rounded-xl border border-gray-300 bg-white py-3 font-semibold text-gray-700 flex items-center justify-center gap-3">
                    @php
                        $gIcon = null;
                        if (file_exists(public_path('images/google-g.svg'))) {
                            $gIcon = asset('images/google-g.svg');
                        } elseif (file_exists(public_path('images/google-g.png'))) {
                            $gIcon = asset('images/google-g.png');
                        }
                    @endphp
                    @if ($gIcon)
                        <img src="{{ $gIcon }}" alt="Google" class="h-5 w-5"/>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 533.5 544.3" class="h-5 w-5">
                            <path fill="#4285F4" d="M533.5 278.4c0-18.5-1.7-36.4-5-53.6H272v101.5h147.3c-6.4 34.6-25.7 63.9-54.7 83.5v69.3h88.4c51.7-47.6 80.5-117.8 80.5-200.7z"/>
                            <path fill="#34A853" d="M272 544.3c73.2 0 134.7-24.2 179.6-65.2l-88.4-69.3c-24.6 16.5-56.2 26.1-91.2 26.1-70 0-129.3-47.2-150.5-110.7H30.7v69.9C75.3 486.5 167.9 544.3 272 544.3z"/>
                            <path fill="#FBBC05" d="M121.5 325.2c-10.2-30.6-10.2-63.7 0-94.3v-69.9H30.7c-40.9 81.8-40.9 152.3 0 234.1l90.8-70z"/>
                            <path fill="#EA4335" d="M272 107.7c38.8-.6 75.8 13.9 104.1 40.8l77.5-77.5C404.4 24.2 343 0 272 0 167.9 0 75.3 57.8 30.7 165.9l90.8 69.9C142.8 154.3 202.1 107.1 272 107.7z"/>
                        </svg>
                    @endif
                    Masuk dengan Google
                </button>

                <p class="mt-6 text-center text-gray-600">Belum punya akun? <a href="#" class="text-indigo-600 hover:text-indigo-700">Daftar disini</a></p>
            </div>
        </div>
    </div>
</div>
<script>
    (function(){
        const roleInput = document.getElementById('role-input');
        const tabs = document.querySelectorAll('#role-tabs .role-tab');
        const activeClasses = 'border-indigo-200 bg-indigo-50 ring-2 ring-indigo-300 text-indigo-700';
        const inactiveClasses = 'border-gray-200 bg-white text-gray-700 ring-0';
        function setActive(target){
            tabs.forEach(btn=>{
                btn.classList.remove(...activeClasses.split(' '));
                btn.classList.add(...inactiveClasses.split(' '));
            });
            target.classList.remove(...inactiveClasses.split(' '));
            target.classList.add(...activeClasses.split(' '));
            roleInput.value = target.getAttribute('data-role');
        }
        tabs.forEach(btn=>btn.addEventListener('click',()=>setActive(btn)));
    })();
    </script>
@endsection


