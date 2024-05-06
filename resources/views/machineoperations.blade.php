<!-- PLACEHOLDER, TEST PURPOSE ONLY! -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Machine Operations</title>
</head>
<body>
    <h1>Machine Operations</h1>

    <table>
        <thead>
            <tr>
                <th>Year</th>
                <th>Month</th>
                <th>Week</th>
                <th>Day</th>
                <th>Code</th>
                <th>Time</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($machineOperations as $machineOperation)
            <tr>
                <td>{{ $machineOperation->year }}</td>
                <td>{{ $machineOperation->month }}</td>
                <td>{{ $machineOperation->week }}</td>
                <td>{{ $machineOperation->day }}</td>
                <td>{{ $machineOperation->code }}</td>
                <td>{{ $machineOperation->time }}</td>
                <td>{{ $machineOperation->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
