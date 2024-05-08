<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/guest/dashboard.css')
</head>
<body>
<div class="dashboard-container">

    <!-- Bagian 1 -->
    <div id="bagian-1" class="big-card-container flex items-center justify-center h-screen">
        <div class="big-card text-white p-6 rounded-lg flex flex-col items-start">
            <div class="text-container flex-grow">
                <h3 class="text-4xl mb-8 font-bold">Welcome To JPM View (Guest Mode)</h3>
                <p class="text-lg mb-8">Selamat datang di halaman dashboard eksklusif JPM! Di sini, Anda akan menemukan rangkuman yang komprehensif dan terperinci mengenai aktivitas operasional yang vital bagi kesuksesan bisnis Anda. Melalui visualisasi data yang intuitif dan informatif, Anda dapat dengan mudah melacak kinerja operasional, menganalisis tren, dan mengidentifikasi potensi area perbaikan.</p>
            </div>
            <div class="logo-container self-end">
                <a href="#bagian-2" id="pindah-ke-bagian-2" class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-12 py-2.5 text-center inline-flex items-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                    Pilih Line
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Bagian 2 (Choose Line) -->
    <div id="bagian-2" class="big-card-container flex items-center justify-center h-screen hidden">
        <div class="big-card dark:bg-blue-900 text-white p-6 rounded-lg flex flex-col items-center justify-center">
            <div class="text-container flex-grow">
                <h3 class="text-3xl mb-8 font-bold">PILIH LINE</h3>
                <!-- Line -->
                <div class="custom-card">


                    @foreach($lines as $line)
                    <div>
                        <a href="{{ route('guest.dashboardGuest', ['line' => $line->id]) }}" class="btn-secondary w-40 h-16 text-lg my-2">{{ $line->name }}</a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="logo-container self-start">
                <a href="#bagian-1" id="kembali-ke-bagian-1" class="text-white button-kembali-1 bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-12 py-2.5 text-left inline-flex items-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                    <svg class="rotate-180 w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                    Back
                </a>
            </div>
        </div>
    </div>

    <!-- Bagian 3 (Choose Year) -->
    <div id="bagian-3" class="big-card-container flex items-center justify-center h-screen hidden">
        <div class="big-card dark:bg-blue-900 text-white p-6 rounded-lg flex flex-col items-start">
            <div class="text-container flex-grow">
                <h3 class="text-3xl mb-8 font-bold">PILIH YEAR</h3>
                <!-- Year -->
                <div class="custom-card">
                    @if($selectedLine)
                    @foreach($selectedYear as $year)
                    <div>
                        <a href="{{ route('guest.dashboardGuest', ['line' => $selectedLine->id, 'year' => $year->year]) }}" class="btn-secondary w-40 h-16 text-lg my-2">{{ $year->year }}</a>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
            <div class="logo-container self-start flex justify-between">
                <a href="#bagian-2" id="kembali-ke-bagian-2" class="text-white button-kembali-1 bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-12 py-2.5 text-left inline-flex items-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                    <svg class="rotate-180 w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                    Back
                </a>
            </div>
        </div>
    </div>

    <!-- Bagian 4 (Choose Month) -->
    <div id="bagian-4" class="big-card-container flex items-center justify-center h-screen hidden">
        <div class="big-card dark:bg-blue-900 text-white p-6 rounded-lg flex flex-col items-start">
            <div class="text-container flex-grow">
                <h3 class="text-3xl mb-8 font-bold">PILIH MONTH</h3>
                <!-- Month -->
                <div class="custom-card">
                    @if($selectedYear)
                    @foreach($selectedMonth as $month)
                    <div>
                        <a href="{{ route('guest.dashboardGuest', ['line' => $selectedLine->id, 'year' => $request->year, 'month' => $month->month]) }}" class="btn-secondary w-40 h-16 text-lg my-2">{{ $month->month }}</a>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
            <div class="logo-container self-start flex justify-between">
                <a href="#bagian-3" id="kembali-ke-bagian-3" class="text-white button-kembali-1 bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-12 py-2.5 text-left inline-flex items-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                    <svg class="rotate-180 w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                    Back
                </a>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('pindah-ke-bagian-2').addEventListener('click', function() {
            document.getElementById('bagian-1').classList.add('hidden');
            document.getElementById('bagian-2').classList.remove('hidden');
        });

        document.getElementById('kembali-ke-bagian-1').addEventListener('click', function() {
            document.getElementById('bagian-2').classList.add('hidden');
            document.getElementById('bagian-1').classList.remove('hidden');
        });

        document.getElementById('kembali-ke-bagian-2').addEventListener('click', function() {
            document.getElementById('bagian-3').classList.add('hidden');
            document.getElementById('bagian-2').classList.remove('hidden');
        });

        document.getElementById('kembali-ke-bagian-3').addEventListener('click', function() {
            document.getElementById('bagian-4').classList.add('hidden');
            document.getElementById('bagian-3').classList.remove('hidden');
        });
    </script>

</div>
</body>
</html>
