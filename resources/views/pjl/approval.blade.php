<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
    @vite('public/css/history.css')
</head>
<body style="background-image: url('{{ asset('ELEMECH.png') }}'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">
@extends('pjl.layout')

@section('title', 'Approval PJL')

@section('content')

<div class='container mx-auto px-4'>
    <div class='weeks-container my-4 mx-auto flex justify-between items-center shadow-2xl rounded-3xl p-6 opacity-75' style="width: 91.666667%;">
        <h1 class="text-4xl font-bold text-gray-800">Status</h1>
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center mt-4" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" role="tablist">
                <li class="me-2 mx-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Return Approval</button>
                </li>
                <li class="me-2 mx-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Approved</button>
                </li>
            </ul>
        </div>
    </div>

    <div id="default-styled-tab-content" class="bg-white shadow-lg rounded-3xl my-4 mx-auto flex items-center opacity-75" style="width: 91.666667%;">
        <div class="bg-white p-6 rounded-3xl my-4 mx-auto hidden w-full" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab" style="min-height: 30em;">
            <!-- Data Need Approve Disini -->
            <p id="no-return-approval" class="text-center text-gray-500 font-bold hidden">Tidak ada return approval</p>
        </div>

        <div class="bg-white p-6 rounded-3xl my-4 mx-auto summary-container hidden w-full" id="styled-dashboard" role="tabpanel" aria-labelledby="dashboard-tab" style="min-height: 30em;">
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
        const currentLine = 'Line1'; // Replace with the actual current line value if available

        profileTab.addEventListener('click', function() {
            // Fetch and display return approval data
            fetch('http://127.0.0.1:8000/api/showreturncard')
                .then(response => response.json())
                .then(data => {
                    profileContent.innerHTML = '';
                    if (data.ReturnApproval.length === 0) {
                        const message = document.createElement('p');
                        message.classList.add('text-center', 'text-gray-500', 'font-bold');
                        message.textContent = 'Tidak Ada Return Approval';
                        container.appendChild(message);
                    } else {
                        noReturnApprovalMessage.classList.add('hidden');
                        data.ReturnApproval.forEach(item => {
                            if (item.current_line === currentLine) {
                                const button = document.createElement('button');
                                button.classList.add('my-2', 'bg-white', 'p-2', 'shadow-md', 'py-4', 'px-4', 'text-black', 'rounded-md', 'flex', 'justify-between', 'items-center', 'w-full');
                                button.innerHTML = `
                                    <div class="text-left">
                                        <h5 class="text-xl font-bold text-black">${item.current_line.replace(/(\D+)(\d+)/, '$1 $2')}</h5>
                                        <h5 class="text-md font-normal text-black">Week ${item.week}, ${getMonthName(item.month)} ${item.year}</h5>
                                    </div>
                                `;
                                button.onclick = function() {
                                    window.location.href = `http://127.0.0.1:8000/pjl/return?line=${item.current_line}&year=${item.year}&month=${item.month}&week=${item.week}`;
                                };
                                profileContent.appendChild(button);
                            }
                        });
                    }
                })
                .catch(error => console.error('Error fetching data:', error));
        });

        dashboardTab.addEventListener('click', function() {
            // Fetch and display approved data
            fetch('http://127.0.0.1:8000/api/showapprovedcard')
                .then(response => response.json())
                .then(data => {
                    dashboardContent.innerHTML = '';
                    if (data.ApprovedCard.length === 0) {
                        const message = document.createElement('p');
                        message.classList.add('text-center', 'text-gray-500', 'font-bold');
                        message.textContent = 'Tidak Ada Data Approved';
                        container.appendChild(message);
                    } else {
                        noApprovedDataMessage.classList.add('hidden');
                        data.ApprovedCard.forEach(item => {
                            if (item.current_line === currentLine) {
                                const button = document.createElement('button');
                                button.classList.add('my-2', 'bg-white', 'p-2', 'shadow-md', 'py-4', 'px-4', 'text-black', 'rounded-md', 'flex', 'justify-between', 'items-center', 'w-full');
                                button.innerHTML = `
                                    <div class="text-left">
                                        <h5 class="text-xl font-bold text-black">${item.current_line.replace(/(\D+)(\d+)/, '$1 $2')}</h5>
                                        <h5 class="text-md font-normal text-black">Week ${item.week}, ${getMonthName(item.month)} ${item.year}</h5>
                                    </div>
                                `;
                                button.onclick = function() {
                                    window.location.href = `http://127.0.0.1:8000/pjl/approved?line=${item.current_line}&year=${item.year}&month=${item.month}&week=${item.week}`;
                                };
                                dashboardContent.appendChild(button);
                            }
                        });
                    }
                })
                .catch(error => console.error('Error fetching data:', error));
        });

        function getMonthName(monthNumber) {
            const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            return months[monthNumber - 1];
        }
    });
</script>
@endsection

</body>
</html>
