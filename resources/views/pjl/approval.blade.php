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
        <div class="bg-white  p-6 rounded-3xl shadow-2xl my-4 mx-auto flex justify-between items-center" style="width: 91.666667%;">
            <h1 class="text-3xl font-bold">January</h1>
        </div>
        <div class='bg-white  p-6 rounded-3xl shadow-2xl my-4 mx-auto flex justify-between items-center' style="width: 91.666667%;">
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center mt-4" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" role="tablist">
                    <li class="me-2 mx-2 flex items-center p-0" role="presentation">
                        <button class="inline-block p-0 border-b-2 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Return Approval</button>
                    </li>
                    <li class="me-2 mx-2 flex items-center p-0" role="presentation">
                        <button class="inline-block p-0 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Approved</button>
                    </li>
                </ul>
            </div>
        </div>
        <div class='bg-white p-6 rounded-3xl shadow-2xl my-4 mx-auto flex items-center'  style='width: 91.666667%;'>
            <div id="default-styled-tab-content">
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="flex items-center justify-between bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                        <h5 class="text-3xl font-bold text-gray-900 dark:text-white">Line</h5>
                        <svg class="w-6 h-6 text-gray-800 dark:text-white ml-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                        </svg>
                    </div>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
                </div>
            </div>
        </div>
    </div>

@endsection

</body>
</html>
