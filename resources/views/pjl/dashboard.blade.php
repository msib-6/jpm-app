<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
@extends('pjl.layout')

@section('title', 'Dashboard')

@section('content')
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
        <button class="bg-purple-100 text-purple-600 h-10 text-lg px-4 rounded-lg border-0 py-2" onclick="openModal()">Add year</button>
    </div>

    <!-- Modal for Adding Years (Hidden by default, with blur and transparency) -->
    <div id="yearModal" class="fixed inset-0 backdrop-blur-md overflow-y-auto h-full w-full hidden">
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


    <!-- Month Container initially hidden -->
    <div class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto summary-container hidden" id="monthsContainer" style="width: 91.666667%;">
        <!-- Months will be added here by JavaScript -->
    </div>

</div>

@endsection

@section('scripts')

<script>
    const selectedLine = 'Line1'; // Adjust the line value as needed

    document.addEventListener('DOMContentLoaded', function() {
        fetchMachineOperations();
    });

    function fetchMachineOperations() {
        fetch('http://127.0.0.1:8000/api/showallmachineoperationpjl')
            .then(response => response.json())
            .then(data => {
                console.log('Data fetched successfully:', data); // Debugging: Check the API response data
                processMachineData(data.operations);
            })
            .catch(error => {
                console.error("Error fetching machine operation data: ", error);
            });
    }

    function processMachineData(machines) {
        const yearsList = document.querySelector('#yearsList .flex-grow');
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
            addYearButton(year, machines); // Adjusted to pass machines for displayMonths function
        });
    }

    function addYearButton(year, machines) {
        const yearsList = document.querySelector('#yearsList .flex-grow');
        const yearButton = document.createElement('button');
        yearButton.textContent = year;
        yearButton.className = 'text-black rounded-xl ml-1 text-xl px-2.5 py-2.5 cursor-pointer h-auto border-0 hover:text-purple-600 focus:text-purple-600';
        yearButton.onclick = () => {
            displayMonths(year, machines);
        };
        yearsList.appendChild(yearButton);
    }

    function displayMonths(selectedYear, machines) {
        const monthsContainer = document.getElementById('monthsContainer');
        monthsContainer.innerHTML = ''; // Clear the container
        monthsContainer.classList.remove('hidden'); // Show the container when a year is selected

        const monthWeekData = {};
        machines.filter(machine => machine.year === selectedYear).forEach(machine => {
            if (!monthWeekData[machine.month]) {
                monthWeekData[machine.month] = new Set();
            }
            monthWeekData[machine.month].add(machine.week);
        });

        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        months.forEach((monthName, index) => {
            const monthIndex = (index + 1).toString();
            const weeks = monthWeekData[monthIndex] || [];
            const button = document.createElement('button');
            button.className = 'month-container my-2 bg-white p-2 shadow-md rounded-md py-1 px-2 text-black rounded-md flex flex-col items-start justify-center w-full';
            button.style.height = '2.5em'; // consistent height for all month divs

            const monthSpan = document.createElement('span');
            monthSpan.textContent = monthName + ' ';
            monthSpan.className = 'text-l font-bold';
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

            // Add click event to navigate to the view page with parameters
            button.onclick = () => {
                window.location.href = `/pjl/view?line=${encodeURIComponent(selectedLine)}&year=${encodeURIComponent(selectedYear)}&month=${encodeURIComponent(monthIndex)}`;
            };

            monthsContainer.appendChild(button);
        });
    }

    function openModal() {
        const existingYears = new Set();
        document.querySelectorAll('#yearsList button').forEach(button => {
            existingYears.add(button.textContent); // Store all displayed years
        });

        const yearModal = document.getElementById('yearModal');
        const yearOptions = document.getElementById('yearOptions');
        yearOptions.innerHTML = ''; // Clear previous options

        const currentYear = new Date().getFullYear();
        for (let i = currentYear - 3; i <= currentYear + 3; i++) {
            if (!existingYears.has(i.toString())) { // Only add year buttons for years not already displayed
                const button = document.createElement('button');
                button.textContent = i;
                button.className = 'm-2 py-2 px-4 bg-purple-500 hover:bg-purple-700 text-white rounded-md';
                button.onclick = function() { addYear(i); };
                yearOptions.appendChild(button);
            }
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
        yearButton.className = 'text-black rounded-xl ml-1 text-xl px-2.5 py-2.5 cursor-pointer h-auto border-0 hover:text-purple-600 focus:text-purple-600';
        yearButton.onclick = () => {
            displayMonths(year, []);
        };
        yearsList.appendChild(yearButton);
    }

</script>
@endsection
</body>
</html>
