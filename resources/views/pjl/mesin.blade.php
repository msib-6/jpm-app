<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
    @vite('resources/css/pjl/dashboard.css')
</head>
<body class="bg-gray-100">
<div class="container mx-auto px-4">
    <!-- Card Title -->
    <div class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto flex justify-between items-center" style="width: 91.666667%;">
        <h3 class="text-3xl font-semibold">PJL Add Mesin</h3>
    </div>

    <!-- Years Container -->
    <div class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto flex justify-between items-center" style="width: 91.666667%;" id="yearsList">
        <button class="year-item py-2 px-4 bg-blue-500 text-white rounded-md">year</button>
        <button class="add-year-btn py-2 px-4 bg-green-500 text-white rounded-md" onclick="openModal()">+ Mesin</button>
    </div>

    <!-- Modal for Adding Years (Hidden by default) -->
<!--    <div id="yearModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">-->
<!--        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">-->
<!--            <div class="mt-3 text-center">-->
<!--                <span class="close-btn top-0 right-0 cursor-pointer text-black px-3 py-1 text-xl font-bold" onclick="closeModal()">&times;</span>-->
<!--                <p class="text-lg font-semibold">Select a Year:</p>-->
<!--                <div id="yearOptions" class="mt-2">-->
<!--                     Year buttons will be inserted here-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

    <!-- Mesin Container -->
    <div class="summary-container bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto" style="width: 91.666667%;" id="monthsContainer">
        <!-- Mesin will be added here by JavaScript -->

    </div>
</div>

<script>

    document.addEventListener('DOMContentLoaded', function () {
        populateMachinery();
    });

    function populateMachinery() {
        const machineryData = [
            { name: 'DIOSNA P 400 NIRO T6 QUADROCOMILL ZANCHETTA', lines: 'Line 1, Line 2' },
            { name: 'DIOSNA P QUADROCOMILL ZA 400 NIR O T6 NCHETTA', lines: 'Line 10' },
            { name: 'DIUADRONA P 400 NIRO T6 QCOSOM NCHEATTA', lines: 'Line 14' },
            { name: 'DI OUA DROCOMILL ZAN CHSNA P 400 NIRO T6 QETTA', lines: 'Line 10' },
            { name: 'DICOMOSNA P 400 NIRO T6 QUAD ROILL ZANCHETTA', lines: 'Line 8' },
            { name: 'DIOSCHETTA NA OCOMILL 400 NIRO T6 QUADRZAN', lines: 'Line 1, Line 5' },
            { name: 'DIOSROCOM ILLNA P 40CHETTA 0 NIRO T6 QUAD ZAN', lines: 'Line 1' }
        ];

        const container = document.getElementById('monthsContainer');
        machineryData.forEach(item => {
            const element = document.createElement('div');
            element.className = 'machine-entry py-4 px-6 mb-4 bg-gray-100 rounded-md shadow-md';
            element.innerHTML = `<h4 class="text-xl font-bold">${item.name}</h4><p>${item.lines}</p>`;
            container.appendChild(element);
        });
    }

    function openModal() {
        document.getElementById('yearModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('yearModal').classList.add('hidden');
    }

    function prepareYearModal() {
        const yearOptionsContainer = document.getElementById('yearOptions');
        const currentYear = new Date().getFullYear();
        for (let i = currentYear - 3; i <= currentYear + 3; i++) {
            const button = document.createElement('button');
            button.textContent = i;
            button.className = 'm-2 py-2 px-4 bg-blue-500 hover:bg-blue-700 text-white rounded-md';
            button.onclick = function() { addYear(i); };
            yearOptionsContainer.appendChild(button);
        }
    }

    function addYear(year) {
        const yearsList = document.getElementById('yearsList');
        const button = document.createElement('button');
        button.className = 'year-item py-2 px-4 bg-gray-300 hover:bg-gray-400 text-black rounded-md';
        button.textContent = year;
        yearsList.appendChild(button);
        closeModal();
    }
</script>
</body>
</html>
