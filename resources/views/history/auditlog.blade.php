<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Log</title>
    <link href="{{ asset('css/history.css') }}" rel="stylesheet">
    <link href="{{ asset('css/flowbite.min.css') }}" rel="stylesheet" />
</head>

<body class="bg-gray-100">

    <section id="content" class="py-8 px-4">
        <div class='container mx-auto'>
            <div class='card flex justify-between opacity-75'>
                <h1 class="text-left text-4xl font-bold text-gray-800">
                    Audit Trail
                </h1>
                <button id="exportPDF" class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-800">Export
                    to PDF</button>
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
                                class="text-blue-600">{{ $item['changes']['original_state'][0]['week'] }}</span>,
                            telah berhasil dikirim pada tanggal <span class="text-blue-600"> {{ $formattedDate }} </span> pukul
                            <span class="text-blue-600">{{ $formattedTime }}</span> Oleh
                            <span class="text-blue-600">{{ $item['fullname'] }}</span>
                        </p>
                    @elseif ($item['event'] == 'add')
                        <p>Pada LINE: <span
                                class="text-green-600">{{ $item['changes']['new_state']['line'] ?? 'N/A' }}</span>, Week
                            <span class="text-green-600">{{ $item['changes']['new_state']['week'] ?? 'N/A' }}</span>,
                            @if ($item['changes']['new_state'] == null)
                                {{ $item['changes']['new_state']['day'] ?? 'N/A' }}
                                {{ $item['changes']['new_state']['updated_at'] == null ? 'N/A' : \Carbon\Carbon::parse($item['changes']['new_state']['updated_at'])->format('F') }}
                                {{ $item['changes']['new_state']['year'] ?? 'N/A' }}
                            @else
                            @endif
                            Kode Ruah <span
                                class="text-green-600">{{ $item['changes']['new_state']['code'] ?? 'N/A' }}</span>,
                            Status: <span
                                class="text-green-600">{{ $item['changes']['new_state']['status'] ?? 'N/A' }}</span>,
                            Catatan: <span
                                class="text-green-600">{{ $item['changes']['new_state']['notes'] ?? 'N/A' }}</span>
                            telah ditambahkan oleh <span class="text-green-500">{{ $item['fullname'] }}</span>
                        </p>
                    @elseif ($item['event'] == 'delete')
                        @php
                            $date = \Carbon\Carbon::parse($item['changes']['original_state']['updated_at'])->addHours(
                                7,
                            );
                            $formattedDate = $date->format('d F Y');
                            $formattedTime = $date->format('H:i');
                        @endphp
                        <p>Pada LINE: <span
                                class="text-red-600">{{ $item['changes']['original_state']['line'] ?? 'N/A' }}</span>,
                            Week <span
                                class="text-red-600">{{ $item['changes']['original_state']['week'] ?? 'N/A' }}</span>,
                            {{ $item['changes']['original_state']['day'] ?? 'N/A' }}
                            {{ $item['changes']['original_state']['updated_at'] == null ? 'NA' : \Carbon\Carbon::parse($item['changes']['original_state']['updated_at'])->format('F') }}
                            {{ $item['changes']['original_state']['year'] ?? 'N/A' }}, Kode Ruah <span
                                class="text-red-600">{{ $item['changes']['original_state']['code'] ?? 'N/A' }}</span>,
                            Jam <span
                                class="text-red-600">{{ $item['changes']['original_state']['time'] ?? 'N/A' }}</span>,
                            description <span
                                class="text-red-600">{{ $item['changes']['original_state']['description'] ?? 'N/A' }}</span>
                            dihapus oleh <span
                                class="text-red-600">{{ $item['changes']['original_state']['changedBy'] ?? 'N/A' }}</span>
                            pada {{ $formattedDate }} pukul {{ $formattedTime }}</p>
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
                        <p>Pada LINE: <span
                                class="text-yellow-600">{{ $item['changes']['original_state']['line'] ?? 'N/A' }}</span>,
                            Week <span
                                class="text-yellow-600">{{ $item['changes']['original_state']['week'] ?? 'N/A' }}</span>,
                            {{ $item['changes']['original_state']['day'] ?? 'N/A' }}
                            {{ \Carbon\Carbon::parse($item['changes']['original_state']['updated_at'])->format('F') ?? 'N/A' }}
                            {{ $item['changes']['original_state']['year'] ?? 'N/A' }}, Kode Ruah <span
                                class="text-yellow-600">{{ $item['changes']['original_state']['code'] ?? 'N/A' }}</span>,
                            Status: <span
                                class="text-yellow-600">{{ $item['changes']['original_state']['status'] ?? 'N/A' }}</span>,
                            Catatan: <span
                                class="text-yellow-600">{{ $item['changes']['original_state']['notes'] ?? 'N/A' }}</span>
                            telah diubah oleh <span
                                class="text-yellow-600">{{ $item['changes']['new_state']['users_id'] ?? 'N/A' }}</span>
                            pada {{ $formattedOriginalDate }} pukul {{ $formattedOriginalTime }} menjadi Kode Ruah
                            <span class="text-yellow-600">{{ $item['changes']['new_state']['code'] ?? 'N/A' }}</span>,
                            Status: <span
                                class="text-yellow-600">{{ $item['changes']['new_state']['status'] ?? 'N/A' }}</span>,
                            Catatan: <span
                                class="text-yellow-600">{{ $item['changes']['new_state']['notes'] ?? 'N/A' }}</span> ke
                            tanggal <span
                                class="text-yellow-600">{{ $item['changes']['new_state']['day'] ?? 'N/A' }}</span>
                            {{ \Carbon\Carbon::parse($item['changes']['new_state']['updated_at'])->format('F') ?? 'N/A' }}
                            {{ $item['changes']['new_state']['year'] ?? 'N/A' }}
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
                            $week = $item['changes']['original_state'][0]['week'] ?? 'N/A';
                            $fullname = $item['fullname'] ?? 'N/A';
                        @endphp
                        <p>Data Week <span class="text-purple-600">{{ $week }}</span>,
                            telah berhasil approve pada tanggal <span class="text-purple-600"> {{ $formattedDate }} </span> pukul
                            <span class="text-purple-600">{{ $formattedTime }}</span> Oleh
                            <span class="text-purple-600">{{ $fullname }}</span>
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
                            $week = $item['changes']['original_state'][0]['week'] ?? 'N/A';
                            $fullname = $item['fullname'] ?? 'N/A';
                        @endphp
                        <p>Data Week <span class="text-orange-600">{{ $week }}</span>,
                            telah berhasil di return pada tanggal <span class="text-orange-600"> {{ $formattedDate }} </span> pukul
                            <span class="text-orange-600">{{ $formattedTime }}</span> Oleh
                            <span class="text-orange-600">{{ $fullname }}</span>
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
    <script>
        document.getElementById('exportPDF').addEventListener('click', function() {
            console.log("Button clicked");
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            doc.text('Audit Log', 10, 10);

            const items = document.querySelectorAll('.audit-item');
            const data = [];

            items.forEach((item, index) => {
                const action = item.querySelector('p span.text-green-500').innerText;
                const text = item.innerText.replace(/\n/g, ' ').trim();
                console.log(`Item ${index + 1}: Action - ${action}, Text - ${text}`);
                data.push([index + 1, action, text]);
            });

            doc.autoTable({
                head: [
                    ['No', 'Action', 'Details']
                ],
                body: data
            });

            doc.save('audit_log.pdf');
        });
    </script>
</body>

</html>
