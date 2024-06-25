<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/tailwind.min.css') }}" rel="stylesheet">
    <style>
        .month-container {
            transition: transform 0.3s ease;
        }
        .month-container:hover {
            transform: scale(1.05);
        }
        .zoom-in {
            opacity: 0;
            transform: scale(0.5);
            animation: zoomIn 0.5s forwards;
        }
        @keyframes zoomIn {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>
<body style="background-image: url('{{ asset('ELEMECH.png') }}'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">
@extends('pjl.layout')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto px-4">
    <div class="pl-6 my-4 mx-auto flex justify-start items-start" style="width: 91.666667%;">
        <div class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                <a href="/pjl/dashboard" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                        </svg>
                        <span class="align-middle" style="line-height: 1.5; margin-top: 2px; font-size: 1rem;">Home</span>
                    </a>
                </li>
            </ol>
        </div>
    </div>

    <div class="bg-gray-100 p-6  rounded-3xl shadow-2xl my-4 mx-auto flex justify-between items-center" style="width: 91.666667%; backdrop-filter: blur(7px); background-color: rgba(255, 255, 255, 0.5);">
                <h3 class="text-3xl font-bold">PM {{ ucfirst(str_replace('Line', 'Line ', $line)) }}</h3>
            </div>

    <div class="bg-gray-100 p-6  rounded-3xl shadow-2xl my-4 mx-auto flex items-center" style="width: 91.666667%; backdrop-filter: blur(7px); background-color: rgba(255, 255, 255, 0.5);" id="yearsList">
        <div class="flex flex-grow items-center space-x-4">
        </div>
        <button class="bg-purple-100 text-purple-600 h-10 text-sm px-6 rounded-lg border-0 py-3" onclick="openModal()">Add Year</button>
    </div>


    <!-- Year Modal -->
    <div id="yearModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-lg">
            <div class="mt-3 text-center relative">
                <span class="close-btn absolute top-0 right-0 cursor-pointer text-black px-3 text-2xl font-bold" onclick="closeModal()">&times;</span>
                <p class="text-lg font-semibold pt-1 pb-3">Add New Year:</p>
                <div id="yearOptions" class="mt-2">
                </div>
            </div>
        </div>
    </div>


    <div class="bg-gray-100 p-6  rounded-3xl shadow-2xl my-4 mx-auto summary-container hidden" id="monthsContainer" style="width: 91.666667%;backdrop-filter: blur(7px); background-color: rgba(255, 255, 255, 0.5);">

    </div>

</div>
@endsection

@section('scripts')

<script>
    const selectedLine = '{{ ucfirst ($line) }}'; // Adjust the line value as needed

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
            displayMonths(year, machines,);
        };
        yearsList.appendChild(yearButton);
    }

    function displayMonths(selectedYear, machines) {
        const monthsContainer = document.getElementById('monthsContainer');
        if (!monthsContainer) {
            console.error("monthsContainer not found");
            return;
        }
        monthsContainer.innerHTML = ''; // Clear the container
        monthsContainer.classList.remove('hidden'); // Show the container when a year is selected

        const monthWeekData = {};
        machines
            .filter(machine => machine.year === selectedYear && machine.current_line === selectedLine && machine.status === "PM")
            .forEach(machine => {
                if (!monthWeekData[machine.month]) {
                    monthWeekData[machine.month] = new Set();
                }
                monthWeekData[machine.month].add(machine.week);
            });

        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        const leftContainer = document.createElement('div');
        const middleContainer = document.createElement('div');
        const rightContainer = document.createElement('div');
        leftContainer.className = 'w-1/3 pr-2';
        middleContainer.className = 'w-1/3 px-2';
        rightContainer.className = 'w-1/3 pl-2';

        months.forEach((monthName, index) => {
            const monthIndex = (index + 1).toString();
            const weeks = monthWeekData[monthIndex] || new Set();
            const button = document.createElement('button');
            button.className = 'month-container my-2 bg-white p-2 shadow-md rounded-md py-1 px-2 text-black flex flex-col items-start justify-center w-full';
            button.style.height = '5em'; // consistent height for all month divs
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
                window.location.href = `/pjl/${encodeURIComponent(selectedLine)}/pm?line=${encodeURIComponent(selectedLine)}&year=${encodeURIComponent(selectedYear)}&month=${encodeURIComponent(monthIndex)}`;
            };

            if (index % 3 === 0) {
                leftContainer.appendChild(button);
            } else if (index % 3 === 1) {
                middleContainer.appendChild(button);
            } else {
                rightContainer.appendChild(button);
            }
        });

        const flexContainer = document.createElement('div');
        flexContainer.className = 'flex';
        flexContainer.appendChild(leftContainer);
        flexContainer.appendChild(middleContainer);
        flexContainer.appendChild(rightContainer);
        monthsContainer.appendChild(flexContainer);
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
