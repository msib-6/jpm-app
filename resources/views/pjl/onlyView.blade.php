<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Jost:ital,wght@0,100..900;1,100..900&family=Poppins:wght@400;600;700&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <title>Machine Schedule Display</title>
    @vite('resources/css/pjl/view.css')
</head>
<body>
<div class="container mx-auto px-4">
    <!-- Breadcrumb -->
    <nav class="flex ml-16 mt-3" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="/pjl/{{ ucfirst($line) }}/dashboard" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="w-3 h-3 me-2.5 ml-2 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 1 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                    </svg>
                    Home
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <a href="/pjl/view" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">PJL</a>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Card Title -->
    <div class="bg-white opacity-75 p-6 rounded-3xl shadow-2xl my-4 mx-auto flex items-center justify-between" style="width: 91.666667%;">
        <h3 id="title" class="text-2xl font-bold">
            <span id="line-display">Loading...</span>
        </h3>
        <div id="weeksList" class="mx-2">
            <!-- Buttons for each week will be dynamically inserted here -->
        </div>
        <h3 class="text-2xl font-bold">
            <span id="month-display">Loading...</span> <span id="year-display">Loading...</span>
        </h3>
    </div>

    <!-- Header for Days -->
    <div class="header-days bg-white opacity-75 p-6 rounded-3xl shadow-2xl my-4 mx-auto" style="width: 91.666667%; display: none;" id="headerDays">
        <div class="grid grid-cols-10 gap-4 text-center font-semibold">
            <div class="flex font-bold items-center justify-center col-span-2 text-xl">Mesin</div>
            <!-- Dynamic date headers -->
            <div id="day1" class="flex flex-col justify-center items-center"><span class="font-bold">Senin</span><span style="font-size: 12px;">Date 1</span></div>
            <div id="day2" class="flex flex-col justifycenter items-center"><span class="font-bold">Selasa</span><span style="font-size: 12px;">Date 2"></span></div>
            <div id="day3" class="flex flex-col justify-center items-center"><span class="font-bold">Rabu</span><span style="font-size: 12px;">Date 3"></span></div>
            <div id="day4" class="flex flex-col justify-center items-center"><span class="font-bold">Kamis</span><span style="font-size: 12px;">Date 4"></span></div>
            <div id="day5" class="flex flex-col justify-center items-center"><span class="font-bold">Jumat</span><span style="font-size: 12px;">Date 5"></span></div>
            <div id="day6" class="flex flex-col justify-center items-center"><span class="font-bold">Sabtu</span><span style="font-size: 12px;">Date 6"></span></div>
            <div id="day7" class="flex flex-col justify-center items-center"><span class="font-bold">Minggu</span><span style="font-size: 12px;">Date 7"></span></div>
            <div id="day8" class="flex flex-col justify-center items-center"><span class="font-bold">Senin</span><span style="font-size: 12px;">Date 8"></span></div>
        </div>
    </div>

    <!-- Data Container -->
    <div id="dataContainer" class="bg-white opacity-75 p-6 rounded-3xl shadow-2xl my-4 mx-auto" style="width: 91.666667%;">
        <!-- Dynamic rows for machines will be appended here -->
    </div>

    <!-- Global Description Container -->
    <div id="globalDescContainer" class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto flex flex-col items-center" style="width: 91.666667%;">
        <h1 class="font-bold text-2xl mb-4">
            Description
        </h1>
        <!-- Dynamic rows for Global Desc will be appended here -->
        <div id="globalDescs" class="flex flex-col items-center w-full">
            <!-- Descriptions will be dynamically inserted here -->
        </div>
    </div>

    <!--  Button Bawah  -->
    <div class="my-4 mx-auto flex flex-col" style="width: 91.666667%;">
        <div class="flex justify-between items-center">
            <div class="flex justify-start">
                <button class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 mr-2">History</button>
            </div>
            <div class="flex justify-end">
                <button id="editWeekButton" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Edit</button>
            </div>
        </div>
    </div>

    <!-- Modal Confirm Delete -->
    <div id="confirmDeleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-lg">
            <h2 class="text-2xl mb-4">Confirm Delete</h2>
            <p id="deleteConfirmMessage" class="mb-4">Are you sure you want to delete this item?</p>
            <div class="flex justify-between items-center">
                <button type="button" id="closeConfirmDeleteModalButton" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 mr-2">Cancel</button>
                <button type="button" id="confirmDeleteButton" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Delete</button>
            </div>
        </div>
    </div>

    <!-- Custom Alert Modal -->
    <div id="custom-alert" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
            <h2 class="text-xl font-bold mb-4">PJM Says</h2>
            <p id="custom-alert-message" class="mb-4">This is a custom alert message.</p>
            <div class="flex justify-between items-end">
                <button onclick="closeAlert()" class="justify-end bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Close</button>
            </div>
        </div>
    </div>

    <!-- History Modal -->
    <div id="historyModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-3xl">
            <h2 class="text-2xl mb-4">History</h2>
            <div id="historyContent" class="mb-4 overflow-y-auto" style="max-height: 450px;">
                <!-- History content will be populated here -->
            </div>
            <div class="flex justify-end">
                <button type="button" id="closeHistoryModalButton" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 mr-2">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showAlert(message) {
        document.getElementById('custom-alert-message').textContent = message;
        document.getElementById('custom-alert').classList.remove('hidden');
    }

    function closeAlert() {
        document.getElementById('custom-alert').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function() {
        const editWeekButton = document.getElementById('editWeekButton');
        const addDataModal = document.getElementById('addDataModal');
        const globalDescs = document.getElementById('globalDescs');
        const historyButton = document.getElementById('historyButton');
        const historyModal = document.getElementById('historyModal');
        const closeHistoryModalButton = document.getElementById('closeHistoryModalButton');
        const historyContent = document.getElementById('historyContent');
        let currentMachineId;
        let currentDay;
        let currentMonth;
        let currentYear;

        getQueryParams();
        setupAutoRefresh();
        checkIsSentStatus();

        async function checkIsSentStatus() {
            const pathSegments = window.location.pathname.split('/');
            const line = pathSegments[2];
            const params = new URLSearchParams(window.location.search);
            const month = params.get('month');
            const week = params.get('week');
            const year = params.get('year');

            const response = await fetch(`http://127.0.0.1:8000/api/showmachineoperation?line=${line}&year=${year}&month=${month}&week=${week}`);
            const operations = await response.json();

            if (operations.some(operation => operation.is_sent === 1)) {
                editWeekButton.style.display = 'none';
            }
        }

        function viewGlobalDescription(desc) {
            globalDescContent.textContent = desc.description;
            currentGlobalDescId = desc.id;
            viewGlobalDescModal.classList.remove('hidden');
        }

        async function fetchAndDisplayGlobalDescriptions() {
            const params = new URLSearchParams(window.location.search);
            const line = window.location.pathname.split('/')[2];
            const month = params.get('month');
            const week = params.get('week');
            const year = params.get('year');

            const response = await fetch(`http://127.0.0.1:8000/api/showglobaldescription`);
            const descriptions = await response.json();

            const filteredDescriptions = descriptions.filter(desc => {
                return desc.line === line && desc.month === month && desc.week === week && desc.year === year;
            });

            globalDescs.innerHTML = ''; // Clear existing descriptions

            filteredDescriptions.forEach(desc => {
                const descButton = document.createElement('button');
                descButton.className = 'my-2 bg-white descWeek p-2 shadow-md rounded-md py-1 px-2 text-black items-center flex justify-center w-full';
                descButton.style.width = '90%';
                descButton.textContent = desc.description;
                descButton.onclick = function() {
                    viewGlobalDescription(desc);
                };
                globalDescs.appendChild(descButton);
            });
        }

        function getQueryParams() {
            const pathSegments = window.location.pathname.split('/');
            const line = pathSegments[2];
            const params = new URLSearchParams(window.location.search);
            const month = params.get('month');
            const year = params.get('year');

            document.getElementById('line-display').textContent = line ? line.replace('Line', 'Line ') : 'N/A';
            document.getElementById('month-display').textContent = month ? getMonthName(month) : 'N/A';
            document.getElementById('year-display').textContent = year ? year : 'N/A';

            setupWeekButtons(line, year, month);
        }

        async function fetchDataForWeek(line, year, month, week) {
            let operationsUrls = [];
            let machinesUrls = [];
            let machineInfoUrls = [];

            if (week === "1") {
                const prevMonth = (month - 1 === 0) ? 12 : month - 1;
                const prevYear = (month - 1 === 0) ? year - 1 : year;

                operationsUrls = [
                    `http://127.0.0.1:8000/api/showmachineoperation?line=${line}&year=${year}&month=${month}&week=${week}`,
                    `http://127.0.0.1:8000/api/showmachineoperation?line=${line}&year=${prevYear}&month=${prevMonth}&week=5`,
                    `http://127.0.0.1:8000/api/showmachineoperation?line=${line}&year=${prevYear}&month=${prevMonth}&week=6`
                ];

                machinesUrls = [
                    `http://127.0.0.1:8000/api/showweeklymachine?line=${line}&year=${year}&month=${month}&week=${week}`,
                    `http://127.0.0.1:8000/api/showweeklymachine?line=${line}&year=${prevYear}&month=${prevMonth}&week=5`,
                    `http://127.0.0.1:8000/api/showweeklymachine?line=${line}&year=${prevYear}&month=${prevMonth}&week=6`
                ];

                machineInfoUrls = [
                    `http://127.0.0.1:8000/api/showmachine`
                ];
            } else {
                operationsUrls = [
                    `http://127.0.0.1:8000/api/showmachineoperation?line=${line}&year=${year}&month=${month}&week=${week}`
                ];

                machinesUrls = [
                    `http://127.0.0.1:8000/api/showweeklymachine?line=${line}&year=${year}&month=${month}&week=${week}`
                ];

                machineInfoUrls = [
                    `http://127.0.0.1:8000/api/showmachine`
                ];
            }

            try {
                const [operationsResponses, machinesResponses, machineInfoResponse] = await Promise.all([
                    Promise.all(operationsUrls.map(url => fetch(url))),
                    Promise.all(machinesUrls.map(url => fetch(url))),
                    fetch(machineInfoUrls[0])
                ]);

                let operationsData = [];
                for (const response of operationsResponses) {
                    const data = await response.json();
                    operationsData = operationsData.concat(data.operations);
                }

                let machinesData = [];
                for (const response of machinesResponses) {
                    const data = await response.json();
                    machinesData = machinesData.concat(data);
                }

                const machineInfoData = await machineInfoResponse.json();

                const machineInfoMap = new Map(machineInfoData.map(machine => [machine.id, machine.category || 'Unknown'])); // Fallback to 'Unknown' if category is empty

                updateURL(line, year, month, week);
                displayMachineData(operationsData, machinesData, machineInfoMap, week);
                await fetchAndDisplayGlobalDescriptions(); // Fetch and display global descriptions for the selected week
            } catch (error) {
                console.error("Error fetching data:", error);
            }
        }

        function updateURL(line, year, month, week) {
            history.pushState({}, '', `?year=${year}&month=${month}&week=${week}`);
        }

        function displayMachineData(operations, machines, machineInfoMap, week) {
            const dataContainer = document.getElementById('dataContainer');
            dataContainer.innerHTML = '';  // Clear existing rows

            // Create a map for machine operations
            const machineOperationsMap = new Map();
            operations.forEach(operation => {
                if (!machineOperationsMap.has(operation.machine_id)) {
                    machineOperationsMap.set(operation.machine_id, []);
                }
                machineOperationsMap.get(operation.machine_id).push(operation);
            });

            // Sort machines by specified categories
            const categoryOrder = ['Granulasi', 'Drying', 'Final mix/camas', 'kompaksi', 'Cetak', 'Coating', 'Mixing', 'Filling', 'Kemas'];
            machines.sort((a, b) => {
                const categoryA = machineInfoMap.get(a.machine_id) || 'Unknown';
                const categoryB = machineInfoMap.get(b.machine_id) || 'Unknown';
                return categoryOrder.indexOf(categoryA) - categoryOrder.indexOf(categoryB);
            });

            machines.forEach(machine => {
                const category = machineInfoMap.get(machine.machine_id);  // Fetch category using machine_id

                const machineRow = document.createElement('div');
                machineRow.className = 'grid grid-cols-10 gap-4 mb-2';
                machineRow.innerHTML = `
                    <div class="font-bold border-2 mesin-jpm p-2 row-span-3 col-span-2 flex items-center justify-center text-center" style="height: 90%;">
                        <div class="flex flex-col justify-center items-center w-full h-full">
                            <span class="inline-flex items-center ${category === 'Granulasi' ? 'custom-badge1' : category === 'Drying' ? 'custom-badge2' : category.includes('Final') ? 'custom-badge3' : category === 'Cetak' ? 'custom-badge4' : category === 'Coating' ? 'custom-badge5' : category === 'Kemas' ? 'custom-badge6' : category === 'Mixing' ? 'custom-badge7' : category === 'Filling' ? 'custom-badge8' : category === 'Kompaksi' ? 'custom-badge9' : ''} text-white text-xs font-medium px-2.5 py-0.5 rounded-full mb-1">
                                <span class="w-2 h-2 mr-1 bg-white rounded-full"></span>
                                ${category}
                            </span>
                            <span>${machine.machine_name}</span>
                        </div>
                    </div>
                `;

                // Add day columns based on header days
                for (let i = 1; i <= 8; i++) {
                    const headerDate = document.getElementById(`day${i}`).children[1].textContent.trim();
                    const dateParts = headerDate.split(' ');
                    const day = parseInt(dateParts[0]);
                    const dayColumn = document.createElement('div');
                    dayColumn.id = `daydata${machine.id}-${day}`;
                    dayColumn.className = 'col-span-1 day-column';
                    machineRow.appendChild(dayColumn);
                }

                dataContainer.appendChild(machineRow);

                // Sort machine operations by time in ascending order, with "PM" status given priority
                const machineOperations = machineOperationsMap.get(machine.id) || [];
                machineOperations.sort((a, b) => {
                    if (a.status === 'PM') return -1;
                    if (b.status === 'PM') return 1;
                    const [hoursA, minutesA] = a.time.split(':').map(Number);
                    const [hoursB, minutesB] = b.time.split(':').map(Number);
                    return hoursA * 60 + minutesA - (hoursB * 60 + minutesB);
                });

                machineOperations.forEach(operation => {
                    const dayColumn = document.getElementById(`daydata${machine.id}-${operation.day}`);

                    if (dayColumn) {
                        const entry = document.createElement('button');
                        const statusClass = {
                            'PM': 'status-pm',
                            'BCP': 'status-bcp',
                            'OFF': 'status-off',
                            'CUSU': 'status-cusu',
                            'DHT': 'status-dht',
                            'CHT': 'status-cht',
                            'KALIBRASI': 'status-kalibrasi',
                            'OVERHAUL': 'status-overhaul',
                            'CV': 'status-cv',
                            'CPV': 'status-cpv'
                        }[operation.status] || '';  // Gunakan kelas sesuai status atau kelas kosong jika tidak ada

                        entry.className = `p-2 border-2 text-xs flex flex-col justify-center isi-jpm text-center entry-button relative ${statusClass}`;
                        entry.style.minHeight = '6em'; // Set the height to 6em

                        entry.innerHTML = operation.status && ['PM', 'BCP', 'OFF', 'CUSU', 'DHT', 'CHT', 'KALIBRASI', 'OVERHAUL', 'CV', 'CPV'].includes(operation.status) ? `
                            <p class="status-only">${operation.status}</p>
                            ${operation.notes ? `<span class="absolute top-0 right-0 w-2 h-2 bg-yellow-500 rounded-full"></span>` : ''}
                        ` : `
                            <p><strong>${operation.code}</strong></p>
                            <p>${operation.time}</p>
                            ${operation.status ? `<p class="text-green-600">${operation.status}</p>` : ''}
                            ${operation.notes ? `<span class="absolute top-0 right-0 w-2 h-2 bg-yellow-500 rounded-full"></span>` : ''}
                        `;
                        entry.onmouseenter = function(event) {
                            if (operation.notes) {
                                showNotesPopup(event, `Line: ${operation.current_line}\nNotes: ${operation.notes}`);
                            } else {
                                showNotesPopup(event, `Line: ${operation.current_line}`);
                            }
                        };
                        entry.onmouseleave = function() {
                            hideNotesPopup();
                        };
                        entry.onclick = function() {
                            openEditModal(operation);
                        };

                        dayColumn.appendChild(entry);
                    }
                });

                // Add onclick event to view machine data modal
                machineRow.querySelector('.mesin-jpm').onclick = function() {
                    viewMachineData(machine);
                };
            });
        }

        function showNotesPopup(event, notes) {
            const popup = document.createElement('div');
            popup.className = 'notes-popup';
            popup.innerHTML = notes.split('\n').map(line => `<strong>${line.split(':')[0]}</strong>: ${line.split(':')[1]}`).join('<br>');
            document.body.appendChild(popup);
            const rect = event.target.getBoundingClientRect();
            popup.style.top = `${rect.top + window.scrollY}px`;
            popup.style.left = `${rect.right + 5 + window.scrollX}px`;
        }

        function hideNotesPopup() {
            const popup = document.querySelector('.notes-popup');
            if (popup) {
                popup.remove();
            }
        }

        function getMonthName(month) {
            const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            return monthNames[month - 1];
        }

        function getMonthNumber(monthName) {
            const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            return monthNames.indexOf(monthName) + 1;
        }

        function setupWeekButtons(line, year, month) {
            const weeksList = document.getElementById('weeksList');
            weeksList.innerHTML = '';  // Clear existing buttons

            // Get the start and end dates of the month
            const startDate = new Date(year, month - 1, 1);

            // Adjust the startDate to the previous Monday if it does not start on a Monday
            if (startDate.getDay() !== 1) {
                while (startDate.getDay() !== 1) {
                    startDate.setDate(startDate.getDate() + 1);
                }
                startDate.setDate(startDate.getDate() - 7); // Go back 7 days to get the Monday of the previous week
            }

            let currentDate = new Date(startDate);
            let weeks = [];
            let week = [formatDate(currentDate)]; // Start the first week with the adjusted or found Monday

            currentDate.setDate(currentDate.getDate() + 1); // Move to the next day

            // Loop through the days, ensuring each week runs from Monday to the following Monday
            while (true) {
                week.push(formatDate(currentDate)); // Add the current day to the current week

                if (currentDate.getDay() === 1 && week.length > 1) { // If it's Monday and not the first iteration
                    weeks.push(week); // Complete the current week
                    week = [formatDate(currentDate)]; // Start a new week with this Monday
                }
                currentDate.setDate(currentDate.getDate() + 1); // Move to the next day

                // Break the loop if we've moved into the next month
                if (currentDate.getMonth() !== month - 1 && currentDate.getDay() === 1) {
                    break;
                }
            }

            // Ensure the last week runs until the next Monday
            while (currentDate.getDay() !== 1) { // Move to the last Monday of the month
                week.push(formatDate(currentDate));
                currentDate.setDate(currentDate.getDate() + 1);
            }
            week.push(formatDate(currentDate)); // Add the final Monday

            if (week.length > 1) {
                weeks.push(week);
            }

            // Create buttons for each week
            weeks.forEach((week, index) => {
                const weekButton = document.createElement('button');
                weekButton.textContent = `Week ${index + 1}`;
                weekButton.className = 'year-item text-black rounded-xl ml-1 text-xl px-2.5 py-2.5 cursor-pointer h-auto border-0 hover:text-purple-600 focus:text-purple-600';
                weekButton.onclick = () => {
                    fetchDataForWeek(line, year, month, index + 1);
                    updateURL(line, year, month, index + 1);
                    document.querySelectorAll('.year-item').forEach(btn => btn.classList.remove('text-purple-600'));
                    weekButton.classList.add('text-purple-600');
                    displayWeek(week);
                };
                weeksList.appendChild(weekButton);
            });

            // Automatically click the first week button
            if (weeksList.children.length > 0) {
                weeksList.children[0].click(); // Using children[0] to ensure it's an element
            }
        }

        function formatDate(date) {
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            return `${days[date.getDay()]}, ${date.getDate()} ${getMonthName(date.getMonth() + 1)} ${date.getFullYear()}`;
        }

        function getWeekNumber(date) {
            const firstDayOfYear = new Date(date.getFullYear(), 0, 1);
            const pastDaysOfYear = (date - firstDayOfYear) / 86400000;
            return Math.ceil((pastDaysOfYear + firstDayOfYear.getDay() + 1) / 7);
        }

        function displayWeek(dates) {
            // Show the header days when a week is displayed
            document.getElementById('headerDays').style.display = 'block';

            dates.forEach((date, index) => {
                if (index < 8) { // Ensure we only update the 8 days
                    const dayElement = document.getElementById(`day${index + 1}`);
                    const dateParts = date.split(" ");
                    dayElement.children[0].textContent = dateParts[0]; // Day name
                    dayElement.children[1].textContent = `${dateParts[1]} ${dateParts[2]} ${dateParts[3]}`; // Full date
                }
            });
        }

        function setupAutoRefresh() {
            setInterval(() => {
                const pathSegments = window.location.pathname.split('/');
                const line = pathSegments[2];
                const params = new URLSearchParams(window.location.search);
                const month = params.get('month');
                const week = params.get('week');
                const year = params.get('year');

                if (line && month && week && year) {
                    fetchDataForWeek(line, year, month, week);
                }
            }, 60000); // Refresh every 60 seconds
        }

        editWeekButton.addEventListener('click', function() {
            const pathSegments = window.location.pathname.split('/');
            const line = pathSegments[2];
            const params = new URLSearchParams(window.location.search);
            const month = params.get('month');
            const week = params.get('week');
            const year = params.get('year');

            if (line && month && week && year) {
                window.location.href = `http://127.0.0.1:8000/pjl/${line}/view?line=${line}&year=${year}&month=${month}&week=${week}`;
            } else {
                showAlert('Error: Missing line, year, month, or week.');
            }
        });


        async function fetchAndDisplayHistory() {
            const params = new URLSearchParams(window.location.search);
            const line = params.get('line');
            const month = params.get('month');
            const week = params.get('week');
            const year = params.get('year');

            try {
                const response = await fetch(`http://127.0.0.1:8000/api/showaudit`);
                const audits = await response.json();

                const filteredAudits = audits.filter(audit => {
                    const newState = audit.changes ? audit.changes.new_state : null;
                    return newState && newState.line === line && newState.month == month && newState.week == week && newState.year == year;
                });

                const historyContent = document.getElementById('historyContent');
                historyContent.innerHTML = ''; // Clear existing content

                filteredAudits.forEach(audit => {
                    const newState = audit.changes ? audit.changes.new_state : null;
                    if (!newState) return;

                    let historyEntry = document.createElement('div');
                    historyEntry.className = 'bg-white p-4 shadow-md rounded-md mb-2';

                    if (newState.day && newState.code && newState.time && newState.status) {
                        historyEntry.innerHTML = `
                            <p>
                                <span><strong>Event:</strong></span>
                                <span style="color: green;">${audit.event}</span>
                            </p>
                            <p>
                                <span><strong>Add</strong></span>
                                <span> data JPM pada Week </span>
                                <span style="color: blue;">${newState.week}</span>,
                                <span style="color: blue;">${newState.day}</span>
                                <span>${getMonthName(newState.month)}</span>
                                <span style="color: blue;">${newState.year}</span>.
                                <span>Kode Ruah: </span>
                                <span style="color: blue;">${newState.code}</span>,
                                <span>Jam: </span>
                                <span style="color: blue;">${newState.time}</span>,
                                <span>Status: </span>
                                <span style="color: blue;">${newState.status}</span>,
                                <span>Notes: </span>
                                <span style="color: blue;">${newState.notes}</span>
                            </p>
                        `;
                    } else if (newState.description) {
                        historyEntry.innerHTML = `
                            <p>
                                <span><strong>Event:</strong></span>
                                <span style="color: green;">${audit.event}</span>
                            </p>
                            <p>
                                <span><strong>Add description</strong></span>
                                <span> pada Week </span>
                                <span style="color: blue;">${newState.week}</span>,
                                <span style="color: blue;">${getMonthName(newState.month)}</span>
                                <span style="color: blue;">${newState.year}</span>.
                                <span>Deskripsi: </span>
                                <span style="color: blue;">${newState.description}</span>
                            </p>
                        `;
                    } else if (newState.machineName) {
                        historyEntry.innerHTML = `
                            <p>
                                <span><strong>Event:</strong></span>
                                <span style="color: green;">${audit.event}</span>
                            </p>
                            <p>
                                <span><strong>Add Mesin Data</strong></span>
                                <span> pada Week </span>
                                <span style="color: blue;">${newState.week}</span>,
                                <span>${getMonthName(newState.month)}</span>
                                <span style="color: blue;">${newState.year}</span>.
                                <span>Nama Mesin : </span>
                                <span style="color: blue;">${newState.machineName}</span>
                            </p>
                        `;
                    } else {
                        historyEntry.innerHTML = `
                            <p><strong>Event:</strong> ${audit.event}</p>
                            <p><strong>Audit ID:</strong> ${audit.audit_id}</p>
                            <p><strong>Machine Operation ID:</strong> ${audit.machineoperation_id}</p>
                            <p><strong>Changes:</strong></p>
                            <pre>${JSON.stringify(audit.changes, null, 2)}</pre>
                        `;
                    }

                    historyContent.appendChild(historyEntry);
                });
            } catch (error) {
                console.error("Error fetching history:", error);
            }
        }
        document.addEventListener('DOMContentLoaded', fetchAndDisplayHistory);
    });

</script>

</body>
</html>
