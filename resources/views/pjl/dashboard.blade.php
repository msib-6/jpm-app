<!-- resources/views/dashboard.blade.php -->
@extends('pjl.layout')

@section('title', 'Dashboard')

@section('content')
<div id="dashboard-content" class="content-template">
    <div class="container mx-auto px-4">
        <div class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto flex justify-between items-center" style="width: 91.666667%;">
            <h3 class="text-3xl font-semibold">PJL Line 3</h3>
        </div>
        <div class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto flex items-center" style="width: 91.666667%;" id="yearsList">
            <div class="flex flex-grow items-center space-x-4"></div>
            <button class="bg-purple-100 text-purple-600 h-10 text-lg px-4 rounded-lg border-0 py-2" onclick="openModal()">+ year</button>
        </div>
        <div id="yearModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3 text-center relative">
                    <span class="close-btn absolute top-0 right-0 cursor-pointer text-black px-3 text-2xl font-bold" onclick="closeModal()">&times;</span>
                    <p class="text-lg font-semibold pt-1 pb-3">Add New Year:</p>
                    <div id="yearOptions" class="mt-2"></div>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto summary-container" id="monthsContainer" style="width: 91.666667%;"></div>
    </div>
</div>
@endsection

@section('scripts')
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
        const yearsList = document.getElementById('yearsList');
        console.log('Years List Element:', yearsList); // Debugging: Verify the yearsList element is selected correctly
        const uniqueYears = new Set();

        machines.forEach(machine => {
            uniqueYears.add(machine.year);
        });

        console.log('Unique Years:', uniqueYears); // Debugging: Verify the unique years extracted

        uniqueYears.forEach(year => {
            const yearButton = document.createElement('button');
            yearButton.textContent = year;
            yearButton.className = 'text-black rounded-xl ml-1 mr-14 text-xl bg-transparent px-2.5 py-2.5 cursor-pointer h-auto border-0 hover:bg-purple-600 hover:text-white focus:bg-purple-600 focus:text-white';
            yearButton.textContent = year;
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
            document.querySelector('#yearsList .flex-grow').appendChild(yearButton); // Add to the flex-grow div
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
        var modal = document.getElementById('yearModal');
        modal.classList.remove('hidden');
    }

    function closeModal() {
        var modal = document.getElementById('yearModal');
        modal.classList.add('hidden');
    }

</script>
@endsection
