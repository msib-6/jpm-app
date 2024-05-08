<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit</title>
    <!-- Menghubungkan CSS Tailwind -->
    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
    <!-- Menghubungkan CSS kustom -->
    <link href="{{ asset('css/history.css') }}" rel="stylesheet">
</head>
<body>
<div class='container'>
    <div class='card'>
        <h1>History</h1>
    </div>
    <div class='weeks-container'>
        <!-- Dropdown menggunakan Tailwind CSS -->
        <div class="dropdown inline-block relative">
            <button class="text-white font-bold py-2 px-4 rounded inline-flex items-center">
                <span class="mr-1">Line</span>
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M10 12.828l-6.364-6.364a1 1 0 00-1.414 1.414l7.071 7.071a1 1 0 001.414 0l7.071-7.071a1 1 0 10-1.414-1.414L10 12.828z"/>
                </svg>
            </button>
            <ul class="dropdown-menu absolute text-gray-700 pt-1">
                <!-- Dropdown items -->
                <li><a class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="https://www.antgroup.com">Line 1</a></li>
                <li><a class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="https://www.aliyun.com">Line 2</a></li>
                <li><a class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="https://www.aliyun.com">Line 3</a></li>
                <li><a class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="https://www.aliyun.com">Line 6</a></li>
                <li><a class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="https://www.aliyun.com">Line 8A</a></li>
                <li><a class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="https://www.aliyun.com">Line 1</a></li>
                <li><a class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="https://www.aliyun.com">Line 2</a></li>
                <li><a class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="https://www.aliyun.com">Line 3</a></li>
            </ul>
        </div>
    </div>
    <div class='summary-container'>
        All Lines
    </div>
</div>
</body>
</html>
