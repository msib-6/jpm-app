<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/tailwind.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Jost:ital,wght@0,100..900&family=Poppins:wght@400;600;700&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <title>Logistik</title>
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

    <!-- Filter and Export Buttons -->
    <div class="flex justify-between my-4">
        <div class="flex space-x-4">
            <select id="lineFilter" class="p-2 rounded-lg border">
                <option value="">Filter by Line</option>
                <!-- Populate this dynamically -->
            </select>
            <select id="statusFilter" class="p-2 rounded-lg border">
                <option value="">Filter by Status</option>
                <option value="Approved">Approved</option>
                <option value="Rejected">Rejected</option>
                <option value="Waiting Approval">Waiting Approval</option>
            </select>
        </div>
        <button id="exportPDF" class="p-2 bg-blue-500 text-white rounded-lg">Export to PDF</button>
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
    <div id="dataContainer" class="bg-white opacity-75 p-6 rounded-3xl shadow-2xl my-4 mx-auto" style="width: 100%; min-height: 30em; max-height: 30em; overflow-y: auto;">
        <!-- Dynamic rows for machines will be appended here -->
    </div>
</div>

<script>
    async function fetchAuditData() {
        try {
            const auditResponse = await fetch('http://127.0.0.1:8000/api/showaudit');
            const audits = await auditResponse.json();

            const operationResponse = await fetch('http://127.0.0.1:8000/api/showallmachineoperationpjl');
            const operationData = await operationResponse.json();
            const operations = operationData.operations;

            const dataContainer = document.getElementById('dataContainer');
            dataContainer.innerHTML = ''; // Clear previous data

            const lines = new Set();

            audits.forEach(audit => {
                if (audit.event === 'edit') {
                    const newState = audit.changes.new_state;
                    const idOperationUpdate = parseInt(newState.id);

                    // Find the corresponding operation by ID
                    const operation = operations.find(op => op.id === idOperationUpdate);

                    // Determine the status based on is_approved, is_rejected, and is_sent
                    let keterangan = '';
                    if (operation) {
                        if (operation.is_approved === 1) {
                            keterangan = "Approved";
                        } else if (operation.is_rejected === 1) {
                            keterangan = "Rejected";
                        } else if (operation.is_sent === 1) {
                            keterangan = "Waiting Approval";
                        } 
                    }

                    // Formatting Date
                    const dateParts = newState.day.split('-');
                    const formattedDate = `${dateParts[0]} ${["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"][parseInt(dateParts[1]) - 1]} ${dateParts[2]}`;

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

                    // Kode Produk Extraction
                    let kodeProdukMatch = newState.code.match(/[a-zA-Z]+/g);
                    let kodeProduk = kodeProdukMatch ? kodeProdukMatch[0] : '';
                    if (kodeProduk.length !== 5) {
                        kodeProduk = kodeProduk.slice(1, 6);
                    }

                    // Formatting Line
                    const formattedLine = newState.line ? newState.line.replace(/(\D+)(\d+)/, '$1 $2') : '';
                    lines.add(formattedLine);

                    // Creating the row
                    const row = document.createElement('div');
                    row.className = 'grid grid-cols-7 gap-4 text-center p-2';
                    row.innerHTML = `
                        <div class="flex-1 items-center justify-center">${formattedDate}</div>
                        <div class="flex-1 items-center justify-center">${newState.time}</div>
                        <div class="flex-1 items-center justify-center">${formattedLine}</div>
                        <div class="flex-1 items-center justify-center">${kodeProduk}</div>
                        <div class="flex-1 items-center justify-center">${newState.code}</div>
                        <div class="flex-1 items-center justify-center">${formattedUpdatedDate}</div>
                        <div class="flex-1 items-center justify-center">${keterangan}</div>
                    `;

                    dataContainer.appendChild(row);
                }
            });

            // Populate line filter
            const lineFilter = document.getElementById('lineFilter');
            lineFilter.innerHTML = '<option value="">Filter by Line</option>'; // Reset options
            lines.forEach(line => {
                const option = document.createElement('option');
                option.value = line;
                option.textContent = line;
                lineFilter.appendChild(option);
            });

        } catch (error) {
            console.error('Error fetching audit data:', error);
        }
    }

    function filterData() {
        const lineFilter = document.getElementById('lineFilter').value;
        const statusFilter = document.getElementById('statusFilter').value;

        const rows = document.querySelectorAll('#dataContainer > div');
        rows.forEach(row => {
            const line = row.children[2].textContent.trim();
            const status = row.children[6].textContent.trim();

            if ((lineFilter && line !== lineFilter) || (statusFilter && status !== statusFilter)) {
                row.style.display = 'none';
            } else {
                row.style.display = 'grid';
            }
        });
    }

    async function exportToPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        
        const rows = document.querySelectorAll('#dataContainer > div');

        let y = 10;
        rows.forEach((row, index) => {
            const text = Array.from(row.children).map(cell => cell.textContent.trim()).join(' | ');
            doc.text(text, 10, y);
            y += 10;
            if (index % 28 === 27) {
                doc.addPage();
                y = 10;
            }
        });

        doc.save('logistik.pdf');
    }

    document.addEventListener('DOMContentLoaded', fetchAuditData);
    document.getElementById('lineFilter').addEventListener('change', filterData);
    document.getElementById('statusFilter').addEventListener('change', filterData);
    document.getElementById('exportPDF').addEventListener('click', exportToPDF);
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</body>
</html>