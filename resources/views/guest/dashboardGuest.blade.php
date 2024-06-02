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
    <div class="background-guest py-0">
        <!--begin::Row-->
        <div class="container">
            <!-- Bagian 1 -->
            <div class="left-section" id="bagian-1">
                <div class="text-container">
                    <h3 class="text-4xl mb-8 font-bold">Welcome To JPM View (Guest Mode)</h3>
                    <p class="text-lg mb-8">Selamat datang di halaman dashboard eksklusif JPM! Di sini, Anda akan menemukan rangkuman yang komprehensif dan terperinci mengenai aktivitas operasional yang vital bagi kesuksesan bisnis Anda. Melalui visualisasi data yang intuitif dan informatif, Anda dapat dengan mudah melacak kinerja operasional, menganalisis tren, dan mengidentifikasi potensi area perbaikan.</p>
                    <button type="button" id="pindah-ke-bagian-2" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 inline-flex items-center">
                        Pilih Line
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </button>
                    <button type="button" onclick="window.location.href='/summary'" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        History
                    </button>
                </div>
            </div>

            <!-- Bagian 2, 3, dan 4 -->
            <div class="right-section">
                <!-- Bagian 2 -->
                <div id="bagian-2" class="hidden">
                    <div class="p-6">
                        <h3 class="text-3xl mb-8 font-bold">PILIH LINE</h3>
                        <div id="line-container" class="scrollable-container">
                            <!-- Line buttons will be populated here -->
                        </div>
                        <div class="logo-container self-start">
                            <a href="#bagian-1" id="kembali-ke-bagian-1" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 inline-flex items-center">
                                <svg class="rotate-180 w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                                Back
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Bagian 3 -->
                <div id="bagian-3" class="hidden">
                    <div class="p-6">
                        <h3 class="text-3xl mb-8 font-bold">PILIH YEAR</h3>
                        <div id="year-container" class="scrollable-container">
                            <!-- Year buttons will be populated here -->
                        </div>
                        <div class="logo-container self-start">
                            <a href="#bagian-2" id="kembali-ke-bagian-2" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 inline-flex items-center">
                                <svg class="rotate-180 w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                                Back
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Bagian 4 -->
                <div id="bagian-4" class="hidden">
                    <div class="p-6">
                        <h3 class="text-3xl mb-8 font-bold">PILIH MONTH</h3>
                        <div id="month-container" class="scrollable-container">
                            <!-- Month buttons will be populated here -->
                        </div>
                        <div class="logo-container self-start">
                            <a href="#bagian-3" id="kembali-ke-bagian-3" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 inline-flex items-center">
                                <svg class="rotate-180 w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                                Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Row-->
    </div>
</div>


        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let selectedLine = null;
                let selectedYear = null;

                // Helper function to convert month number to Indonesian month name
                function monthName(monthNumber) {
                    const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                    return monthNames[monthNumber - 1];  // monthNumber - 1 because array is zero-indexed
                }

                // Event listener for 'Pilih Line' button
                document.getElementById('pindah-ke-bagian-2').addEventListener('click', function () {
                document.getElementById('bagian-2').classList.remove('hidden');
                document.getElementById('bagian-3').classList.add('hidden');
                document.getElementById('bagian-4').classList.add('hidden');
                document.getElementById('pindah-ke-bagian-2').classList.add('hidden');
                fetchLines();
                });

                // Event listeners for back buttons
                document.getElementById('kembali-ke-bagian-1').addEventListener('click', function () {
                document.getElementById('bagian-2').classList.add('hidden');
                document.getElementById('pindah-ke-bagian-2').classList.remove('hidden');
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

                // Fetch and display lines
                function fetchLines() {
                    axios.get('http://127.0.0.1:8000/api/showallmachineoperationguest')
                        .then(function (response) {
                            const lines = new Set(response.data.operations.map(machine => machine.current_line));
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
                        button.textContent = `${line}`;
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
                    axios.get(`http://127.0.0.1:8000/api/showallmachineoperationguest?line=${line}`)
                        .then(function (response) {
                            const years = new Set(response.data.operations.filter(machine => machine.current_line === line).map(machine => machine.year));
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
                    axios.get(`http://127.0.0.1:8000/api/showallmachineoperationguest?line=${line}&year=${year}`)
                        .then(function (response) {
                            const months = new Set(response.data.operations.filter(machine => machine.current_line === line && machine.year === year).map(machine => machine.month));
                            populateMonths(Array.from(months));
                        })
                        .catch(function (error) {
                            console.error('Error fetching months:', error);
                        });
                }

                // Populate month buttons and add click handler to redirect
                function populateMonths(months) {
                    const monthContainer = document.getElementById('month-container');
                    monthContainer.innerHTML = '';
                    months.forEach(month => {
                        const button = document.createElement('button');
                        button.textContent = monthName(month);
                        button.className = 'btn w-48 h-16 text-lg ml-4 mb-4 text-left';
                        button.addEventListener('click', () => {
                            window.location.href = `/guest/viewGuest?line=${selectedLine}&year=${selectedYear}&month=${month}`;
                        });
                        monthContainer.appendChild(button);
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