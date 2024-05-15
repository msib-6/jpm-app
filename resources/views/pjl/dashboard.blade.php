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
        <h3 class="text-3xl font-semibold">PJL Line 3</h3>
    </div>

    <!-- Years Container -->
    <div class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto flex justify-between items-center" style="width: 91.666667%;" id="yearsList">
        <!-- Lokasi Add Year -->
        <button class="add-year-btn py-2 px-4 bg-green-500 flex items-center justify-center text-white" onclick="openModal()">+ year</button>
    </div>

    <!-- Modal for Adding Years (Hidden by default) -->
    <div id="yearModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center relative">  <!-- Tambahkan class 'relative' di sini -->
                <span class="close-btn absolute top-0 right-0 cursor-pointer text-black px-3 text-2xl font-bold" onclick="closeModal()">&times;</span>
                <p class="text-lg font-semibold pt-1 pb-3">Add New Year:</p>
                <div id="yearOptions" class="mt-2">
                    <!-- Year buttons will be inserted here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Month Container -->
    <div class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto hidden" style="width: 91.666667%;" id="monthsContainer">
        <!-- Months will be added here by JavaScript -->
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        const container = document.getElementById('monthsContainer');

        months.forEach(month => {
            const ul = document.createElement('ul');
            const button = document.createElement('button');
            button.className = 'month-item py-2 px-4 bg-gray-300 text-black rounded-md';
            button.textContent = month;
            ul.appendChild(button);
            container.appendChild(ul);
        });

        // Functions for modal
        prepareYearModal();
    });

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
        button.className = 'year-item py-2 px-4 bg-blue-500 text-white rounded-md';
        button.textContent = year;

        const addButton = document.querySelector('.add-year-btn');
        yearsList.insertBefore(button, addButton); // Menambahkan sebelum tombol "+ year"

        document.getElementById('monthsContainer').classList.remove('hidden'); // Make months visible
        closeModal();
    }

</script>
</body>
</html>
