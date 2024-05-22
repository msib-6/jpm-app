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
    <div class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto flex justify-between items-center" style="width: 91.666667%;" id="weeksList">
        <!-- Buttons for each week will be appended here -->
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
    <div class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto" style="width: 91.666667%;">
        <!-- Main grid container with vertical alignment adjustments -->
        <div class="grid grid-cols-10 gap-4">
            <div id="machineName" class="font-bold border-2 mesin-jpm p-2 row-span-3 col-span-2 flex items-center justify-center text-center machine_name" style="height: 90%;"></div>
            <!-- Day columns dynamically filled in JavaScript -->
        </div>
    </div>




</div>

<script>
    // Function to trigger on document load or specific event
    function getQueryParams() {
        const params = new URLSearchParams(window.location.search);
        const current_line = params.get('line');
        const month = params.get('month');
        const year = params.get('year');

        document.getElementById('line-display').textContent = current_line ? current_line : 'N/A';
        document.getElementById('month-display').textContent = month ? getMonthName(month) : 'N/A';
        document.getElementById('year-display').textContent = year ? year : 'N/A';

        if (current_line && month && year) {
            fetchDataFromAPI(current_line, year, month);
        } else {
            console.error("Missing URL parameters: line, year, or month");
        }
    }

    function fetchDataFromAPI(current_line, year, month) {
        const baseUrl = "http://127.0.0.1:8000/api/showmachineoperation";

        fetch(baseUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log("Data fetched successfully:", data);
                // Assuming the data.machines holds the array of machine operations
                const filteredData = data.machines.filter(machine =>
                    String(machine.year) === String(year) &&
                    String(machine.month) === String(month) &&
                    String(machine.current_line) === String(current_line)
                );
                console.log("Filtered data:", filteredData);
                displayMachineData(filteredData);
                // Now call setupWeekButtons with any necessary parameters
                setupWeekButtons(parseInt(year), parseInt(month));
            })
            .catch(error => {
                console.error("Error fetching data:", error);
            });
    }

    function displayMachineData(data) {
        const machineNameElement = document.getElementById('machineName');
        console.log("Attempting to display data for", data.length, "days");
        if (data.length === 0) {
            console.log("No data available for this selection.");
            machineNameElement.textContent = 'No data available';
        }
        data.forEach((machine, index) => {
            const dayIndex = `day${machine.day}`;
            const dayElement = document.getElementById(dayIndex) || createDayElement(dayIndex);
            const entry = document.createElement('div');
            entry.className = 'p-2 border-2 text-xs flex flex-col justify-center isi-jpm text-center';
            entry.innerHTML = `
            <p class="font-bold kode-bn">${machine.code}</p>
            <p class="time">${machine.time}</p>
            <p class="description">${machine.description}</p>
        `;
            dayElement.appendChild(entry);
            if (index === 0) {
                machineNameElement.textContent = machine.machine_name;
            }
        });
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
            currentDate.setDate(currentDate.getDate + 1);
        }
        week.push(formatDate(currentDate)); // Add the final Monday

        if (week.length > 1) {
            weeks.push(week);
        }

        // Create buttons for each week
        weeks.forEach((week, index) => {
            const weekButton = document.createElement('button');
            weekButton.textContent = `Week ${index + 1}`;
            weekButton.className = 'year-item py-2 px-4 bg-blue-500 text-white rounded-md';
            weekButton.onclick = () => displayWeek(week);
            weeksList.appendChild(weekButton);
        });
    }

    function formatDate(date) {
        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        return `${days[date.getDay()]}, ${date.getDate()} ${getMonthName(date.getMonth() + 1)} ${date.getFullYear()}`;
    }


    function displayWeek(dates) {
        // Show the header days when a week is displayed
        document.getElementById('headerDays').style.display = 'block';

        dates.forEach((date, index) => {
            if (index < 8) { // Ensure we only update the 8 days
                const dayElement = document.getElementById(`day${index + 1}`);
                dayElement.children[0].textContent = date.split(",")[0]; // Day name
                dayElement.children[1].textContent = date.split(",")[1]; // Date
            }
        });
    }


    document.addEventListener('DOMContentLoaded', getQueryParams);
</script>

</body>
</html>