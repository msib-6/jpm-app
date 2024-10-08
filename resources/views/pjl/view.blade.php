<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
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
                    <button id="savetodraftButton"
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 mr-2">Save to
                        Draft</button>
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
                                    $actionDate = \Carbon\Carbon::parse($audit['timestamp'])->setTimezone(
                                        'Asia/Jakarta',
                                    );
                                    $actionTime = $actionDate->format('H:i:s');
                                    $actionDateFormatted = $actionDate->format('d F Y');
                                @endphp

                                @if ($audit['event'] === 'add' && $newState)
                                    <p><strong>Action:</strong> <span class="text-green-600">ADD</span></p>
                                    <p>Pada <span class="text-green-600">Week {{ $newState['week'] ?? 'NA' }}</span>,
                                        Tanggal
                                        <span class="text-green-600">{{ $actionDateFormatted }}</span>,
                                        Kode Ruah
                                        <span class="text-green-600">{{ $newState['code'] ?? 'NA' }}</span>, Status:
                                        <span class="text-green-600">{{ $newState['status'] ?? 'NA' }}</span>, Catatan:
                                        <span class="text-green-600">{{ $newState['notes'] ?? 'NA' }}</span> telah
                                        ditambahkan oleh
                                        <span class="text-green-600">{{ $audit['fullname'] ?? 'NA' }}</span>
                                    </p>
                                @elseif ($audit['event'] === 'edit' && $newState && $originalState)
                                    @php
                                        $newUpdatedAt = \Carbon\Carbon::parse($newState['updated_at'])->setTimezone(
                                            'Asia/Jakarta',
                                        );
                                        $updatedDate = $newUpdatedAt->format('d F Y');
                                        $updatedTime = $newUpdatedAt->format('H:i');
                                        $originalDate =
                                            ($originalState['day'] ?? 'NA') .
                                            ' ' .
                                            ($originalState['month'] ?? 'NA') .
                                            ' ' .
                                            ($originalState['year'] ?? 'NA');
                                        $newDate =
                                            ($newState['day'] ?? 'NA') .
                                            ' ' .
                                            ($newState['month'] ?? 'NA') .
                                            ' ' .
                                            ($newState['year'] ?? 'NA');
                                    @endphp
                                    <p><strong>Action:</strong> <span class="text-yellow-600">EDIT</span></p>
                                    <p>Pada <span class="text-yellow-600">Week
                                            {{ $originalState['week'] ?? 'NA' }}</span>,
                                        <span class="text-yellow-600">{{ $originalDate }}</span>. Kode Ruah <span
                                            class="text-yellow-600">{{ $originalState['code'] ?? 'NA' }}</span>,
                                        Status: <span
                                            class="text-yellow-600">{{ $originalState['status'] ?? 'NA' }}</span>,
                                        Catatan:
                                        <span class="text-yellow-600">{{ $originalState['notes'] ?? 'NA' }}</span>
                                        telah
                                        diubah
                                        oleh
                                        <span class="text-yellow-600">{{ $audit['fullname'] ?? 'NA' }}</span> pada
                                        <span class="text-yellow-600">{{ $updatedDate }}</span> pukul <span
                                            class="text-yellow-600">{{ $updatedTime }}</span> menjadi Kode Ruah <span
                                            class="text-blue-600">{{ $newState['code'] ?? 'NA' }}</span>, Status:
                                        <span class="text-blue-600">{{ $newState['status'] ?? 'NA' }}</span>, Catatan:
                                        <span class="text-blue-600">{{ $newState['notes'] ?? 'NA' }}</span> ke tanggal
                                        <span class="text-blue-600">{{ $newState['day'] ?? 'NA' }}
                                            {{ $newState['month'] ?? 'NA' }} {{ $newState['year'] ?? 'NA' }}</span>
                                        Pada
                                        <span class="text-blue-600"> Week {{ $newState['week'] ?? 'NA' }}</span>
                                    </p>
                                @elseif ($audit['event'] === 'delete' && $originalState)
                                    <p><strong>Action:</strong> <span class="text-red-600">DELETE</span></p>
                                    <p>Pada Line: <span
                                            class="text-red-600">{{ $originalState['line'] ?? 'NA' }}</span>
                                        Week <span class="text-red-600">{{ $originalState['week'] ?? 'NA' }}</span>,
                                        Data tanggal <span class="text-red-600">{{ $originalState['day'] ?? 'NA' }}
                                            {{ $originalState['month'] == null ? 'N/A' : \Carbon\Carbon::createFromFormat('m', $originalState['month'])->format('F') }}
                                            {{ $originalState['year'] ?? 'NA' }}</span>,
                                        Mesin <span
                                            class="text-red-600">{{ $originalState['machine_name'] ?? 'NA' }}</span>,
                                        Kode Ruah <span
                                            class="text-red-600">{{ $originalState['code'] ?? 'NA' }}</span>,
                                        Jam <span class="text-red-600">{{ $originalState['time'] ?? 'NA' }}</span>,
                                        Status <span
                                            class="text-red-600">{{ $originalState['status'] ?? 'NA' }}</span>,
                                        Catatan <span
                                            class="text-red-600">{{ $originalState['notes'] ?? 'NA' }}</span>,
                                        telah dihapus oleh <span
                                            class="text-red-600">{{ $audit['fullname'] ?? 'NA' }}</span>,
                                        pada tanggal <span class="text-red-600">{{ $actionDateFormatted }}</span>
                                    </p>
                                @elseif ($audit['event'] === 'send_revision')
                                    <p><strong>Action:</strong> <span class="text-purple-600">SEND JPM FORM</span></p>
                                    <p>Revisi pada <span class="text-purple-600">Week
                                            {{ $audit['changes']['original_state'][0]['week'] ?? 'NA' }}</span> dikirim
                                        pada tanggal
                                        <span class="text-purple-600">{{ $actionDateFormatted }}</span> pukul <span
                                            class="text-purple-600">{{ $actionTime }}</span>
                                        oleh
                                        <span class="text-purple-600">{{ $audit['fullname'] ?? 'NA' }}</span>
                                    </p>
                                @elseif ($audit['event'] == 'descadd')
                                    @php
                                        $date = \Carbon\Carbon::parse($audit['timestamp'])->setTimezone('Asia/Jakarta');
                                        $formattedDate = $date->format('F');
                                        $formattedTime = $date->format('H:i');
                                        $week = $audit['changes']['new_state']['week'] ?? 'N/A';
                                    @endphp
                                    <p><strong>Action:</strong> <span class="text-green-600">Add Global Desc</span>
                                    </p>
                                    <p>Pada Week <span class="text-green-600">{{ $week }}</span>,
                                        <span class="text-green-600">{{ $audit['fullname'] ?? 'N/A' }}</span>,
                                        telah menambahkan deskripsi <span class="text-green-600">
                                            {{ $audit['changes']['new_state']['description'] }}</span>,
                                        pukul <span class="text-green-600">{{ $formattedTime }}</span>
                                    </p>
                                @elseif ($audit['event'] == 'descdelete')
                                    @php
                                        $date = \Carbon\Carbon::parse($audit['timestamp'])->setTimezone('Asia/Jakarta');
                                        $formattedDate = $date->format('F');
                                        $formattedTime = $date->format('H:i');
                                        $week = $audit['changes']['original_state']['week'] ?? 'N/A';
                                    @endphp
                                    <p><strong>Action:</strong> <span class="text-red-600">Delete Global Desc</span>
                                    </p>
                                    <p>Pada Week <span class="text-red-600">{{ $week }}</span>,
                                        <span class="text-red-600">{{ $audit['fullname'] ?? 'N/A' }}</span>,
                                        telah menghapus deskripsi <span class="text-red-600">
                                            {{ $audit['changes']['original_state']['description'] }}</span>,
                                        pukul <span class="text-red-600">{{ $formattedTime }}</span>
                                    </p>
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
            const savetodraftButton = document.getElementById('savetodraftButton');
            const historyButton = document.getElementById('historyButton');
            const historyModal = document.getElementById('historyModal');
            const closeHistoryModalButton = document.getElementById('closeHistoryModalButton');
            const historyContent = document.getElementById('historyContent');
            let currentMachineId;
            let currentMachineIdWeekly;
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

            savetodraftButton.addEventListener('click', async function() {
                const userId = document.getElementById('userId').value;
                const params = new URLSearchParams(window.location.search);
                const line = params.get('line');
                const month = params.get('month');
                const week = params.get('week');
                const year = params.get('year');

                showAlert('Save to Draft berhasil');

                window.location.href =
                    `http://127.0.0.1:8000/pjl/${line}/onlyView?year=${year}&month=${month}&week=${week}`;
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

            // Fungsi untuk menambahkan data ke mesin
            async function addDataToMachine(machineId, day, month, year) {
                const dataCode = document.getElementById('dataCode').value;
                const userId = document.getElementById('userId').value;
                const hours = document.getElementById('hours').value;
                const minutes = document.getElementById('minutes').value;
                const dataTime = `${hours}:${minutes}`;
                const dataNotes = document.getElementById('dataNotes').value;
                const dataStatus = document.getElementById('dataStatus').value;
                const params = new URLSearchParams(window.location.search);
                const line = params.get('line');
                const week = params.get('week');
                const daysInWeek = document.querySelectorAll('.day-column');
                const lastMonday = daysInWeek[7].querySelector('.add-data-button') ? true : false;
                let targetWeek = week;
                let targetMachineId = machineId;

                if (day === parseInt(document.getElementById('day8').children[1].textContent.trim().split(' ')[
                        0]) && lastMonday) {
                    const nextWeek = parseInt(week) + 1;
                    const response = await fetch(
                        `http://127.0.0.1:8000/api/showweeklymachine?line=${line}&year=${year}&month=${month}&week=${nextWeek}`
                    );
                    const nextWeekMachines = await response.json();

                    const nextWeekMachine = nextWeekMachines.find(machine => machine.machine_id === parseInt(
                        machineId));
                    if (nextWeekMachine) {
                        targetMachineId = nextWeekMachine.id;
                        targetWeek = nextWeek;
                    }
                }

                const responseAdd = await fetch(
                    `http://127.0.0.1:8000/api/addmachineoperation/${line}/${targetMachineId}`, {
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
                            week: targetWeek,
                            year,
                            userId,
                        }),
                    });

                if (responseAdd.ok) {
                    showAlert(`Data added successfully`);
                } else {
                    const errorData = await responseAdd.json();
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
                const userId = document.getElementById('userId').value;

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
                        year: year,
                        userId,
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
                const userId = document.getElementById('userId').value;
                const response = await fetch(
                    `http://127.0.0.1:8000/api/deletemachineoperation/${operationId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            userId
                        }),
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
                const userId = document.getElementById('userId').value;
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
                        year,
                        userId
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

            async function fetchAndDisplayGlobalDescriptions() {
                const params = new URLSearchParams(window.location.search);
                const line = params.get('line');
                const month = params.get('month');
                const week = params.get('week');
                const year = params.get('year');

                const response = await fetch(`http://127.0.0.1:8000/api/showglobaldescription`);
                const descriptions = await response.json();

                const filteredDescriptions = descriptions.filter(desc => {
                    return desc.line === line && desc.month === month && desc.week === week && desc
                        .year === year;
                });

                globalDescs.innerHTML = ''; // Clear existing descriptions

                filteredDescriptions.forEach(desc => {
                    const descButton = document.createElement('button');
                    descButton.className =
                        'my-2 bg-white descWeek p-2 shadow-md rounded-md py-1 px-2 text-black items-center flex justify-center w-full';
                    descButton.style.width = '90%';
                    descButton.textContent = desc.description;
                    descButton.onclick = function() {
                        viewGlobalDescription(desc);
                    };
                    globalDescs.appendChild(descButton);
                });
            }

            async function deleteGlobalDescription(id) {
                const userId = document.getElementById('userId').value;
                const response = await fetch(`http://127.0.0.1:8000/api/deleteglobaldescription/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        userId
                    }),
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


            async function deleteMachineData(id) {
                const userId = document.getElementById('userId').value;
                const response = await fetch(`http://127.0.0.1:8000/api/deleteweeklymachine/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        userId
                    }),
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

                document.getElementById('line-display').textContent = line ? line.replace('Line', 'Line ') : 'N/A';
                document.getElementById('month-display').textContent = month ? getMonthName(month) : 'N/A';
                document.getElementById('year-display').textContent = year ? year : 'N/A';

                setupWeekButtons(line, year, month);
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
                        true);
                    const allWaitingApproval = operationsData.operations.every(operation => operation
                        .is_approved === false && operation.is_rejected === false);
                    const allRejected = operationsData.operations.every(operation => operation.is_rejected ===
                        true);

                    if (allApproved) {
                        status = "Approved";
                    } else if (allWaitingApproval) {
                        status = "Waiting Approval";
                    } else if (allRejected) {
                        status = "Rejected";
                    }
                }

                document.getElementById('statusWeek').innerHTML = `
                <h3 class="text-2xl font-bold">${status}</h3>
            `;

                const savetodraftButton = document.getElementById('savetodraftButton');
                const sendWeekButton = document.getElementById('sendWeekButton');
                const openModalButton = document.getElementById('openModalButton');
                if (status !== "NEW") {
                    savetodraftButton.style.display = 'none';
                }
                if (status === "Approved") {
                    sendWeekButton.style.display = 'none';
                    openModalButton.style.display = 'none';
                }
                if (week === "1") {
                    sendWeekButton.style.display = 'none';
                    openModalButton.style.display = 'none';
                }
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
                console.log("Fetching data for:", {
                    line,
                    year,
                    month,
                    week
                });
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
                } else if (week === "5" || week === "6") {
                    // Calculate the next month and adjust the year if needed
                    let nextMonth = parseInt(month) + 1;
                    let nextYear = parseInt(year);

                    if (nextMonth > 12) {
                        nextMonth = 1;
                        nextYear += 1;
                    }

                    operationsUrls = [
                        `http://127.0.0.1:8000/api/showmachineoperation?line=${line}&year=${year}&month=${month}&week=${week}`,
                        `http://127.0.0.1:8000/api/showmachineoperation?line=${line}&year=${year}&month=${month}&week=${nextWeek}`,
                        `http://127.0.0.1:8000/api/showmachineoperation?line=${line}&year=${nextYear}&month=${nextMonth}&week=2`
                    ];

                    machinesUrls = [
                        `http://127.0.0.1:8000/api/showweeklymachine?line=${line}&year=${year}&month=${month}&week=${week}`,
                        `http://127.0.0.1:8000/api/showweeklymachine?line=${line}&year=${year}&month=${month}&week=${nextWeek}`,
                        `http://127.0.0.1:8000/api/showweeklymachine?line=${line}&year=${nextYear}&month=${nextMonth}&week=2`
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
                        console.log("Operations data:", data);
                    }

                    let machinesData = [];
                    for (const response of machinesResponses) {
                        const data = await response.json();
                        machinesData = machinesData.concat(data);
                        console.log("Machines data:", data);
                    }

                    const machineInfoData = await machineInfoResponse.json();
                    console.log("Machine info data:", machineInfoData);
                    const machineInfoMap = new Map(machineInfoData.map(machine => [machine.id, machine
                        .category || 'Unknown'
                    ])); // Fallback to'Unknown' if category is empty

                    updateURL(line, year, month, week);
                    displayMachineData(operationsData, machinesData, machineInfoMap, week);
                    await fetchAndDisplayGlobalDescriptions
                        (); // Fetch and display global descriptions for the selected week
                } catch (error) {
                    console.error("Error fetching data:", error);
                }
            }



            function updateURL(line, year, month, week) {
                history.pushState({}, '', `?line=${line}&year=${year}&month=${month}&week=${week}`);
            }

            // Fungsi untuk menampilkan data mesin termasuk operasi untuk minggu berikutnya
            function displayMachineData(operations, machines, machineInfoMap, week) {
                const dataContainer = document.getElementById('dataContainer');
                dataContainer.innerHTML = ''; // Hapus baris yang ada

                const machineOperationsMap = new Map();
                operations.forEach(operation => {
                    let machineIdKey;

                    if (week === 1 && (operation.week === 1 || operation.week === 5 || operation.week ===
                        6)) {
                        machineIdKey = operation.machine_id;
                    } else if (week === 2 && (operation.week === 5 || operation.week === 6 || operation
                        .week === 2 || operation.week === 3)) {
                        machineIdKey = operation.machine_id;
                    } else if (week === 3 && (operation.week === 3 || operation.week === 4)) {
                        machineIdKey = operation.machine_id;
                    } else if (week === 4 && (operation.week === 4 || operation.week === 5)) {
                        machineIdKey = operation.machine_id;
                    } else if (week === 5 && (operation.week === 5 || operation.week === 6 || operation
                        .week === 2)) {
                        machineIdKey = operation.machine_id;
                    } else if (week === 6 && (operation.week === 5 || operation.week === 6 || operation
                        .week === 2)) {
                        machineIdKey = operation.machine_id;
                    } else {
                        machineIdKey = operation.machine_id_parent;
                    }

                    if (!machineOperationsMap.has(machineIdKey)) {
                        machineOperationsMap.set(machineIdKey, []);
                    }

                    machineOperationsMap.get(machineIdKey).push(operation);
                });

                // Sort machines by specified categories
                const categoryOrder = ['Granulasi', 'Drying', 'Final mix/camas', 'kompaksi', 'Cetak', 'Coating',
                    'Mixing', 'Filling', 'Kemas'
                ];
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
                            <div class="flex flex-col justify-center items-center w-9/12 h-full">
                                <span class="inline-flex items-center ${category === 'Granulasi' ? 'custom-badge1' : category === 'Drying' ? 'custom-badge2' : category.includes('Final') ? 'custom-badge3' : category === 'Cetak' ? 'custom-badge4' : category === 'Coating' ? 'custom-badge5' : category === 'Kemas' ? 'custom-badge6' : category === 'Mixing' ? 'custom-badge7' : category === 'Filling' ? 'custom-badge8' : category === 'Kompaksi' ? 'custom-badge9' : ''} text-white text-xs font-medium px-2.5 py-0.5 rounded-full mb-1">
                                    <span class="w-2 h-2 mr-1 bg-white rounded-full"></span>
                                    ${category}
                                </span>
                                <span class="text-sm">${machine.machine_name}</span>
                            </div>
                        </div>
                    `;

                    for (let i = 1; i <= 8; i++) {
                        const headerDate = document.getElementById(`day${i}`).children[1].textContent
                            .trim();
                        const dateParts = headerDate.split(' ');
                        const day = parseInt(dateParts[0]);
                        const dayColumn = document.createElement('div');
                        dayColumn.id = `daydata${machine.machine_id}-${day}`;
                        dayColumn.className = 'col-span-1 day-column';
                        machineRow.appendChild(dayColumn);
                    }

                    dataContainer.appendChild(machineRow);

                    // Mendapatkan operasi mesin untuk minggu ini atau minggu berikutnya
                    const machineOperations = machineOperationsMap.get(machine.machine_id) || [];
                    const machineOperationsNextWeek = machineOperationsMap.get(machine.machine_id_parent) ||
                        [];
                    const allMachineOperations = [...machineOperations, ...machineOperationsNextWeek];

                    allMachineOperations.sort((a, b) => {
                        if (a.status === 'PM') return -1;
                        if (b.status === 'PM') return 1;
                        const [hoursA, minutesA] = a.time.split(':').map(Number);
                        const [hoursB, minutesB] = b.time.split(':').map(Number);
                        return hoursA * 60 + minutesA - (hoursB * 60 + minutesB);
                    });

                    allMachineOperations.forEach(operation => {
                        const dayColumn = document.getElementById(
                            `daydata${machine.machine_id}-${operation.day}`);
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
                            } [operation.status] || '';

                            entry.className =
                                `p-2 border-2 text-xs flex flex-col justify-center isi-jpm text-center entry-button relative ${statusClass}`;
                            entry.style.minHeight = '6em';

                            entry.innerHTML = operation.status && ['PM', 'BCP', 'OFF', 'BREAKDOWN',
                                'CUSU', 'DHT', 'CHT', 'KALIBRASI', 'OVERHAUL', 'CV', 'CPV'
                            ].includes(operation.status) ? `
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
                                    showNotesPopup(event,
                                        `Line: ${operation.current_line}\nNotes: ${operation.notes}`
                                    );
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

                    function getWeeksInMonth(year, month) {
                        const firstDayOfMonth = new Date(year, month - 1, 1).getDay();
                        const lastDateOfMonth = new Date(year, month, 0).getDate();
                        const daysInMonth = firstDayOfMonth + lastDateOfMonth;

                        return Math.ceil(daysInMonth / 7);
                    }

                    for (let i = 1; i <= 8; i++) {
                        const headerDate = document.getElementById(`day${i}`).children[1].textContent.trim();
                        const dateParts = headerDate.split(' ');
                        const day = parseInt(dateParts[0]);
                        const dayColumn = document.getElementById(`daydata${machine.machine_id}-${day}`);
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
                                    const totalWeeks = getWeeksInMonth(currentYear, currentMonth);
                                    let nextWeekUrl = '';
                                    switch (parseInt(week)) {
                                        case 1:
                                            nextWeekUrl = `http://127.0.0.1:8000/api/showweeklymachine?line=${line}&year=${currentYear}&month=${currentMonth}&week=2`;
                                            break;
                                        case 2:
                                            nextWeekUrl = `http://127.0.0.1:8000/api/showweeklymachine?line=${line}&year=${currentYear}&month=${currentMonth}&week=3`;
                                            break;
                                        case 3:
                                            nextWeekUrl = `http://127.0.0.1:8000/api/showweeklymachine?line=${line}&year=${currentYear}&month=${currentMonth}&week=4`;
                                            break;
                                        case 4:
                                            nextWeekUrl = `http://127.0.0.1:8000/api/showweeklymachine?line=${line}&year=${currentYear}&month=${currentMonth}&week=5`;
                                            break;
                                        case 5:
                                            if (totalWeeks === 6) {
                                                nextWeekUrl = `http://127.0.0.1:8000/api/showweeklymachine?line=${line}&year=${currentYear}&month=${currentMonth}&week=6`;
                                            } else {
                                                const nextMonth = (currentMonth % 12);
                                                const nextYear = nextMonth === 1 ? currentYear + 1 : currentYear;
                                                nextWeekUrl = `http://127.0.0.1:8000/api/showweeklymachine?line=${line}&year=${nextYear}&month=${nextMonth}&week=2`;
                                            }
                                            break;
                                        case 6:
                                            const nextMonth = (currentMonth % 12);
                                            const nextYear = nextMonth === 1 ? currentYear + 1 : currentYear;
                                            nextWeekUrl = `http://127.0.0.1:8000/api/showweeklymachine?line=${line}&year=${nextYear}&month=${nextMonth}&week=2`;
                                            break;
                                        default:
                                            console.error('Invalid week number');
                                            return;
                                    }

                                    const response = await fetch(nextWeekUrl);
                                    const nextWeekMachines = await response.json();
                                    const nextWeekMachine = nextWeekMachines.find(m => m.machine_name === machine.machine_name);
                                    if (nextWeekMachine) {
                                        currentMachineIdWeekly = nextWeekMachine.machine_id;
                                        currentMachineId = nextWeekMachine.id;
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

            function createDayElement(id) {
                const container = document.querySelector('.grid');
                const newDayElement = document.createElement('div');
                newDayElement.id = id;
                newDayElement.className = 'col-span-1 grid grid-rows-3 gap-2';
                container.appendChild(newDayElement);
                return newDayElement;
            }

            function getMonthName(month) {
                const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
                    "September", "Oktober", "November", "Desember"
                ];
                return monthNames[month - 1];
            }

            function getMonthNumber(monthName) {
                const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
                    "September", "Oktober", "November", "Desember"
                ];
                return monthNames.indexOf(monthName) + 1;
            }

            function setupWeekButtons(line, year, month, activeWeek) {
                const weeksList = document.getElementById('weeksList');
                weeksList.innerHTML = ''; // Clear existing buttons

                // Get the start and end dates of the month
                const startDate = new Date(year, month - 1, 1);

                // Adjust the startDate to the previous Monday if it does not start on a Monday
                if (startDate.getDay() !== 1) {
                    while (startDate.getDay() !== 1) {
                        startDate.setDate(startDate.getDate() + 1);
                    }
                    startDate.setDate(startDate.getDate() -
                        7); // Go back 7 days to get the Monday of the previous week
                } else {
                    startDate.setDate(startDate.getDate() - 7); // Go back 7 days even if it is already Monday
                }

                let currentDate = new Date(startDate);
                let weeks = [];
                let week = [formatDate(currentDate)]; // Start the first week with the adjusted or found Monday

                currentDate.setDate(currentDate.getDate() + 1); // Move to the next day

                // Loop through the days, ensuring each week runs from Monday to the following Monday
                while (true) {
                    week.push(formatDate(currentDate)); // Add the current day to the current week

                    if (currentDate.getDay() === 1 && week.length >
                        1) { // If it's Monday and not the first iteration
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
                    weekButton.className =
                        'year-item text-black rounded-xl ml-1 text-xl px-2.5 cursor-not-allowed py-2.5 h-auto border-0';
                    if (index + 1 === parseInt(activeWeek)) {
                        weekButton.classList.add('text-purple-600');
                    } else {
                        weekButton.classList.add('text-gray-400', 'cursor-not-allowed');
                    }
                    weekButton.onclick = () => {
                        document.querySelectorAll('.year-item').forEach(btn => btn.classList.remove(
                            'text-purple-600'));
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
                        dayElement.children[1].textContent =
                            `${dateParts[1]} ${dateParts[2]} ${dateParts[3]}`; // Full date
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
                }, 10000); // Refresh every 10 seconds
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
                    if (day === parseInt(operation.day) && month === parseInt(operation.month) && year === parseInt(
                            operation.year)) {
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

            // async function fetchAndDisplayHistory() {
            //     const params = new URLSearchParams(window.location.search);
            //     const line = params.get('line');
            //     const month = params.get('month');
            //     const week = params.get('week');
            //     const year = params.get('year');

            //     try {
            //         const response = await fetch(`http://127.0.0.1:8000/api/showaudit`);
            //         const audits = await response.json();

            //         const filteredAudits = audits.filter(audit => {
            //             const newState = audit.changes ? audit.changes.new_state : null;
            //             return newState && newState.line === line && newState.month == month && newState
            //                 .week == week && newState.year == year;
            //         });

            //         // Mengurutkan filteredAudits berdasarkan timestamp dalam urutan descending
            //         filteredAudits.sort((a, b) => new Date(b.audit_id) - new Date(a.audit_id));

            //         const historyContent = document.getElementById('historyContent');
            //         // historyContent.innerHTML = ''; // Clear existing content

            //         filteredAudits.forEach(audit => {
            //             const newState = audit.changes ? audit.changes.new_state : null;
            //             if (!newState) return;

            //             console.log(audit);

            //             let historyEntry = document.createElement('div');
            //             historyEntry.className = 'bg-white shadow-md rounded-lg p-4 mb-4';
            //             const actionDate = new Date(audit.timestamp);
            //             const actionTime =
            //                 `${actionDate.getHours().toString().padStart(2, '0')}:${actionDate.getMinutes().toString().padStart(2, '0')}:${actionDate.getSeconds().toString().padStart(2, '0')}`;
            //             const actionDateFormatted =
            //                 `${actionDate.getDate()} ${getMonthName(actionDate.getMonth() + 1)} ${actionDate.getFullYear()}`;

            //             if (audit.event === 'add') {
            //                 if (newState.day && newState.code && newState.status && newState.notes) {
            //                     historyEntry.innerHTML = `
        //             <p><strong>Action:</strong> <span class="text-green-600">ADD</span></p>
        //             <p>Pada <span class="text-green-600">Week ${newState.week}</span>, <span class="text-green-600">${newState.day} ${getMonthName(newState.month)} ${newState.year}</span>. Kode Ruah <span class="text-green-600">${newState.code}</span>, Status: <span class="text-green-600">${newState.status}</span>, Catatan: <span class="text-green-600">${newState.notes}</span> telah ditambahkan oleh <span class="text-green-600">${newState.userId}</span></p>
        //         `;
            //                 } else if (newState.machineName) {
            //                     historyEntry.innerHTML = `
        //             <p><strong>Action:</strong> <span class="text-green-600">ADD</span></p>
        //             <p>Pada <span class="text-green-600">Week ${newState.week}</span>. Machine <span class="text-green-600">${newState.machineName}</span> ditambahkan pada <span class="text-green-600">${actionDate}</span></p>
        //         `;
            //                 }
            //             } else if (audit.event === 'edit') {
            //                 const originalState = audit.changes.original_state;

            //                 const originalDate =
            //                     `${originalState.day} ${getMonthName(originalState.month)} ${originalState.year}`;
            //                 const newDate =
            //                     `${newState.day} ${getMonthName(newState.month)} ${newState.year}`;

            //                 const newUpdatedAt = new Date(newState.updated_at);
            //                 newUpdatedAt.setHours(newUpdatedAt.getHours() + 7); // Add 7 hours
            //                 const updatedDate =
            //                     `${newUpdatedAt.getDate()} ${getMonthName(newUpdatedAt.getMonth() + 1)} ${newUpdatedAt.getFullYear()}`;
            //                 const updatedTime =
            //                     `${newUpdatedAt.getHours().toString().padStart(2, '0')}:${newUpdatedAt.getMinutes().toString().padStart(2, '0')}`;

            //                 historyEntry.innerHTML = `
        //                 <p><strong>Action:</strong> <span class="text-green-600">EDIT</span></p>
        //                 <p>Pada <span class="text-red-600">Week ${originalState.week}</span>, <span class="text-red-600">${originalDate}</span>. Kode Ruah <span class="text-red-600">${originalState.code}</span>, Status: <span class="text-red-600">${originalState.status}</span>, Catatan: <span class="text-red-600">${originalState.notes}</span> telah diubah oleh <span class="text-red-600">${newState.users_id}</span> pada <span class="text-red-600">${updatedDate}</span> pukul <span class="text-red-600">${updatedTime}</span> menjadi Kode Ruah <span class="text-blue-600">${newState.code}</span>, Status: <span class="text-blue-600">${newState.status}</span>, Catatan: <span class="text-blue-600">${newState.notes}</span> ke tanggal <span class="text-blue-600">${newState.day} Week ${newState.week}</span></p>
        //             `;

            //                 // if (originalState && newState.day && newState.code && newState.status &&
            //                 //     newState.notes) {

            //                 // }
            //             } else if (audit.event === 'delete') {
            //                 const originalState = audit.changes.original_state;
            //                 historyEntry.innerHTML = `
        //             <p><strong>Action:</strong> <span class="text-green-600">DELETE</span></p>
        //             <p>Pada <span class="text-green-600">Week ${originalState.week}</span>. Description <span class="text-green-600">"${originalState.description}"</span> dihapus pada <span class="text-green-600">${actionDateFormatted}</span></p>
        //         `;

            //                 //         if (originalState && originalState.day && originalState.code) {
            //                 //             const originalDate =
            //                 //                 `${originalState.day} ${getMonthName(originalState.month)} ${originalState.year}`;
            //                 //             historyEntry.innerHTML = `
        //             //     <p><strong>Action:</strong> <span class="text-green-600">DELETE</span></p>
        //             //     <p>Pada <span class="text-green-600">Week ${originalState.week}</span>, <span class="text-green-600">${originalDate}</span>. Kode Ruah <span class="text-green-600">${originalState.code}</span>, Jam <span class="text-green-600">${originalState.time}</span> dihapus pada <span class="text-green-600">${actionDateFormatted}</span> pukul <span class="text-green-600">${actionTime}</span></p>
        //             // `;
            //                 //         } else if (originalState && originalState.description) {
            //                 //             historyEntry.innerHTML = `
        //             //     <p><strong>Action:</strong> <span class="text-green-600">DELETE</span></p>
        //             //     <p>Pada <span class="text-green-600">Week ${originalState.week}</span>. Description <span class="text-green-600">"${originalState.description}"</span> dihapus pada <span class="text-green-600">${actionDateFormatted}</span></p>
        //             // `;
            //                 //         }
            //             } else if (audit.event === 'send_revision') {
            //                 historyEntry.innerHTML = `
        //         <p><strong>Action:</strong> <span class="text-green-600">SEND REVISION</span></p>
        //         <p>Revisi dikirim pada <span class="text-green-600">${actionDateFormatted}</span> pukul <span class="text-green-600">${actionTime}</span></p>
        //     `;
            //             } else {
            //                 historyEntry.innerHTML = ``;
            //             }
            //             historyContent.appendChild(historyEntry);
            //         });
            //     } catch (error) {
            //         console.error("Error fetching history data:", error);
            //     }
            // }

            // async function fetchAndDisplayHistory() {
            //     const params = new URLSearchParams(window.location.search);
            //     const line = params.get('line');
            //     const month = params.get('month');
            //     const week = params.get('week');
            //     const year = params.get('year');

            //     try {
            //         const response = await fetch(`http://127.0.0.1:8000/api/showaudit`);
            //         const audits = await response.json();

            //         const filteredAudits = audits.filter(audit => {
            //             const newState = audit.changes ? audit.changes.new_state : null;
            //             return newState && newState.line === line && newState.month == month && newState
            //                 .week == week && newState.year == year;
            //         });

            //         // Mengurutkan filteredAudits berdasarkan timestamp dalam urutan descending
            //         filteredAudits.sort((a, b) => new Date(b.audit_id) - new Date(a.audit_id));

            //         const historyContent = document.getElementById('historyContent');
            //         // historyContent.innerHTML = ''; // Clear existing content

            //         filteredAudits.forEach(audit => {
            //             const newState = audit.changes ? audit.changes.new_state : null;
            //             if (!newState) return;

            //             console.log(audit);

            //             let historyEntry = document.createElement('div');
            //             historyEntry.className = 'bg-white shadow-md rounded-lg p-4 mb-4';
            //             const actionDate = new Date(audit.timestamp);
            //             const actionTime =
            //                 `${actionDate.getHours().toString().padStart(2, '0')}:${actionDate.getMinutes().toString().padStart(2, '0')}:${actionDate.getSeconds().toString().padStart(2, '0')}`;
            //             const actionDateFormatted =
            //                 `${actionDate.getDate()} ${getMonthName(actionDate.getMonth() + 1)} ${actionDate.getFullYear()}`;

            //             if (audit.event === 'add') {
            //                 if (newState.day && newState.code && newState.status && newState.notes) {
            //                     historyEntry.innerHTML = `
        //             <p><strong>Action:</strong> <span class="text-green-600">ADD</span></p>
        //             <p>Pada <span class="text-green-600">Week ${newState.week}</span>, <span class="text-green-600">${newState.day} ${getMonthName(newState.month)} ${newState.year}</span>. Kode Ruah <span class="text-green-600">${newState.code}</span>, Status: <span class="text-green-600">${newState.status}</span>, Catatan: <span class="text-green-600">${newState.notes}</span> telah ditambahkan oleh <span class="text-green-600">${newState.userId}</span></p>
        //         `;
            //                 } else if (newState.machineName) {
            //                     historyEntry.innerHTML = `
        //             <p><strong>Action:</strong> <span class="text-green-600">ADD</span></p>
        //             <p>Pada <span class="text-green-600">Week ${newState.week}</span>. Machine <span class="text-green-600">${newState.machineName}</span> ditambahkan pada <span class="text-green-600">${actionDateFormatted}</span></p>
        //         `;
            //                 }
            //             } else if (audit.event === 'edit') {
            //                 const originalState = audit.changes ? audit.changes.original_state : null;
            //                 if (!originalState) return;

            //                 const originalDate =
            //                     `${originalState.day} ${getMonthName(originalState.month)} ${originalState.year}`;
            //                 const newDate =
            //                     `${newState.day} ${getMonthName(newState.month)} ${newState.year}`;

            //                 const newUpdatedAt = new Date(newState.updated_at);
            //                 newUpdatedAt.setHours(newUpdatedAt.getHours() + 7); // Add 7 hours
            //                 const updatedDate =
            //                     `${newUpdatedAt.getDate()} ${getMonthName(newUpdatedAt.getMonth() + 1)} ${newUpdatedAt.getFullYear()}`;
            //                 const updatedTime =
            //                     `${newUpdatedAt.getHours().toString().padStart(2, '0')}:${newUpdatedAt.getMinutes().toString().padStart(2, '0')}`;

            //                 historyEntry.innerHTML = `
        //         <p><strong>Action:</strong> <span class="text-green-600">EDIT</span></p>
        //         <p>Pada <span class="text-red-600">Week ${originalState.week}</span>, <span class="text-red-600">${originalDate}</span>. Kode Ruah <span class="text-red-600">${originalState.code}</span>, Status: <span class="text-red-600">${originalState.status}</span>, Catatan: <span class="text-red-600">${originalState.notes}</span> telah diubah oleh <span class="text-red-600">${newState.users_id}</span> pada <span class="text-red-600">${updatedDate}</span> pukul <span class="text-red-600">${updatedTime}</span> menjadi Kode Ruah <span class="text-blue-600">${newState.code}</span>, Status: <span class="text-blue-600">${newState.status}</span>, Catatan: <span class="text-blue-600">${newState.notes}</span> ke tanggal <span class="text-blue-600">${newState.day} Week ${newState.week}</span></p>
        //     `;
            //             } else if (audit.event === 'delete') {
            //                 const originalState = audit.changes ? audit.changes.original_state : null;
            //                 if (!originalState) return;

            //                 historyEntry.innerHTML = `
        //         <p><strong>Action:</strong> <span class="text-green-600">DELETE</span></p>
        //         <p>Pada <span class="text-green-600">Week ${originalState.week}</span>. Description <span class="text-green-600">"${originalState.description}"</span> dihapus pada <span class="text-green-600">${actionDateFormatted}</span></p>
        //     `;
            //             } else if (audit.event === 'send_revision') {
            //                 historyEntry.innerHTML = `
        //         <p><strong>Action:</strong> <span class="text-green-600">SEND REVISION</span></p>
        //         <p>Revisi dikirim pada <span class="text-green-600">${actionDateFormatted}</span> pukul <span class="text-green-600">${actionTime}</span></p>
        //     `;
            //             } else {
            //                 historyEntry.innerHTML = ``;
            //             }
            //             historyContent.appendChild(historyEntry);
            //         });
            //     } catch (error) {
            //         console.error("Error fetching history data:", error);
            //     }
            // }

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

        });

        // Custom function to increase hour in time picker
        function increaseHour() {
            const hoursInput = document.getElementById('hours');
            let hours = parseInt(hoursInput.value);
            hours = (hours + 1) % 24;
            hoursInput.value = hours.toString().padStart(2, '0');
        }

        // Custom function to decrease hour in time picker
        function decreaseHour() {
            const hoursInput = document.getElementById('hours');
            let hours = parseInt(hoursInput.value);
            hours = (hours - 1 + 24) % 24;
            hoursInput.value = hours.toString().padStart(2, '0');
        }

        // Custom function to increase minute in time picker
        function increaseMinute() {
            const minutesInput = document.getElementById('minutes');
            let minutes = parseInt(minutesInput.value);
            minutes = (minutes + 1) % 60;
            minutesInput.value = minutes.toString().padStart(2, '0');
        }

        // Custom function to decrease minute in time picker
        function decreaseMinute() {
            const minutesInput = document.getElementById('minutes');
            let minutes = parseInt(minutesInput.value);
            minutes = (minutes - 1 + 60) % 60;
            minutesInput.value = minutes.toString().padStart(2, '0');
        }

        // Custom function to increase hour in edit time picker
        function increaseHourEdit() {
            const hoursInput = document.getElementById('editHours');
            let hours = parseInt(hoursInput.value);
            hours = (hours + 1) % 24;
            hoursInput.value = hours.toString().padStart(2, '0');
        }

        // Custom function to decrease hour in edit time picker
        function decreaseHourEdit() {
            const hoursInput = document.getElementById('editHours');
            let hours = parseInt(hoursInput.value);
            hours = (hours - 1 + 24) % 24;
            hoursInput.value = hours.toString().padStart(2, '0');
        }

        // Custom function to increase minute in edit time picker
        function increaseMinuteEdit() {
            const minutesInput = document.getElementById('editMinutes');
            let minutes = parseInt(minutesInput.value);
            minutes = (minutes + 1) % 60;
            minutesInput.value = minutes.toString().padStart(2, '0');
        }

        // Custom function to decrease minute in edit time picker
        function decreaseMinuteEdit() {
            const minutesInput = document.getElementById('editMinutes');
            let minutes = parseInt(minutesInput.value);
            minutes = (minutes - 1 + 60) % 60;
            minutesInput.value = minutes.toString().padStart(2, '0');
        }
    </script>
</body>

</html>
