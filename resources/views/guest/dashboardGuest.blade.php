
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body>
<div class="dashboard-container">
    <div class="big-card-container">
        <div class="big-card bg-blue-800 text-white p-6 rounded-lg">
            <div class="content-wrapper flex">
                <div class="text-container flex-grow">
                    <h3 class="text-3xl mb-8">Welcome To PJM View (Guest Mode)</h3>
                    <p class="text-lg">Lorem ipsum dolor sit amet consectetur. Pretium dignissim egestas sagittis ut. Tellus viverra urna lorem praesent blandit fringilla. Consequat in turpis massa accumsan. Viverra ornare ac egestas est sed ut at faucibus auctor. Lacus ut amet massa risus elementum dictum amet. Interdum semper augue amet a placerat augue in. Imperdiet nec urna venenatis quis.</p>
                </div>
                <div class="logo-container">
                    <!-- <img src="{{ asset('image/kosong.png') }}" alt="Kosong" class="logo"> -->
                </div>
            </div>
        </div>
    </div>

    <!-- Card for Line, Year, and Month -->
    <div class="custom-card-row">
        <div class="custom-card">
            @foreach($lines as $line)
            <div>
                <a href="{{ route('dashboard', ['line' => $line->id]) }}" class="btn-secondary w-40 h-16 text-lg my-2">{{ $line->name }}</a>
            </div>
            @endforeach
        </div>
        @if($selectedLine)
        <div class="custom-card">
            @foreach($years as $year)
            <div>
                <a href="{{ route('dashboard', ['line' => $selectedLine->id, 'year' => $year->year]) }}" class="btn-secondary w-40 h-16 text-lg my-2">{{ $year->year }}</a>
            </div>
            @endforeach
        </div>
        @endif
        @if($selectedYear)
        <div class="custom-card">
            @foreach($months as $month)
            <div>
                <a href="{{ route('dashboard', ['line' => $selectedLine->id, 'year' => $selectedYear->year, 'month' => $month->month]) }}" class="text-lg my-2">{{ $month->month }}</a>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Button for history -->
    <div class="mt-8 ml-4 w-4/5">
        <a href="#" class="btn-primary w-full h-16 text-2xl mt-12">History</a>
    </div>
</div>
</body>
</html>
