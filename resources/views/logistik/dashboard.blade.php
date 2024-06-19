<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Jost:ital,wght@0,100..900&family=Poppins:wght@400;600;700&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <title>Machine Schedule Display</title>
    @vite('resources/css/logistik/logistik.css')
</head>
<body>
<div class="container mx-auto px-4">
    <!-- Card Title -->
    <div class="bg-white opacity-75 p-6 rounded-3xl shadow-2xl my-4 mx-auto flex items-center justify-between" style="width: 100%;">
        <h3 id="title" class="text-2xl font-bold">
            <span id="line-display">Logistik</span>
        </h3>
    </div>

    <!-- Header for Data -->
    <div class="header-days bg-white opacity-75 p-6 rounded-3xl shadow-2xl my-4 mx-auto" style="width:100%;" id="headerDays">
        <div class="grid grid-cols-7 gap-4 text-center font-semibold">
            <div class="flex-1 flex-col font-bold items-center justify-center text-large">Tanggal</div>
            <div class="flex-1 flex-col font-bold items-center justify-center text-large">Jam</div>
            <div class="flex-1 flex-col font-bold items-center justify-center text-large">Line</div>
            <div class="flex-1 flex-col font-bold items-center justify-center text-large">Kode Produk</div>
            <div class="flex-1 flex-col font-bold items-center justify-center text-large">No Batch</div>
            <div class="flex-1 flex-col font-bold items-center justify-center text-large">Data Update JPM</div>
            <div class="flex-1 flex-col font-bold items-center justify-center text-large">Keterangan</div>
        </div>
    </div>

    <!-- Data Container -->
    <div id="dataContainer" class="bg-white opacity-75 p-6 rounded-3xl shadow-2xl my-4 mx-auto" style="width: 100%;">
        <!-- Dynamic rows for machines will be appended here -->
    </div>
</div>

<script>
    async function fetchAuditData() {
        const response = await fetch('http://127.0.0.1:8000/api/showaudit');
        const auditData = await response.json();

        const fetchOperationsPromises = auditData.map(async (audit) => {
            if (audit.event === 'edit') {
                const newState = audit.changes.new_state;
                const operationResponse = await fetch(`http://127.0.0.1:8000/api/showallmachineoperationpjl?id=${newState.id}`);
                const operationData = await operationResponse.json();

                if (operationData.operations.length > 0) {
                    const operation = operationData.operations[0];
                    let status = '';

                    if (operation.is_approved === 1) {
                        status = 'Approved';
                    } else if (operation.is_rejected === 1) {
                        status = 'Rejected';
                    } else if (operation.is_sent === 1) {
                        status = 'Waiting Approval';
                    }

                    // Formatting Updated Date and Time
                    const originalDate = new Date(newState.updated_at);
                    const updatedDay = originalDate.getUTCDate();
                    const updatedMonth = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"][originalDate.getUTCMonth()];
                    const updatedYear = originalDate.getUTCFullYear();
                    let updatedHours = originalDate.getUTCHours() + 7;
                    if (updatedHours >= 24) {
                        updatedHours -= 24;
                    }
                    const formattedTime = `${String(updatedHours).padStart(2, '0')}:${String(originalDate.getMinutes()).padStart(2, '0')}:${String(originalDate.getSeconds()).padStart(2, '0')}`;
                    const formattedUpdatedDate = `${updatedDay} ${updatedMonth} ${updatedYear}, ${formattedTime}`;

                    // Creating the row
                    const row = document.createElement('div');
                    row.className = 'flex justify-between text-center p-2';
                    row.innerHTML = `
                    <div class="flex-1 items-center justify-center">${newState.day}</div>
                    <div class="flex-1 items-center justify-center">${newState.time}</div>
                    <div class="flex-1 items-center justify-center">${newState.line}</div>
                    <div class="flex-1 items-center justify-center">${newState.code}</div>
                    <div class="flex-1 items-center justify-center">${newState.code}</div>
                    <div class="flex-1 items-center justify-center">${formattedUpdatedDate}</div>
                    <div class="flex-1 items-center justify-center">${newState.notes ? newState.notes : ''}</div>
                    <div class="flex-1 items-center justify-center">${status}</div>
                `;

                    const dataContainer = document.getElementById('dataContainer');
                    dataContainer.appendChild(row);
                }
            }
        });

        await Promise.all(fetchOperationsPromises);
    }

    document.addEventListener('DOMContentLoaded', fetchAuditData);

</script>
</body>
</html>
