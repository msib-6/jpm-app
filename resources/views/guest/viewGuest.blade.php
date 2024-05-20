<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
    @vite('resources/css/guest/view.css')
    <title>Machine Schedule Display Guest</title>
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
    <div class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto flex justify-between items-center" style="width: 91.666667%;" id="yearsList">
        <button class="year-item py-2 px-4 bg-blue-500 text-white rounded-md">Week 1</button>
    </div>

    <!-- Header for Days -->
    <div class="header-days bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto" style="width: 91.666667%;">
        <div class="grid grid-cols-10 gap-4 text-center font-semibold">
            <!-- Use flexbox utilities to center content vertically and horizontally -->
            <div class="flex font-bold items-center justify-center col-span-2 text-xl">Mesin</div>
            <!-- Hari Kesatu -->
            <div class="flex flex-col justify-center items-center">
                <span class="font-bold">Senin</span>
                <span>4 Maret 2024</span>
            </div>
            <!-- Hari Kedua -->
            <div class="flex flex-col justify-center items-center">
                <span class="font-bold">Selasa</span>
                <span>5 Maret 2024</span>
            </div>
            <!-- Hari Ketiga -->
            <div class="flex flex-col justify-center items-center">
                <span class="font-bold">Rabu</span>
                <span>6 Maret 2024</span>
            </div>
            <!-- Hari Keempat -->
            <div class="flex flex-col justify-center items-center">
                <span class="font-bold">Kamis</span>
                <span>7 Maret 2024</span>
            </div>
            <!-- Hari Kelima -->
            <div class="flex flex-col justify-center items-center">
                <span class="font-bold">Jumat</span>
                <span>8 Maret 2024</span>
            </div>
            <!-- Hari Keenam -->
            <div class="flex flex-col justify-center items-center">
                <span class="font-bold">Sabtu</span>
                <span>9 Maret 2024</span>
            </div>
            <!-- Hari Ketujuh -->
            <div class="flex flex-col justify-center items-center">
                <span class="font-bold">Minggu</span>
                <span>10 Maret 2024</span>
            </div>
            <!-- Hari Kedelapan -->
            <div class="flex flex-col justify-center items-center">
                <span class="font-bold">Senin</span>
                <span>11 Maret 2024</span>
            </div>
        </div>
    </div>


    <!-- Data Container -->
    <div class="bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto" style="width: 91.666667%;">
        <!-- Main grid container with vertical alignment adjustments -->
        <div class="grid grid-cols-10 gap-4">
            <!-- Mesin DIOSNA - spans across all data rows for March 4 -->
            <div  class="font-bold border-2 mesin-jpm p-2 row-span-3 col-span-2 flex items-center justify-center text-center" style="height: 90%;">
                DIOSNA P 400 NIRO T6 QUADROCOMIL ZANCHETTA (Line 1)
            </div>

            <!-- Data for March 4, vertically aligned to the top -->
            <div class="col-span-1 grid grid-rows-3 gap-2">
                <div class="p-2 border-2 text-xs flex flex-col justify-center isi-jpm text-center">
                    <p class="font-bold kode-bn">KTPRGES678</p>
                    <p>07:00</p>
                    <p>Supervisi</p>
                </div>
                <div class="p-2 border-2 text-xs flex flex-col justify-center isi-jpm text-center">
                    <p class="font-bold kode-bn">KTPRGES678</p>
                    <p>07:00</p>
                    <p>Supervisi</p>
                </div>
                <div class="p-2 border-2 text-xs flex flex-col justify-center isi-jpm text-center">
                    <p class="font-bold kode-bn">KTPRGES678</p>
                    <p>07:00</p>
                    <p>Supervisi</p>
                </div>
            </div>

            <!-- Example for March 5, assuming 2 entries -->
            <div class="col-span-1 grid grid-rows-3 gap-2">
                <div class="p-2 border-2 text-xs flex flex-col justify-center isi-jpm text-center">
                    <p class="font-bold kode-bn">KTPRGES678</p>
                    <p>07:00</p>
                    <p>Supervisi</p>
                </div>
                <div class="p-2 border-2 text-xs flex flex-col justify-center isi-jpm text-center">
                    <p class="font-bold kode-bn">KTPRGES678</p>
                    <p>07:00</p>
                    <p>Supervisi</p>
                </div>
            </div>

            <div class="col-span-1 grid grid-rows-3 gap-2">
                <div class="p-2 border-2 text-xs flex flex-col justify-center isi-jpm text-center">
                    <p class="font-bold kode-bn">KTPRGES678</p>
                    <p>07:00</p>
                    <p>Supervisi</p>
                </div>
            </div>

        </div>
    </div>



</div>

<script>
    function getQueryParams() {
        const params = new URLSearchParams(window.location.search);
        const line = params.get('line');
        const month = params.get('month');
        const year = params.get('year');

        // Convert month number to Indonesian month name
        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        const monthName = month ? monthNames[parseInt(month) - 1] : 'N/A';

        document.getElementById('line-display').textContent = line ? line : 'N/A';
        document.getElementById('month-display').textContent = monthName;
        document.getElementById('year-display').textContent = year ? year : 'N/A';
    }

    document.addEventListener('DOMContentLoaded', getQueryParams);



</script>
</body>
</html>
