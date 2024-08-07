<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/guest/dashboard.css')
</head>
<body>
<div class="card h-full">
    <!--begin::Body-->
    <div class="card-body py-0">
        <!--begin::Row-->
        <div class="flex items-center h-100">
            <!--begin::Col-->
            <div class="w-7/12 xl:pl-10 pr-2 ml-8">
                <!-- Bagian 1 -->
                <div id="bagian-1" class="left-section">
                    <!-- Breadcrumb -->
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center mb-2 space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <li class="inline-flex items-center">
                                <a href="/guest/dashboard" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                                    </svg>
                                    <span class="align-middle" style="line-height: 1.5; margin-top: 2px; font-size: 1rem;">Home</span>
                                </a>
                            </li>
                        </ol>
                    </nav>
                    <!-- Breadcrumb -->
                    <div class="text-container">
                        <h3 class="text-4xl mb-8 font-bold">Welcome To JPM View</h3>
                        <h3 class="text-4xl mb-8 font-bold">(Guest Mode)</h3>
                        <p class="text-lg mb-8">Selamat datang di halaman dashboard eksklusif JPM! Di sini, Anda akan menemukan rangkuman yang komprehensif dan terperinci mengenai aktivitas operasional yang vital bagi kesuksesan bisnis Anda. Melalui visualisasi data yang intuitif dan informatif, Anda dapat dengan mudah melacak kinerja operasional, menganalisis tren, dan mengidentifikasi potensi area perbaikan.</p>
                        <button type="button" id="pindah-ke-bagian-2" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 inline-flex items-center">
                            Pilih Line
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </button>
                        <button type="button" onclick="window.location.href='/'" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            Login
                        </button>
                        <button type="button" onclick="window.location.href='/auditlog'" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            Audit Log
                        </button>
                    </div>
                </div>

                <!-- Bagian 2 -->
                <div id="bagian-2" class="left-section hidden">
                    <!-- Breadcrumb -->
                    <nav class="flex " aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <li class="inline-flex items-center">
                                <a href="/guest/dashboard" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                                    </svg>
                                    <span class="align-middle" style="line-height: 1.5; margin-top: 2px; font-size: 1rem;">Home</span>
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <a href="/guest/dashboard" class="align-middle ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white" style="line-height: 1.5; margin-top: 2px; font-size: 1rem;">Line</a>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <!-- Breadcrumb -->
                    <div class="">
                        <h3 class="text-3xl font-bold">PILIH LINE</h3>
                        <div id="line-container">
                            <!-- Line buttons will be populated here -->
                        </div>
                        <div class="logo-container self-start">
                            <button href="#bagian-1" id="kembali-ke-bagian-1" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-12 py-2.5 text-left inline-flex items-center">
                                <svg class="rotate-180 w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                                Back
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Bagian 3 (Choose Year) -->
                <div id="bagian-3" class="left-section hidden">
                    <!-- Breadcrumb -->
                    <nav class="flex " aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <li class="inline-flex items-center">
                                <a href="/guest/dashboard" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                                    </svg>
                                    <span class="align-middle" style="line-height: 1.5; margin-top: 2px; font-size: 1rem;">Home</span>
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <a href="/guest/dashboard" class="align-middle ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white" style="line-height: 1.5; margin-top: 2px; font-size: 1rem;">Line</a>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <!-- Breadcrumb -->
                    <div class=" p-0">
                        <h3 class="text-3xl font-bold">PILIH YEAR</h3>
                        <div id="year-container">
                            <!-- Year buttons will be populated here -->
                        </div>
                        <div class="logo-container self-start">
                            <a href="#bagian-2" id="kembali-ke-bagian-2" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-12 py-2.5 text-left inline-flex items-center">
                                <svg class="rotate-180 w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                                Back
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Bagian 4 (Choose Month) -->
                <div id="bagian-4" class="left-section hidden">
                    <!-- Breadcrumb -->
                    <nav class="flex " aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <li class="inline-flex items-center">
                                <a href="/guest/dashboard" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                                    </svg>
                                    <span class="align-middle" style="line-height: 1.5; margin-top: 2px; font-size: 1rem;">Home</span>
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <a href="/guest/dashboard" class="align-middle ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white" style="line-height: 1.5; margin-top: 2px; font-size: 1rem;">Line</a>
                                </div>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <a href="#" class="align-middle ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white" style="line-height: 1.5; margin-top: 2px; font-size: 1rem;">Year</a>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <a href="/guest/dashboard" class="align-middle ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white" style="line-height: 1.5; margin-top: 2px; font-size: 1rem;">Month</a>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <!-- Breadcrumb -->
                    <div class=" p-0">
                        <h3 class="text-3xl font-bold">PILIH MONTH</h3>
                        <div id="month-container">
                            <!-- Month buttons will be populated here -->
                        </div>
                        <div class="logo-container self-start">
                            <a href="#bagian-3" id="kembali-ke-bagian-3" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-12 py-2.5 text-left inline-flex items-center">
                                <svg class="rotate-180 w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                                Back
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Bagian 5 (Choose Week) -->
                <div id="bagian-5" class="left-section hidden">
                    <!-- Breadcrumb -->
                    <nav class="flex " aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <li class="inline-flex items-center">
                                <a href="/guest/dashboard" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                                    </svg>
                                    <span class="align-middle" style="line-height: 1.5; margin-top: 2px; font-size: 1rem;">Home</span>
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <a href="/guest/dashboard" class="align-middle ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white" style="line-height: 1.5; margin-top: 2px; font-size: 1rem;">Line</a>
                                </div>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <a href="#" class="align-middle ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white" style="line-height: 1.5; margin-top: 2px; font-size: 1rem;">Year</a>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <a href="#" class="align-middle ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white" style="line-height: 1.5; margin-top: 2px; font-size: 1rem;">Month</a>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <a href="#" class="align-middle ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white" style="line-height: 1.5; margin-top: 2px; font-size: 1rem;">Week</a>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <!-- Breadcrumb -->
                    <div class=" p-0">
                        <h3 class="text-3xl font-bold">PILIH WEEK</h3>
                        <div id="week-container">
                            <!-- Week buttons will be populated here -->
                        </div>
                        <div class="logo-container self-start">
                            <a href="#bagian-4" id="kembali-ke-bagian-4" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-12 py-2.5 text-left inline-flex items-center">
                                <svg class="rotate-180 w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                                Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class=" w-7/12 pt-5 lg:pt-15">
                <!--begin::Illustration-->
                <div class="image bg-no-repeat bg-contain bg-right-bottom" style="background-image:url('{{ asset('') }}'); height: 48em; width: 24em;">
                </div>
                <!--begin::Illustration-->
            </div>
            <!--end::Col-->
        </div>
    </div>
</div>
<!--end::Row-->
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let selectedLine = null;
        let selectedYear = null;
        let selectedMonth = null;

        // Helper function to convert month number to Indonesian month name
        function monthName(monthNumber) {
            const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            return monthNames[monthNumber - 1];  // monthNumber - 1 because array is zero-indexed
        }

        // Event listener for 'Pilih Line' button
        document.getElementById('pindah-ke-bagian-2').addEventListener('click', function () {
            document.getElementById('bagian-1').classList.add('hidden');
            document.getElementById('bagian-2').classList.remove('hidden');
            document.getElementById('bagian-3').classList.add('hidden');
            document.getElementById('bagian-4').classList.add('hidden');
            document.getElementById('bagian-5').classList.add('hidden');
            fetchLines();
        });

        // Event listeners for back buttons
        document.getElementById('kembali-ke-bagian-1').addEventListener('click', function() {
            document.getElementById('bagian-2').classList.add('hidden');
            document.getElementById('bagian-1').classList.remove('hidden');
        });

        document.getElementById('kembali-ke-bagian-2').addEventListener('click', function () {
            document.getElementById('bagian-3').classList.add('hidden');
            document.getElementById('bagian-2').classList.remove('hidden');
            if (selectedLine) {
                fetchLines(); // Refetch lines to ensure context remains
            }
        });

        document.getElementById('kembali-ke-bagian-3').addEventListener('click', function () {
            document.getElementById('bagian-4').classList.add('hidden');
            document.getElementById('bagian-3').classList.remove('hidden');
            if (selectedLine && selectedYear) {
                fetchYears(selectedLine); // Refetch years to ensure context remains
            }
        });

        document.getElementById('kembali-ke-bagian-4').addEventListener('click', function () {
            document.getElementById('bagian-5').classList.add('hidden');
            document.getElementById('bagian-4').classList.remove('hidden');
            if (selectedLine && selectedYear && selectedMonth) {
                fetchMonths(selectedLine, selectedYear); // Refetch months to ensure context remains
            }
        });

        // Fetch and display lines
        function fetchLines() {
            axios.get('http://127.0.0.1:8000/api/showapprovedcard')
                .then(function (response) {
                    const lines = new Set(response.data.ApprovedCard.map(card => card.current_line));
                    populateLines(Array.from(lines));
                })
                .catch(function (error) {
                    console.error('Error fetching lines:', error);
                });
        }

        // Populate line buttons
        function populateLines(lines) {
            const lineContainer = document.getElementById('line-container');
            lineContainer.innerHTML = '';
            lines.forEach(line => {
                const button = document.createElement('button');
                button.textContent = line.replace(/(\d+)/g, ' $1'); // Add space before the number
                button.className = 'btn w-48 h-16 text-lg ml-4 mb-4 text-left';
                button.addEventListener('click', () => selectLine(line));
                lineContainer.appendChild(button);
            });
        }

        // Select line and fetch years
        function selectLine(line) {
            selectedLine = line;
            document.getElementById('bagian-2').classList.add('hidden');
            document.getElementById('bagian-3').classList.remove('hidden');
            fetchYears(line);
        }

        // Fetch and display years based on the selected line
        function fetchYears(line) {
            axios.get(`http://127.0.0.1:8000/api/showapprovedcard?line=${line}`)
                .then(function (response) {
                    const years = new Set(response.data.ApprovedCard.filter(card => card.current_line === line).map(card => card.year));
                    populateYears(Array.from(years));
                })
                .catch(function (error) {
                    console.error('Error fetching years:', error);
                });
        }

        // Populate year buttons
        function populateYears(years) {
            const yearContainer = document.getElementById('year-container');
            yearContainer.innerHTML = '';
            years.forEach(year => {
                const button = document.createElement('button');
                button.textContent = year;
                button.className = 'btn w-48 h-16 text-lg ml-4 mb-4 text-left';
                button.addEventListener('click', () => selectYear(year));
                yearContainer.appendChild(button);
            });
        }

        // Select year and fetch months
        function selectYear(year) {
            selectedYear = year;
            document.getElementById('bagian-3').classList.add('hidden');
            document.getElementById('bagian-4').classList.remove('hidden');
            fetchMonths(selectedLine, year);
        }

        // Fetch and display months based on the selected line and year
        function fetchMonths(line, year) {
            axios.get(`http://127.0.0.1:8000/api/showapprovedcard?line=${line}&year=${year}`)
                .then(function (response) {
                    const months = new Set(response.data.ApprovedCard.filter(card => card.current_line === line && card.year === year).map(card => card.month));
                    populateMonths(Array.from(months));
                })
                .catch(function (error) {
                    console.error('Error fetching months:', error);
                });
        }

        // Populate month buttons
        function populateMonths(months) {
            const monthContainer = document.getElementById('month-container');
            monthContainer.innerHTML = '';
            months.forEach(month => {
                const button = document.createElement('button');
                button.textContent = monthName(month);
                button.className = 'btn w-48 h-16 text-lg ml-4 mb-4 text-left';
                button.addEventListener('click', () => selectMonth(month));
                monthContainer.appendChild(button);
            });
        }

        // Select month and fetch weeks
        function selectMonth(month) {
            selectedMonth = month;
            document.getElementById('bagian-4').classList.add('hidden');
            document.getElementById('bagian-5').classList.remove('hidden');
            fetchWeeks(selectedLine, selectedYear, month);
        }

        // Fetch and display weeks based on the selected line, year, and month
        function fetchWeeks(line, year, month) {
            axios.get(`http://127.0.0.1:8000/api/showapprovedcard?line=${line}&year=${year}&month=${month}`)
                .then(function (response) {
                    const weeks = new Set(response.data.ApprovedCard.filter(card => card.current_line === line && card.year === year && card.month === month).map(card => card.week));
                    populateWeeks(Array.from(weeks));
                })
                .catch(function (error) {
                    console.error('Error fetching weeks:', error);
                });
        }

        // Populate week buttons and add click handler to redirect
        function populateWeeks(weeks) {
            const weekContainer = document.getElementById('week-container');
            weekContainer.innerHTML = '';
            weeks.forEach(week => {
                const button = document.createElement('button');
                button.textContent = "Week " + week;
                button.className = 'btn w-48 h-16 text-lg ml-4 mb-4 text-left';
                button.addEventListener('click', () => {
                    window.location.href = `/guest/viewguest?line=${selectedLine}&year=${selectedYear}&month=${selectedMonth}&week=${week}`;
                });
                weekContainer.appendChild(button);
            });
        }
    });
</script>
<script>
    console.clear();
</script>
</div>
</body>
</html>
