<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Jost:ital,wght@0,100..900;1,100..900&family=Poppins:wght@400;600;700&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <title>Machine Schedule Display</title>
    @vite('resources/css/pjl/view.css')
</head>
<body>
<div class="container mx-auto px-4">
    <!-- Card Title -->
    <div class="bg-white opacity-75 p-6 rounded-3xl shadow-2xl my-4 mx-auto flex items-center justify-between" style="width: 100%;">
        <h3 id="title" class="text-2xl font-bold">
            <span id="line-display">Logistik</span>
        </h3>
    </div>

    <!-- Header for Days -->
    <div class="header-days bg-white opacity-75 p-6 rounded-3xl shadow-2xl my-4 mx-auto" style="width:100%;" id="headerDays">
        <div class="flex justify-between text-center font-semibold">
            <div class="flex-1 font-bold items-center justify-center text-sm">Tanggal</div>
            <div class="flex-1 font-bold items-center justify-center text-sm">Jam</div>
            <div class="flex-1 font-bold items-center justify-center text-sm">Line</div>
            <div class="flex-1 font-bold items-center justify-center text-sm">Kode Produk</div>
            <div class="flex-1 font-bold items-center justify-center text-sm">No Batch</div>
            <div class="flex-1 font-bold items-center justify-center text-sm">Tanggal dan Waktu Revisi JPM</div>
            <div class="flex-1 font-bold items-center justify-center text-sm">Keterangan</div>
        </div>
    </div>

    <!-- Data Container -->
    <div id="dataContainer" class="bg-white opacity-75 p-6 rounded-3xl shadow-2xl my-4 mx-auto" style="width: 100%;">
        <!-- Dynamic rows for machines will be appended here -->
    </div>
</div>
</body>
</html>