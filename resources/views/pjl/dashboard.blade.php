<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="bg-gray-100">
<div class="container mx-auto px-4">
    <!-- Card Title -->
    <div class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto flex justify-between items-center" style="width: 91.666667%;">
        <h3 class="text-3xl font-bold">PJL Line 3</h3>
    </div>

    <!-- Years Container -->
    <div class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto flex items-center" style="width: 91.666667%;" id="yearsList">
        <div class="flex flex-grow items-center space-x-4">
            <!-- Dynamic year buttons will be added here -->
        </div>
        <button class="bg-purple-100 text-purple-600 h-10 text-lg px-4 rounded-lg border-0 py-2" onclick="openModal()">+ year</button>
    </div>

    <!-- Modal for Adding Years (Hidden by default) -->
    <div id="yearModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center relative">
                <span class="close-btn absolute top-0 right-0 cursor-pointer text-black px-3 text-2xl font-bold" onclick="closeModal()">&times;</span>
                <p class="text-lg font-semibold pt-1 pb-3">Add New Year:</p>
                <div id="yearOptions" class="mt-2">
                    <!-- Year buttons will be inserted here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Month Container -->
    <div class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto summary-container" id="monthsContainer" style="width: 91.666667%;">
        <!-- Months will be added here by JavaScript -->
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetchMachineOperations();
    });

    function fetchMachineOperations() {
        axios.get('http://127.0.0.1:8000/api/showMachineOperation')
            .then(function (response) {
                console.log('Data fetched successfully:', response.data); // Debugging: Check the API response data
                processMachineData(response.data.machines);
            })
            .catch(function (error) {
                console.error("Error fetching machine operation data: ", error);
            });
    }

    function processMachineData(machines) {
        const yearsList = document.querySelector('#yearsList .flex-grow'); // Directly select the flex-grow container
        if (!yearsList) {
            console.error("Years list flex container not found");
            return;
        }

        yearsList.innerHTML = ''; // Clear previous year buttons if any

        const uniqueYears = new Set();

        machines.forEach(machine => {
            uniqueYears.add(machine.year);
        });

        // Convert the Set to an array and sort it
        const sortedYears = Array.from(uniqueYears).sort((a, b) => a - b);

        sortedYears.forEach(year => {
            const yearButton = document.createElement('button');
            yearButton.textContent = year;
            yearButton.className = 'text-black rounded-xl ml-1 text-xl bg-transparent px-2.5 py-2.5 cursor-pointer h-auto border-0 hover:bg-purple-600 hover:text-white focus:bg-purple-600 focus:text-white';
            yearButton.onclick = () => {
                // Clear active styles from all buttons
                const activeButtons = yearsList.querySelectorAll('.bg-purple-600');
                activeButtons.forEach(btn => {
                    btn.classList.remove('bg-purple-600', 'text-white');
                });

                // Add active class to the clicked button
                yearButton.classList.add('bg-purple-600', 'text-white');

                displayMonths(year, machines);
            };
            yearsList.appendChild(yearButton); // Append button to the flex-grow container
        });
    }

    function displayMonths(selectedYear, machines) {
        const monthsContainer = document.getElementById('monthsContainer');
        monthsContainer.innerHTML = ''; // Clear the container

        const monthWeekData = {};
        machines.filter(machine => machine.year === selectedYear).forEach(machine => {
            if (!monthWeekData[machine.month]) {
                monthWeekData[machine.month] = new Set();
            }
            monthWeekData[machine.month].add(machine.week);
        });

        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        months.forEach((monthName, index) => {
            const monthIndex = (index + 1).toString().padStart(2, '0');
            const weeks = monthWeekData[monthIndex] || [];
            const button = document.createElement('button');
            button.className = 'month-container my-4 bg-white p-2 shadow-md rounded-md py-2 px-4 text-black rounded-md flex flex-col items-start justify-center w-full';
            button.style.height = '5em'; // consistent height for all month divs

            const monthSpan = document.createElement('span');
            monthSpan.textContent = monthName + ' ';
            monthSpan.className = 'text-2xl font-bold';
            button.appendChild(monthSpan);

            if (weeks.size === 0) {
                const weekSpan = document.createElement('span');
                weekSpan.textContent = '0 Week';
                weekSpan.className = 'block text-s text-left w-full month-item-week';
                button.appendChild(weekSpan);
            } else {
                const weeksArray = Array.from(weeks).map(week => `Week ${week}`).join(', ');
                const weekSpan = document.createElement('span');
                weekSpan.textContent = weeksArray;
                weekSpan.className = 'text-s';
                button.appendChild(weekSpan);
            }

            monthsContainer.appendChild(button);
        });
    }

    function openModal() {
        const yearModal = document.getElementById('yearModal');
        const yearOptions = document.getElementById('yearOptions');
        yearOptions.innerHTML = ''; // Clear previous options
        const currentYear = new Date().getFullYear();
        for (let i = currentYear - 3; i <= currentYear + 3; i++) {
            const button = document.createElement('button');
            button.textContent = i;
            button.className = 'm-2 py-2 px-4 bg-blue-500 hover:bg-blue-700 text-white rounded-md';
            button.onclick = function() { addYear(i); };
            yearOptions.appendChild(button);
        }
        yearModal.classList.remove('hidden');
    }

    function closeModal() {
        var modal = document.getElementById('yearModal');
        modal.classList.add('hidden');
    }

    function addYear(year) {
        // Save year to local storage
        localStorage.setItem('selectedYear', year);
        displayYear(year);
        closeModal();
    }

    function displayYear(year) {
        const yearsList = document.getElementById('yearsList').querySelector('.flex-grow');
        const yearButton = document.createElement('button');
        yearButton.textContent = year;
        yearButton.className = 'year-item text-black ml-1 mr-14 text-xl bg-transparent px-2.5 py-2.5 cursor-pointer h-auto border-0 hover:bg-purple-600 hover:text-white focus:bg-purple-600 focus:text-white';
        yearButton.onclick = () => {
            displayMonths(year, []);
        };
        yearsList.appendChild(yearButton);
    }
</script>
</body>
</html>
