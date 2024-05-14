<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/pjl/dashboard.css')
</head>
<body class="bg-gray-100">
<div class="container mx-auto">
    <div class="card">
        <!-- Tampilkan Nama Line Jika Diperlukan -->
    </div>
    <div class="weeks-container flex">
        <!-- Tampilkan Tahun -->
        <button class="year-item bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2" onclick="setSelectedYear(2021)">2021</button>
        <!-- Tambah Tahun Baru -->
        <button class="add-year-btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="setModalYearOpen(true)">+ Add Year</button>
        <!-- Modal Tambah Tahun -->
        <div id="modalYear" class="modal hidden fixed w-full h-full top-0 left-0 flex items-center justify-center">
            <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
            <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                <div class="modal-content py-4 text-left px-6">
                    <div class="modal-header flex justify-between items-center pb-3">
                        <p class="text-2xl font-bold">Add Year</p>
                        <button class="modal-close" onclick="setModalYearOpen(false)">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p class="pb-2">Year:</p>
                        <select id="yearSelect" class="form-select w-full border rounded p-2">
                            <option value="" disabled selected>Choose here</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                        </select>
                    </div>
                    <div class="modal-footer justify-end pt-2">
                        <button class="modal-close bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="handleYearOk()">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tampilkan Summary Container Jika Tahun Dipilih -->
    <div id="summaryContainer" class="summary-container">
        <!-- Tampilkan Bulan dan Minggu -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // State
        let modalYearOpen = false;
        let selectedYear = null;
        let years = [];
        let selectedMonth = null;
        let months = {};

        // Axios
        const fetchData = async () => {
            try {
                const response = await axios.get('http://127.0.0.1:8000/api/showcodeline2');
                const operationData = response.data;

                // Pastikan operationData adalah array sebelum menggunakan map()
                if (Array.isArray(operationData)) {
                    const uniqueYears = Array.from(new Set(operationData.map(item => item.year)));
                    years = uniqueYears;

                    const uniqueMonths = {};
                    uniqueYears.forEach(year => {
                        uniqueMonths[year] = [];
                    });

                    operationData.forEach(item => {
                        if (item.month !== null) {
                            if (!uniqueMonths[item.year][item.month]) {
                                uniqueMonths[item.year][item.month] = new Set();
                            }
                            uniqueMonths[item.year][item.month].add(item.week);
                        }
                    });

                    Object.keys(uniqueMonths).forEach(year => {
                        Object.keys(uniqueMonths[year]).forEach(month => {
                            uniqueMonths[year][month] = Array.from(uniqueMonths[year][month]);
                        });
                    });

                    months = uniqueMonths;
                    render();
                } else {
                    console.error('Data fetched is not an array:', operationData);
                }
            } catch (error) {
                console.error('Error fetching operation data:', error);
            }
        };

        // Render Function
        const render = () => {
            const yearsContainer = document.querySelector('.weeks-container');
            yearsContainer.innerHTML = '';
            years.sort((a, b) => a - b).forEach(year => {
                const yearButton = document.createElement('button');
                yearButton.className = "year-item bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2";
                yearButton.textContent = year;
                yearButton.onclick = () => setSelectedYear(year);
                yearsContainer.appendChild(yearButton);
            });

            const summaryContainer = document.getElementById('summaryContainer');
            summaryContainer.innerHTML = '';
            if (selectedYear !== null) {
                for (let monthNumber = 1; monthNumber <= 12; monthNumber++) {
                    const monthLink = document.createElement('a');
                    monthLink.href = `/add-week/${selectedYear}/${monthNumber}`;
                    const monthDiv = document.createElement('div');
                    monthDiv.className = "month-item cursor-pointer";
                    monthDiv.onclick = () => setSelectedMonth(monthNumber);
                    monthDiv.textContent = monthNames[monthNumber];
                    if (months[selectedYear] && months[selectedYear][monthNumber]) {
                        const weekP = document.createElement('p');
                        weekP.className = "isi-week-bulan";
                        weekP.textContent = `Week : ${months[selectedYear][monthNumber].join(', Week : ')}`;
                        monthDiv.appendChild(weekP);
                    }
                    monthLink.appendChild(monthDiv);
                    summaryContainer.appendChild(monthLink);
                }
            }
        };

        // Handle OK Button for Modal
        const handleYearOk = () => {
            const yearSelect = document.getElementById('yearSelect');
            const selectedYearValue = parseInt(yearSelect.value);
            if (selectedYearValue !== null && !years.includes(selectedYearValue)) {
                years.push(selectedYearValue);
                localStorage.setItem('selectedYears', JSON.stringify(years));
                months[selectedYearValue] = [];
                render();
            } else {
                // Year already exists or invalid year value
                // Add logging or display error message here if needed
            }
            setModalYearOpen(false);
        };

        // Set Modal Year Open
        const setModalYearOpen = (isOpen) => {
            modalYearOpen = isOpen;
            const modalYear = document.getElementById('modalYear');
            if (isOpen) {
                modalYear.classList.remove('hidden');
            } else {
                modalYear.classList.add('hidden');
            }
        };

        // Set Selected Year
        const setSelectedYear = (year) => {
            selectedYear = year;
            render();
        };

        // Set Selected Month
        const setSelectedMonth = (month) => {
            selectedMonth = month;
        };

        // Objek yang memetakan angka bulan ke nama bulan dalam bahasa Indonesia
        const monthNames = {
            1: 'Januari',
            2: 'Februari',
            3: 'Maret',
            4: 'April',
            5: 'Mei',
            6: 'Juni',
            7: 'Juli',
            8: 'Agustus',
            9: 'September',
            10: 'Oktober',
            11: 'November',
            12: 'Desember',
        };

        // Panggil fetchData saat halaman dimuat
        window.onload = () => {
            fetchData();
            // Ambil data tahun yang disimpan di local storage saat halaman dimuat
            const storedYears = JSON.parse(localStorage.getItem('selectedYears'));
            if (storedYears) {
                years = storedYears;
            }
            render();
        };
    </script>

</div>


</body>
</html>
