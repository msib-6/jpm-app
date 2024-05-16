<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
    @vite('resources/css/manager/dashboard.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100"> <!-- Tambahkan kelas bg-gray-100 untuk latar belakang -->

<section id="content" class="py-8 px-4"> <!-- Tambahkan kelas px-4 untuk memberikan ruang padding di sisi -->

    <div class='container mx-auto'>
        <div class='card flex justify-between'> <!-- Tambahkan kelas flex dan justify-between -->
            <h1 class="text-left text-4xl font-bold text-gray-800">Manager</h1>
        </div>
        <div class='weeks-container'>
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center mt-4" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" role="tablist">
                    <li class="me-2 mx-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Waiting Approval</button>
                    </li>
                    <li class="me-2 mx-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Approved</button>
                    </li>

                </ul>
            </div>
        </div>

        <div class='summary-container bg-white shadow-lg rounded-lg p-6 mb-8'> <!-- Gunakan kelas Tailwind CSS untuk mengatur tampilan kontainer ringkasan -->
            <div id="default-styled-tab-content">
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab">
                    <button class="flex items-center justify-between bg-gray-100 bg-white border border-gray-200 rounded-lg w-11/12 mx-auto button-manager-dashboard">
                        <!-- Column for Text -->
                        <div class="flex flex-col justify-center w-11/12">
                            <!-- Line 3 Heading -->
                            <div class="w-full">
                                <h5 class="text-2xl font-bold text-black dark:bg-gray-700 py-2 px-4 rounded">Line 3</h5>
                            </div>
                            <!-- Week 4, Januari 2024 Heading -->
                            <div class="w-full">
                                <h5 class="text-lg font-normal text-black dark:bg-gray-700 py-2 px-4 rounded">Week 4, Januari 2024</h5>
                            </div>
                        </div>
                        <!-- Column for SVG Icon, centered -->
                        <div class="flex items-center justify-center w-11/12">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                            </svg>
                        </div>
                    </button>

                    <button class="flex mt-7 items-center justify-between bg-gray-100 bg-white border border-gray-200 rounded-lg w-11/12 mx-auto button-manager-dashboard">
                        <!-- Column for Text -->
                        <div class="flex flex-col justify-center w-11/12">
                            <!-- Line 3 Heading -->
                            <div class="w-full">
                                <h5 class="text-2xl font-bold text-black dark:bg-gray-700 py-2 px-4 rounded">Line 3</h5>
                            </div>
                            <!-- Week 4, Januari 2024 Heading -->
                            <div class="w-full">
                                <h5 class="text-lg font-normal text-black dark:bg-gray-700 py-2 px-4 rounded">Week 4, Januari 2024</h5>
                            </div>
                        </div>
                        <!-- Column for SVG Icon, centered -->
                        <div class="flex items-center justify-center w-11/12">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                            </svg>
                        </div>
                    </button>
                </div>

                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-dashboard" role="tabpanel" aria-labelledby="dashboard-tab">

                    <button class="flex items-center justify-between bg-gray-100 bg-white border-2 border-green-500 rounded-lg w-11/12 mx-auto button-manager-dashboard">
                        <!-- Column for Text -->
                        <div class="flex flex-col justify-center w-11/12">
                            <!-- Line 3 Heading -->
                            <div class="w-full">
                                <h5 class="text-2xl font-bold text-black dark:bg-gray-700 py-2 px-4 rounded">Line 3</h5>
                            </div>
                            <!-- Week 4, Januari 2024 Heading -->
                            <div class="w-full">
                                <h5 class="text-lg font-normal text-black dark:bg-gray-700 py-2 px-4 rounded">Week 4, Januari 2024</h5>
                            </div>
                        </div>
                        <!-- Column for SVG Icon, centered -->
                        <div class="flex items-center justify-center w-11/12">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                            </svg>
                        </div>
                    </button>

                    <button class="flex mt-7 items-center justify-between bg-green-100 bg-white border-2 border-green-500 rounded-lg w-11/12 mx-auto button-manager-dashboard">
                        <!-- Column for Text -->
                        <div class="flex flex-col justify-center w-11/12">
                            <!-- Line 3 Heading -->
                            <div class="w-full">
                                <h5 class="text-2xl font-bold text-black dark:bg-gray-700 py-2 px-4 rounded">Line 2</h5>
                            </div>
                            <!-- Week 4, Januari 2024 Heading -->
                            <div class="w-full">
                                <h5 class="text-lg font-normal text-black dark:bg-gray-700 py-2 px-4 rounded">Week 1, Januari 2024</h5>
                            </div>
                        </div>
                        <!-- Column for SVG Icon, centered -->
                        <div class="flex items-center justify-center w-11/12">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                            </svg>
                        </div>
                    </button>

                </div>
            </div>
        </div>


    </div>
    </div>
    </div>

</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>
