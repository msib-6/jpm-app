<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/tailwind.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Jost:ital,wght@0,100..900&family=Poppins:wght@400;600;700&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">
    <title>Raw Data Logistik</title>
    @vite('resources/css/logistik/logistik.css')
</head>

<body>
    <div class="container mx-auto px-4">
        <!-- Card Title -->
        <div class="bg-white opacity-75 p-6 rounded-3xl shadow-2xl my-4 mx-auto flex items-center justify-between"
            style="width: 100%;">
            <h3 id="title" class="text-3xl font-bold relative z-10">
                <span id="line-display" class="justify-start">Raw Data</span>
            </h3>
            <div class="flex justify-end">
                <button id="exportPDF" class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 mr-2">Export to PDF</button>
                <button id="exportCSV" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 mr-2">Export to CSV</button>
                <button id="exportExcel" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Export to Excel</button>
            </div>
        </div>

        <!-- Header for Data -->
        <div class="header-days bg-white opacity-75 p-6 rounded-3xl shadow-2xl my-4 mx-auto" style="width:100%;"
            id="headerDays">
            <div class="grid grid-cols-11 gap-4 text-center font-semibold">
                <div class="flex-1 flex-col font-bold items-center justify-center text-large">Mesin</div>
                <div class="flex-1 flex-col font-bold items-center justify-center text-large">Kategori</div>
                <div class="flex-1 flex-col font-bold items-center justify-center text-large">Tahun</div>
                <div class="flex-1 flex-col font-bold items-center justify-center text-large">Bulan</div>
                <div class="flex-1 flex-col font-bold items-center justify-center text-large">Week</div>
                <div class="flex-1 flex-col font-bold items-center justify-center text-large">Tanggal</div>
                <div class="flex-1 flex-col font-bold items-center justify-center text-large">Kode Produk</div>
                <div class="flex-1 flex-col font-bold items-center justify-center text-large">Jam</div>
                <div class="flex-1 flex-col font-bold items-center justify-center text-large">Status</div>
                <div class="flex-1 flex-col font-bold items-center justify-center text-large">Notes</div>
                <div class="flex-1 flex-col font-bold items-center justify-center text-large">
                    <select id="lineFilter" class="font-bold rounded-lg border">
                        <option value="all">All Lines</option>
                        <!-- Populate this dynamically -->
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

    <script>
        async function fetchMachineOperations() {
            try {
                const response = await fetch('http://127.0.0.1:8000/api/showallmachineoperationpjl');
                const data = await response.json();
                const operations = data.operations;

                const dataContainer = document.getElementById('dataContainer');
                dataContainer.innerHTML = ''; // Clear previous data

                const lines = new Set();
                operations.forEach(operation => {
                    // lines.add(operation.current_line);
                    const row = document.createElement('div');
                    row.className = 'grid grid-cols-11 gap-4 text-center p-2 data-row';

                    const day = operation.day;
                    const month = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli",
                        "Agustus", "September", "Oktober", "November", "Desember"
                    ][operation.month - 1];
                    const year = operation.year;
                    const formattedDate = `${day}`;

                    const formattedLine = operation.current_line ? operation.current_line.replace(/(\D+)(\d+)/,
                        '$1 $2') : '';
                    lines.add(formattedLine);

                    const values = [
                        operation.machine_name, operation.category, operation.year, month, operation.week,
                        formattedDate, operation.code, operation.time, operation.status,
                        operation.notes, formattedLine
                    ];

                    values.forEach(value => {
                        const valueDiv = document.createElement('div');
                        valueDiv.className = 'flex-1 flex-col items-center justify-center text-sm';
                        valueDiv.textContent = value;
                        row.appendChild(valueDiv);
                    });

                    dataContainer.appendChild(row);
                });

                const lineFilter = document.getElementById('lineFilter');
                lines.forEach(line => {
                    const option = document.createElement('option');
                    option.value = line;
                    option.textContent = line;
                    lineFilter.appendChild(option);
                });

            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        function filterData() {
            const lineFilter = document.getElementById('lineFilter').value;
            const rows = document.querySelectorAll('.data-row');
            rows.forEach(row => {
                const line = row.children[10].textContent.trim();
                if (lineFilter !== 'all' && line !== lineFilter) {
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

            doc.text('Raw Data Logistik', 14, 16);

            const lineFilter = document.getElementById('lineFilter').value;

            const rows = Array.from(document.querySelectorAll('.data-row')).filter(row => {
                const line = row.children[10].textContent.trim();
                return (lineFilter === 'all' || line === lineFilter);
            }).map(row => {
                return Array.from(row.children).map(cell => cell.textContent.trim());
            });

            const headers = [
                ['Mesin', 'Kategori', 'Tahun', 'Bulan', 'Week', 'Tanggal', 'Kode Produk', 'Jam', 'Status', 'Notes',
                    'Line'
                ]
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

            doc.save('RawDataLog.pdf');
        }

        function exportToCSV() {
            const lineFilter = document.getElementById('lineFilter').value;

            const rows = Array.from(document.querySelectorAll('.data-row')).filter(row => {
                const line = row.children[10].textContent.trim();
                return (lineFilter === 'all' || line === lineFilter);
            }).map(row => {
                return Array.from(row.children).map(cell => cell.textContent.trim());
            });

            const headers = ['Mesin', 'Kategori', 'Tahun', 'Bulan', 'Week', 'Tanggal', 'Kode Produk', 'Jam', 'Status',
                'Notes', 'Line'
            ];

            let csvContent = 'data:text/csv;charset=utf-8,' + headers.join(',') + '\n';

            rows.forEach(row => {
                const rowContent = row.join(',');
                csvContent += rowContent + '\n';
            });

            const encodedUri = encodeURI(csvContent);
            const link = document.createElement('a');
            link.setAttribute('href', encodedUri);
            link.setAttribute('download', 'RawDataLog.csv');
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        function exportToExcel() {
            const lineFilter = document.getElementById('lineFilter').value;

            const rows = Array.from(document.querySelectorAll('.data-row')).filter(row => {
                const line = row.children[10].textContent.trim();
                return (lineFilter === 'all' || line === lineFilter);
            }).map(row => {
                return Array.from(row.children).map(cell => cell.textContent.trim());
            });

            const headers = ['Mesin', 'Kategori', 'Tahun', 'Bulan', 'Week', 'Tanggal', 'Kode Produk', 'Jam', 'Status',
                'Notes', 'Line'
            ];

            const worksheet = XLSX.utils.aoa_to_sheet([headers, ...rows]);
            const workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Raw Data Logistik');

            XLSX.writeFile(workbook, 'RawDataLog.xlsx');
        }

        document.addEventListener('DOMContentLoaded', function() {
            fetchMachineOperations();
            document.getElementById('lineFilter').addEventListener('change', filterData);
            document.getElementById('exportPDF').addEventListener('click', exportToPDF);
            document.getElementById('exportCSV').addEventListener('click', exportToCSV);
            document.getElementById('exportExcel').addEventListener('click', exportToExcel);
        });
    </script>

    <script src="{{ asset('js/jspdf.umd.min.js') }}"></script>
    <script src="{{ asset('js/jspdf.plugin.autotable.js') }}"></script>
    <script src="{{ asset('js/xlsx.full.min.js') }}"></script>
</body>

</html>
