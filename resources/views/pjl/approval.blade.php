<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/tailwind.min.css') }}" rel="stylesheet">
    @vite('public/css/history.css')
    <style>
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
            top: -0.75em;
            right: -0.75em;
            background-color: red;
            color: white;
            border-radius: 50%;
            width: 1.5em;
            height: 1.5em;
            display: flex;
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
@extends('pjl.layout')

@section('title', 'Approval PJL')

@section('content')

<div class='container mx-auto px-4'>
    <input type="text" id="userId" hidden value="{{auth()->user()->name}}">
    <div class='weeks-container my-4 mx-auto zoom-in flex justify-between items-center shadow-2xl rounded-3xl p-6' style="width: 91.666667%;backdrop-filter: blur(7px); background-color: rgba(255, 255, 255, 0.5);">
        <h1 class="text-4xl font-bold text-gray-800">Status</h1>
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700 relative">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center mt-4" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" role="tablist">
                <li class="me-2 mx-2 relative" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="true">
                        Return Approval
                        <span id="return-approval-count" class="notification-bubble hidden"></span>
                    </button>
                </li>
                <li class="me-2 mx-2 relative" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">
                        Approved
                        <span id="approved-count" class="notification-bubble approved hidden"></span>
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <div id="default-styled-tab-content" class="bg-white zoom-in shadow-lg rounded-3xl my-4 mx-auto flex items-center" style="width: 91.666667%;backdrop-filter: blur(7px); background-color: rgba(255, 255, 255, 0.5);">
        <div class=" p-6 rounded-3xl my-4 mx-auto w-full" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab" style="min-height: 30em;">
            <!-- Data Need Approve Disini -->
            <p id="no-return-approval" class="text-center text-gray-500 font-bold hidden">Tidak ada return approval</p>
        </div>

        <div class=" p-6 rounded-3xl my-4 mx-auto hidden w-full" id="styled-dashboard" role="tabpanel" aria-labelledby="dashboard-tab" style="min-height: 30em;">
            <!-- Data Approved Disini -->
            <p id="no-approved-data" class="text-center text-gray-500 font-bold hidden">Tidak ada data approved</p>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profileTab = document.getElementById('profile-styled-tab');
        const dashboardTab = document.getElementById('dashboard-styled-tab');
        const profileContent = document.getElementById('styled-profile');
        const dashboardContent = document.getElementById('styled-dashboard');
        const noReturnApprovalMessage = document.getElementById('no-return-approval');
        const noApprovedDataMessage = document.getElementById('no-approved-data');
        const returnApprovalCount = document.getElementById('return-approval-count');
        const approvedCount = document.getElementById('approved-count');
        const currentLine = '{{ ucfirst($line) }}'; // Replace with the actual current line value if available

        function fetchReturnApprovalData() {
            // Fetch and display return approval data
            fetch('http://127.0.0.1:8000/api/showreturncard')
                .then(response => response.json())
                .then(data => {
                    profileContent.innerHTML = '';
                    if (data.RejectedApproval.length === 0) {
                        const message = document.createElement('p');
                        message.classList.add('text-center', 'text-gray-500', 'font-bold');
                        message.textContent = 'Tidak Ada Return Approval';
                        profileContent.appendChild(message);
                        returnApprovalCount.classList.add('hidden');
                    } else {
                        noReturnApprovalMessage.classList.add('hidden');
                        let count = 0;
                        data.RejectedApproval.forEach(item => {
                            if (item.current_line === currentLine) {
                                count++;
                                const button = document.createElement('button');
                                button.classList.add('my-2', 'bg-white', 'p-2', 'shadow-md', 'py-4', 'px-4', 'text-black', 'rounded-md', 'flex', 'justify-between', 'items-center', 'w-full', 'relative');
                                button.innerHTML = `
                                    <div class="text-left">
                                        <h5 class="text-xl font-bold text-black">${item.current_line.replace(/(\D+)(\d+)/, '$1 $2')}</h5>
                                        <h5 class="text-md font-normal text-black">Week ${item.week}, ${getMonthName(item.month)} ${item.year}</h5>
                                    </div>
                                `;
                                button.onclick = function() {
                                    window.location.href = `http://127.0.0.1:8000/pjl/${item.current_line}/return?line=${item.current_line}&year=${item.year}&month=${item.month}&week=${item.week}`;
                                };
                                profileContent.appendChild(button);
                            }
                        });
                        returnApprovalCount.textContent = count;
                        returnApprovalCount.classList.remove('hidden');
                    }
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        function fetchApprovedData() {
            // Fetch and display approved data
            fetch('http://127.0.0.1:8000/api/showapprovedcard')
                .then(response => response.json())
                .then(data => {
                    dashboardContent.innerHTML = '';
                    if (data.ApprovedCard.length === 0) {
                        const message = document.createElement('p');
                        message.classList.add('text-center', 'text-gray-500', 'font-bold');
                        message.textContent = 'Tidak Ada Data Approved';
                        dashboardContent.appendChild(message);
                        approvedCount.classList.add('hidden');
                    } else {
                        noApprovedDataMessage.classList.add('hidden');
                        let count = 0;
                        data.ApprovedCard.forEach(item => {
                            if (item.current_line === currentLine) {
                                count++;
                                const button = document.createElement('button');
                                button.classList.add('my-2', 'bg-white', 'p-2', 'shadow-md', 'py-4', 'px-4', 'text-black', 'rounded-md', 'flex', 'justify-between', 'items-center', 'w-full', 'relative');
                                button.innerHTML = `
                                    <div class="text-left">
                                        <h5 class="text-xl font-bold text-black">${item.current_line.replace(/(\D+)(\d+)/, '$1 $2')}</h5>
                                        <h5 class="text-md font-normal text-black">Week ${item.week}, ${getMonthName(item.month)} ${item.year}</h5>
                                    </div>
                                `;
                                button.onclick = function() {
                                    window.location.href = `/pjl/${item.current_line}/onlyView?line=${item.current_line}&year=${item.year}&month=${item.month}&week=${item.week}`;
                                };
                                dashboardContent.appendChild(button);
                            }
                        });
                        approvedCount.textContent = count;
                        approvedCount.classList.remove('hidden');
                    }
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        profileTab.addEventListener('click', function() {
            fetchReturnApprovalData();
            profileTab.classList.add('text-purple-600', 'border-purple-600');
            dashboardTab.classList.remove('text-purple-600', 'border-purple-600');
            profileContent.classList.remove('hidden');
            dashboardContent.classList.add('hidden');
        });

        dashboardTab.addEventListener('click', function() {
            fetchApprovedData();
            dashboardTab.classList.add('text-purple-600', 'border-purple-600');
            profileTab.classList.remove('text-purple-600', 'border-purple-600');
            dashboardContent.classList.remove('hidden');
            profileContent.classList.add('hidden');
        });

        function getMonthName(monthNumber) {
            const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            return months[monthNumber - 1];
        }

        // Fetch data and activate the Return Approval tab on page load
        fetchReturnApprovalData();
        fetchApprovedData();
        profileTab.click();
    });
</script>
@endsection

</body>
</html>
