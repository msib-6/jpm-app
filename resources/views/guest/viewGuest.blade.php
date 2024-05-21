<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
    <link href="/node_modules/flowbite/dist/flowbite.min.css" rel="stylesheet">
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
        <!-- Mesin DIOSNA - spans across all data rows for March 4 -->
        <div class="grid grid-cols-10 gap-4">
            <!-- Mesin DIOSNA - spans across all data rows for March 4 -->
            <div  class="font-bold border-2 mesin-jpm p-2 row-span-3 col-span-2 flex items-center justify-center text-center" style="height: 90%;">
            <span class="inline-flex items-center custom-badge1 text-white text-xs font-medium px-2.5 py-0.5 rounded-full">
                    <span class="w-2 h-2 mr-1 bg-white rounded-full"></span>
                    Granulasi
                </span>
            DIOSNA P 400 NIRO T6 QUADROCOMIL ZANCHETTA (Line 2)
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
                 <div class="p-2 border-2 text-xs flex flex-col justify-center isi-jpm text-center">
                    <p class="font-bold kode-bn">KTPRGES678</p>
                    <p>07:00</p>
                    <p>Supervisi</p>
                </div>
            </div>

            <!-- Example for March 6, assuming 2 entries -->
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
            <!-- Example for March 7, assuming 2 entries -->
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
                        <!-- Data for March 8, vertically aligned to the top -->
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

            <!-- Example for March 9, assuming 2 entries -->
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

            <!-- Example for March 10, assuming 2 entries -->
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
            <!-- Example for March 11, assuming 2 entries -->
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

        </div>

        <div class="grid grid-cols-10 gap-4">
            <!-- Mesin DIOSNA - spans across all data rows for March 4 -->
            <div  class="font-bold border-2 mesin-jpm p-2 row-span-3 col-span-2 flex items-center justify-center text-center" style="height: 90%;">
            <span class="inline-flex items-center custom-badge2 text-white text-xs font-medium px-2.5 py-0.5 rounded-full">
                    <span class="w-2 h-2 mr-1 bg-white rounded-full"></span>
                    Drying
                </span>
            DIOSNA P 400 NIRO T6 QUADROCOMIL ZANCHETTA (Line 2)
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
                 <div class="p-2 border-2 text-xs flex flex-col justify-center isi-jpm text-center">
                    <p class="font-bold kode-bn">KTPRGES678</p>
                    <p>07:00</p>
                    <p>Supervisi</p>
                </div>
            </div>

            <!-- Example for March 6, assuming 2 entries -->
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
            <!-- Example for March 7, assuming 2 entries -->
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
                        <!-- Data for March 8, vertically aligned to the top -->
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

            <!-- Example for March 9, assuming 2 entries -->
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

            <!-- Example for March 10, assuming 2 entries -->
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
            <!-- Example for March 11, assuming 2 entries -->
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
        </div>

        <div class="grid grid-cols-10 gap-4">
            <!-- Mesin DIOSNA - spans across all data rows for March 4 -->
            <div  class="font-bold border-2 mesin-jpm p-2 row-span-3 col-span-2 flex items-center justify-center text-center" style="height: 90%;">
            <span class="inline-flex items-center custom-badge3 text-white text-xs font-medium px-2.5 py-0.5 rounded-full">
                    <span class="w-2 h-2 mr-1 bg-white rounded-full"></span>
                    Final Mix/Camas
                </span>
            DIOSNA P 400 NIRO T6 QUADROCOMIL ZANCHETTA (Line 2)
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
                 <div class="p-2 border-2 text-xs flex flex-col justify-center isi-jpm text-center">
                    <p class="font-bold kode-bn">KTPRGES678</p>
                    <p>07:00</p>
                    <p>Supervisi</p>
                </div>
            </div>

            <!-- Example for March 6, assuming 2 entries -->
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
            <!-- Example for March 7, assuming 2 entries -->
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
                        <!-- Data for March 8, vertically aligned to the top -->
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

            <!-- Example for March 9, assuming 2 entries -->
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

            <!-- Example for March 10, assuming 2 entries -->
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
            <!-- Example for March 11, assuming 2 entries -->
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
        </div>

        <div class="grid grid-cols-10 gap-4">
            <!-- Mesin DIOSNA - spans across all data rows for March 4 -->
            <div  class="font-bold border-2 mesin-jpm p-2 row-span-3 col-span-2 flex items-center justify-center text-center" style="height: 90%;">
            <span class="inline-flex items-center custom-badge4 text-white text-xs font-medium px-2.5 py-0.5 rounded-full">
                    <span class="w-2 h-2 mr-1 bg-white rounded-full"></span>
                    Cetak
                </span>
            DIOSNA P 400 NIRO T6 QUADROCOMIL ZANCHETTA (Line 2)
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
                 <div class="p-2 border-2 text-xs flex flex-col justify-center isi-jpm text-center">
                    <p class="font-bold kode-bn">KTPRGES678</p>
                    <p>07:00</p>
                    <p>Supervisi</p>
                </div>
            </div>

            <!-- Example for March 6, assuming 2 entries -->
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
            <!-- Example for March 7, assuming 2 entries -->
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
                        <!-- Data for March 8, vertically aligned to the top -->
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

            <!-- Example for March 9, assuming 2 entries -->
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

            <!-- Example for March 10, assuming 2 entries -->
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
            <!-- Example for March 11, assuming 2 entries -->
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
        </div>

        <div class="grid grid-cols-10 gap-4">
            <!-- Mesin DIOSNA - spans across all data rows for March 4 -->
            <div  class="font-bold border-2 mesin-jpm p-2 row-span-3 col-span-2 flex items-center justify-center text-center" style="height: 90%;">
            <span class="inline-flex items-center custom-badge5 text-white text-xs font-medium px-2.5 py-0.5 rounded-full">
                    <span class="w-2 h-2 mr-1 bg-white rounded-full"></span>
                    Coating
                </span>
            DIOSNA P 400 NIRO T6 QUADROCOMIL ZANCHETTA (Line 2)
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
                 <div class="p-2 border-2 text-xs flex flex-col justify-center isi-jpm text-center">
                    <p class="font-bold kode-bn">KTPRGES678</p>
                    <p>07:00</p>
                    <p>Supervisi</p>
                </div>
            </div>

            <!-- Example for March 6, assuming 2 entries -->
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
            <!-- Example for March 7, assuming 2 entries -->
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
                        <!-- Data for March 8, vertically aligned to the top -->
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

            <!-- Example for March 9, assuming 2 entries -->
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

            <!-- Example for March 10, assuming 2 entries -->
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
            <!-- Example for March 11, assuming 2 entries -->
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
        </div>

        <div class="grid grid-cols-10 gap-4">
            <!-- Mesin DIOSNA - spans across all data rows for March 4 -->
            <div  class="font-bold border-2 mesin-jpm p-2 row-span-3 col-span-2 flex items-center justify-center text-center" style="height: 90%;">
            <span class="inline-flex items-center custom-badge6 text-white text-xs font-medium px-2.5 py-0.5 rounded-full">
                    <span class="w-2 h-2 mr-1 bg-white rounded-full"></span>
                    Kemas
                </span>
            DIOSNA P 400 NIRO T6 QUADROCOMIL ZANCHETTA (Line 2)
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
                 <div class="p-2 border-2 text-xs flex flex-col justify-center isi-jpm text-center">
                    <p class="font-bold kode-bn">KTPRGES678</p>
                    <p>07:00</p>
                    <p>Supervisi</p>
                </div>
            </div>

            <!-- Example for March 6, assuming 2 entries -->
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
            <!-- Example for March 7, assuming 2 entries -->
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
                        <!-- Data for March 8, vertically aligned to the top -->
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

            <!-- Example for March 9, assuming 2 entries -->
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

            <!-- Example for March 10, assuming 2 entries -->
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
            <!-- Example for March 11, assuming 2 entries -->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>
