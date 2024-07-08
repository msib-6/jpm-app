<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/tailwind.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Jost:ital,wght@0,100..900;1,100..900&family=Poppins:wght@400;600;700&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">
    <title>Machine Schedule Display</title>
    @vite('resources/css/pjl/view.css')
</head>

<body>
<div class="container mx-auto px-4">
    <!-- Code -->
    <input type="text" id="userId" hidden value="{{ auth()->user()->id }}">
    <!-- Card Title -->
    <div class="bg-gray-100 p-6 rounded-3xl shadow-2xl my-4 mx-auto flex items-center justify-between"
         style="width: 91.666667%; backdrop-filter: blur(7px); background-color: rgba(255, 255, 255, 0.5);">
        <h3 id="title" class="text-2xl font-bold">
            <span id="line-display">{{ ucfirst(str_replace('Line', 'Line ', $line)) }}</span>
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
    <div class="header-days bg-gray-100  p-6 rounded-3xl shadow-2xl my-4 mx-auto"
         style="width: 91.666667%; display: none; backdrop-filter: blur(7px); background-color: rgba(255, 255, 255, 0.5);"
         id="headerDays">
        <div class="grid grid-cols-10 gap-4 text-center font-semibold">
            <div class="flex font-bold items-center justify-center col-span-2 text-xl">Mesin</div>
            <!-- Dynamic date headers -->
            <div id="day1" class="flex flex-col justify-center items-center"><span
                    class="font-bold">Senin</span><span style="font-size: 12px;">Date 1</span></div>
            <div id="day2" class="flex flex-col justify-center items-center"><span
                    class="font-bold">Selasa</span><span style="font-size: 12px;">Date 2</span></div>
            <div id="day3" class="flex flex-col justify-center items-center"><span
                    class="font-bold">Rabu</span><span style="font-size: 12px;">Date 3</span></div>
            <div id="day4" class="flex flex-col justify-center items-center"><span
                    class="font-bold">Kamis</span><span style="font-size: 12px;">Date 4</span></div>
            <div id="day5" class="flex flex-col justify-center items-center"><span
                    class="font-bold">Jumat</span><span style="font-size: 12px;">Date 5</span></div>
            <div id="day6" class="flex flex-col justify-center items-center"><span
                    class="font-bold">Sabtu</span><span style="font-size: 12px;">Date 6</span></div>
            <div id="day7" class="flex flex-col justify-center items-center"><span
                    class="font-bold">Minggu</span><span style="font-size: 12px;">Date 7</span></div>
            <div id="day8" class="flex flex-col justify-center items-center"><span
                    class="font-bold">Senin</span><span style="font-size: 12px;">Date 8</span></div>
        </div>
    </div>

    <!-- Data Container -->
    <div id="dataContainer" class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto"
         style="width: 91.666667%; backdrop-filter: blur(7px); background-color: rgba(255, 255, 255, 0.5);">
        <!-- Dynamic rows for machines will be appended here -->
    </div>

    <!-- Global Description Container -->
    <div id="globalDescContainer"
         class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto flex flex-col items-center"
         style="width: 91.666667%;">
        <h1 class="font-bold text-2xl mb-4">
            Description
        </h1>
        <!-- Add Description Button -->
        <button id="openGlobalDescModalButton"
                class="add-desc-button relative inline-flex items-center justify-center p-0.5 mb-4 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
                <span
                    class="relative add-desc-button2 px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                    Add Description
                </span>
        </button>
        <!-- Dynamic rows for Global Desc will be appended here -->
        <div id="globalDescs" class="flex flex-col items-center w-full">
            <!-- Descriptions will be dynamically inserted here -->
        </div>
    </div>

    <!-- Button Bawah -->
    <div class="my-4 mx-auto flex flex-col" style="width: 91.666667%;">
        <div class="flex justify-between items-center">
            <div class="flex justify-start">
                <button id="historyButton"
                        class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 mr-2">History</button>
            </div>
            <div class="flex justify-end">
                <button id="sendWeekButton"
                        class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Send Week</button>
            </div>
        </div>
    </div>

    <!-- Add Mesin Button -->
    <button type="button" id="openModalButton"
            class="add-mesin-button text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
        Add Mesin
    </button>

    <!-- Modal Add Mesin -->
    <div id="addMesinModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-lg">
            <h2 class="text-2xl mb-4">Add Mesin</h2>
            <form id="addMesinForm">
                <div id="mesinCheckboxContainer" class="mb-4" style="max-height: 450px; overflow-y: auto;">
                    <!-- Checkboxes will be appended here -->
                </div>
                <div class="flex justify-end">
                    <button type="button" id="closeModalButton"
                            class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 mr-2">Cancel</button>
                    <button type="submit"
                            class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600">Add
                        Mesin</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Add Data -->
    <div id="addDataModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-lg">
            <h2 class="text-2xl mb-4">Add Data</h2>
            <form id="addDataForm">
                <div class="mb-4">
                    <label for="dataCode" class="block text-gray-700">Kode</label>
                    <input type="text" id="dataCode" class="w-full px-3 py-2 border rounded-lg" required
                           placeholder="Contoh: KTNLGG12345" maxlength="11">
                </div>
                <!-- Time -->
                <div class="mb-4 time-picker">
                    <label for="dataTime" class="block text-gray-700">Jam :</label>
                    <div class="time-inputs">
                        <div class="time-input">
                            <button type="button" onclick="increaseHour()">&#9650;</button>
                            <input type="number" id="hours" value="07" min="0" max="23"
                                   step="1" required>
                            <button type="button" onclick="decreaseHour()">&#9660;</button>
                        </div>
                        <span>:</span>
                        <div class="time-input">
                            <button type="button" onclick="increaseMinute()">&#9650;</button>
                            <input type="number" id="minutes" value="00" min="0" max="59"
                                   step="1" required>
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
                    <button type="button" id="closeDataModalButton"
                            class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 mr-2">Cancel</button>
                    <button type="submit"
                            class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600">Add Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Add Global Description -->
    <div id="addGlobalDescModal"
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-lg">
            <h2 class="text-2xl mb-4">Add Global Description</h2>
            <form id="addGlobalDescForm">
                <div class="mb-4">
                    <label for="globalDesc" class="block text-gray-700">Description</label>
                    <textarea id="globalDesc" class="w-full px-3 py-2 border rounded-lg" rows="3" required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" id="closeGlobalDescModalButton"
                            class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 mr-2">Cancel</button>
                    <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Add
                        Description</button>
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
                            <input type="number" id="editHours" value="07" min="0" max="23"
                                   step="1" required>
                            <button type="button" onclick="decreaseHourEdit()">&#9660;</button>
                        </div>
                        <span>:</span>
                        <div class="time-input">
                            <button type="button" onclick="increaseMinuteEdit()">&#9650;</button>
                            <input type="number" id="editMinutes" value="00" min="0" max="59"
                                   step="1" required>
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
                    <button type="button" id="deleteOperationButton"
                            class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 mr-2">Delete
                        Operation</button>
                    <div class="flex justify-end">
                        <button type="button" id="closeEditDataModalButton"
                                class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 mr-2">Cancel</button>
                        <button type="submit"
                                class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600">Save
                            Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal View Global Description -->
    <div id="viewGlobalDescModal"
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-lg">
            <h2 class="text-2xl mb-4">View Global Description</h2>
            <div id="globalDescContent" class="mb-4">
                <!-- Description content will be populated here -->
            </div>
            <div class="flex justify-between items-center">
                <button type="button" id="deleteGlobalDescButton"
                        class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Delete</button>
                <button type="button" id="closeViewGlobalDescModalButton"
                        class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 mr-2">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Modal View Machine Data -->
    <div id="viewMachineDataModal"
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-lg">
            <h2 class="text-2xl mb-4">View Machine Data</h2>
            <div id="machineDataContent" class="mb-4">
                <!-- Machine data content will be populated here -->
            </div>
            <div class="flex justify-between items-center">
                <button type="button" id="closeViewMachineDataModalButton"
                        class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 mr-2">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Modal Confirm Delete -->
    <div id="confirmDeleteModal"
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-lg">
            <h2 class="text-2xl mb-4">Confirm Delete</h2>
            <p id="deleteConfirmMessage" class="mb-4">Are you sure you want to delete this item?</p>
            <div class="flex justify-between items-center">
                <button type="button" id="closeConfirmDeleteModalButton"
                        class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 mr-2">Cancel</button>
                <button type="button" id="confirmDeleteButton"
                        class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Delete</button>
            </div>
        </div>
    </div>

    <!-- Custom Alert Modal -->
    <div id="custom-alert" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
            <h2 class="text-xl font-bold mb-4">Alert</h2>
            <p id="custom-alert-message" class="mb-4">This is a custom alert message.</p>
            <div class="flex justify-between items-end">
                <button onclick="closeAlert()"
                        class="justify-end bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Close</button>
            </div>
        </div>
    </div>

    <!-- History Modal -->
    <div id="historyModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-3xl">
            <h2 class="text-2xl mb-4">History</h2>
            <div class="mb-4 overflow-y-auto" style="max-height: 450px;">
                <!-- History content will be populated here -->

                @foreach ($list as $audit)
                @if ($audit['changes'] != null)
                <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                    @php
                    $newState = $audit['changes']['new_state'] ?? null;
                    $originalState = $audit['changes']['original_state'] ?? null;
                    $actionDate = \Carbon\Carbon::parse($audit['timestamp'])->setTimezone('Asia/Jakarta');
                    $actionTime = $actionDate->format('H:i:s');
                    $actionDateFormatted = $actionDate->format('d F Y');
                    @endphp

                    @if ($audit['event'] === 'add' && $newState)
                    <p><strong>Action:</strong> <span class="text-green-600">ADD</span></p>
                    <p>Pada <span class="text-green-600">Week {{ $newState['week'] }}</span>, <span
                            class="text-green-600">{{ $newState['day'] ?? 'NA' }}
                                            {{ $newState['month'] ?? 'NA' }} {{ $newState['year'] ?? 'NA' }}</span>, Kode Ruah
                        <span class="text-green-600">{{ $newState['code'] ?? 'NA' }}</span>, Status:
                        <span class="text-green-600">{{ $newState['status'] ?? 'NA' }}</span>, Catatan:
                        <span class="text-green-600">{{ $newState['notes'] ?? 'NA' }}</span> telah
                        ditambahkan oleh
                        <span class="text-green-600">{{ $newState['userId'] ?? 'NA' }}</span>
                    </p>
                    @elseif ($audit['event'] === 'edit' && $newState && $originalState)
                    @php
                    $newUpdatedAt = \Carbon\Carbon::parse($newState['updated_at'])->addHours(7);
                    $updatedDate = $newUpdatedAt->format('d F Y');
                    $updatedTime = $newUpdatedAt->format('H:i');
                    $originalDate =
                    $originalState['day'] ??
                    'NA' . ' ' . $originalState['month'] . ' ' . $originalState['year'];
                    $newDate =
                    $newState['day'] ??
                    'NA' . ' ' . $newState['month'] . ' ' . $newState['year'];
                    @endphp
                    <p><strong>Action:</strong> <span class="text-green-600">EDIT</span></p>
                    <p>Pada <span class="text-red-600">Week {{ $originalState['week'] }}</span>, <span
                            class="text-red-600">{{ $originalDate }}</span>. Kode Ruah <span
                            class="text-red-600">{{ $originalState['code'] }}</span>, Status: <span
                            class="text-red-600">{{ $originalState['status'] }}</span>, Catatan: <span
                            class="text-red-600">{{ $originalState['notes'] }}</span> telah diubah
                        oleh
                        <span class="text-red-600">{{ $newState['users_id'] }}</span> pada <span
                            class="text-red-600">{{ $updatedDate }}</span> pukul <span
                            class="text-red-600">{{ $updatedTime }}</span> menjadi Kode Ruah <span
                            class="text-blue-600">{{ $newState['code'] }}</span>, Status: <span
                            class="text-blue-600">{{ $newState['status'] }}</span>, Catatan: <span
                            class="text-blue-600">{{ $newState['notes'] }}</span> ke tanggal <span
                            class="text-blue-600">{{ $newState['day'] ?? 'NA' }} Week
                                            {{ $newState['week'] }}</span>
                    </p>
                    @elseif ($audit['event'] === 'delete' && $originalState)
                    <p><strong>Action:</strong> <span class="text-green-600">DELETE</span></p>
                    <p>Pada <span class="text-green-600">Week {{ $originalState['week'] }}</span>.
                        Description <span
                            class="text-green-600">"{{ $originalState['description'] }}"</span>
                        dihapus
                        pada <span class="text-green-600">{{ $actionDateFormatted }}</span></p>
                    @elseif ($audit['event'] === 'send_revision')
                    <p><strong>Action:</strong> <span class="text-green-600">SEND REVISION</span></p>
                    <p>Revisi dikirim pada <span
                            class="text-green-600">{{ $actionDateFormatted }}</span>
                        pukul <span class="text-green-600">{{ $actionTime }}</span></p>
                    @endif
                </div>
                @endif
                @endforeach
            </div>
            <div class="flex justify-end">
                <button type="button" id="closeHistoryModalButton"
                        class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 mr-2">Close</button>
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
        const confirmDeleteModal = document.getElementById('confirmDeleteModal');
        const deleteConfirmMessage = document.getElementById('deleteConfirmMessage');
        const confirmDeleteButton = document.getElementById('confirmDeleteButton');
        const sendWeekButton = document.getElementById('sendWeekButton');
        const historyButton = document.getElementById('historyButton');
        const historyModal = document.getElementById('historyModal');
        const closeHistoryModalButton = document.getElementById('closeHistoryModalButton');
        const historyContent = document.getElementById('historyContent');
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
            }
            confirmDeleteModal.classList.add('hidden');
        });

        closeViewMachineDataModalButton.addEventListener('click', function() {
            viewMachineDataModal.classList.add('hidden');
        });


        sendWeekButton.addEventListener('click', async function() {
            const userId = document.getElementById('userId').value;
            const params = new URLSearchParams(window.location.search);
            const line = params.get('line');
            const month = params.get('month');
            const week = params.get('week');
            const year = params.get('year');
            const url =
                `http://127.0.0.1:8000/api/sendrevision?line=${line}&year=${year}&month=${month}&week=${week}`;

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        userId
                    }),
                });

                if (response.ok) {
                    window.location.href =
                        `onlyView?line=${line}&year=${year}&month=${month}&week=${week}`;
                } else {
                    const errorData = await response.json();
                    showAlert(`Error sending week data: ${errorData.message}`);
                }
            } catch (error) {
                showAlert(`Error sending week data: ${error.message}`);
            }
        });

        historyButton.addEventListener('click', async function() {
            // await fetchAndDisplayHistory();
            historyModal.classList.remove('hidden');
        });

        closeHistoryModalButton.addEventListener('click', function() {
            historyModal.classList.add('hidden');
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
            const userId = document.getElementById('userId').value;

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
                        year,
                        userId
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
            const userId = document.getElementById('userId').value;
            const hours = document.getElementById('hours').value;
            const minutes = document.getElementById('minutes').value;
            const time = `${hours}:${minutes}`;
            const notes = document.getElementById('dataNotes').value;
            const status = document.getElementById('dataStatus').value;

            try {
                const response = await fetch('http://127.0.0.1:8000/api/addmachineoperation', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        machineId,
                        dataCode,
                        day,
                        month,
                        year,
                        userId,
                        time,
                        notes,
                        status
                    }),
                });

                if (response.ok) {
                    showAlert('Data added successfully');
                    await fetchDataForWeek(line, year, month, week); // Refresh data after adding
                } else {
                    const errorData = await response.json();
                    showAlert(`Error adding data: ${errorData.message}`);
                }
            } catch (error) {
                showAlert(`Error adding data: ${error.message}`);
            }
        }

        function displayMachineData(operations, machines, machineInfoMap, week) {
            const dataContainer = document.getElementById('dataContainer');
            dataContainer.innerHTML = ''; // Clear existing rows

            const machineOperationsMap = new Map();
            operations.forEach(operation => {
                const machineIdKey = operation.week === week ? operation.machine_id : operation.machine_id_parent;
                if (!machineOperationsMap.has(machineIdKey)) {
                    machineOperationsMap.set(machineIdKey, []);
                }
                machineOperationsMap.get(machineIdKey).push(operation);
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

                for (let i = 1; i <= 8; i++) {
                    const headerDate = document.getElementById(`day${i}`).children[1].textContent.trim();
                    const dateParts = headerDate.split(' ');
                    const day = parseInt(dateParts[0]);
                    const dayColumn = document.getElementById(`daydata${machine.id}-${day}`);
                    if (dayColumn) {
                        const addButton = document.createElement('button');
                        addButton.className = 'add-jpm-button add-data-button rounded-full bg-grey-500 text-white text-xs w-7 h-7 thin-plus';
                        addButton.textContent = '+';
                        addButton.onclick = async function() {
                            const params = new URLSearchParams(window.location.search);
                            const line = params.get('line');
                            currentMachineId = machine.id;
                            currentMachineIdWeekly = machine.machine_id;
                            currentDay = day;
                            currentMonth = getMonthNumber(dateParts[1]);
                            currentYear = parseInt(dateParts[2]);

                            const isLastMonday = i === 8;
                            if (isLastMonday) {
                                const nextWeek = parseInt(week) + 1;
                                const response = await fetch(`http://127.0.0.1:8000/api/showweeklymachine?line=${line}&year=${currentYear}&month=${currentMonth}&week=${nextWeek}`);
                                const nextWeekMachines = await response.json();
                                const nextWeekMachine = nextWeekMachines.find(m => m.machine_name === machine.machine_name);
                                if (nextWeekMachine) {
                                    currentMachineIdWeekly = nextWeekMachine.machine_id;
                                    currentDay = day;
                                }
                            }

                            addDataModal.classList.remove('hidden');
                        };
                        dayColumn.appendChild(addButton);
                    }
                }

                machineRow.querySelector('.mesin-jpm').onclick = function() {
                    viewMachineData(machine);
                };
            });
        }


        async function editData(operationId) {
            const dataCode = document.getElementById('editDataCode').value;
            const userId = document.getElementById('userId').value;
            const day = document.getElementById('editDay').value;
            const hours = document.getElementById('editHours').value;
            const minutes = document.getElementById('editMinutes').value;
            const time = `${hours}:${minutes}`;
            const notes = document.getElementById('editDataNotes').value;
            const status = document.getElementById('editDataStatus').value;

            try {
                const response = await fetch(`http://127.0.0.1:8000/api/editmachineoperation/${operationId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        dataCode,
                        day,
                        userId,
                        time,
                        notes,
                        status
                    }),
                });

                if (response.ok) {
                    showAlert('Data updated successfully');
                    await fetchDataForWeek(currentLine, currentYear, currentMonth, currentWeek); // Refresh data after updating
                } else {
                    const errorData = await response.json();
                    showAlert(`Error updating data: ${errorData.message}`);
                }
            } catch (error) {
                showAlert(`Error updating data: ${error.message}`);
            }
        }

        async function deleteData(operationId) {
            try {
                const response = await fetch(`http://127.0.0.1:8000/api/deletemachineoperation/${operationId}`, {
                    method: 'DELETE',
                });

                if (response.ok) {
                    showAlert('Data deleted successfully');
                    await fetchDataForWeek(currentLine, currentYear, currentMonth, currentWeek); // Refresh data after deleting
                } else {
                    const errorData = await response.json();
                    showAlert(`Error deleting data: ${errorData.message}`);
                }
            } catch (error) {
                showAlert(`Error deleting data: ${error.message}`);
            }
        }

        async function fetchAndDisplayGlobalDescriptions() {
            const params = new URLSearchParams(window.location.search);
            const line = params.get('line');
            const month = params.get('month');
            const week = params.get('week');
            const year = params.get('year');

            try {
                const response = await fetch(`http://127.0.0.1:8000/api/getglobaldescription?line=${line}&year=${year}&month=${month}&week=${week}`);
                const descriptions = await response.json();

                globalDescs.innerHTML = ''; // Clear existing descriptions

                descriptions.forEach(desc => {
                    const descElement = document.createElement('div');
                    descElement.className = 'bg-white shadow-md rounded-lg p-4 mb-4';
                    descElement.innerHTML = `
                        <p class="text-gray-700">${desc.description}</p>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 mt-2" onclick="viewGlobalDescription(${desc.id}, '${desc.description}')">View</button>
                    `;
                    globalDescs.appendChild(descElement);
                });
            } catch (error) {
                console.error('Error fetching global descriptions:', error);
            }
        }

        async function addGlobalDescription() {
            const description = document.getElementById('globalDesc').value;
            const params = new URLSearchParams(window.location.search);
            const line = params.get('line');
            const month = params.get('month');
            const week = params.get('week');
            const year = params.get('year');
            const userId = document.getElementById('userId').value;

            try {
                const response = await fetch('http://127.0.0.1:8000/api/addglobaldescription', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        description,
                        line,
                        month,
                        week,
                        year,
                        userId
                    }),
                });

                if (response.ok) {
                    showAlert('Description added successfully');
                    await fetchAndDisplayGlobalDescriptions(); // Refresh global descriptions after adding
                } else {
                    const errorData = await response.json();
                    showAlert(`Error adding description: ${errorData.message}`);
                }
            } catch (error) {
                showAlert(`Error adding description: ${error.message}`);
            }
        }

        function viewGlobalDescription(id, description) {
            currentGlobalDescId = id;
            document.getElementById('globalDescContent').textContent = description;
            viewGlobalDescModal.classList.remove('hidden');
        }

        async function deleteGlobalDescription(id) {
            try {
                const response = await fetch(`http://127.0.0.1:8000/api/deleteglobaldescription/${id}`, {
                    method: 'DELETE',
                });

                if (response.ok) {
                    showAlert('Description deleted successfully');
                    await fetchAndDisplayGlobalDescriptions(); // Refresh global descriptions after deleting
                } else {
                    const errorData = await response.json();
                    showAlert(`Error deleting description: ${errorData.message}`);
                }
            } catch (error) {
                showAlert(`Error deleting description: ${error.message}`);
            }
        }

        function confirmDeleteOperation(operationId) {
            currentOperationId = operationId;
            deleteConfirmMessage.textContent = 'Are you sure you want to delete this operation?';
            confirmDeleteButton.setAttribute('data-delete-mode', 'operation');
            confirmDeleteModal.classList.remove('hidden');
        }

        function confirmDeleteGlobalDesc(descId) {
            currentGlobalDescId = descId;
            deleteConfirmMessage.textContent = 'Are you sure you want to delete this global description?';
            confirmDeleteButton.setAttribute('data-delete-mode', 'description');
            confirmDeleteModal.classList.remove('hidden');
        }

        function getQueryParams() {
            const params = new URLSearchParams(window.location.search);
            currentLine = params.get('line');
            currentMonth = params.get('month');
            currentWeek = params.get('week');
            currentYear = params.get('year');
            document.getElementById('month-display').textContent = currentMonth;
            document.getElementById('year-display').textContent = currentYear;
            fetchDataForWeek(currentLine, currentYear, currentMonth, currentWeek);
        }

        function updateURL(line, year, month, week) {
            const newUrl = `${window.location.pathname}?line=${line}&year=${year}&month=${month}&week=${week}`;
            history.replaceState(null, '', newUrl);
        }

        function setupAutoRefresh() {
            setInterval(() => {
                fetchDataForWeek(currentLine, currentYear, currentMonth, currentWeek);
            }, 60000); // Refresh every 60 seconds
        }

        function increaseHour() {
            const hourInput = document.getElementById('hours');
            let hour = parseInt(hourInput.value, 10);
            hour = (hour + 1) % 24;
            hourInput.value = hour.toString().padStart(2, '0');
        }

        function decreaseHour() {
            const hourInput = document.getElementById('hours');
            let hour = parseInt(hourInput.value, 10);
            hour = (hour - 1 + 24) % 24;
            hourInput.value = hour.toString().padStart(2, '0');
        }

        function increaseMinute() {
            const minuteInput = document.getElementById('minutes');
            let minute = parseInt(minuteInput.value, 10);
            minute = (minute + 1) % 60;
            minuteInput.value = minute.toString().padStart(2, '0');
        }

        function decreaseMinute() {
            const minuteInput = document.getElementById('minutes');
            let minute = parseInt(minuteInput.value, 10);
            minute = (minute - 1 + 60) % 60;
            minuteInput.value = minute.toString().padStart(2, '0');
        }

        function increaseHourEdit() {
            const hourInput = document.getElementById('editHours');
            let hour = parseInt(hourInput.value, 10);
            hour = (hour + 1) % 24;
            hourInput.value = hour.toString().padStart(2, '0');
        }

        function decreaseHourEdit() {
            const hourInput = document.getElementById('editHours');
            let hour = parseInt(hourInput.value, 10);
            hour = (hour - 1 + 24) % 24;
            hourInput.value = hour.toString().padStart(2, '0');
        }

        function increaseMinuteEdit() {
            const minuteInput = document.getElementById('editMinutes');
            let minute = parseInt(minuteInput.value, 10);
            minute = (minute + 1) % 60;
            minuteInput.value = minute.toString().padStart(2, '0');
        }

        function decreaseMinuteEdit() {
            const minuteInput = document.getElementById('editMinutes');
            let minute = parseInt(minuteInput.value, 10);
            minute = (minute - 1 + 60) % 60;
            minuteInput.value = minute.toString().padStart(2, '0');
        }

        async function displayMachineData(operationsData, machinesData, machineInfoMap, week) {
            const dataContainer = document.getElementById('dataContainer');
            dataContainer.innerHTML = ''; // Clear existing data

            const headerDays = document.getElementById('headerDays');
            headerDays.style.display = 'block'; // Ensure the header is displayed

            // Date placeholders
            const dayPlaceholders = ['day1', 'day2', 'day3', 'day4', 'day5', 'day6', 'day7', 'day8'];

            // Fill in the date placeholders
            const currentDate = new Date();
            currentDate.setDate(currentDate.getDate() - currentDate.getDay() + 1); // Start of the week

            for (let i = 0; i < dayPlaceholders.length; i++) {
                const datePlaceholder = document.getElementById(dayPlaceholders[i]);
                const day = currentDate.getDate();
                const month = currentDate.getMonth() + 1; // Months are zero-based
                datePlaceholder.innerHTML = `<span class="font-bold">${datePlaceholder.querySelector('span:first-child').textContent}</span><span style="font-size: 12px;">${day}/${month}</span>`;
                currentDate.setDate(day + 1);
            }

            // Group operations by machine
            const operationsByMachine = operationsData.reduce((acc, operation) => {
                if (!acc[operation.machine_name]) {
                    acc[operation.machine_name] = [];
                }
                acc[operation.machine_name].push(operation);
                return acc;
            }, {});

            // Display machines and their operations
            machinesData.forEach(machine => {
                const machineRow = document.createElement('div');
                machineRow.className = 'grid grid-cols-10 gap-4 items-center mb-4';

                const machineName = document.createElement('div');
                machineName.className = 'col-span-2 font-bold';
                machineName.textContent = machine.machine_name;
                machineRow.appendChild(machineName);

                for (let i = 0; i < 8; i++) {
                    const dayCell = document.createElement('div');
                    dayCell.className = 'flex flex-col justify-center items-center';

                    const addButton = document.createElement('button');
                    addButton.className = 'bg-green-500 text-white px-2 py-1 rounded-lg hover:bg-green-600';
                    addButton.textContent = 'Add';
                    addButton.addEventListener('click', () => {
                        currentMachineId = machine.id;
                        currentDay = i + 1;
                        currentMonth = machine.month;
                        currentYear = machine.year;
                        addDataModal.classList.remove('hidden');
                    });

                    dayCell.appendChild(addButton);
                    machineRow.appendChild(dayCell);
                }

                dataContainer.appendChild(machineRow);

                // Display operations for each machine
                if (operationsByMachine[machine.machine_name]) {
                    operationsByMachine[machine.machine_name].forEach(operation => {
                        const operationRow = document.createElement('div');
                        operationRow.className = 'grid grid-cols-10 gap-4 items-center mb-4';

                        const operationMachineName = document.createElement('div');
                        operationMachineName.className = 'col-span-2 font-bold text-gray-600';
                        operationMachineName.textContent = '';
                        operationRow.appendChild(operationMachineName);

                        for (let i = 0; i < 8; i++) {
                            const operationDayCell = document.createElement('div');
                            operationDayCell.className = 'flex flex-col justify-center items-center';

                            if (operation.day === i + 1) {
                                const operationInfo = document.createElement('div');
                                operationInfo.className = 'text-center';
                                operationInfo.innerHTML = `
                                    <div>${operation.dataCode}</div>
                                    <div>${operation.time}</div>
                                    <div>${operation.notes}</div>
                                    <div>${operation.status}</div>
                                `;

                                const editButton = document.createElement('button');
                                editButton.className = 'bg-blue-500 text-white px-2 py-1 rounded-lg hover:bg-blue-600 mt-2';
                                editButton.textContent = 'Edit';
                                editButton.addEventListener('click', () => {
                                    currentOperationId = operation.id;
                                    document.getElementById('editDataCode').value = operation.dataCode;
                                    document.getElementById('editDay').value = operation.day;
                                    document.getElementById('editHours').value = operation.time.split(':')[0];
                                    document.getElementById('editMinutes').value = operation.time.split(':')[1];
                                    document.getElementById('editDataNotes').value = operation.notes;
                                    document.getElementById('editDataStatus').value = operation.status;
                                    editDataModal.classList.remove('hidden');
                                });

                                operationDayCell.appendChild(operationInfo);
                                operationDayCell.appendChild(editButton);
                            }

                            operationRow.appendChild(operationDayCell);
                        }

                        dataContainer.appendChild(operationRow);
                    });
                }
            });
        }
    });
</script>
</body>

</html>
