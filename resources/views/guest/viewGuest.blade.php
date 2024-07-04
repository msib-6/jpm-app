<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/tailwind.min.css') }}" rel="stylesheet">
    <title>Machine Schedule Display</title>
    @vite('resources/css/pjl/view.css')
    <style>
        .day-column {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start; /* Align items at the top */
            gap: 0.5rem;
        }

        .entry-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
        }
    </style>
</head>
<body>

    <div class="container mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="flex ml-16 mt-3" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="/guest/dashboard" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5 ml-2 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="/guest/dashboard" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                            Line
                        </a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="/guest/dashboard" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                            Year
                        </a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="/guest/dashboard" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                            Month
                        </a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="/guest/view" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                            View
                        </a>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Card Title -->
        <div class="bg-white p-6 opacity-75 rounded-3xl shadow-2xl my-4 mx-auto flex items-center justify-between" style="width: 91.666667%;">
            <h3 id="title" class="text-2xl font-bold">
                <span id="line-display">Loading...</span>
            </h3>
            <!-- Container for buttons, each week's button will be appended here -->
            <div id="weeksList" class="mx-2">
                <!-- Buttons for each week will be dynamically inserted here -->
            </div>
            <h3 class="text-2xl font-bold">
                <span id="month-display">Loading...</span> <span id="year-display">Loading...</span>
            </h3>
        </div>

        <!-- Weeks Container -->
        <div class="bg-white opacity-75 p-6 rounded-3xl shadow-2xl my-4 mx-auto flex justify-between items-center" style="width: 91.666667%;" id="weeksList">
            <!-- Buttons for each week will be appended here -->
        </div>

        <!-- Header for Days -->
        <div class="header-days bg-white opacity-75 p-6 rounded-3xl shadow-2xl my-4 mx-auto" style="width: 91.666667%; display: none;" id="headerDays">
            <div class="grid grid-cols-10 gap-4 text-center font-semibold">
                <div class="flex font-bold items-center justify-center col-span-2 text-xl">Mesin</div>
                <!-- Dynamic date headers -->
                <div id="day1" class="flex flex-col justify-center items-center"><span class="font-bold">Senin</span><span style="font-size: 12px;">Date 1</span></div>
                <div id="day2" class="flex flex-col justify-center items-center"><span class="font-bold">Selasa</span><span style="font-size: 12px;">Date 2</span></div>
                <div id="day3" class="flex flex-col justify-center items-center"><span class="font-bold">Rabu</span><span style="font-size: 12px;">Date 3</span></div>
                <div id="day4" class="flex flex-col justify-center items-center"><span class="font-bold">Kamis</span><span style="font-size: 12px;">Date 4"></span></div>
                <div id="day5" class="flex flex-col justify-center items-center"><span class="font-bold">Jumat</span><span style="font-size: 12px;">Date 5"></span></div>
                <div id="day6" class="flex flex-col justify-center items-center"><span class="font-bold">Sabtu</span><span style="font-size: 12px;">Date 6"></span></div>
                <div id="day7" class="flex flex-col justify-center items-center"><span class="font-bold">Minggu</span><span style="font-size: 12px;">Date 7"></span></div>
                <div id="day8" class="flex flex-col justify-center items-center"><span class="font-bold">Senin</span><span style="font-size: 12px;">Date 8"></span></div>
            </div>
        </div>

        <!-- Data Container -->
        <div id="dataContainer" class="bg-white opacity-75 p-6 rounded-3xl shadow-2xl my-4 mx-auto" style="width: 91.666667%;">
            <div class="grid grid-cols-10 gap-4">
                <div class="font-bold items-center justify-center col-span-2 text-xl">Mesin</div>
                <!-- Column placeholders -->
                <div class="day-column"></div>
                <div class="day-column"></div>
                <div class="day-column"></div>
                <div class="day-column"></div>
                <div class="day-column"></div>
                <div class="day-column"></div>
                <div class="day-column"></div>
                <div class="day-column"></div>
            </div>
        </div>

        <!-- Button to download PDF -->
        <div class="text-center my-4">
            <button onclick="downloadPDF()" class="text-white bg-gradient-to-r mr-16 from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-3 py-2.5 flex items-center float-right">
                <svg class="w-6 h-6 mr-1 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2m-8 1V4m0 12-4-4m4 4 4-4"/>
                </svg>
                Download PDF
            </button>
        </div>
    </div>

    <script src="{{ asset('js/dayjs.min.js') }}"></script>
    <script src="{{ asset('js/dayjs-id.js') }}"></script>
    <script src="{{ asset('js/locale-Data.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/jspdf.umd.min.js') }}"></script>
    <script src="{{ asset('js/jspdf.plugin.autotable.min.js') }}"></script>
    <script>
        const { jsPDF } = window.jspdf;

        document.addEventListener("DOMContentLoaded", function () {
            // initialize the page
            const urlParams = new URLSearchParams(window.location.search);
            const line = urlParams.get('line');
            const year = urlParams.get('year');
            const month = urlParams.get('month');
            const week = urlParams.get('week');

            fetchWeeks(line, year, month, week);

            // Add event listener for download button
            document.getElementById('downloadPDFButton').addEventListener('click', downloadPDF);
        });

        async function fetchWeeks(line, year, month, week) {
            try {
                const response = await axios.get(`/api/v1/weeks?line=${line}&year=${year}&month=${month}`);
                const weeks = response.data;

                displayWeeks(weeks, line, year, month, week);
            } catch (error) {
                console.error('Error fetching weeks:', error);
            }
        }

        async function fetchMachineSchedule(line, year, month, week) {
            try {
                const response = await axios.get(`/api/v1/schedule?line=${line}&year=${year}&month=${month}&week=${week}`);
                const schedule = response.data;

                displaySchedule(schedule);
            } catch (error) {
                console.error('Error fetching schedule:', error);
            }
        }

        function displayWeeks(weeks, line, year, month, selectedWeek) {
            const weeksList = document.getElementById('weeksList');
            weeksList.innerHTML = '';

            weeks.forEach(week => {
                const button = document.createElement('button');
                button.textContent = `Week ${week.number}`;
                button.classList.add('mx-1', 'px-2', 'py-1', 'rounded', selectedWeek == week.number ? 'bg-blue-600' : 'bg-gray-200');

                button.addEventListener('click', () => {
                    fetchMachineSchedule(line, year, month, week.number);
                    highlightSelectedWeek(week.number);
                });

                weeksList.appendChild(button);
            });
        }

        function displaySchedule(schedule) {
            const daysContainer = document.getElementById('headerDays');
            const dataContainer = document.getElementById('dataContainer');

            // Populate header with dates
            for (let i = 1; i <= 8; i++) {
                document.getElementById(`day${i}`).querySelector('span:last-child').textContent = schedule.dates[i - 1];
            }

            // Populate schedule data
            const columns = dataContainer.querySelectorAll('.day-column');
            columns.forEach((column, columnIndex) => {
                column.innerHTML = '';
                schedule.data.forEach(row => {
                    const entry = row[columnIndex];
                    const button = document.createElement('button');
                    button.textContent = entry.text;
                    button.classList.add('entry-button', 'bg-gray-300', 'rounded');

                    column.appendChild(button);
                });
            });

            daysContainer.style.display = 'block';
        }

        function highlightSelectedWeek(week) {
            const weeksList = document.getElementById('weeksList');
            weeksList.querySelectorAll('button').forEach(button => {
                button.classList.toggle('bg-blue-600', button.textContent.includes(`Week ${week}`));
                button.classList.toggle('bg-gray-200', !button.textContent.includes(`Week ${week}`));
            });
        }

        function downloadPDF() {
            const doc = new jsPDF();

            // Add title
            doc.text('Machine Schedule', 20, 10);

            // Get schedule data
            const scheduleData = [];
            const rows = document.querySelectorAll('.day-column');
            rows.forEach((row, rowIndex) => {
                const rowData = [];
                row.querySelectorAll('button').forEach(button => {
                    rowData.push(button.textContent);
                });
                scheduleData.push(rowData);
            });

            // Add table to PDF
            doc.autoTable({
                head: [['Machine', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Next Monday']],
                body: scheduleData,
            });

            // Save the PDF
            doc.save('machine_schedule.pdf');
        }
    </script>
</body>
</html>
