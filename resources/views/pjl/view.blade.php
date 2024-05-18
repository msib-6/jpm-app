<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
    <title>Machine Schedule Display</title>
</head>
<body class="bg-gray-100">
<div class="container mx-auto px-4">
    <!-- Card Title -->
    <div class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto flex justify-between items-center" style="width: 91.666667%;">
        <h3 id="title" class="text-2xl font-bold">
            Line: <span id="line-display">Loading...</span>, <span id="month-display">Loading...</span> <span id="year-display">Loading...</span>
        </h3>
    </div>

    <!-- Weeks Buttons Container -->
    <div id="weeks-buttons-container" class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto flex justify-between items-center flex-wrap" style="width: 91.666667%;">
        <!-- Week buttons will be added here by JavaScript -->
    </div>

    <!-- Inserted new div for weeks display -->
    <div id="weeksDisplay" class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto" style="width: 91.666667%;">
        <!-- Detailed weeks data will be populated here upon week button click -->
    </div>

    <!-- The rest of your content -->

</div>

<script>
    function getQueryParams() {
        const params = new URLSearchParams(window.location.search);
        const line = params.get('line');
        const year = params.get('year');
        const month = params.get('month');

        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        const monthName = month ? monthNames[parseInt(month) - 1] : 'N/A';

        document.getElementById('line-display').textContent = line ? line : 'N/A';
        document.getElementById('month-display').textContent = monthName;
        document.getElementById('year-display').textContent = year ? year : 'N/A';

        if (year && month) {
            updateWeeksDisplay(year, month);
        }
    }

    function getWeeksOfMonth(year, month) {
        const weeks = [];
        let currentDate = new Date(year, parseInt(month) - 1, 1);

        currentDate.setDate(currentDate.getDate() - (currentDate.getDay() === 0 ? 6 : currentDate.getDay() - 1));

        while (currentDate.getMonth() === parseInt(month) - 1 || currentDate.getMonth() === parseInt(month) - 2 && currentDate.getDay() !== 1) {
            let endOfWeek = new Date(currentDate);
            endOfWeek.setDate(currentDate.getDate() + 6);

            weeks.push({
                start: new Date(currentDate),
                end: new Date(endOfWeek)
            });

            currentDate.setDate(currentDate.getDate() + 7);
        }

        return weeks;
    }

    function updateWeeksDisplay(year, month) {
        const weeks = getWeeksOfMonth(year, parseInt(month));
        const weeksButtonsContainer = document.getElementById('weeks-buttons-container');
        weeksButtonsContainer.innerHTML = ''; // Clear previous buttons

        weeks.forEach((week, index) => {
            const weekButton = document.createElement('button');
            weekButton.textContent = `Week ${index + 1}: ${week.start.toLocaleDateString()} to ${week.end.toLocaleDateString()}`;
            weekButton.className = 'week-button py-2 px-4 bg-blue-500 text-white rounded-md m-1';
            weekButton.onclick = () => showWeekDetails(week.start, week.end);
            weeksButtonsContainer.appendChild(weekButton);
        });
    }

    function showWeekDetails(start, end) {
        const weeksDisplay = document.getElementById('weeksDisplay');
        weeksDisplay.innerHTML = `<div>Week from ${start.toLocaleDateString()} to ${end.toLocaleDateString()}:</div>`;
        for (let date = new Date(start); date <= end; date.setDate(date.getDate() + 1)) {
            const dayDiv = document.createElement('div');
            dayDiv.className = 'day-info p-2 mt-2 bg-gray-100';
            dayDiv.textContent = `${date.toDateString()}`;
            weeksDisplay.appendChild(dayDiv);
        }
    }

    document.addEventListener('DOMContentLoaded', getQueryParams);
</script>
</body>
</html>
