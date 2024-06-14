<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
    @vite('public/css/history.css')
</head>
<body style="background-image: url('{{ asset('elegant.jpg') }}'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">
@extends('pjl.layout')

@section('title', 'Approval PJL')

@section('content')

    <div class='container mx-auto px-4'>
    <div class='weeks-container my-4 mx-auto flex justify-between items-center shadow-2xl rounded-3xl p-6' style="width: 91.666667%;">
        <h1 class="text-4xl font-bold text-gray-800">January</h1>
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

        <div id="default-styled-tab-content" class="bg-white shadow-lg rounded-3xl my-4 mx-auto flex items-center" style="width: 91.666667%;">
        <div class="bg-white p-6 rounded-3xl my-4 mx-auto hidden w-full" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab" style="min-height: 30em;">
            <!-- Data Need Approve Disini -->
        </div>

        <div class="bg-white p-6 rounded-3xl my-4 mx-auto summary-container hidden w-full" id="styled-dashboard" role="tabpanel" aria-labelledby="dashboard-tab" style="min-height: 30em;">
            <!-- Data Approved Disini -->
        </div>
    </div>
    </div>

@endsection

</body>
</html>
