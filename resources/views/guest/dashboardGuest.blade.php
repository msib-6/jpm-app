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
                <a href="#" id="pindah-ke-bagian-2" class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-12 py-2.5 text-center inline-flex items-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
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
                <div class="custom-card" id="line-container">
                    <!-- Line buttons will be populated here -->
                </div>
            </div>
            <div class="logo-container self-start">
                <!-- Tetapkan tombol kembali ke Bagian 1 -->
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
                <div id="year-container" class="custom-card">
                    <!-- Year buttons will be populated here -->
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
                <div id="month-container" class="custom-card">
                    <!-- Month buttons will be populated here -->
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

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Script saat tombol pindah ke Bagian 2 diklik
            document.getElementById('pindah-ke-bagian-2').addEventListener('click', function () {
                document.getElementById('bagian-1').classList.add('hidden');
                document.getElementById('bagian-2').classList.remove('hidden');
            });

            // Script saat tombol kembali ke Bagian 1 diklik
            document.getElementById('kembali-ke-bagian-1').addEventListener('click', function () {
                document.getElementById('bagian-2').classList.add('hidden');
                document.getElementById('bagian-1').classList.remove('hidden');
            });

            // Fungsi untuk menampilkan pilihan line
            function showLineSelection(machines) {
                const lineContainer = document.getElementById('line-container');
                machines.forEach(machine => {
                    const button = document.createElement('button');
                    button.textContent = machine.line;
                    button.className = 'btn w-48 h-16 text-lg ml-4 mb-4 text-left';
                    button.addEventListener('click', function () {
                        selectLine(machine.id);
                    });
                    lineContainer.appendChild(button);
                });
            }

            // Fungsi untuk memilih line
            function selectLine(selectedLineId) {
                // Ambil data tahun berdasarkan line yang dipilih
                axios.get(`http://127.0.0.1:8000/api/showcodeline2?line_id=${selectedLineId}`)
                    .then(function (response) {
                        const years = response.data.machines.map(machine => machine.year);
                        showYearSelection(years);
                    })
                    .catch(function (error) {
                        console.error('Error fetching data:', error);
                    });
            }

            // Fungsi untuk menampilkan pilihan tahun
            function showYearSelection(years) {
                document.getElementById('bagian-2').classList.add('hidden');
                document.getElementById('bagian-3').classList.remove('hidden');

                const yearContainer = document.getElementById('year-container');
                yearContainer.innerHTML = ''; // Bersihkan konten sebelumnya

                years.forEach(year => {
                    const button = document.createElement('button');
                    button.textContent = year;
                    button.className = 'btn w-48 h-16 text-lg ml-4 mb-4 text-left';
                    button.addEventListener('click', function () {
                        selectYear(year);
                    });
                    yearContainer.appendChild(button);
                });
            }

            // Fungsi untuk memilih tahun
            function selectYear(selectedYear) {
                document.getElementById('bagian-3').classList.add('hidden');
                document.getElementById('bagian-4').classList.remove('hidden');
                // Ambil data bulan berdasarkan tahun yang dipilih
                axios.get(`http://127.0.0.1:8000/api/showcodeline2?year=${selectedYear}`)
                    .then(function (response) {
                        const months = response.data.machines.map(machine => machine.month);
                        showMonthSelection(months);
                    })
                    .catch(function (error) {
                        console.error('Error fetching data:', error);
                    });
            }

            // Fungsi untuk menampilkan pilihan bulan
            function showMonthSelection(months) {
                const monthContainer = document.getElementById('month-container');
                monthContainer.innerHTML = ''; // Bersihkan konten sebelumnya

                months.forEach(month => {
                    const button = document.createElement('button');
                    button.textContent = month;
                    button.className = 'btn w-48 h-16 text-lg ml-4 mb-4 text-left';
                    button.addEventListener('click', function () {
                        // Tambahkan logika sesuai kebutuhan
                        console.log('Bulan dipilih:', month);
                    });
                    monthContainer.appendChild(button);
                });
            }

            // Load machines data when the page loads
            axios.get('http://127.0.0.1:8000/api/showcodeline2')
                .then(function (response) {
                    const machines = response.data.machines;
                    showLineSelection(machines);
                })
                .catch(function (error) {
                    console.error('Error fetching data:', error);
                });
        });
    </script>


</div>
</body>
</html>
