<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Log</title>
    <link href="{{ asset('css/history.css') }}" rel="stylesheet">
    <link href="{{ asset('css/flowbite.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/tailwind.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <section id="content" class="py-8 px-4">
        <div class='container mx-auto'>
            <div class='card flex justify-between opacity-75'>
                <h1 class="text-left text-4xl font-bold text-gray-800">
                    Audit Trail
                </h1>
                <div class="flex justify-end opacity-75">
                    <button id="exportPDF"
                        class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-800 mr-2">Export
                        to PDF</button>
                    <button id="exportExcel"
                        class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-800">Export to Excel</button>
                </div>
            </div>

            <hr class="mt-5">

            @foreach ($list as $item)
                <div class="audit-item bg-white p-4 shadow-md rounded-md mb-2">
                    <p>Action:
                        @if ($item['event'] == 'send_revision')
                            <span class="text-blue-600">Send JPM Form</span>
                        @elseif ($item['event'] == 'add')
                            <span class="text-green-600">ADD</span>
                        @elseif ($item['event'] == 'delete')
                            <span class="text-red-600">DELETE</span>
                        @elseif ($item['event'] == 'edit')
                            <span class="text-yellow-600">EDIT</span>
                        @elseif ($item['event'] == 'approve')
                            <span class="text-purple-600">APPROVE</span>
                        @elseif ($item['event'] == 'return')
                            <span class="text-orange-600">RETURN</span>
                        @elseif ($item['event'] == 'login')
                            <span class="text-green-600">LOGIN</span>
                        @elseif ($item['event'] == 'logout')
                            <span class="text-red-600">LOGOUT</span>
                        @elseif ($item['event'] == 'descadd')
                            <span class="text-green-600">Add Global Desc</span>
                        @elseif ($item['event'] == 'addweekmachine')
                            <span class="text-green-600">Add Machine Weekly</span>
                        @elseif ($item['event'] == 'descdelete')
                            <span class="text-red-600">Delete Global Desc</span>
                        @else
                            <span class="text-gray-600">{{ strtoupper($item['event']) }}</span>
                        @endif
                    </p>

                    @if ($item['event'] == 'send_revision')
                        @php
                            $date = \Carbon\Carbon::parse($item['timestamp'])->setTimezone('Asia/Jakarta');
                            $formattedDate = $date->format('d F Y');
                            $formattedTime = $date->format('H:i');
                        @endphp
                        <p>Data Week <span
                                class="text-blue-600">{{ $item['changes']['original_state'][0]['week'] ?? 'N/A' }}</span>,
                            telah berhasil dikirim pada tanggal <span class="text-blue-600"> {{ $formattedDate }}
                            </span> pukul
                            <span class="text-blue-600">{{ $formattedTime }}</span> Oleh
                            <span class="text-blue-600">{{ $item['fullname'] }}</span>
                        </p>
                    @elseif ($item['event'] == 'add')
                        <p>Pada Line: <span
                                class="text-green-600">{{ $item['changes']['new_state']['line'] ?? 'N/A' }}</span>, Week
                            <span class="text-green-600">{{ $item['changes']['new_state']['week'] ?? 'N/A' }}</span>,
                            @if ($item['changes']['new_state'] == null)
                                {{ $item['changes']['new_state']['day'] ?? 'N/A' }}
                                {{ $item['changes']['new_state']['updated_at'] == null ? 'N/A' : \Carbon\Carbon::parse($item['changes']['new_state']['updated_at'])->format('F') }}
                                {{ $item['changes']['new_state']['year'] ?? 'N/A' }}
                            @else
                            @endif
                            Data tanggal <span
                                class="text-green-600">{{ $item['changes']['new_state']['day'] ?? 'N/A' }}
                                {{ $item['changes']['new_state']['month'] == null ? 'N/A' : \Carbon\Carbon::createFromFormat('m', $item['changes']['new_state']['month'])->format('F') }}
                                {{ $item['changes']['new_state']['year'] ?? 'N/A' }}</span>,
                            Kode Ruah <span
                                class="text-green-600">{{ $item['changes']['new_state']['code'] ?? 'N/A' }}</span>,
                            Status: <span
                                class="text-green-600">{{ $item['changes']['new_state']['status'] ?? 'N/A' }}</span>,
                            Catatan: <span
                                class="text-green-600">{{ $item['changes']['new_state']['notes'] ?? 'N/A' }}</span>,
                            Global Desc: <span
                                class="text-green-600">{{ $item['changes']['new_state']['description'] ?? 'N/A' }}</span>    
                            telah ditambahkan oleh <span class="text-green-500">{{ $item['fullname'] }}</span>
                        </p>
                    @elseif ($item['event'] == 'delete')
                        @php
                            // $date = \Carbon\Carbon::parse($item['changes']['original_state']['updated_at'])->setTimezone(
                            //     'Asia/Jakarta',);
                            $timestamp = $item['timestamp'] ?? null;
                            if ($timestamp) {
                                $date = \Carbon\Carbon::parse($timestamp)->setTimezone('Asia/Jakarta');
                                $formattedDate = $date->format('d F Y');
                                $formattedTime = $date->format('H:i');
                            } else {
                                $formattedDate = 'N/A';
                                $formattedTime = 'N/A';
                            }
                        @endphp
                        <p>Pada Line: <span
                                class="text-red-600">{{ $item['changes']['original_state']['line'] ?? 'N/A' }}</span>,
                            Week <span
                                class="text-red-600">{{ $item['changes']['original_state']['week'] ?? 'N/A' }}</span>,
                            Data tanggal <span
                                class="text-red-600">{{ $item['changes']['original_state']['day'] ?? 'N/A' }}
                                {{ $item['changes']['original_state']['month'] == null ? 'N/A' : \Carbon\Carbon::createFromFormat('m', $item['changes']['original_state']['month'])->format('F') }}
                                {{ $item['changes']['original_state']['year'] ?? 'N/A' }}</span>,
                            Mesin <span
                                class="text-red-600">{{ $item['changes']['original_state']['machine_name'] ?? 'N/A' }}</span>,
                            Kode Ruah <span
                                class="text-red-600">{{ $item['changes']['original_state']['code'] ?? 'N/A' }}</span>,
                            Jam <span
                                class="text-red-600">{{ $item['changes']['original_state']['time'] ?? 'N/A' }}</span>,
                            Catatan <span
                                class="text-red-600">{{ $item['changes']['original_state']['notes'] ?? 'N/A' }}</span>
                            dihapus oleh <span class="text-red-600">{{ $item['fullname'] }}</span>
                            pada <span class="text-red-600">{{ $formattedDate }}</span> pukul <span
                                class="text-red-600">{{ $formattedTime }}</span>
                        </p>
                    @elseif ($item['event'] == 'edit')
                        @php
                            $originalDate = \Carbon\Carbon::parse(
                                $item['changes']['original_state']['updated_at'],
                            )->addHours(7);
                            $formattedOriginalDate = $originalDate->format('d F Y');
                            $formattedOriginalTime = $originalDate->format('H:i');
                            $newDate = \Carbon\Carbon::parse($item['changes']['new_state']['updated_at'])->addHours(7);
                            $formattedNewDate = $newDate->format('d F Y');
                            $formattedNewTime = $newDate->format('H:i');
                        @endphp
                        <p>Pada Line: <span
                                class="text-yellow-600">{{ $item['changes']['original_state']['line'] ?? 'N/A' }}</span>,
                            Week <span
                                class="text-yellow-600">{{ $item['changes']['original_state']['week'] ?? 'N/A' }}</span>,
                            Pada <span class="text-yellow-600">{{ $item['changes']['original_state']['day'] ?? 'N/A' }}
                                {{ \Carbon\Carbon::parse($item['changes']['original_state']['updated_at'])->format('F') ?? 'N/A' }}
                                {{ $item['changes']['original_state']['year'] ?? 'N/A' }}</span>, Kode Ruah
                            <span
                                class="text-yellow-600">{{ $item['changes']['original_state']['code'] ?? 'N/A' }}</span>,
                            Status: <span
                                class="text-yellow-600">{{ $item['changes']['original_state']['status'] ?? 'N/A' }}</span>,
                            Catatan: <span
                                class="text-yellow-600">{{ $item['changes']['original_state']['notes'] ?? 'N/A' }}</span>
                            telah diubah oleh <span class="text-yellow-600">{{ $item['fullname'] ?? 'N/A' }}</span>
                            Pada Tanggal <span class="text-yellow-600">{{ $formattedOriginalDate }}</span> pukul <span
                                class="text-yellow-600">{{ $formattedOriginalTime }}</span> menjadi Kode Ruah
                            <span class="text-blue-600">{{ $item['changes']['new_state']['code'] ?? 'N/A' }}</span>,
                            Status: <span
                                class="text-blue-600">{{ $item['changes']['new_state']['status'] ?? 'N/A' }}</span>,
                            Catatan: <span
                                class="text-blue-600">{{ $item['changes']['new_state']['notes'] ?? 'N/A' }}</span> ke
                            tanggal <span class="text-blue-600">{{ $item['changes']['new_state']['day'] ?? 'N/A' }}
                                {{ \Carbon\Carbon::parse($item['changes']['new_state']['updated_at'])->format('F') ?? 'N/A' }}
                                {{ $item['changes']['new_state']['year'] ?? 'N/A' }}</span>
                        </p>
                    @elseif ($item['event'] == 'approve')
                        @php
                            // Pastikan timestamp tidak null
                            $timestamp = $item['timestamp'] ?? null;
                            if ($timestamp) {
                                $date = \Carbon\Carbon::parse($timestamp)->setTimezone('Asia/Jakarta');
                                $formattedDate = $date->format('d F Y');
                                $formattedTime = $date->format('H:i');
                            } else {
                                $formattedDate = 'N/A';
                                $formattedTime = 'N/A';
                            }

                            // Pastikan changes dan original_state tidak null
                            $week = $item['changes']['week'] ?? 'N/A';
                            $fullname = $item['fullname'] ?? 'N/A';
                        @endphp
                        <p>Pada Line: <span class="text-purple-600">{{ $item['changes']['line'] ?? 'N/A' }}</span>,
                            Bulan <span class="text-purple-600">{{ $item['changes']['month'] ?? 'N/A' }}</span>,
                            Data Week <span class="text-purple-600">{{ $week }}</span>,
                            telah berhasil di Approve pada tanggal <span class="text-purple-600"> {{ $formattedDate }}
                            </span> pukul
                            <span class="text-purple-600">{{ $formattedTime }}</span> Oleh
                            <span class="text-purple-600">{{ $item['changes']['approved_by'] ?? 'N/A' }}</span>
                        </p>
                    @elseif ($item['event'] == 'return')
                        @php
                            // Pastikan timestamp tidak null
                            $timestamp = $item['timestamp'] ?? null;
                            if ($timestamp) {
                                $date = \Carbon\Carbon::parse($timestamp)->setTimezone('Asia/Jakarta');
                                $formattedDate = $date->format('d F Y');
                                $formattedTime = $date->format('H:i');
                            } else {
                                $formattedDate = 'N/A';
                                $formattedTime = 'N/A';
                            }

                            // Pastikan changes dan original_state tidak null
                            $week = $item['changes']['week'] ?? 'N/A';
                            $fullname = $item['fullname'] ?? 'N/A';
                        @endphp
                        <p>Pada Line: <span class="text-orange-600">{{ $item['changes']['line'] ?? 'N/A' }}</span>,
                            Bulan <span class="text-orange-600">{{ $item['changes']['month'] ?? 'N/A' }}</span>,
                            Data Week <span class="text-orange-600">{{ $week }}</span>,
                            telah berhasil di Return pada tanggal <span class="text-orange-600"> {{ $formattedDate }}
                            </span>,
                            pukul <span class="text-orange-600">{{ $formattedTime }}</span>,
                            Oleh <span class="text-orange-600">{{ $item['changes']['rejected_by'] ?? 'N/A' }}</span>
                        </p>
                    @elseif ($item['event'] == 'login')
                        @php
                            $date = \Carbon\Carbon::parse($item['timestamp'])->setTimezone('Asia/Jakarta');
                            $formattedDate = $date->format('d F Y');
                            $formattedTime = $date->format('H:i');
                        @endphp
                        <p><span class="text-green-600">{{ $item['fullname'] ?? 'N/A' }}</span>
                            telah berhasil Log-in pada tanggal <span class="text-green-600"> {{ $formattedDate }}
                            </span> pukul
                            <span class="text-green-600">{{ $formattedTime }}</span>
                        </p>
                    @elseif ($item['event'] == 'logout')
                        @php
                            $date = \Carbon\Carbon::parse($item['timestamp'])->setTimezone('Asia/Jakarta');
                            $formattedDate = $date->format('d F Y');
                            $formattedTime = $date->format('H:i');
                        @endphp
                        <p><span class="text-red-600">{{ $item['fullname'] ?? 'N/A' }}</span>
                            telah berhasil Log-out pada tanggal <span class="text-red-600"> {{ $formattedDate }}
                            </span> pukul
                            <span class="text-red-600">{{ $formattedTime }}</span>
                        </p>
                    @elseif ($item['event'] == 'descadd')
                        @php
                            $date = \Carbon\Carbon::parse($item['timestamp'])->setTimezone('Asia/Jakarta');
                            $formattedDate = $date->format('F');
                            $formattedTime = $date->format('H:i');
                            $week = $item['changes']['new_state']['week'] ?? 'N/A';
                        @endphp
                        <p>Pada Line: <span class="text-green-600">{{ $item['changes']['new_state']['line'] ?? 'N/A' }}</span>,
                            Bulan <span class="text-green-600">{{ $formattedDate }}</span>,
                            Week <span class="text-green-600">{{ $week }}</span>,
                            telah menambahkan deskripsi <span class="text-green-600"> {{ $item['changes']['new_state']['description'] }}
                            </span>,
                            pukul <span class="text-green-600">{{ $formattedTime }}</span>,
                            Oleh <span class="text-green-600">{{ $item['fullname'] ?? 'N/A' }}</span>
                        </p>
                    @elseif ($item['event'] == 'descdelete')
                        @php
                            $date = \Carbon\Carbon::parse($item['timestamp'])->setTimezone('Asia/Jakarta');
                            $formattedDate = $date->format('F');
                            $formattedTime = $date->format('H:i');
                            $week = $item['changes']['original_state']['week'] ?? 'N/A';
                        @endphp
                        <p>Pada Line: <span class="text-red-600">{{ $item['changes']['original_state']['line'] ?? 'N/A' }}</span>,
                            Bulan <span class="text-red-600">{{ $formattedDate }}</span>,
                            Week <span class="text-red-600">{{ $week }}</span>,
                            telah menghapus deskripsi <span class="text-red-600"> {{ $item['changes']['original_state']['description'] }}
                            </span>,
                            pukul <span class="text-red-600">{{ $formattedTime }}</span>,
                            Oleh <span class="text-red-600">{{ $item['fullname'] ?? 'N/A' }}</span>
                        </p>
                    @elseif ($item['event'] == 'addweekmachine')
                        @php
                            $date = \Carbon\Carbon::parse($item['timestamp'])->setTimezone('Asia/Jakarta');
                            $formattedDate = $date->format('F');
                            $formattedTime = $date->format('H:i');
                            $week = $item['changes']['new_state']['week'] ?? 'N/A';
                        @endphp
                        <p>Pada Line: <span class="text-green-600">{{ $item['changes']['new_state']['line'] ?? 'N/A' }}</span>,
                            Bulan <span class="text-green-600">{{ $formattedDate }}</span>,
                            Week <span class="text-green-600">{{ $week }}</span>,
                            telah menambahkan mesin <span class="text-green-600"> {{ $item['changes']['new_state']['machineName'] }}
                            </span>,
                            pukul <span class="text-green-600">{{ $formattedTime }}</span>,
                            Oleh <span class="text-green-600">{{ $item['fullname'] ?? 'N/A' }}</span>
                        </p>
                    @else
                        <p>{{ json_encode($item) }}</p>
                    @endif
                </div>
            @endforeach

            <hr>

            <div class='bg-white opacity-75 p-6 rounded-xl shadow-2xl my-4 mx-auto' id="data-container">
                <div class="flex justify-center">
                    {{ $data->links('pagination::tailwind') }}
                </div>
            </div>
            {{-- {{ $data->links() }} --}}
        </div>
    </section>

    <script src="{{ asset('js/jspdf.umd.min.js') }}"></script>
    <script src="{{ asset('js/jspdf.plugin.autotable.js') }}"></script>
    <script src="{{ asset('js/xlsx.full.min.js') }}"></script>
    <script>
        document.getElementById('exportPDF').addEventListener('click', () => {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();
            const elements = document.querySelectorAll('.audit-item');
            let data = [];

            const cleanText = (text) => {
                return text.replace(/\s+/g, ' ').trim();
            };

            elements.forEach((element, index) => {
                const action = cleanText(element.querySelector('p:first-of-type span').textContent);
                const descriptionElement = element.querySelector('p:nth-of-type(2)');
                const description = descriptionElement ? cleanText(descriptionElement.textContent) : 'N/A';
                data.push([index + 1, action, description]);
            });

            doc.autoTable({
                head: [
                    ['#', 'Action', 'Description']
                ],
                body: data,
                styles: {
                    fontSize: 10,
                    cellPadding: 3
                },
                columnStyles: {
                    0: {
                        cellWidth: 10
                    },
                    1: {
                        cellWidth: 40
                    },
                    2: {
                        cellWidth: 140
                    }
                },
                headStyles: {
                    fillColor: [146, 97, 232],
                    textColor: [255, 255, 255]
                },
                theme: 'striped'
            });

            doc.save('audits_log.pdf');
        });

        document.getElementById('exportExcel').addEventListener('click', () => {
            const elements = document.querySelectorAll('.audit-item');
            let data = [
                ['#', 'Action', 'Description']
            ];

            const cleanText = (text) => {
                return text.replace(/\s+/g, ' ').trim();
            };

            elements.forEach((element, index) => {
                const action = cleanText(element.querySelector('p:first-of-type span').textContent);
                const descriptionElement = element.querySelector('p:nth-of-type(2)');
                const description = descriptionElement ? cleanText(descriptionElement.textContent) : 'N/A';
                data.push([index + 1, action, description]);
            });

            // Create a new workbook and add the data to the first sheet
            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.aoa_to_sheet(data);
            XLSX.utils.book_append_sheet(wb, ws, 'Audit Log');

            // Adjust column widths
            const colWidths = data[0].map((col, i) => {
                const colLength = data.map(row => row[i].toString().length);
                return {
                    wch: Math.max(...colLength)
                };
            });

            ws['!cols'] = colWidths;

            // Export the workbook to an Excel file
            XLSX.writeFile(wb, 'audits_log.xlsx');
        });
    </script>
</body>

</html>
