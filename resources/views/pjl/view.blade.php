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
    <div class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto flex justify-between items-center" style="width: 91.666667%;">
        <h3 id="title" class="text-2xl font-bold">
            Line: <span id="line-display">Loading...</span>, <span id="month-display">Loading...</span> <span id="year-display">Loading...</span>
        </h3>
    </div>

    <!-- Weeks Container -->
    <div class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto flex justify-between items-center" style="width: 91.666667%;">
        <div class="flex flex-grow items-center space-x-4" id="weeksList">
            <!-- Buttons for each week will be appended here -->
        </div>
    </div>

    <!-- Header for Days -->
    <div class="header-days bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto" style="width: 91.666667%; display: none;" id="headerDays">
        <div class="grid grid-cols-10 gap-4 text-center font-semibold">
            <div class="flex font-bold items-center justify-center col-span-2 text-xl">Mesin</div>
            <!-- Dynamic date headers -->
            <div id="day1" class="flex flex-col justify-center items-center"><span class="font-bold">Senin</span><span>Date 1</span></div>
            <div id="day2" class="flex flex-col justify-center items-center"><span class="font-bold">Selasa</span><span>Date 2</span></div>
            <div id="day3" class="flex flex-col justify-center items-center"><span class="font-bold">Rabu</span><span>Date 3</span></div>
            <div id="day4" class="flex flex-col justify-center items-center"><span class="font-bold">Kamis</span><span>Date 4</span></div>
            <div id="day5" class="flex flex-col justify-center items-center"><span class="font-bold">Jumat</span><span>Date 5</span></div>
            <div id="day6" class="flex flex-col justify-center items-center"><span class="font-bold">Sabtu</span><span>Date 6</span></div>
            <div id="day7" class="flex flex-col justify-center items-center"><span class="font-bold">Minggu</span><span>Date 7</span></div>
            <div id="day8" class="flex flex-col justify-center items-center"><span class="font-bold">Senin</span><span>Date 8</span></div>
        </div>
    </div>

    <!-- Data Container -->
    <div id="machineOperations" class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto" style="width: 91.666667%; display: none;">
        <!-- Dynamic machine operations will be appended here -->
    </div>




</div>

<script>
    // Function to trigger on document load or specific event
    function getQueryParams() {
        const params = new URLSearchParams(window.location.search);
        const line = params.get('line');
        const month = params.get('month');
        const year = params.get('year');

        document.getElementById('line-display').textContent = line ? line : 'N/A';
        document.getElementById('month-display').textContent = month ? getMonthName(month) : 'N/A';
        document.getElementById('year-display').textContent = year ? year : 'N/A';

        if (line && month && year) {
            fetchDataFromAPI(line, year, month);
        } else {
            console.error("Missing URL parameters: line, year, or month");
        }
    }

    function fetchDataFromAPI(line, year, month) {
        const baseUrl = "http://127.0.0.1:8000/api/showmachineoperation";
        fetch(baseUrl)
            .then(response => response.json())
            .then(data => {
                const filteredData = filterData(data.machines, line, year, month);
                setupWeekButtons(year, month, filteredData);
            })
            .catch(error => console.error("Error fetching data:", error));
    }

    function filterData(data, line, year, month) {
        return data.filter(machine =>
            machine.line === line &&
            machine.year === year &&
            machine.month === month
        );
    }

    function setupWeekButtons(year, month, data) {
        const weeksList = document.getElementById('weeksList');
        weeksList.innerHTML = ''; // Clear previous buttons
        const numWeeks = 5; // Placeholder for dynamic week count based on data
        for (let i = 1; i <= numWeeks; i++) {
            const weekButton = document.createElement('button');
            weekButton.textContent = `Week ${i}`;
            weekButton.className = 'week-button';
            weekButton.onclick = () => displayWeek(i, data);
            weeksList.appendChild(weekButton);
        }
    }

    function displayWeek(weekNumber, data) {
        const weekData = data.filter(item => item.week === weekNumber.toString());
        renderMachineOperations(weekData);
    }

    function renderMachineOperations(data) {
        const machineOperations = document.getElementById('machineOperations');
        machineOperations.innerHTML = '';
        const machines = {};

        data.forEach(operation => {
            const machineName = operation.machine_name;
            if (!machines[machineName]) {
                machines[machineName] = {};
            }
            if (!machines[machineName][operation.day]) {
                machines[machineName][operation.day] = [];
            }
            machines[machineName][operation.day].push(operation);
        });

        for (let machineName in machines) {
            const machineRow = document.createElement('div');
            machineRow.className = 'machine-row';
            const machineNameDiv = document.createElement('div');
            machineNameDiv.textContent = machineName;
            machineRow.appendChild(machineNameDiv);

            for (let i = 1; i <= 7; i++) { // Assuming 7 days + 1 extra for the following Monday
                const dayCol = document.createElement('div');
                dayCol.className = 'day-col';
                const operations = machines[machineName][i] || [];
                operations.forEach(operation => {
                    const operationDiv = document.createElement('div');
                    operationDiv.textContent = `${operation.code} - ${operation.time}`;
                    dayCol.appendChild(operationDiv);
                });
                machineRow.appendChild(dayCol);
            }
            machineOperations.appendChild(machineRow);
        }
        machineOperations.style.display = 'block';
    }




    function getMonthName(month) {
        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return monthNames[month - 1];
    }

    function setupWeekButtons(year, month) {
        const weeksList = document.getElementById('weeksList');
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
            weekButton.className = 'text-black rounded-xl ml-1 text-xl px-2.5 py-2.5 cursor-pointer h-auto border-0 hover:text-purple-600 focus:text-purple-600';
            weekButton.onclick = () => displayWeek(week);
            weeksList.appendChild(weekButton);
        });
    }

    function formatDate(date) {
        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        return `${days[date.getDay()]}, ${date.getDate()} ${getMonthName(date.getMonth() + 1)} ${date.getFullYear()}`;
    }


    function displayWeek(dates, data) {
        document.getElementById('headerDays').style.display = 'block';

        dates.forEach((date, index) => {
            if (index < 8) {
                const dayElement = document.getElementById(`day${index + 1}`);
                dayElement.children[0].textContent = date.split(",")[0];
                dayElement.children[1].textContent = date.split(",")[1];
            }
        });

        renderMachineOperations(data, dates);
    }



    document.addEventListener('DOMContentLoaded', getQueryParams);
</script>

</body>
</html>
