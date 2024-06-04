<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Jost:ital,wght@0,100..900;1,100..900&family=Poppins:wght@400;600;700&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <title>PJL PM Display</title>
    @vite('resources/css/pjl/view.css')
</head>
<body>
<div class="container mx-auto px-4">
    <nav class="flex ml-14" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="/pjl/pmdashboard" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                    </svg>
                    Home
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <a href="/pjl/view" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">PM</a>
                </div>
            </li>
        </ol>
    </nav>

    <div class="bg-white opacity-75 p-6 rounded-3xl shadow-2xl my-4 mx-auto flex items-center justify-between" style="width: 91.666667%;">
        <h3 id="title" class="text-2xl font-bold">PM: <span id="line-display">Loading...</span></h3>
        <div id="weeksList" class="mx-2"></div>
        <h3 class="text-2xl font-bold"><span id="month-display">Loading...</span> <span id="year-display">Loading...</span></h3>
    </div>

    <div id="globalDescContainer" class="bg-white opacity-75 p-6 rounded-3xl shadow-2xl my-4 mx-auto flex justify-between items-start" style="width: 91.666667%;">
        <div class="justify-start">
            <p class="text-2xl font-bold">View Data</p>
            <div id="dataContainer">
                <!-- Dynamic machine data will be loaded here -->
            </div>
        </div>
        <div class="justify-end">
            <h2 class="text-2xl font-bold mb-4">Add Data PM</h2>
            <form id="addDataForm">

                <!-- Select Mesin Data -->
                <div class="mb-4">
                    <label for="machineSelect" class="block text-gray-700">Pilih Mesin</label>
                    <select id="machineSelect" class="w-full px-3 py-2 border rounded-lg">
                        <option value="">Pilih Mesin</option>
                    </select>
                </div>

                <!-- Date/Day Pick -->
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg class="w-4 ml-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input type="date" id="dateInput" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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

                <!-- Button -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600">Add Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        getQueryParams();
        setupAutoRefresh();
    });

    function setupAutoRefresh() {
        setInterval(() => {
            const params = new URLSearchParams(window.location.search);
            const line = params.get('line');
            const month = params.get('month');
            const year = params.get('year');

            if (line && month && year) {
                fetchData(line, year, month);
            }
        }, 5000); // Refresh every 5 seconds
    }

    function getQueryParams() {
        const params = new URLSearchParams(window.location.search);
        const line = params.get('line');
        const month = params.get('month');
        const year = params.get('year');

        document.getElementById('line-display').textContent = line || 'N/A';
        document.getElementById('month-display').textContent = month ? getMonthName(parseInt(month)) : 'N/A';
        document.getElementById('year-display').textContent = year || 'N/A';

        fetchData(line, year, month);
        fetchMachineData(line, year, month);
    }

    function fetchData(line, year, month) {
        const apiUrl = `http://127.0.0.1:8000/api/showallmachineoperationpjl?line=${line}&year=${year}&month=${month}&status=PM`;
        fetch(apiUrl)
            .then(response => response.json())
            .then(data => displayData(data, line, year, month))
            .catch(error => console.error('Error loading machine data:', error));
    }

    function fetchMachineData(line, year, month) {
        const machineSelect = document.getElementById('machineSelect');
        machineSelect.innerHTML = '<option value="">Pilih Mesin</option>';

        for (let week = 1; week <= 6; week++) {
            const apiUrl = `http://127.0.0.1:8000/api/showweeklymachine?line=${line}&year=${year}&month=${month}&week=${week}`;
            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    data.forEach(machine => {
                        const option = document.createElement('option');
                        option.value = machine.id;  // Use machine ID as value
                        option.textContent = `${machine.machine_name} (Week ${machine.week})`;
                        machineSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error loading machine data:', error));
        }
    }

    function displayData(data, line, year, month) {
        const container = document.getElementById('dataContainer');
        container.innerHTML = '';  // Reset container

        // Sort data by date
        data.operations.sort((a, b) => new Date(a.year, a.month - 1, a.day) - new Date(b.year, b.month - 1, b.day));

        data.operations.forEach(op => {
            if (op.status === 'PM' && op.current_line === line && op.year === year && op.month === month) {
                const date = new Date(year, month-1, op.day);  // Month index is 0-based in JavaScript
                const formattedDate = date.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
                const content = document.createElement('button');
                content.className = 'month-container my-2 bg-white p-2 shadow-md rounded-md py-3 px-2 text-black rounded-md flex flex-col items-start justify-center w-full';
                content.innerHTML = `<p class="text-xl font-bold">Mesin: ${op.machine_name}</p>
                                     <p>
                                        <span class="text-lg font-bold">Tanggal:</span>
                                        <span>${formattedDate}</span>
                                    </p>`;
                container.appendChild(content);
            }
        });
    }

    function getMonthName(monthIndex) {
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        return months[monthIndex - 1];
    }

    document.getElementById('addDataForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const params = new URLSearchParams(window.location.search);
        const line = params.get('line');
        const machineId = document.getElementById('machineSelect').value;

        const dateInput = new Date(document.getElementById('dateInput').value);
        const day = dateInput.getDate(); // Get the day from the parsed date

        const time = `${document.getElementById('hours').value}:${document.getElementById('minutes').value}`;
        const notes = document.getElementById('dataNotes').value;
        const status = 'PM';
        const code = 'PM';

        const data = {
            day: day,
            code: code,
            time: time,
            status: status,
            notes: notes
        };

        fetch(`http://127.0.0.1:8000/api/addmachineoperation/${line}/${machineId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(result => {
                console.log('Success:', result);
                alert('Data added successfully');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to add data: ' + (error.message || JSON.stringify(error)));
            });
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
