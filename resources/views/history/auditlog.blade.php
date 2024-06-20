<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Log</title>
    <link href="{{ asset('css/history.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100">

<section id="content" class="py-8 px-4">

    <div class='container mx-auto'>
        <div class='card flex justify-between opacity-75'>
            <h1 class="text-left text-4xl font-bold text-gray-800'>History</h1>
            <button class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-3 py-2.5 flex items-center float-right">
            <svg class="w-6 h-6 mr-1 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2m-8 1V4m0 12-4-4m4 4 4-4"/>
            </svg>
            Audit Trail
            </button>
        </div>
        <div class='weeks-container opacity-75'>
            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" type="button" class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                Select Line
                <svg class="w-3 h-3 ml-1 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
            </button>

            <div id="dropdown" class="hidden dropdown-menu bg-white divide-y divide-gray-100 rounded-lg shadow-md mt-2 w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">

                </ul>
            </div>
        </div>

        <div class='bg-white opacity-75 p-6 rounded-xl shadow-2xl my-4 mx-auto' id="data-container">
        <!--      Data Audit di sini      -->
        </div>
    </div>

</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script>
    async function fetchAuditData() {
        const response = await fetch('http://127.0.0.1:8000/api/showaudit');
        const data = await response.json();
        displayAuditData(data);
    }

    function displayAuditData(data) {
        const container = document.getElementById('data-container');
        container.innerHTML = ''; // Clear previous content
        data.forEach(item => {
            let content = '';
            if (item.event === 'send_revision') {
                const date = new Date(item.changes.original_state[0].updated_at);
                date.setHours(date.getHours() + 7);
                const formattedDate = `${date.getDate()} ${date.toLocaleString('default', { month: 'long' })} ${date.getFullYear()}`;
                const formattedTime = date.toTimeString().split(':');
                content = `<p>Data Week ${item.changes.original_state[0].week}, ${formattedDate} telah berhasil dikirim pada tanggal ${formattedDate}, pukul ${formattedTime[0]}:${formattedTime[1]}</p>`;
            } else {
                content = `<p>${JSON.stringify(item)}</p>`;
            }
            const div = document.createElement('div');
            div.classList.add('audit-item');
            div.className = 'bg-white p-4 shadow-md rounded-md mb-2';
            div.innerHTML = content;
            container.appendChild(div);
        });
    }

    document.addEventListener('DOMContentLoaded', fetchAuditData);
</script>

</body>
</html>
