<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'HealthCare Plus' }}</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <style>
        body {
            background-color: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem 0;
        }
        .auth-card {
            width: 100%;
            max-width: 500px;
        }
    </style>
</head>
<body>
    <div class="card shadow-lg auth-card">
        <div class="card-body p-5">
            {{ $slot }}
        </div>
    </div>
</body>
</html>