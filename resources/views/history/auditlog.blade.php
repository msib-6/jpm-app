<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Log</title>
    <link href="{{ asset('css/history.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100"> <!-- Tambahkan kelas bg-gray-100 untuk latar belakang -->

<section id="content" class="py-8 px-4"> <!-- Tambahkan kelas px-4 untuk memberikan ruang padding di sisi -->

    <div class='container mx-auto'>
        <div class='card flex justify-between'> <!-- Tambahkan kelas flex dan justify-between -->
            <h1 class="text-left text-4xl font-bold text-gray-800">History</h1> <!-- Sesuaikan ukuran dan gaya teks -->
            <button class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-3 py-2.5 flex items-center float-right">
                <svg class="w-6 h-6 mr-1 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2m-8 1V4m0 12-4-4m4 4 4-4"/>
                </svg>
                Download PDF
            </button>
        </div>
        <div class='weeks-container'>
            <!-- Button trigger dropdown -->
            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" type="button" class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                Select Line
                <svg class="w-3 h-3 ml-1 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div id="dropdown" class="hidden dropdown-menu bg-white divide-y divide-gray-100 rounded-lg shadow-md mt-2 w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                    @for ($i = 1; $i <= 14; $i++)
                        @if ($i == 6 || $i == 9)
                            @continue
                        @endif

                        @if ($i == 8)
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Line 8A</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Line 8B</a></li>
                        @else
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Line {{ $i }}</a></li>
                        @endif
                    @endfor
                </ul>
            </div>
        </div>

        <div class='summary-container bg-white shadow-lg rounded-lg p-6 mb-8'> <!-- Gunakan kelas Tailwind CSS untuk mengatur tampilan kontainer ringkasan -->
            
        </div>
    </div>

</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>
