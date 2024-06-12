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
    <!-- Card Title -->
    <div class="bg-white opacity-75 p-6 rounded-3xl shadow-2xl my-4 mx-auto flex items-center justify-between" style="width: 91.666667%;">
        <h3 id="title" class="text-2xl font-bold">
            <span id="line-display">{{ ucfirst(str_replace('Line', 'Line ', $line)) }}</span>
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
    <div class="header-days bg-white opacity-75 p-6 rounded-3xl shadow-2xl my-4 mx-auto" style="width: 91.666667%; display: none;" id="headerDays">
        <div class="grid grid-cols-10 gap-4 text-center font-semibold">
            <div class="flex font-bold items-center justify-center col-span-2 text-xl">Mesin</div>
            <!-- Dynamic date headers -->
            <div id="day1" class="flex flex-col justify-center items-center"><span class="font-bold">Senin</span><span style="font-size: 12px;">Date 1</span></div>
            <div id="day2" class="flex flex-col justify-center items-center"><span class="font-bold">Selasa</span><span style="font-size: 12px;">Date 2"></span></div>
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
        <!-- Add Description Button -->
        <button id="openGlobalDescModalButton" class="add-desc-button relative inline-flex items-center justify-center p-0.5 mb-4 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
            <span class="relative add-desc-button2 px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                Add Description
            </span>
        </button>
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
                <button id="sendWeekButton" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Send Week</button>
            </div>
        </div>
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
                <div id="mesinCheckboxContainer" class="mb-4" style="max-height: 450px; overflow-y: auto;">
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
                <!-- Status -->
                <div class="mb-4">
                    <label for="dataStatus" class="block text-gray-700">Status</label>
                    <select id="dataStatus" class="w-full px-3 py-2 border rounded-lg">
                        <option value=""></option>
                        <option value="SUPERVISI">SUPERVISI</option>
                        <option value="VALIDASI">VALIDASI</option>
                        <option value="MICRO">MICRO</option>
                        <option value="PQ">PQ</option>
                        <option value="TRIAL">TRIAL</option>
                        <option value="STUDY PAT">STUDY PAT</option>
                        <option value="STUDY BATCH CAMPAIGN">STUDY BATCH CAMPAIGN</option>
                        <option value="BCP">BCP</option>
                        <option value="BREAKDOWN">BREAKDOWN</option>
                        <option value="OFF">OFF</option>
                        <option value="CUSU">CUSU</option>
                        <option value="DHT">DHT</option>
                        <option value="CHT">CHT</option>
                        <option value="KALIBRASI">KALIBRASI</option>
                        <option value="OVERHAUL">OVERHAUL</option>
                        <option value="CV">CV</option>
                        <option value="CPV">CPV</option>
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

    <!-- Modal Add Global Description -->
    <div id="addGlobalDescModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-lg">
            <h2 class="text-2xl mb-4">Add Global Description</h2>
            <form id="addGlobalDescForm">
                <div class="mb-4">
                    <label for="globalDesc" class="block text-gray-700">Description</label>
                    <textarea id="globalDesc" class="w-full px-3 py-2 border rounded-lg" rows="3" required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" id="closeGlobalDescModalButton" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 mr-2">Cancel</button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Add Description</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Data -->
    <div id="editDataModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-lg">
            <h2 class="text-2xl mb-4">Edit Data</h2>
            <form id="editDataForm">
                <!-- Code -->
                <div class="mb-4">
                    <label for="editDataCode" class="block text-gray-700">Kode</label>
                    <input type="text" id="editDataCode" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <!-- Day Selector -->
                <div class="mb-4">
                    <label for="editDay" class="block text-gray-700">Hari:</label>
                    <select id="editDay" class="w-full px-3 py-2 border rounded-lg">
                        <!-- Options will be dynamically populated -->
                    </select>
                </div>
                <!-- Time -->
                <div class="mb-4 time-picker">
                    <label for="editDataTime" class="block text-gray-700">Jam :</label>
                    <div class="time-inputs">
                        <div class="time-input">
                            <button type="button" onclick="increaseHourEdit()">&#9650;</button>
                            <input type="number" id="editHours" value="08" min="0" max="23" step="1" required>
                            <button type="button" onclick="decreaseHourEdit()">&#9660;</button>
                        </div>
                        <span>:</span>
                        <div class="time-input">
                            <button type="button" onclick="increaseMinuteEdit()">&#9650;</button>
                            <input type="number" id="editMinutes" value="00" min="0" max="59" step="1" required>
                            <button type="button" onclick="decreaseMinuteEdit()">&#9660;</button>
                        </div>
                    </div>
                </div>
                <!-- Notes -->
                <div class="mb-4">
                    <label for="editDataNotes" class="block text-gray-700">Notes</label>
                    <input type="text" id="editDataNotes" class="w-full px-3 py-2 border rounded-lg">
                </div>
                <!-- Status -->
                <div class="mb-4">
                    <label for="editDataStatus" class="block text-gray-700">Status</label>
                    <select id="editDataStatus" class="w-full px-3 py-2 border rounded-lg">
                        <option value=""></option>
                        <option value="SUPERVISI">SUPERVISI</option>
                        <option value="VALIDASI">VALIDASI</option>
                        <option value="MICRO">MICRO</option>
                        <option value="PQ">PQ</option>
                        <option value="TRIAL">TRIAL</option>
                        <option value="STUDY PAT">STUDY PAT</option>
                        <option value="STUDY BATCH CAMPAIGN">STUDY BATCH CAMPAIGN</option>
                        <option value="BCP">BCP</option>
                        <option value="BREAKDOWN">BREAKDOWN</option>
                        <option value="OFF">OFF</option>
                        <option value="CUSU">CUSU</option>
                        <option value="DHT">DHT</option>
                        <option value="CHT">CHT</option>
                        <option value="KALIBRASI">KALIBRASI</option>
                        <option value="OVERHAUL">OVERHAUL</option>
                        <option value="CV">CV</option>
                        <option value="CPV">CPV</option>
                    </select>
                </div>
                <!-- Buttons -->
                <div class="flex justify-between items-center">
                    <button type="button" id="deleteOperationButton" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 mr-2">Delete Operation</button>
                    <div class="flex justify-end">
                        <button type="button" id="closeEditDataModalButton" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 mr-2">Cancel</button>
                        <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal View Global Description -->
    <div id="viewGlobalDescModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-lg">
            <h2 class="text-2xl mb-4">View Global Description</h2>
            <div id="globalDescContent" class="mb-4">
                <!-- Description content will be populated here -->
            </div>
            <div class="flex justify-between items-center">
                <button type="button" id="deleteGlobalDescButton" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Delete</button>
                <button type="button" id="closeViewGlobalDescModalButton" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 mr-2">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Modal View Machine Data -->
    <div id="viewMachineDataModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-lg">
            <h2 class="text-2xl mb-4">View Machine Data</h2>
            <div id="machineDataContent" class="mb-4">
                <!-- Machine data content will be populated here -->
            </div>
            <div class="flex justify-between items-center">
                <button type="button" id="deleteMachineDataButton" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Delete</button>
                <button type="button" id="closeViewMachineDataModalButton" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 mr-2">Cancel</button>
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
        const openModalButton = document.getElementById('openModalButton');
        const closeModalButton = document.getElementById('closeModalButton');
        const addMesinModal = document.getElementById('addMesinModal');
        const addMesinForm = document.getElementById('addMesinForm');
        const mesinCheckboxContainer = document.getElementById('mesinCheckboxContainer');
        const addDataModal = document.getElementById('addDataModal');
        const closeDataModalButton = document.getElementById('closeDataModalButton');
        const addDataForm = document.getElementById('addDataForm');
        const openGlobalDescModalButton = document.getElementById('openGlobalDescModalButton');
        const closeGlobalDescModalButton = document.getElementById('closeGlobalDescModalButton');
        const addGlobalDescModal = document.getElementById('addGlobalDescModal');
        const addGlobalDescForm = document.getElementById('addGlobalDescForm');
        const editDataModal = document.getElementById('editDataModal');
        const closeEditDataModalButton = document.getElementById('closeEditDataModalButton');
        const editDataForm = document.getElementById('editDataForm');
        const deleteOperationButton = document.getElementById('deleteOperationButton');
        const viewGlobalDescModal = document.getElementById('viewGlobalDescModal');
        const closeViewGlobalDescModalButton = document.getElementById('closeViewGlobalDescModalButton');
        const globalDescs = document.getElementById('globalDescs');
        const deleteGlobalDescButton = document.getElementById('deleteGlobalDescButton');
        const viewMachineDataModal = document.getElementById('viewMachineDataModal');
        const closeViewMachineDataModalButton = document.getElementById('closeViewMachineDataModalButton');
        const machineDataContent = document.getElementById('machineDataContent');
        const deleteMachineDataButton = document.getElementById('deleteMachineDataButton');
        const confirmDeleteModal = document.getElementById('confirmDeleteModal');
        const deleteConfirmMessage = document.getElementById('deleteConfirmMessage');
        const confirmDeleteButton = document.getElementById('confirmDeleteButton');
        const sendWeekButton = document.getElementById('sendWeekButton');
        let currentMachineId;
        let currentDay;
        let currentMonth;
        let currentYear;
        let currentOperationId;
        let currentGlobalDescId;
        let currentMachineDataId;

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
            await addDataToMachine(currentMachineId, currentDay, currentMonth, currentYear);
            addDataModal.classList.add('hidden');
            addDataForm.reset();
        });

        closeEditDataModalButton.addEventListener('click', function() {
            editDataModal.classList.add('hidden');
        });

        editDataForm.addEventListener('submit', async function(event) {
            event.preventDefault();
            await editData(currentOperationId);
            editDataModal.classList.add('hidden');
            editDataForm.reset();
        });

        deleteOperationButton.addEventListener('click', function() {
            confirmDeleteOperation(currentOperationId);
        });

        openGlobalDescModalButton.addEventListener('click', function() {
            addGlobalDescModal.classList.remove('hidden');
        });

        closeGlobalDescModalButton.addEventListener('click', function() {
            addGlobalDescModal.classList.add('hidden');
        });

        addGlobalDescForm.addEventListener('submit', async function(event) {
            event.preventDefault();
            await addGlobalDescription();
            await fetchAndDisplayGlobalDescriptions();
            addGlobalDescModal.classList.add('hidden');
            addGlobalDescForm.reset();
        });

        closeViewGlobalDescModalButton.addEventListener('click', function() {
            viewGlobalDescModal.classList.add('hidden');
        });

        closeConfirmDeleteModalButton.addEventListener('click', function() {
            confirmDeleteModal.classList.add('hidden');
        });

        deleteGlobalDescButton.addEventListener('click', function() {
            confirmDeleteGlobalDesc(currentGlobalDescId);
        });

        confirmDeleteButton.addEventListener('click', async function() {
            const deleteMode = confirmDeleteButton.getAttribute('data-delete-mode');
            if (deleteMode === 'operation') {
                await deleteData(currentOperationId);
                editDataModal.classList.add('hidden');
            } else if (deleteMode === 'description') {
                await deleteGlobalDescription(currentGlobalDescId);
                viewGlobalDescModal.classList.add('hidden');
                await fetchAndDisplayGlobalDescriptions();
            } else if (deleteMode === 'machine') {
                await deleteMachineData(currentMachineDataId);
                viewMachineDataModal.classList.add('hidden');
            }
            confirmDeleteModal.classList.add('hidden');
        });

        closeViewMachineDataModalButton.addEventListener('click', function() {
            viewMachineDataModal.classList.add('hidden');
        });

        deleteMachineDataButton.addEventListener('click', function() {
            confirmDeleteMachineData(currentMachineDataId);
        });

        sendWeekButton.addEventListener('click', async function() {
            const params = new URLSearchParams(window.location.search);
            const line = params.get('line');
            const month = params.get('month');
            const week = params.get('week');
            const year = params.get('year');
            const url = `http://127.0.0.1:8000/api/sendrevision?line=${line}&year=${year}&month=${month}&week=${week}`;

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    }
                });

                if (response.ok) {
                    window.location.href = `onlyView?line=${line}&year=${year}&month=${month}&week=${week}`;
                } else {
                    const errorData = await response.json();
                    showAlert(`Error sending week data: ${errorData.message}`);
                }
            } catch (error) {
                showAlert(`Error sending week data: ${error.message}`);
            }
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
                    checkbox.className = 'inline-checkbox';
                    checkbox.className = 'flex items-center mb-2';
                    checkbox.innerHTML = `
                        <input type="checkbox" id="machine-${machine.id}" name="machines" value="${machine.machine_name}" class="mr-2 mb-4">
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
                    showAlert(`Machine ${machineName} added successfully`);
                } else {
                    const errorData = await response.json();
                    showAlert(`Error adding machine ${machineName}: ${errorData.message}`);
                }
            }
        }

        async function addDataToMachine(machineId, day, month, year) {
            const dataCode = document.getElementById('dataCode').value;
            const hours = document.getElementById('hours').value;
            const minutes = document.getElementById('minutes').value;
            const dataTime = `${hours}:${minutes}`;
            const dataNotes = document.getElementById('dataNotes').value;
            const dataStatus = document.getElementById('dataStatus').value;
            const params = new URLSearchParams(window.location.search);
            const line = params.get('line');
            const week = params.get('week');

            const response = await fetch(`http://127.0.0.1:8000/api/addmachineoperation/${line}/${machineId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    day,
                    code: dataCode,
                    time: dataTime,
                    status: dataStatus,
                    notes: dataNotes,
                    line,
                    month,
                    week,
                    year
                }),
            });

            if (response.ok) {
                showAlert(`Data added successfully`);
            } else {
                const errorData = await response.json();
                showAlert(`Error adding data: ${errorData.message}`);
            }
        }

        async function editData(operationId) {
            const dataCode = document.getElementById('editDataCode').value;
            const day = document.getElementById('editDay').value;
            const hours = document.getElementById('editHours').value;
            const minutes = document.getElementById('editMinutes').value;
            const dataTime = `${hours}:${minutes}`;
            const dataNotes = document.getElementById('editDataNotes').value;
            const dataStatus = document.getElementById('editDataStatus').value;
            const params = new URLSearchParams(window.location.search);
            const line = params.get('line');
            const month = currentMonth; // Get the month from the header date
            const year = currentYear; // Get the year from the header date

            const response = await fetch(`http://127.0.0.1:8000/api/editmachineoperation/${operationId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    day,
                    code: dataCode,
                    time: dataTime,
                    status: dataStatus,
                    notes: dataNotes,
                    line: line,
                    month: month,
                    week: params.get('week'),
                    year: year
                }),
            });

            if (response.ok) {
                showAlert(`Data updated successfully`);
            } else {
                const errorData = await response.json();
                showAlert(`Error updating data: ${errorData.message}`);
            }
        }

        async function deleteData(operationId) {
            const response = await fetch(`http://127.0.0.1:8000/api/deletemachineoperation/${operationId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                }
            });

            if (response.ok) {
                showAlert(`Data deleted successfully`);
            } else {
                const errorData = await response.json();
                showAlert(`Error deleting data: ${errorData.message}`);
            }
        }

        function confirmDeleteOperation(id) {
            currentOperationId = id;
            deleteConfirmMessage.textContent = "Are you sure you want to delete this machine operation?";
            confirmDeleteButton.setAttribute('data-delete-mode', 'operation');
            confirmDeleteModal.classList.remove('hidden');
        }

        async function addGlobalDescription() {
            const globalDesc = document.getElementById('globalDesc').value;
            const params = new URLSearchParams(window.location.search);
            const line = params.get('line');
            const month = params.get('month');
            const week = params.get('week');
            const year = params.get('year');

            const response = await fetch('http://127.0.0.1:8000/api/addglobaldescription', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    description: globalDesc,
                    line,
                    month,
                    week,
                    year
                }),
            });

            if (response.ok) {
                showAlert(`Global description added successfully`);
            } else {
                const errorData = await response.json();
                showAlert(`Error adding global description: ${errorData.message}`);
            }
        }

        function viewGlobalDescription(desc) {
            globalDescContent.textContent = desc.description;
            currentGlobalDescId = desc.id;
            viewGlobalDescModal.classList.remove('hidden');
        }

        async function fetchAndDisplayGlobalDescriptions(line, year, month, week) {
            let descriptionPromises = [];

            if (week === "1") {
                const prevMonth = (month - 1 === 0) ? 12 : month - 1;
                const prevYear = (month - 1 === 0) ? year - 1 : year;

                descriptionPromises = [
                    fetch(`http://127.0.0.1:8000/api/showglobaldescription?line=${line}&year=${year}&month=${month}&week=1`),
                    fetch(`http://127.0.0.1:8000/api/showglobaldescription?line=${line}&year=${prevYear}&month=${prevMonth}&week=5`),
                    fetch(`http://127.0.0.1:8000/api/showglobaldescription?line=${line}&year=${prevYear}&month=${prevMonth}&week=6`)
                ];

            } else {
                descriptionPromises = [
                    fetch(`http://127.0.0.1:8000/api/showglobaldescription?line=${line}&year=${year}&month=${month}&week=${week}`)
                ];
            }

            try {
                const descriptionsResponses = await Promise.all(descriptionPromises);

                let descriptions = [];
                for (const response of descriptionsResponses) {
                    const data = await response.json();
                    descriptions = descriptions.concat(data);
                }

                const uniqueDescriptions = descriptions.filter((desc, index, self) =>
                        index === self.findIndex((d) => (
                            d.id === desc.id
                        ))
                );

                globalDescs.innerHTML = ''; // Clear existing descriptions

                uniqueDescriptions.forEach(desc => {
                    const descButton = document.createElement('button');
                    descButton.className = 'my-2 bg-white p-2 shadow-md rounded-md py-1 px-2 text-black items-center flex justify-center w-full';
                    descButton.style.width = '90%';
                    descButton.textContent = desc.description;
                    descButton.onclick = function() {
                        viewGlobalDescription(desc);
                    };
                    globalDescs.appendChild(descButton);
                });
            } catch (error) {
                console.error("Error fetching data:", error);
            }
        }

        async function deleteGlobalDescription(id) {
            const response = await fetch(`http://127.0.0.1:8000/api/deleteglobaldescription/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                },
            });

            if (response.ok) {
                showAlert(`Global description deleted successfully`);
            } else {
                const errorData = await response.json();
                showAlert(`Error deleting global description: ${errorData.message}`);
            }
        }

        function confirmDeleteGlobalDesc(id) {
            currentGlobalDescId = id;
            deleteConfirmMessage.textContent = "Are you sure you want to delete this global description?";
            confirmDeleteButton.setAttribute('data-delete-mode', 'description');
            confirmDeleteModal.classList.remove('hidden');
        }

        function confirmDeleteMachineData(id) {
            currentMachineDataId = id;
            deleteConfirmMessage.textContent = "Are you sure you want to delete this machine data?";
            confirmDeleteButton.setAttribute('data-delete-mode', 'machine');
            confirmDeleteModal.classList.remove('hidden');
        }

        async function deleteMachineData(id) {
            const response = await fetch(`http://127.0.0.1:8000/api/deleteweeklymachine/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                },
            });

            if (response.ok) {
                showAlert(`Machine data deleted successfully`);
            } else {
                const errorData = await response.json();
                showAlert(`Error deleting machine data: ${errorData.message}`);
            }
        }

        function viewMachineData(machine) {
            const machineContent = `
                <p><strong>Machine Name:</strong> ${machine.machine_name}</p>
            `;
            machineDataContent.innerHTML = machineContent;
            currentMachineDataId = machine.id;
            viewMachineDataModal.classList.remove('hidden');
        }

        function getQueryParams() {
            const params = new URLSearchParams(window.location.search);
            const line = params.get('line');
            const month = params.get('month');
            const year = params.get('year');
            const week = params.get('week');

            document.getElementById('line-display').textContent = line ? line : 'N/A';
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
            history.pushState({}, '', `?line=${line}&year=${year}&month=${month}&week=${week}`);
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

                // Populate machine row with operations
                const machineOperations = machineOperationsMap.get(machine.id) || [];
                machineOperations.forEach(operation => {
                    const dayColumn = document.getElementById(`daydata${machine.id}-${operation.day}`);
                    if (dayColumn) {
                        const entry = document.createElement('button');
                        entry.className = 'p-2 border-2 text-xs flex flex-col justify-center isi-jpm text-center entry-button relative';
                        entry.innerHTML = `
                            <p><strong>${operation.code}</strong></p>
                            <p>${operation.time}</p>
                            ${operation.status ? `<p class="text-red-600">${operation.status}</p>` : ''}
                            ${operation.notes ? `<span class="absolute top-0 right-0 w-2 h-2 bg-yellow-500 rounded-full"></span>` : ''}
                        `;
                        entry.onclick = function() {
                            openEditModal(operation);
                        };

                        if (operation.notes) {
                            entry.onmouseenter = function(event) {
                                showNotesPopup(event, operation.notes);
                            };
                            entry.onmouseleave = function() {
                                hideNotesPopup();
                            };
                        }

                        dayColumn.appendChild(entry);
                    }
                });

                // Add "+ Add Data" button at the end of each day column
                for (let i = 1; i <= 8; i++) {
                    const headerDate = document.getElementById(`day${i}`).children[1].textContent.trim();
                    const dateParts = headerDate.split(' ');
                    const day = parseInt(dateParts[0]);
                    const dayColumn = document.getElementById(`daydata${machine.id}-${day}`);
                    if (dayColumn) {
                        const addButton = document.createElement('button');
                        addButton.className = 'add-jpm-button add-data-button rounded-full bg-grey-500 text-white w-10 h-10'; // Set width and height to 10 each for circular shape
                        addButton.textContent = '+';
                        addButton.onclick = function() {
                            currentMachineId = machine.id;
                            currentDay = day;
                            currentMonth = getMonthNumber(dateParts[1]);
                            currentYear = parseInt(dateParts[2]);
                            addDataModal.classList.remove('hidden');
                        };
                        dayColumn.appendChild(addButton);
                    }
                }

                // Add onclick event to view machine data modal
                machineRow.querySelector('.mesin-jpm').onclick = function() {
                    viewMachineData(machine);
                };
            });
        }

        function showNotesPopup(event, notes) {
            const popup = document.createElement('div');
            popup.className = 'notes-popup';
            popup.textContent = notes;
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

        function getMonthNumber(monthName) {
            const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            return monthNames.indexOf(monthName) + 1;
        }

        function setupWeekButtons(line, year, month, activeWeek) {
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
                if (index + 1 === parseInt(activeWeek)) {
                    weekButton.classList.add('text-purple-600');
                } else {
                    weekButton.classList.add('text-gray-400', 'cursor-not-allowed');
                }
                weekButton.onclick = () => {
                    fetchDataForWeek(line, year, month, index + 1);
                    updateURL(line, year, month, index + 1);
                    document.querySelectorAll('.year-item').forEach(btn => btn.classList.remove('text-purple-600'));
                    weekButton.classList.add('text-purple-600');
                    displayWeek(week);
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
            const days = ['Minggu', 'Senin', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
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
            }, 10000); // Refresh every 30 seconds
        }

        function openEditModal(operation) {
            document.getElementById('editDataCode').value = operation.code;

            const editDaySelector = document.getElementById('editDay');
            editDaySelector.innerHTML = ''; // Clear previous options

            for (let i = 1; i <= 8; i++) {
                const headerDate = document.getElementById(`day${i}`).children[1].textContent.trim();
                const dateParts = headerDate.split(' ');
                const day = parseInt(dateParts[0]);
                const month = getMonthNumber(dateParts[1]);
                const year = parseInt(dateParts[2]);

                const option = document.createElement('option');
                option.value = day;
                option.textContent = `${dateParts[0]} - ${dateParts[1]} ${dateParts[2]}`;
                if (day === parseInt(operation.day) && month === parseInt(operation.month) && year === parseInt(operation.year)) {
                    option.selected = true;
                }
                editDaySelector.appendChild(option);
            }

            const timeParts = operation.time.split(':');
            document.getElementById('editHours').value = timeParts[0];
            document.getElementById('editMinutes').value = timeParts[1];
            document.getElementById('editDataNotes').value = operation.notes;
            document.getElementById('editDataStatus').value = operation.status;
            currentOperationId = operation.id;
            editDataModal.classList.remove('hidden');
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

    function increaseHourEdit() {
        const hoursInput = document.getElementById('editHours');
        let hours = parseInt(hoursInput.value, 10);
        if (hours < 23) {
            hours += 1;
        } else {
            hours = 0;
        }
        hoursInput.value = hours.toString().padStart(2, '0');
    }

    function decreaseHourEdit() {
        const hoursInput = document.getElementById('editHours');
        let hours = parseInt(hoursInput.value, 10);
        if (hours > 0) {
            hours -= 1;
        } else {
            hours = 23;
        }
        hoursInput.value = hours.toString().padStart(2, '0');
    }

    function increaseMinuteEdit() {
        const minutesInput = document.getElementById('editMinutes');
        let minutes = parseInt(minutesInput.value, 10);
        if (minutes < 59) {
            minutes += 1;
        } else {
            minutes = 0;
        }
        minutesInput.value = minutes.toString().padStart(2, '0');
    }

    function decreaseMinuteEdit() {
        const minutesInput = document.getElementById('editMinutes');
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
