@extends('alumni.layouts.app')

@section('title', 'Tentang Kami - Portal Kerja POLINDRA')

@section('content')
    <!-- Tentang Kami -->
    <section class="mb-12">
        <h1 class="text-2xl font-bold mb-6">Tentang Kami</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Text -->
            <div class="md:col-span-2 text-justify text-gray-800 leading-relaxed space-y-4">
                <p>Lorem ipsum dolor sit amet consectetur. Amet at suspendisse pulvinar amet.
                    Praesent ac cursus mauris nibh a proin. Ut libero purus ligula tristique justo id.
                    Feugiat urna quis elit scelerisque in diam. Tristique ullamcorper pharetra
                    adipiscing turpis tristique eleifend tincidunt id. Nisl massa magna sociosqu
                    ipsum donec tortor odio ipsum. Aliquet sit adipiscing net tincidunt est eget
                    aliquet. Viverra sagittis fusce amet egestas faucibus interdum venenatis.
                    Ultrices scelerisque pulvinar quam purus a feugiat.</p>

                <p>Nibh donec ornare turpis egestas ut vulputate eget id sed tortor libero
                    faucibus diam auctor lobortis. Praesent ut auctor eget eget libero. Consequat
                    amet sed elit massa leo. Pulvinar luctus non orci bibendum amet. Tellus
                    ullamcorper nibh facilisis quam bibendum luctus habitant imperdiet
                    elementum. Sed consequat ac vitae eget dignissim dui non in. Nibh molestie
                    tempus viverra diam pellentesque laoreet. Dui nulla sollicitudin et pulvinar.</p>

                <p>Nulla nunc ultricies dui mauris egestas velit amet sed malesuada. Tempus ut
                    lobortis felis odio lorem amet nisl tristique nunc. Aliquam nunc nunc amet
                    donec interdum congue potenti. Et eget pharetra sit ut sed sed ipsum enim
                    arcu. Dictum nulla id ut mattis. Pulvinar fringilla a suspendisse ac sollicitudin
                    ante ut. Elementum nisi nisi nec elementum. Commodo nunc sagittis lectus
                    nullam augue. Faucibus pellentesque tellus accumsan sem. Aliquet massa
                    enim aliquam nunc consectetur.</p>

                <p>Nulla lectus semper sed in volutpat nisi. Viverra cursus praesent odio mattis.</p>
            </div>

            <!-- Placeholder Box -->
            <div class="bg-gray-100 rounded-xl h-80"></div>
        </div>
    </section>

    <!-- Dokumen Publik -->
    <section>
        <h2 class="text-xl font-semibold mb-6">Dokumen Publik</h2>

        <div class="space-y-4">
            <div class="flex justify-between items-center bg-gray-100 rounded-lg px-6 py-4">
                <span class="text-gray-700">Lorem ipsum dolor sit</span>
                <a href="#"
                    class="px-6 py-2 rounded-lg bg-gradient-to-r from-blue-900 to-purple-700
                text-white font-medium flex items-center gap-2 hover:opacity-90 transition">
                    Download
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                    </svg>
                </a>
            </div>

            <div class="flex justify-between items-center bg-gray-100 rounded-lg px-6 py-4">
                <span class="text-gray-700">Lorem ipsum dolor sit</span>
                <a href="#"
                    class="px-6 py-2 rounded-lg bg-gradient-to-r from-blue-900 to-purple-700
                text-white font-medium flex items-center gap-2 hover:opacity-90 transition">
                    Download
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                    </svg>
                </a>
            </div>

            <div class="flex justify-between items-center bg-gray-100 rounded-lg px-6 py-4">
                <span class="text-gray-700">Lorem ipsum dolor sit</span>
                <a href="#"
                    class="px-6 py-2 rounded-lg bg-gradient-to-r from-blue-900 to-purple-700
                text-white font-medium flex items-center gap-2 hover:opacity-90 transition">
                    Download
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
@endsection
