<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/tailwind.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Jost:ital,wght@0,100..900&family=Poppins:wght@400;600;700&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">
    <title>Logistik</title>
    @vite('resources/css/logistik/logistik.css')
</head>

<body
    style="background-image: url('{{ asset('ELEMECH.png') }}'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">
    @extends('logistik.layout')

    @section('title', 'Dashboard')

    @section('content')
        <div class="container mx-auto px-4">
            <!-- Card Title -->
            <div class="bg-white opacity-75 p-6 rounded-3xl shadow-2xl my-4 mx-auto flex items-center justify-between"
                style="width: 100%;">
                <h3 id="title" class="text-3xl font-bold relative z-10">
                    <span id="line-display">Histori Perubahan</span>
                </h3>
                <div class="flex justify-end">
                    <button id="exportPDF"
                        class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 mr-2">Export
                        to PDF</button>
                    <button id="exportExcel" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Export
                        to Excel</button>
                </div>
            </div>

            <!-- Header for Data -->
            <div class="header-days bg-white opacity-75 p-6 rounded-3xl shadow-2xl my-4 mx-auto" style="width:100%;"
                id="headerDays">
                <div class="grid grid-cols-8 gap-4 text-center font-semibold">
                    <div class="flex-1 flex-col font-bold items-center justify-center text-lg mt-2">Tanggal</div>
                    <div class="flex-1 flex-col font-bold items-center justify-center text-lg mt-2">Jam</div>
                    <div class="flex-1 flex-col font-bold items-center justify-center text-lg mt-2">Week</div>
                    <div class="flex-1 flex-col font-bold items-center justify-center text-lg">
                        <select id="lineFilter" class="flex-1 flex-col font-bold rounded-lg border mb-2">
                            <option value="all">All Lines</option>
                            <!-- Populate this dynamically -->
                        </select>
                    </div>
                    <div class="flex-1 flex-col font-bold items-center justify-center text-lg mt-2">Kode Produk</div>
                    <div class="flex-1 flex-col font-bold items-center justify-center text-lg mt-2">No Batch</div>
                    <div class="flex-1 flex-col font-bold items-center justify-center text-lg mt-2">Data Update JPM</div>
                    <div class="flex-1 flex-col font-bold items-center justify-center text-lg">
                        <select id="statusFilter" class="flex-1 flex-col font-bold rounded-lg border">
                            <option value="all">All Status</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
                            <option value="Waiting Approval">Waiting</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Data Container -->
            <div id="dataContainer" class="bg-white opacity-75 p-6 rounded-3xl shadow-2xl my-4 mx-auto"
                style="width: 100%; min-height: 30em; max-height: 30em; overflow-y: auto;">
                <!-- Dynamic rows for machines will be appended here -->
            </div>
        </div>
    @endsection

    @section('scripts')

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

                            const operation = operations.find(op => op.id === idOperationUpdate);

                            let keterangan = '';
                            if (operation) {
                                if (operation.is_approved === true) {
                                    keterangan = "Approved";
                                } else if (operation.is_rejected === true) {
                                    keterangan = "Rejected";
                                } else if (operation.is_sent === true) {
                                    keterangan = "Waiting Approval";
                                }
                            }

                            let day = newState.day;
                            let year = newState.year;
                            let monthIndex = newState.month - 1;

                            // Adjust month if day <= 5 and day >= 1 and week == 5
                            if (day >= 1 && day <= 5 && newState.week == 5) {
                                monthIndex += 1;
                                if (monthIndex > 11) {
                                    monthIndex = 0; // January
                                    year += 1;
                                }
                            }
                            const month = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli",
                                "Agustus", "September", "Oktober", "November", "Desember"
                            ][parseInt(monthIndex)];

                            const formattedDate = `${day} ${month} ${year}`;

                            const originalDate = new Date(newState.updated_at);
                            const updatedDay = originalDate.getUTCDate();
                            const updatedMonth = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli",
                                "Agustus", "September", "Oktober", "November", "Desember"
                            ][originalDate.getUTCMonth()];
                            const updatedYear = originalDate.getUTCFullYear();
                            let updatedHours = originalDate.getUTCHours() + 7;
                            if (updatedHours >= 24) {
                                updatedHours -= 24;
                            }
                            const formattedTime =
                                `${String(updatedHours).padStart(2, '0')}:${String(originalDate.getMinutes()).padStart(2, '0')}:${String(originalDate.getSeconds()).padStart(2, '0')}`;
                            const formattedUpdatedDate =
                                `${updatedDay} ${updatedMonth} ${updatedYear}, ${formattedTime}`;

                            let kodeProdukMatch = newState.code.match(/[a-zA-Z]+/g);
                            let kodeProduk = kodeProdukMatch ? kodeProdukMatch[0] : '';
                            if (kodeProduk.length !== 5) {
                                kodeProduk = kodeProduk.slice(1, 6);
                            }

                            const formattedLine = newState.line ? newState.line.replace(/(\D+)(\d+)/, '$1 $2') : '';
                            lines.add(formattedLine);

                            const row = document.createElement('div');
                            row.className = 'grid grid-cols-8 gap-4 text-center p-2 text-sm';
                            row.innerHTML = `
                    <div class="col-span-1">${formattedDate}</div>
                    <div class="col-span-1">${newState.time}</div>
                    <div class="col-span-1">Week ${newState.week}</div>
                    <div class="col-span-1">${formattedLine}</div>
                    <div class="col-span-1">${kodeProduk}</div>
                    <div class="col-span-1">${newState.code}</div>
                    <div class="col-span-1">${formattedUpdatedDate}</div>
                    <div class="col-span-1">${keterangan}</div>
                `;

                            dataContainer.appendChild(row);
                        }
                    });

                    const lineFilter = document.getElementById('lineFilter');
                    lineFilter.innerHTML = '<option value="all">All Lines</option>';
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
                    const line = row.children[3].textContent.trim();
                    const status = row.children[7].textContent.trim();

                    if ((lineFilter !== 'all' && line !== lineFilter) || (statusFilter !== 'all' && status !==
                            statusFilter)) {
                        row.style.display = 'none';
                    } else {
                        row.style.display = 'grid';
                    }
                });
            }

            function exportToPDF() {
                const {
                    jsPDF
                } = window.jspdf;
                const doc = new jsPDF('landscape');

                doc.text('Histori Logistik', 14, 16);

                const lineFilter = document.getElementById('lineFilter').value;
                const statusFilter = document.getElementById('statusFilter').value;

                const rows = Array.from(document.querySelectorAll('#dataContainer > div')).filter(row => {
                    const line = row.children[3].textContent.trim();
                    const status = row.children[7].textContent.trim();
                    return (lineFilter === 'all' || line === lineFilter) && (statusFilter === 'all' || status ===
                        statusFilter);
                }).map(row => {
                    return Array.from(row.children).map(cell => cell.textContent.trim());
                });

                const headers = [
                    ['Tanggal', 'Jam', 'Week', 'Line', 'Kode Produk', 'No Batch', 'Data Update JPM', 'Status']
                ];

                doc.autoTable({
                    head: headers,
                    body: rows,
                    startY: 20,
                    headStyles: {
                        fillColor: [146, 97, 232]
                    },
                    theme: 'striped',
                });

                doc.save('HistoriLog.pdf');
            }

            function exportToExcel() {
                const workbook = XLSX.utils.book_new();
                const lineFilter = document.getElementById('lineFilter').value;
                const statusFilter = document.getElementById('statusFilter').value;

                const rows = Array.from(document.querySelectorAll('#dataContainer > div')).filter(row => {
                    const line = row.children[3].textContent.trim();
                    const status = row.children[7].textContent.trim();
                    return (lineFilter === 'all' || line === lineFilter) && (statusFilter === 'all' || status ===
                        statusFilter);
                }).map(row => {
                    return Array.from(row.children).map(cell => cell.textContent.trim());
                });

                const headers = [
                    ['Tanggal', 'Jam', 'Week', 'Line', 'Kode Produk', 'No Batch', 'Data Update JPM', 'Status']
                ];

                const worksheet = XLSX.utils.aoa_to_sheet([...headers, ...rows]);
                XLSX.utils.book_append_sheet(workbook, worksheet, 'HistoriLogistik');
                XLSX.writeFile(workbook, 'HistoriLog.xlsx');
            }

            document.addEventListener('DOMContentLoaded', function() {
                fetchAuditData();

                document.getElementById('lineFilter').addEventListener('change', filterData);
                document.getElementById('statusFilter').addEventListener('change', filterData);
                document.getElementById('exportPDF').addEventListener('click', exportToPDF);
                document.getElementById('exportExcel').addEventListener('click', exportToExcel);
            });
        </script>

        <script src="{{ asset('js/jspdf.umd.min.js') }}"></script>
        <script src="{{ asset('js/jspdf.plugin.autotable.js') }}"></script>
        <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
    @endsection
</body>

</html>
