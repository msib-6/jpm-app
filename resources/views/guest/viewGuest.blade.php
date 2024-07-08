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
                        <a href="/guest/dashboard" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                            Week
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
        <div class="bg-gray-100 p-6 rounded-3xl shadow-2xl my-4 mx-auto flex items-center justify-between"
             style="width: 91.666667%; backdrop-filter: blur(7px); background-color: rgba(255, 255, 255, 0.5);">
            <h3 id="title" class="text-2xl font-bold">
                <span id="line-display">Loading...</span>
            </h3>
            <!-- Status WEEK "APPROVED", "WAITING APPROVAL", "REJECTED" -->
            <div id="statusWeek" class="mx-2">
                <!-- status week will be dynamically inserted here -->
            </div>

            <!-- Container for buttons, each week's button will be appended here -->
            <div id="weeksList" class="mx-2">
                <!-- Buttons for each week will be inserted here -->
            </div>

            <!-- Revisi keberapa "revision_number" -->
            <div id="revision_number" class="mx-2">
                <!-- revision_number week will be inserted here -->
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
        <div id="dataContainer" class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto" style="width: 91.666667%; backdrop-filter: blur(7px); background-color: rgba(255, 255, 255, 0.5);">
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
            const globalDescs = document.getElementById('globalDescs');
            let currentGlobalDescId;

            getQueryParams();
            setupAutoRefresh();
            checkIsSentStatus();

            async function checkIsSentStatus() {
                const params = new URLSearchParams(window.location.search);
                const line = params.get('line');
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
                const line = params.get('line');
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
                    const descButton = document.createElement('div');
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
                const params = new URLSearchParams(window.location.search);
                const line = params.get('line');
                const month = params.get('month');
                const year = params.get('year');
                const week = params.get('week');

                document.getElementById('line-display').textContent = line ? line.replace('Line', 'Line ') : 'N/A';
                document.getElementById('month-display').textContent = month ? getMonthName(month) : 'N/A';
                document.getElementById('year-display').textContent = year ? year : 'N/A';

                setupWeekButtons(line, year, month, week);
                fetchStatusWeek(line, year, month, week);
                fetchRevisionNumber(line, year, month, week);
            }

            async function fetchStatusWeek(line, year, month, week) {
                const response = await fetch(
                    `http://127.0.0.1:8000/api/showmachineoperation?line=${line}&year=${year}&month=${month}&week=${week}`
                );
                const operationsData = await response.json();

                let status = "NEW";

                if (operationsData.operations.length > 0) {
                    const allApproved = operationsData.operations.every(operation => operation.is_approved ===
                        1);
                    const allWaitingApproval = operationsData.operations.every(operation => operation
                        .is_approved === 0 && operation.is_rejected === 0);
                    const allRejected = operationsData.operations.every(operation => operation.is_rejected ===
                        1);

                    if (allApproved) {
                        status = "APPROVED";
                    } else if (allWaitingApproval) {
                        status = "WAITING APPROVAL";
                    } else if (allRejected) {
                        status = "REJECTED";
                    }
                }

                document.getElementById('statusWeek').innerHTML = `
                <h3 class="text-2xl font-bold">${status}</h3>
            `;
            }

            async function fetchRevisionNumber(line, year, month, week) {
                const response = await fetch(`http://127.0.0.1:8000/api/showrevision`);
                const revisionsData = await response.json();

                const revision = revisionsData.find(revision => {
                    return revision.line === line && revision.year == year && revision.month == month &&
                        revision.week == week;
                });

                const revisionNumber = revision ? revision.revision_number : "0";
                const returnNotes = revision ? revision.return_notes : "No notes available.";

                document.getElementById('revision_number').innerHTML = `
                <h3 class="text-xl font-bold">${revisionNumber} Revisi</h3>
            `;

                // Set the content of the notes popup
                document.getElementById('revisionNotesPopup').textContent = returnNotes;
            }
            document.getElementById('revision_number').addEventListener('mouseover', function() {
                document.getElementById('revisionNotesPopup').classList.remove('hidden');
            });

            document.getElementById('revision_number').addEventListener('mouseout', function() {
                document.getElementById('revisionNotesPopup').classList.add('hidden');
            });


            async function fetchDataForWeek(line, year, month, week) {
                let operationsUrls = [];
                let machinesUrls = [];
                let machineInfoUrls = [];
                const nextWeek = parseInt(week) + 1;

                if (week === "1") {
                    const prevMonth = (month - 1 === 0) ? 12 : month - 1;
                    const prevYear = (month - 1 === 0) ? year - 1 : year;

                    operationsUrls = [
                        `http://127.0.0.1:8000/api/showmachineoperation?line=${line}&year=${year}&month=${month}&week=${week}`,
                        `http://127.0.0.1:8000/api/showmachineoperation?line=${line}&year=${prevYear}&month=${prevMonth}&week=5`,
                        `http://127.0.0.1:8000/api/showmachineoperation?line=${line}&year=${prevYear}&month=${prevMonth}&week=6`,
                        `http://127.0.0.1:8000/api/showmachineoperation?line=${line}&year=${year}&month=${month}&week=${nextWeek}`
                    ];

                    machinesUrls = [
                        `http://127.0.0.1:8000/api/showweeklymachine?line=${line}&year=${year}&month=${month}&week=${week}`,
                        `http://127.0.0.1:8000/api/showweeklymachine?line=${line}&year=${prevYear}&month=${prevMonth}&week=5`,
                        `http://127.0.0.1:8000/api/showweeklymachine?line=${line}&year=${prevYear}&month=${prevMonth}&week=6`,
                        `http://127.0.0.1:8000/api/showweeklymachine?line=${line}&year=${year}&month=${month}&week=${nextWeek}`
                    ];

                    machineInfoUrls = [
                        `http://127.0.0.1:8000/api/showmachine`
                    ];
                } else {
                    operationsUrls = [
                        `http://127.0.0.1:8000/api/showmachineoperation?line=${line}&year=${year}&month=${month}&week=${week}`,
                        `http://127.0.0.1:8000/api/showmachineoperation?line=${line}&year=${year}&month=${month}&week=${nextWeek}`
                    ];

                    machinesUrls = [
                        `http://127.0.0.1:8000/api/showweeklymachine?line=${line}&year=${year}&month=${month}&week=${week}`,
                        `http://127.0.0.1:8000/api/showweeklymachine?line=${line}&year=${year}&month=${month}&week=${nextWeek}`
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
                    const machineIdKey = operation.week === week ? operation.machine_id : operation.machine_id_parent;
                    if (!machineOperationsMap.has(machineIdKey)) {
                        machineOperationsMap.set(machineIdKey, []);
                    }
                    machineOperationsMap.get(machineIdKey).push(operation);
                });

                // Sort machines by specified categories
                const categoryOrder = ['Granulasi', 'Drying', 'Final mix/camas', 'kompaksi', 'Cetak', 'Coating', 'Mixing', 'Filling', 'Kemas'];
                machines.sort((a, b) => {
                    const categoryA = machineInfoMap.get(a.machine_id) || 'Unknown';
                    const categoryB = machineInfoMap.get(b.machine_id) || 'Unknown';
                    return categoryOrder.indexOf(categoryA) - categoryOrder.indexOf(categoryB);
                });

                const combinedMachines = combineWeeklyMachines(machines);

                combinedMachines.forEach(machine => {
                    const category = machineInfoMap.get(machine.machine_id);

                    const machineRow = document.createElement('div');
                    machineRow.className = 'grid grid-cols-10 gap-4 mb-2';
                    machineRow.innerHTML = `
                        <div class="font-bold border-2 mesin-jpm p-2 row-span-3 col-span-2 flex items-center justify-center text-center" style="height: 90%;">
                            <div class="flex flex-col justify-center items-center w-full h-full">
                                <span class="inline-flex items-center ${category === 'Granulasi' ? 'custom-badge1' : category === 'Drying' ? 'custom-badge2' : category.includes('Final') ? 'custom-badge3' : category === 'Cetak' ? 'custom-badge4' : category === 'Coating' ? 'custom-badge5' : category === 'Kemas' ? 'custom-badge6' : category === 'Mixing' ? 'custom-badge7' : category === 'Filling' ? 'custom-badge8' : category === 'Kompaksi' ? 'custom-badge9' : ''} text-white text-xs font-medium px-2.5 py-0.5 rounded-full mb-1">
                                    <span class="w-2 h-2 mr-1 bg-white rounded-full"></span>
                                    ${category}
                                </span>
                                <span class="text-sm">${machine.machine_name}</span>
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

                    // Mendapatkan operasi mesin untuk minggu ini atau minggu berikutnya
                    const machineOperations = machineOperationsMap.get(machine.machine_id) || [];
                    const machineOperationsNextWeek = machineOperationsMap.get(machine.machine_id_parent) || [];
                    const allMachineOperations = [...machineOperations, ...machineOperationsNextWeek];

                    allMachineOperations.sort((a, b) => {
                        if (a.status === 'PM') return -1;
                        if (b.status === 'PM') return 1;
                        const [hoursA, minutesA] = a.time.split(':').map(Number);
                        const [hoursB, minutesB] = b.time.split(':').map(Number);
                        return hoursA * 60 + minutesA - (hoursB * 60 + minutesB);
                    });

                    allMachineOperations.forEach(operation => {
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
                                'CPV': 'status-cpv',
                                'BREAKDOWN': 'status-breakdown',
                            }[operation.status] || '';

                            entry.className = `p-2 border-2 text-xs flex flex-col justify-center isi-jpm text-center entry-button relative ${statusClass}`;
                            entry.style.minHeight = '6em';

                            entry.innerHTML = operation.status && ['PM', 'BCP', 'OFF', 'BREAKDOWN', 'CUSU', 'DHT', 'CHT', 'KALIBRASI', 'OVERHAUL', 'CV', 'CPV'].includes(operation.status) ? `
                                <p class="status-only">${operation.status}</p>
                                ${operation.notes ? `<span class="absolute top-0 right-0 w-2 h-2 bg-yellow-500 rounded-full"></span>` : ''}
                                ${operation.is_approved != 1 ? `<span class="absolute bottom-0 left-0 w-2 h-2 bg-red-500 rounded-full"></span>` : ''}
                            ` : `
                                <p><strong>${operation.code}</strong></p>
                                <p>${operation.time}</p>
                                ${operation.status ? `<p class="text-green-600">${operation.status}</p>` : ''}
                                ${operation.notes ? `<span class="absolute top-0 right-0 w-2 h-2 bg-yellow-500 rounded-full"></span>` : ''}
                                ${operation.is_approved != 1 ? `<span class="absolute bottom-0 left-0 w-2 h-2 bg-red-500 rounded-full"></span>` : ''}
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

                });
            }


            function showNotesPopup(event, notes) {
                const popup = document.createElement('div');
                popup.className = 'notes-popup';
                popup.innerHTML = notes.split('\n').map(line =>
                    `<strong>${line.split(':')[0]}</strong>: ${line.split(':')[1]}`).join('<br>');
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

            function setupWeekButtons(current_line, year, month, activeWeek) {
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
                    weekButton.textContent = `W${index + 1}`;
                    weekButton.className = 'year-item text-black rounded-xl ml-1 text-xl px-2.5 py-2.5 cursor-pointer h-auto border-0';
                    if (index + 1 === parseInt(activeWeek)) {
                        weekButton.classList.add('text-purple-600');
                    } else {
                        weekButton.classList.add('text-gray-400', 'cursor-not-allowed');
                    }
                    weekButton.onclick = () => {
                        if (weekButton.classList.contains('text-purple-600')) {
                            fetchDataForWeek(current_line, year, month, index + 1);
                            updateURL(current_line, year, month, index + 1);
                            document.querySelectorAll('.year-item').forEach(btn => btn.classList.remove('text-purple-600'));
                            weekButton.classList.add('text-purple-600');
                            displayWeek(week);
                        }
                    };
                    weeksList.appendChild(weekButton);
                });

                // Automatically click the specified week button
                const params = new URLSearchParams(window.location.search);
                const weekParam = params.get('week');
                if (weekParam && weeksList.children[weekParam - 1]) {
                    weeksList.children[weekParam - 1].click(); // Click the specified week
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
                    const params = new URLSearchParams(window.location.search);
                    const line = params.get('line');
                    const month = params.get('month');
                    const week = params.get('week');
                    const year = params.get('year');

                    if (line && month && week && year) {
                        fetchDataForWeek(line, year, month, week);
                    }
                }, 30000); // Refresh every 30 seconds
            }

            function combineWeeklyMachines(machines) {
                const machineMap = new Map();

                machines.forEach(machine => {
                    const key = `${machine.machine_id}-${machine.machine_name}`;

                    if (!machineMap.has(key)) {
                        machineMap.set(key, machine);
                    }
                });

                return Array.from(machineMap.values());
            }

            // document.addEventListener('DOMContentLoaded', fetchAndDisplayHistory);
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
