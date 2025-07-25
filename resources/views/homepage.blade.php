<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthCare Plus - Appointment Booking</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(to right, #e0f7fa, #b3e5fc); /* Light blue gradient */
            color: #333;
            text-align: center;
        }
        .container-landing {
            background-color: #ffffff;
            padding: 40px 60px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            max-width: 800px;
            width: 90%;
            animation: fadeIn 1s ease-out;
        }
        h1 {
            color: #007bff; /* Primary blue */
            margin-bottom: 25px;
            font-size: 3em;
            font-weight: 700;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.05);
        }
        p {
            font-size: 1.3em;
            line-height: 1.6;
            margin-bottom: 40px;
            color: #666;
        }
        .button-group {
            display: flex;
            gap: 25px;
            justify-content: center;
            flex-wrap: wrap; /* Allows buttons to wrap on smaller screens */
        }
        .btn-landing {
            display: inline-block;
            padding: 18px 35px;
            font-size: 1.3em;
            font-weight: bold;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-patient {
            background-color: #007bff; /* Primary blue */
            color: #fff;
        }
        .btn-patient:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }
        .btn-staff {
            background-color: #28a745; /* Green for staff */
            color: #fff;
        }
        .btn-staff:hover {
            background-color: #218838;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Basic responsiveness */
        @media (max-width: 768px) {
            .container-landing {
                padding: 30px;
            }
            h1 {
                font-size: 2.2em;
            }
            p {
                font-size: 1.1em;
            }
            .button-group {
                flex-direction: column;
                gap: 15px;
            }
            .btn-landing {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container-landing">
        <h1>Appointment Booking System for Hospitals</h1>
      
        <div class="button-group">
            <a href="{{ route('register') }}" class="btn-landing btn-patient">Patient Registration</a>
            <a href="{{ route('staff.register') }}" class="btn-landing btn-staff">Staff Registration</a>
        </div>
    </div>
</body>
</html>