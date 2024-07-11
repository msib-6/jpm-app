<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/tailwind.min.css') }}" rel="stylesheet">
    <style>
        .month-container {
            transition: transform 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border-radius: 1rem;
            background-color: rgba(255, 255, 255, 0.5);
            margin-bottom: 1rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .month-container:hover {
            transform: scale(1.1);
        }
        .month-name {
            font-size: 1.4rem;
            font-weight: bold;
        }
        .week-list {
            display: flex;
            gap: 0.5rem;
            font-size: 0.875rem;
        }
        .week-item {
            background-color: #E9D5FF;
            color: #7C3AED;
            padding: 0.5rem;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 2rem;
            height: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .zoom-in {
            opacity: 0;
            transform: scale(0.8);
            animation: zoomIn 0.7s cubic-bezier(0.25, 0.8, 0.25, 1) forwards;
        }
        @keyframes zoomIn {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        .notification-bubble {
            position: absolute;
            /* top: -0.75em;
            right: -0.75em; */
            background-color: red;
            color: white;
            border-radius: 50%;
            width: 1.75em;
            /* height: 1.5em; */
            /* display: flex; */
            align-items: center;
            justify-content: center;
            font-size: 0.75em;
            text-align: center;
        }
        .notification-bubble.approved {
            background-color: green;
        }
    </style>
</head>
<body style="background-image: url('{{ asset('ELEMECH.png') }}'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">
@extends('manager.layout')

@section('title', 'Manager Dashboard')

@section('content')
<div class="container mx-auto px-4">
    <input type="text" id="userId" hidden value="{{auth()->user()->name}}">
    <div class='weeks-container zoom-in my-4 mx-auto flex justify-between items-center shadow-2xl rounded-3xl p-6' style="width: 91.666667%;backdrop-filter: blur(7px); background-color: rgba(255, 255, 255, 0.5);">
        <h1 class="text-4xl font-bold text-gray-800">Manager</h1>
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center mt-4" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" role="tablist">
                <li class="me-2 mx-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Waiting Approval</button>
                    <span id="waiting-approval-count" class="notification-bubble hidden"></span>
                </li>
                <li class="me-2 mx-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Approved</button>
                    <span id="approved-count" class="notification-bubble approved hidden"></span>
                </li>
            </ul>
        </div>
    </div>

    <div id="default-styled-tab-content" class="bg-white zoom-in shadow-lg rounded-3xl my-4 mx-auto flex items-center" style="width: 91.666667%; backdrop-filter: blur(7px); background-color: rgba(255, 255, 255, 0.5);">
        <div class="p-6 rounded-3xl my-4 mx-auto hidden w-full" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab" style="min-height: 30em;">
            <!-- Data Need Approve Disini -->
        </div>

        <div class="p-6 rounded-3xl my-4 mx-auto hidden w-full" id="styled-dashboard" role="tabpanel" aria-labelledby="dashboard-tab" style="min-height: 30em;">
            <!-- Data Approved Disini -->
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {

const waitingApprovalCount = document.getElementById('waiting-approval-count');
const approvedCount = document.getElementById('approved-count');

// Fetch and display waiting approval data
fetch('http://127.0.0.1:8000/api/showwaitingapprovalcard')
    .then(response => response.json())
    .then(data => {
        const container = document.getElementById('styled-profile');
        if (data.WaitingApproval.length === 0) {
            const message = document.createElement('p');
            message.classList.add('text-center', 'text-gray-500', 'font-bold');
            message.textContent = 'Tidak Ada Waiting Approval';
            container.appendChild(message);
            waitingApprovalCount.classList.add('hidden');
        } else {
            data.WaitingApproval.forEach(item => {
                const div = document.createElement('div');
                div.className = 'month-container'; // Menggunakan kelas month-container

                const span = document.createElement('span');
                span.textContent = `${item.current_line.replace(/(\D+)(\d+)/, '$1 $2')} - Week ${item.week}, ${getMonthName(item.month)} ${item.year}`;
                span.className = 'month-name'; // Menggunakan kelas month-name
                
                div.appendChild(span);
                div.onclick = function() {
                    window.location.href = `http://127.0.0.1:8000/manager/approve?line=${item.current_line}&year=${item.year}&month=${item.month}&week=${item.week}`;
                };
                container.appendChild(div);
            });
            waitingApprovalCount.textContent = data.WaitingApproval.length;
            waitingApprovalCount.classList.remove('hidden');
        }
    })
    .catch(error => console.error('Error fetching data:', error));

// Fetch and display approved data
fetch('http://127.0.0.1:8000/api/showapprovedcard')
    .then(response => response.json())
    .then(data => {
        const container = document.getElementById('styled-dashboard');
        if (data.ApprovedCard.length === 0) {
            const message = document.createElement('p');
            message.classList.add('text-center', 'text-gray-500', 'font-bold');
            message.textContent = 'Tidak Ada Data Approved';
            container.appendChild(message);
            approvedCount.classList.add('hidden');
        } else {
            data.ApprovedCard.forEach(item => {
                const div = document.createElement('div');
                div.className = 'month-container'; // Menggunakan kelas month-container

                const span = document.createElement('span');
                span.textContent = `${item.current_line.replace(/(\D+)(\d+)/, '$1 $2')} - Week ${item.week}, ${getMonthName(item.month)} ${item.year}`;
                span.className = 'month-name'; // Menggunakan kelas month-name
                
                div.appendChild(span);
                div.onclick = function() {
                    window.location.href = `http://127.0.0.1:8000/manager/approve?line=${item.current_line}&year=${item.year}&month=${item.month}&week=${item.week}`;
                };
                container.appendChild(div);
            });
            approvedCount.textContent = data.ApprovedCard.length;
            approvedCount.classList.remove('hidden');
        }
    })
    .catch(error => console.error('Error fetching data:', error));
});

function getMonthName(monthNumber) {
const months = [
    'January', 'February', 'March', 'April', 'May', 'June',
    'July', 'August', 'September', 'October', 'November', 'December'
];
return months[monthNumber - 1];
}
</script>

@endsection
</body>
</html>
