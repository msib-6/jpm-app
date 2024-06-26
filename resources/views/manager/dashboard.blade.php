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
    </style>
</head>
<body style="background-image: url('{{ asset('ELEMECH.png') }}'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">
@extends('manager.layout')

@section('title', 'Manager Dashboard')

@section('content')
<div class="container mx-auto px-4">
    <div class='weeks-container zoom-in my-4 mx-auto flex justify-between items-center shadow-2xl rounded-3xl p-6' style="width: 91.666667%;backdrop-filter: blur(7px); background-color: rgba(255, 255, 255, 0.5);">
        <h1 class="text-4xl font-bold text-gray-800">Manager</h1>
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

    <div id="default-styled-tab-content" class="bg-white zoom-in shadow-lg rounded-3xl my-4 mx-auto flex items-center" style="width: 91.666667%; backdrop-filter: blur(7px); background-color: rgba(255, 255, 255, 0.5);">
        <div class=" p-6 rounded-3xl my-4 mx-auto hidden w-full" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab" style="min-height: 30em;">
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
                } else {
                    data.WaitingApproval.forEach(item => {
                        const button = document.createElement('button');
                        button.classList.add('my-2', 'bg-white', 'p-2', 'shadow-md', 'py-4', 'px-4', 'text-black', 'rounded-md', 'flex', 'justify-between', 'items-center', 'w-full');
                        button.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)'; // Tambahkan box-shadow
                        button.innerHTML = `
                            <div class="text-left">
                                <h5 class="text-xl font-bold text-black">${item.current_line.replace(/(\D+)(\d+)/, '$1 $2')}</h5>
                                <h5 class="text-md font-normal text-black">Week ${item.week}, ${getMonthName(item.month)} ${item.year}</h5>
                            </div>
                        `;
                        button.onclick = function() {
                            window.location.href = `http://127.0.0.1:8000/manager/approve?line=${item.current_line}&year=${item.year}&month=${item.month}&week=${item.week}`;
                        };
                        container.appendChild(button);
                    });
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
                } else {
                    data.ApprovedCard.forEach(item => {
                        const button = document.createElement('button');
                        button.classList.add('my-2', 'bg-white', 'p-2', 'shadow-md', 'py-4', 'px-4', 'text-black', 'rounded-md', 'flex', 'justify-between', 'items-center', 'w-full');
                        button.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)'; // Tambahkan box-shadow
                        button.innerHTML = `
                            <div class="text-left">
                                <h5 class="text-xl font-bold text-black">${item.current_line.replace(/(\D+)(\d+)/, '$1 $2')}</h5>
                                <h5 class="text-md font-normal text-black">Week ${item.week}, ${getMonthName(item.month)} ${item.year}</h5>
                            </div>
                        `;
                        button.onclick = function() {
                            window.location.href = `http://127.0.0.1:8000/manager/approve?line=${item.current_line}&year=${item.year}&month=${item.month}&week=${item.week}`;
                        };
                        container.appendChild(button);
                    });
                }
            })
            .catch(error => console.error('Error fetching data:', error));
    });

    function getMonthName(monthNumber) {
        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        return months[monthNumber - 1];
    }
</script>

@endsection

</body>
</html>
