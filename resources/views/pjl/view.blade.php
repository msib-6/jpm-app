<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
    <title>Machine Schedule Display</title>
    @vite('resources/css/pjl/view.css')
</head>
<body class="bg-gray-100">
<div class="container mx-auto px-4">

    <!-- Card Title -->
<!--    <div class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto flex justify-between items-center" style="width: 91.666667%;">-->
<!--        <h3 id="title" class="text-2xl font-bold">-->
<!--            Line: <span id="line-display">Loading...</span>, <span id="month-display">Loading...</span> <span id="year-display">Loading...</span>-->
<!--        </h3>-->
<!--    </div>-->

    <!-- Title and Weeks Container -->
    <div class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto flex items-center justify-between" style="width: 91.666667%;">
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



    <!-- Header for Days -->
    <div class="header-days bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto" style="width: 91.666667%; display: none;" id="headerDays">
        <div class="grid grid-cols-10 gap-4 text-center font-semibold">
            <div class="flex font-bold items-center justify-center col-span-2 text-xl">Mesin</div>
            <!-- Dynamic date headers -->
            <div id="day1" class="flex flex-col justify-center items-center"><span class="font-bold">Senin</span><span>Date 1</span></div>
            <div id="day2" class="flex flex-col justify-center items-center"><span class="font-bold">Selasa</span><span>Date 2</span></div>
            <div id="day3" class="flex flex-col justify-center items-center"><span class="font-bold">Rabu</span><span>Date 3</span></div>
            <div id="day4" class="flex flex-col justify-center items-center"><span class="font-bold">Kamis</span><span>Date 4"></span></div>
            <div id="day5" class="flex flex-col justify-center items-center"><span class="font-bold">Jumat</span><span>Date 5"></span></div>
            <div id="day6" class="flex flex-col justify-center items-center"><span class="font-bold">Sabtu</span><span>Date 6"></span></div>
            <div id="day7" class="flex flex-col justify-center items-center"><span class="font-bold">Minggu</span><span>Date 7"></span></div>
            <div id="day8" class="flex flex-col justify-center items-center"><span class="font-bold">Senin</span><span>Date 8"></span></div>
        </div>
    </div>

    <!-- Data Container -->
    <div id="dataContainer" class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto" style="width: 91.666667%;">
        <!-- Dynamic rows for machines will be appended here -->
    </div>

    <!-- Global Container -->
    <div id="globalDescContainer" class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto flex justify-center items-start" style="width: 91.666667%;">
        <!-- Dynamic rows for Global Desc will be appended here -->


        <button class="add-desc-button relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
            <span class="relative add-desc-button2 px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                Button Add Desc Testing
            </span>
        </button>

    </div>


    <!-- Add Mesin Button -->
    <button type="button" id="openModalButton" class="add-mesin-button text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
        Add Mesin
    </button>

    <!-- Modal Add Mesin-->
    <div id="addMesinModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-lg">
            <h2 class="text-2xl mb-4">Add Mesin</h2>
            <form id="addMesinForm">
                <div id="mesinCheckboxContainer" class="mb-4">
                    <!-- Checkboxes will be appended here -->
                </div>
                <div class="flex justify-end">
                    <button type="button" id="closeModalButton" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 mr-2">Cancel</button>
                    <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600">Add Mesin</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Add Data -->
    <div id="addDataModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-lg">
            <h2 class="text-2xl mb-4">Add Data</h2>
            <form id="addDataForm">

                <!-- Code -->
                <div class="mb-4">
                    <label for="dataCode" class="block text-gray-700">Kode</label>
                    <input type="text" id="dataCode" class="w-full px-3 py-2 border rounded-lg" required>
                </div>

                <!-- Time -->
                <div class="mb-4 time-picker">
                    <label for="dataTime" class="block text-gray-700">Jam :</label>
                    <div class="time-inputs">
                        <div class="time-input">
                            <button type="button" onclick="increaseHour()">&#9650;</button>
                            <input type="number" id="hours" value="08" min="0" max="23" step="1" required>
                            <button type="button" onclick="decreaseHour()">&#9660;</button>
                        </div>
                        <span>:</span>
                        <div class="time-input">
                            <button type="button" onclick="increaseMinute()">&#9650;</button>
                            <input type="number" id="minutes" value="00" min="0" max="59" step="1" required>
                            <button type="button" onclick="decreaseMinute()">&#9660;</button>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div class="mb-4">
                    <label for="dataNotes" class="block text-gray-700">Notes</label>
                    <input type="text" id="dataNotes" class="w-full px-3 py-2 border rounded-lg">
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="dataDescription" class="block text-gray-700">Description</label>
                    <input type="text" id="dataDescription" class="w-full px-3 py-2 border rounded-lg">
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="dataStatus" class="block text-gray-700">Status</label>
                    <select id="dataStatus" class="w-full px-3 py-2 border rounded-lg">
                        <option value="PJL">PJL</option>
                        <option value="PM">PM</option>
                    </select>
                </div>

                <!-- Button -->
                <div class="flex justify-end">
                    <button type="button" id="closeDataModalButton" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 mr-2">Cancel</button>
                    <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600">Add Data</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const openModalButton = document.getElementById('openModalButton');
        const closeModalButton = document.getElementById('closeModalButton');
        const addMesinModal = document.getElementById('addMesinModal');
        const addMesinForm = document.getElementById('addMesinForm');
        const mesinCheckboxContainer = document.getElementById('mesinCheckboxContainer');
        const addDataModal = document.getElementById('addDataModal');
        const closeDataModalButton = document.getElementById('closeDataModalButton');
        const addDataForm = document.getElementById('addDataForm');
        let currentMachineId;
        let currentDay;

        openModalButton.addEventListener('click', async function() {
            await populateMesinCheckboxes();
            addMesinModal.classList.remove('hidden');
        });

        closeModalButton.addEventListener('click', function() {
            addMesinModal.classList.add('hidden');
        });

        addMesinForm.addEventListener('submit', async function(event) {
            event.preventDefault();
            await addSelectedMesin();
            addMesinModal.classList.add('hidden');
        });

        closeDataModalButton.addEventListener('click', function() {
            addDataModal.classList.add('hidden');
        });

        addDataForm.addEventListener('submit', async function(event) {
            event.preventDefault();
            await addDataToMachine(currentMachineId, currentDay);
            addDataModal.classList.add('hidden');
        });

        getQueryParams();
        setupAutoRefresh();

        async function populateMesinCheckboxes() {
            const params = new URLSearchParams(window.location.search);
            const line = params.get('line');
            try {
                const response = await fetch('http://127.0.0.1:8000/api/showmachine');
                const machines = await response.json();

                const filteredMachines = machines.filter(machine => {
                    if (Array.isArray(machine.line)) {
                        return machine.line.includes(line);
                    } else {
                        return machine.line === line;
                    }
                });

                mesinCheckboxContainer.innerHTML = ''; // Clear existing checkboxes

                filteredMachines.forEach(machine => {
                    const checkbox = document.createElement('div');
                    checkbox.className = 'flex flex-col items-start mb-2';
                    checkbox.innerHTML = `
                        <input type="checkbox" id="machine-${machine.id}" name="machines" value="${machine.machine_name}" class="mr-2">
                        <label for="machine-${machine.id}" class="text-gray-700">
                            <span class="block">${machine.machine_name}</span>
                            <span class="block text-sm text-gray-500">${machine.category}</span>
                        </label>
                    `;
                    mesinCheckboxContainer.appendChild(checkbox);
                });
            } catch (error) {
                console.error('Error fetching machines:', error);
            }
        }

        async function addSelectedMesin() {
            const selectedMachines = document.querySelectorAll('input[name="machines"]:checked');
            const params = new URLSearchParams(window.location.search);
            const line = params.get('line');
            const month = params.get('month');
            const week = params.get('week');
            const year = params.get('year');

            for (const machine of selectedMachines) {
                const machineName = machine.value;

                const response = await fetch('http://127.0.0.1:8000/api/addweeklymachine', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        machineName,
                        line,
                        month,
                        week,
                        year
                    }),
                });

                if (response.ok) {
                    alert(`Machine ${machineName} added successfully`);
                } else {
                    const errorData = await response.json();
                    alert(`Error adding machine ${machineName}: ${errorData.message}`);
                }
            }
        }

        async function addSelectedMesin() {
            const selectedMachines = document.querySelectorAll('input[name="machines"]:checked');
            const params = new URLSearchParams(window.location.search);
            const line = params.get('line');
            const month = params.get('month');
            const week = params.get('week');
            const year = params.get('year');

            for (const machine of selectedMachines) {
                const machineName = machine.value;

                const response = await fetch('http://127.0.0.1:8000/api/addweeklymachine', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        machineName,
                        line,
                        month,
                        week,
                        year
                    }),
                });

                if (response.ok) {
                    alert(`Machine ${machineName} added successfully`);
                } else {
                    const errorData = await response.json();
                    alert(`Error adding machine ${machineName}: ${errorData.message}`);
                }
            }
        }

        function getQueryParams() {
            const params = new URLSearchParams(window.location.search);
            const line = params.get('line');
            const month = params.get('month');
            const year = params.get('year');

            document.getElementById('line-display').textContent = line ? line : 'N/A';
            document.getElementById('month-display').textContent = month ? getMonthName(month) : 'N/A';
            document.getElementById('year-display').textContent = year ? year : 'N/A';

            setupWeekButtons(line, year, month);
        }

        async function fetchDataForWeek(line, year, month, week) {
            const operationsUrl = `http://127.0.0.1:8000/api/showmachineoperation?line=${line}&year=${year}&month=${month}&week=${week}`;
            const machinesUrl = `http://127.0.0.1:8000/api/showweeklymachine?line=${line}&year=${year}&month=${month}&week=${week}`;
            const machineInfoUrl = `http://127.0.0.1:8000/api/showmachine`;

            try {
                const [operationsResponse, machinesResponse, machineInfoResponse] = await Promise.all([
                    fetch(operationsUrl),
                    fetch(machinesUrl),
                    fetch(machineInfoUrl)
                ]);

                const operationsData = await operationsResponse.json();
                const machinesData = await machinesResponse.json();
                const machineInfoData = await machineInfoResponse.json();

                const machineInfoMap = new Map(machineInfoData.map(machine => [machine.id, machine.category || 'Unknown'])); // Fallback to 'Unknown' if category is empty

                updateURL(line, year, month, week);
                displayMachineData(operationsData.operations, machinesData, machineInfoMap);
            } catch (error) {
                console.error("Error fetching data:", error);
            }
        }

        function updateURL(line, year, month, week) {
            history.pushState({}, '', `?line=${line}&year=${year}&month=${month}&week=${week}`);
        }

        function displayMachineData(operations, machines, machineInfoMap) {
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
                    <div id="daydata1-${machine.id}" class="col-span-1 day-column"></div>
                    <div id="daydata2-${machine.id}" class="col-span-1 day-column"></div>
                    <div id="daydata3-${machine.id}" class="col-span-1 day-column"></div>
                    <div id="daydata4-${machine.id}" class="col-span-1 day-column"></div>
                    <div id="daydata5-${machine.id}" class="col-span-1 day-column"></div>
                    <div id="daydata6-${machine.id}" class="col-span-1 day-column"></div>
                    <div id="daydata7-${machine.id}" class="col-span-1 day-column"></div>
                    <div id="daydata8-${machine.id}" class="col-span-1 day-column"></div>
                `;
                dataContainer.appendChild(machineRow);

                // Populate machine row with operations
                const machineOperations = machineOperationsMap.get(machine.id) || [];
                machineOperations.forEach(operation => {
                    const dayIndex = parseInt(operation.day) % 8;  // Adjust based on your date system
                    const dayColumn = document.getElementById(`daydata${dayIndex + 1}-${machine.id}`);

                    if (dayColumn) {
                        const entry = document.createElement('button');
                        entry.className = 'p-2 border-2 text-xs flex flex-col justify-center isi-jpm text-center entry-button';
                        entry.innerHTML = `
                            <p><strong>${operation.code}</strong></p>
                            <p>${operation.time}</p>
                            ${operation.status ? `<p>${operation.status}</p>` : ''}
                        `;
                        dayColumn.appendChild(entry);
                    }
                });

                // Add "+ Add Data" button at the end of each day column
                for (let i = 1; i <= 8; i++) {
                    const dayColumn = document.getElementById(`daydata${i}-${machine.id}`);
                    if (dayColumn) {
                        const addButton = document.createElement('button');
                        addButton.className = 'add-jpm-button add-data-button rounded-full bg-purple-500 text-white w-10 h-10'; // Set width and height to 10 each for circular shape
                        addButton.textContent = '+';
                        addButton.onclick = function() {
                            currentMachineId = machine.id;
                            const headerDate = document.getElementById(`day${i}`).children[1].textContent.trim();
                            currentDay = parseInt(headerDate);
                            addDataModal.classList.remove('hidden');
                        };
                        dayColumn.appendChild(addButton);
                    }
                }
            });
        }

        function createDayElement(id) {
            const container = document.querySelector('.grid');
            const newDayElement = document.createElement('div');
            newDayElement.id = id;
            newDayElement.className = 'col-span-1 grid grid-rows-3 gap-2';
            container.appendChild(newDayElement);
            return newDayElement;
        }

        function getMonthName(month) {
            const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            return monthNames[month - 1];
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

        function displayWeek(dates) {
            // Show the header days when a week is displayed
            document.getElementById('headerDays').style.display = 'block';

            dates.forEach((date, index) => {
                if (index < 8) { // Ensure we only update the 8 days
                    const dayElement = document.getElementById(`day${index + 1}`);
                    dayElement.children[0].textContent = date.split(",")[0]; // Day name
                    dayElement.children[1].textContent = date.split(",")[1]; // Date
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
            }, 30000); // Refresh every 60 seconds
        }

    });

    function increaseHour() {
        const hoursInput = document.getElementById('hours');
        let hours = parseInt(hoursInput.value, 10);
        if (hours < 23) {
            hours += 1;
        } else {
            hours = 0;
        }
        hoursInput.value = hours.toString().padStart(2, '0');
    }

    function decreaseHour() {
        const hoursInput = document.getElementById('hours');
        let hours = parseInt(hoursInput.value, 10);
        if (hours > 0) {
            hours -= 1;
        } else {
            hours = 23;
        }
        hoursInput.value = hours.toString().padStart(2, '0');
    }

    function increaseMinute() {
        const minutesInput = document.getElementById('minutes');
        let minutes = parseInt(minutesInput.value, 10);
        if (minutes < 59) {
            minutes += 1;
        } else {
            minutes = 0;
        }
        minutesInput.value = minutes.toString().padStart(2, '0');
    }

    function decreaseMinute() {
        const minutesInput = document.getElementById('minutes');
        let minutes = parseInt(minutesInput.value, 10);
        if (minutes > 0) {
            minutes -= 1;
        } else {
            minutes = 59;
        }
        minutesInput.value = minutes.toString().padStart(2, '0');
    }
</script>

</body>
</html>
