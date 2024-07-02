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
            </div>

            <hr class="mt-5">
            {{-- <p>AuditTrail Log</p> --}}
            {{-- @foreach ($list as $item)
                <div class="bg-white p-4 shadow-md rounded-md mb-2">
                    <p>Action: <span class="text-green-500">{{ $item['event'] }} </span>
                        @if ($item['event'] == 'send_revision')
                            <span class="text-green-500">Week {{ $item['mesin']['week'] ?? 'NA' }}</span>
                        @endif
                    </p>
                    @switch($item['event'])
                        @case('send_revision')
                            <p>Data Week <span class="text-green-500">{{ $item['mesin']['week'] ?? 'NA' }}</span> telah berhasil
                                dikirim pada tanggal
                                {{ $item['timestamp'] }}</p>
                        @break

                        @case('add')
                            <p>Pada LINE: <span class="text-green-500">{{ $item['line'] }}</span>, Week <span
                                    class="text-green-500">{{ $item['mesin']['week'] }}</span>,
                                {{ $item['timestamp'] }}, Kode Ruah <span
                                    class="text-green-500">{{ $item['mesin']['ruah'] }}</span>, Status:
                                <span class="text-green-500">{{ $item['mesin']['status'] }}</span>, Catatan: <span
                                    class="text-green-500">{{ $item['mesin']['noted'] }}</span> telah ditambahkan oleh <span
                                    class="text-green-500">{{ $item['fullname'] }}</span>
                            </p>
                        @break

                        @case('return')
                            <p>{{ $item['return'] }}</p>
                        @break

                        @case('delete')
                        @break

                        @default
                            <p>NOT FOUND AUDIT TRAIL</p>
                    @endswitch
                </div>
            @endforeach --}}

            @foreach ($list as $item)
                <div class="audit-item bg-white p-4 shadow-md rounded-md mb-2">
                    <p>Action: <span class="text-green-500">
                            @if ($item['event'] == 'send_revision')
                                Send JPM Week {{ $item['changes']['original_state'][0]['week'] }}
                            @elseif ($item['event'] == 'add')
                                ADD
                            @elseif ($item['event'] == 'delete')
                                DELETE
                            @elseif ($item['event'] == 'edit')
                                EDIT
                            @else
                                {{ strtoupper($item['event']) }}
                            @endif
                        </span></p>

                    @if ($item['event'] == 'send_revision')
                        @php
                            $date = \Carbon\Carbon::parse(
                                $item['timestamp'],
                                )->setTimezone('Asia/Jakarta');
                            $formattedDate = $date->format('d F Y');
                            $formattedTime = $date->format('H:i');
                        @endphp
                        <p>Data Week <span
                                class="text-green-500">{{ $item['changes']['original_state'][0]['week'] }}</span>,
                             telah berhasil dikirim pada tanggal {{ $formattedDate }}, pukul
                            {{ $formattedTime }}</p>
                    @elseif ($item['event'] == 'add')
                        <p>Pada LINE: <span
                                class="text-green-500">{{ $item['changes']['new_state']['line'] ?? 'N/A' }}</span>, Week
                            <span class="text-green-500">{{ $item['changes']['new_state']['week'] ?? 'N/A' }}</span>,
                            @if ($item['changes']['new_state'] == null)
                                {{ $item['changes']['new_state']['day'] ?? 'N/A' }}
                                {{ $item['changes']['new_state']['updated_at'] == null ? 'N/A' : \Carbon\Carbon::parse($item['changes']['new_state']['updated_at'])->format('F') }}
                                {{ $item['changes']['new_state']['year'] ?? 'N/A' }}
                            @else
                            @endif
                            Kode Ruah <span
                                class="text-green-500">{{ $item['changes']['new_state']['code'] ?? 'N/A' }}</span>,
                            Status: <span
                                class="text-green-500">{{ $item['changes']['new_state']['status'] ?? 'N/A' }}</span>,
                            Catatan: <span
                                class="text-green-500">{{ $item['changes']['new_state']['notes'] ?? 'N/A' }}</span>
                            telah ditambahkan oleh <span
                                class="text-green-500">{{ $item['fullname'] }}</span>
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
                                class="text-green-500">{{ $item['changes']['original_state']['line'] ?? 'N/A' }}</span>,
                            Week <span
                                class="text-green-500">{{ $item['changes']['original_state']['week'] ?? 'N/A' }}</span>,
                            {{ $item['changes']['original_state']['day'] ?? 'N/A' }}
                            {{ $item['changes']['original_state']['updated_at'] == null ? 'NA' : \Carbon\Carbon::parse($item['changes']['original_state']['updated_at'])->format('F') }}
                            {{ $item['changes']['original_state']['year'] ?? 'N/A' }}, Kode Ruah <span
                                class="text-green-500">{{ $item['changes']['original_state']['code'] ?? 'N/A' }}</span>,
                            Jam <span
                                class="text-green-500">{{ $item['changes']['original_state']['time'] ?? 'N/A' }}</span>,
                            description <span
                                class="text-green-500">{{ $item['changes']['original_state']['description'] ?? 'N/A' }}</span>
                            dihapus oleh <span
                                class="text-green-500">{{ $item['changes']['original_state']['changedBy'] ?? 'N/A' }}</span>
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
                                class="text-green-500">{{ $item['changes']['original_state']['line'] ?? 'N/A' }}</span>,
                            Week <span
                                class="text-green-500">{{ $item['changes']['original_state']['week'] ?? 'N/A' }}</span>,
                            {{ $item['changes']['original_state']['day'] ?? 'N/A' }}
                            {{ \Carbon\Carbon::parse($item['changes']['original_state']['updated_at'])->format('F') ?? 'N/A' }}
                            {{ $item['changes']['original_state']['year'] ?? 'N/A' }}, Kode Ruah <span
                                class="text-green-500">{{ $item['changes']['original_state']['code'] ?? 'N/A' }}</span>,
                            Status: <span
                                class="text-green-500">{{ $item['changes']['original_state']['status'] ?? 'N/A' }}</span>,
                            Catatan: <span
                                class="text-green-500">{{ $item['changes']['original_state']['notes'] ?? 'N/A' }}</span>
                            telah diubah oleh <span
                                class="text-green-500">{{ $item['changes']['new_state']['users_id'] ?? 'N/A' }}</span>
                            pada {{ $formattedOriginalDate }} pukul {{ $formattedOriginalTime }} menjadi Kode Ruah
                            <span class="text-green-500">{{ $item['changes']['new_state']['code'] ?? 'N/A' }}</span>,
                            Status: <span
                                class="text-green-500">{{ $item['changes']['new_state']['status'] ?? 'N/A' }}</span>,
                            Catatan: <span
                                class="text-green-500">{{ $item['changes']['new_state']['notes'] ?? 'N/A' }}</span> ke
                            tanggal <span
                                class="text-green-500">{{ $item['changes']['new_state']['day'] ?? 'N/A' }}</span>
                            {{ \Carbon\Carbon::parse($item['changes']['new_state']['updated_at'])->format('F') ?? 'N/A' }}
                            {{ $item['changes']['new_state']['year'] ?? 'N/A' }}
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

    {{-- <script>
        async function fetchAuditData() {
            try {
                const response = await fetch('http://127.0.0.1:8000/api/showaudit');
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const data = await response.json();
                displayAuditData(data);
            } catch (error) {
                console.error('Error fetching audit data:', error);
            }
        }

        function displayAuditData(data) {
            const container = document.getElementById('data-container');
            container.innerHTML = ''; // Clear previous content

            const sortedData = data.sort((a, b) => b.audit_id - a.audit_id);

            sortedData.forEach(item => {
                let content = '';
                const user = item.user ? item.user.name : 'Unknown User';

                if (item.event === 'send_revision') {
                    const date = new Date(item.changes.original_state[0].updated_at);
                    date.setHours(date.getUTCHours() + 7);
                    const formattedDate =
                        `${date.getDate()} ${date.toLocaleString('default', { month: 'long' })} ${date.getFullYear()}`;
                    const formattedTime =
                        `${date.getHours()}:${date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes()}`;
                    content = `
                    <p>Action: <span class="text-green-500">Send JPM Week </span><span class="text-green-500">${item.changes.original_state[0].week}</p>
                    <p>Data Week <span class="text-green-500">${item.changes.original_state[0].week}</span>, ${formattedDate} telah berhasil dikirim pada tanggal ${formattedDate}, pukul ${formattedTime}</p>
                `;
                } else if (item.event === 'add') {
                    content = `
                    <p>Action: <span class="text-green-500">ADD</span></p>
                    <p>Pada LINE: <span class="text-green-500">${item.changes.new_state.line}</span>, Week <span class="text-green-500">${item.changes.new_state.week}</span>, ${item.changes.new_state.day} ${new Date(item.changes.new_state.updated_at).toLocaleString('default', { month: 'long' })} ${item.changes.new_state.year}, Kode Ruah <span class="text-green-500">${item.changes.new_state.code}</span>, Status: <span class="text-green-500">${item.changes.new_state.status}</span>, Catatan: <span class="text-green-500">${item.changes.new_state.notes}</span> telah ditambahkan oleh <span class="text-green-500">${item.changes.new_state.userId}</span></p>
                `;
                } else if (item.event === 'delete') {
                    const date = new Date(item.changes.original_state.updated_at);
                    date.setHours(date.getUTCHours() + 7);
                    const formattedDate =
                        `${date.getDate()} ${date.toLocaleString('default', { month: 'long' })} ${date.getFullYear()}`;
                    const formattedTime =
                        `${date.getHours()}:${date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes()}`;
                    content = `
                    <p>Action: <span class="text-green-500">DELETE</span></p>
                    <p>Pada LINE: <span class="text-green-500">${item.changes.original_state.line}</span>, Week <span class="text-green-500">${item.changes.original_state.week}</span>, ${item.changes.original_state.day} ${new Date(item.changes.original_state.updated_at).toLocaleString('default', { month: 'long' })} ${item.changes.original_state.year}, Kode Ruah <span class="text-green-500">${item.changes.original_state.code}</span>, Jam <span class="text-green-500">${item.changes.original_state.time}</span>, description <span class="text-green-500">${item.changes.original_state.description}</span> dihapus oleh <span class="text-green-500">${item.changes.original_state.changedBy}</span> pada ${formattedDate} pukul ${formattedTime}</p>
                `;
                } else if (item.event === 'edit') {
                    const originalDate = new Date(item.changes.original_state.updated_at);
                    originalDate.setHours(originalDate.getUTCHours() + 7);
                    const formattedOriginalDate =
                        `${originalDate.getDate()} ${originalDate.toLocaleString('default', { month: 'long' })} ${originalDate.getFullYear()}`;
                    const formattedOriginalTime =
                        `${originalDate.getHours()}:${originalDate.getMinutes() < 10 ? '0' + originalDate.getMinutes() : originalDate.getMinutes()}`;

                    const newDate = new Date(item.changes.new_state.updated_at);
                    newDate.setHours(newDate.getUTCHours() + 7);
                    const formattedNewDate =
                        `${newDate.getDate()} ${newDate.toLocaleString('default', { month: 'long' })} ${newDate.getFullYear()}`;
                    const formattedNewTime =
                        `${newDate.getHours()}:${newDate.getMinutes() < 10 ? '0' + newDate.getMinutes() : newDate.getMinutes()}`;

                    content = `
                    <p>Action: <span class="text-green-500">EDIT</span></p>
                    <p>Pada LINE: <span class="text-green-500">${item.changes.original_state.line}</span>, Week <span class="text-green-500">${item.changes.original_state.week}</span>, ${item.changes.original_state.day} ${new Date(item.changes.original_state.updated_at).toLocaleString('default', { month: 'long' })} ${item.changes.original_state.year}, Kode Ruah <span class="text-green-500">${item.changes.original_state.code}</span>, Status: <span class="text-green-500">${item.changes.original_state.status}</span>, Catatan: <span class="text-green-500">${item.changes.original_state.notes}</span> telah diubah oleh <span class="text-green-500">${item.changes.new_state.users_id}</span> pada ${formattedOriginalDate} pukul ${formattedOriginalTime} menjadi Kode Ruah <span class="text-green-500">${item.changes.new_state.code}</span>, Status: <span class="text-green-500">${item.changes.new_state.status}</span>, Catatan: <span class="text-green-500">${item.changes.new_state.notes}</span> ke tanggal <span class="text-green-500">${item.changes.new_state.day}</span> ${new Date(item.changes.new_state.updated_at).toLocaleString('default', { month: 'long' })} ${item.changes.new_state.year}</p>
                `;
                } else {
                    content = `
                    <p>Action: <span class="text-green-500">${item.event.toUpperCase()}</span></p>
                    <p>${JSON.stringify(item)}</p>
                `;
                }
                const div = document.createElement('div');
                div.classList.add('audit-item');
                div.className = 'bg-white p-4 shadow-md rounded-md mb-2';
                div.innerHTML = content;
                container.appendChild(div);
            });
        }

        document.addEventListener('DOMContentLoaded', fetchAuditData);
    </script> --}}

</body>

</html>
