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
    <div class="pl-6 my-4 mx-auto flex justify-start items-start" style="width: 91.666667%;">
        <div class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="/pjl/dashboard" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                        </svg>
                        Home
                    </a>
                </li>
            </ol>
        </div>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto flex justify-between items-center" style="width: 91.666667%;">
        <h3 class="text-3xl font-bold">PM Line 1</h3>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto flex items-center" style="width: 91.666667%;" id="yearsList">
        <div class="flex flex-grow items-center space-x-4">
        </div>
        <button class="bg-purple-100 text-purple-600 h-10 text-lg px-4 rounded-lg border-0 py-2" onclick="openModal()">Add year</button>
    </div>

    <div id="yearModal" class="fixed inset-0 backdrop-blur-md overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center relative">
                <span class="close-btn absolute top-0 right-0 cursor-pointer text-black px-3 text-2xl font-bold" onclick="closeModal()">&times;</span>
                <p class="text-lg font-semibold pt-1 pb-3">Add New Year:</p>
                <div id="yearOptions" class="mt-2">
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto summary-container hidden" id="monthsContainer" style="width: 91.666667%;">
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
            if (machine.current_line === selectedLine && machine.status === "PM") {
                uniqueYears.add(machine.year);
            }
        });

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
        monthsContainer.innerHTML = '';
        monthsContainer.classList.remove('hidden');

        const monthWeekData = {};
        machines.filter(machine => machine.year === selectedYear && machine.current_line === selectedLine && machine.status === "PM").forEach(machine => {
            if (!monthWeekData[machine.month]) {
                monthWeekData[machine.month] = new Set();
            }
            monthWeekData[machine.month].add(machine.week);
        });

        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        months.forEach((monthName, index) => {
            const monthIndex = (index + 1).toString();
            const weeks = monthWeekData[monthIndex] || new Set();
            const button = document.createElement('button');
            button.className = 'month-container my-2 bg-white p-2 shadow-md rounded-md py-1 px-2 text-black rounded-md flex flex-col items-start justify-center w-full';
            button.style.height = '5em';

            const monthSpan = document.createElement('span');
            monthSpan.textContent = monthName + ' ';
            monthSpan.className = 'text-lg font-bold';
            button.appendChild(monthSpan);

            if (weeks.size === 0) {
                const weekSpan = document.createElement('span');
                weekSpan.textContent = 'No PM Data';
                weekSpan.className = 'block text-s text-left w-full month-item-week';
                button.appendChild(weekSpan);
            } else {
                const weeksArray = Array.from(weeks).map(week => week === "1" ? "Ada Data PM" : `Week ${week}`).join(', ');
                const weekSpan = document.createElement('span');
                weekSpan.textContent = weeksArray;
                weekSpan.className = 'text-s';
                button.appendChild(weekSpan);
            }

            button.onclick = () => {
                window.location.href = `/pjl/pm?line=${encodeURIComponent(selectedLine)}&year=${encodeURIComponent(selectedYear)}&month=${encodeURIComponent(monthIndex)}`;
            };

            monthsContainer.appendChild(button);
        });
    }

    function openModal() {
        const existingYears = new Set();
        document.querySelectorAll('#yearsList button').forEach(button => {
            existingYears.add(button.textContent);
        });

        const yearModal = document.getElementById('yearModal');
        const yearOptions = document.getElementById('yearOptions');
        yearOptions.innerHTML = '';

        const currentYear = new Date().getFullYear();
        for (let i = currentYear - 3; i <= currentYear + 3; i++) {
            if (!existingYears.has(i.toString())) {
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