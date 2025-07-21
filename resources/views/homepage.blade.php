<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthCare Plus - Your Health, Our Priority</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <style>
        /* Based on your Design System */
        :root {
            --primary-blue: #0066CC;
            --secondary-teal: #00B4A6;
            --success-green: #00A86B;
            --neutral-bg: #F8FAFC;
        }
        body { background-color: var(--neutral-bg); font-family: sans-serif; }
        .navbar-brand, .hero-title, .section-title { font-weight: bold; }
        .portal-card, .feature-card {
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            background-color: white;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            transition: transform 0.2s ease-in-out;
        }
        .portal-card:hover, .feature-card:hover { 
            border-color: #2e8eefff;
            transform: translateY(-5px); }
        .icon-circle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-bottom: 1rem;
        }
        /* Icon Colors */
        .icon-primary { color: var(--primary-blue); background-color: rgba(0, 102, 204, 0.1); }
        .icon-secondary { color: var(--secondary-teal); background-color: rgba(0, 180, 166, 0.1); }
        .icon-success { color: var(--success-green); background-color: rgba(0, 168, 107, 0.1); }
        
        .footer { background-color: #1F2937; color: #d1d5db; }
        .footer a { color: #9ca3af; text-decoration: none; }
        .footer a:hover { color: white; }
    </style>
</head>
<body>
    <header class="bg-white shadow-sm sticky-top">
        <nav class="navbar navbar-expand-lg container">
            <a class="navbar-brand"  style="color: var(--primary-blue);">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-heart-pulse-fill" viewBox="0 0 16 16" style="margin-right: 8px;">
                    <path d="M1.475 9.063C.813 8.413 0 7.332 0 6.002c0-1.806 1.464-3.27 3.27-3.27s3.27 1.464 3.27 3.27c0 1.002-.454 1.838-1.152 2.456l-1.09 1.09L8 14l1.09-1.09-1.09-1.09C6.182 10.298 5.73 9.462 5.73 8.46c0-.55.153-1.05.42-1.5z"/>
                    <path d="M10.832 3.232a.5.5 0 0 1 .696.032l1.884 1.884a.5.5 0 0 1 .032.696L12.53 7H11.5l.404-.404L10.832 3.232zM10 8.768a.5.5 0 0 1 .696-.032l2.122-2.121a.5.5 0 0 1 .707 0l1.414 1.414a.5.5 0 0 1 0 .707l-2.12 2.122a.5.5 0 0 1-.697.032L10 8.768zM8.893 1.956a.5.5 0 0 1 .491.042l1.06 1.06a.5.5 0 0 1-.707.708L8.893 2.956a.5.5 0 0 1 0-.999z"/>
                </svg>
                HealthCare Plus
            </a>
            <div class="ms-auto">
                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Patient Portal</a>
                <a href="{{ route('staff.login') }}"  class="btn btn-outline-primary me-2">Staff Portal</a>
            </div>
        </nav>
        
    </header>

    <main>
        <section class="text-center py-5">
            <div class="container">
                <h1 class="display-4 hero-title">Your Health, Our Priority</h1>
                <p class="lead text-muted col-lg-8 mx-auto">
                    Experience seamless healthcare management with our comprehensive appointment booking system. Connect with top medical professionals and manage your health journey with ease.
                </p>
            </div>
        </section>

        <section class="py-5" id="patient-portal">
            <div class="container">
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-5">
                        <div class="card portal-card p-4 text-center">
                            <div class="icon-circle icon-primary mx-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                                </svg>
                                </div>
                            <h3>Patient Portal</h3>
                            <p class="text-muted">Book appointments, track your health records, and manage your healthcare journey.</p>
                            <a href="{{ route('login') }}"class="stretched-link fw-bold text-decoration-none">Access Portal →</a>
                        </div>
                    </div>
                    <div class="col-lg-5" id="staff-portal">
                        <div class="card portal-card p-4 text-center">
                            <div class="icon-circle icon-secondary mx-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-shield-check" viewBox="0 0 16 16">
                                    <path d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.5.5 0 0 0 .101.025.5.5 0 0 0 .1-.025c.076-.023.174-.06.294-.118.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.923-.283-1.879-.623-2.837-.855A2.2 2.2 0 0 0 8.002 1.5a2.2 2.2 0 0 0-2.664.09zM10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                                </svg>
                                </div>
                            <h3>Staff Portal</h3>
                            <p class="text-muted">Manage appointments, patient records, and streamline healthcare operations.</p>
                            <a href="{{ route('staff.login') }}"  class="stretched-link fw-bold text-decoration-none">Access Portal →</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 bg-white">
            <div class="container text-center">
                <h2 class="section-title">Why Choose HealthCare Plus</h2>
                <p class="lead text-muted mb-5 col-lg-8 mx-auto">We provide comprehensive healthcare management solutions designed for modern healthcare needs.</p>
                <div class="row g-5">
                    <div class="col-md-4">
                        <div class="feature-card p-3 border-0">
                            <div class="icon-circle icon-primary mx-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                                    <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.798a7 7 0 0 0-.653-.796l.724-.69a8 8 0 0 1 1.287 1.387l-.858.535q-.41-.52-.925-.994zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-4.5 0a1.5 1.5 0 1 0 3 0 1.5 1.5 0 0 0-3 0m-.5.5v1h1V8h-1z"/>
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                </svg>
                                </div>
                            <h4 class="mt-3">24/7 Availability</h4>
                            <p class="text-muted small">Book appointments and access your health records anytime, anywhere with our online platform.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                         <div class="feature-card p-3 border-0">
                            <div class="icon-circle icon-secondary mx-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-shield-lock" viewBox="0 0 16 16">
                                    <path d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.5.5 0 0 0 .101.025.5.5 0 0 0 .1-.025c.076-.023.174-.06.294-.118.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.923-.283-1.879-.623-2.837-.855A2.2 2.2 0 0 0 8.002 1.5a2.2 2.2 0 0 0-2.664.09zM9 5a1 1 0 0 1 1-1h.5a.5.5 0 0 1 0 1H10a1 1 0 0 1-1-1M8 8v3a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1"/>
                                </svg>
                                </div>
                            <h4 class="mt-3">Secure & Private</h4>
                            <p class="text-muted small">Your health information is protected with industry-standard security measures and privacy protocols.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                         <div class="feature-card p-3 border-0">
                            <div class="icon-circle icon-success mx-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                </svg>
                                </div>
                            <h4 class="mt-3">Expert Care</h4>
                            <p class="text-muted small">Connect with qualified healthcare professionals and specialists for comprehensive medical care.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer pt-5 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="fw-bold text-white">HealthCare Plus</h5>
                    <p class="small">Your trusted partner in healthcare management and wellness.</p>
                </div>
                <div class="col-lg-2 col-6 mb-4">
                    <h6 class="fw-bold text-white">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-6 mb-4">
                    <h6 class="fw-bold text-white">Support</h6>
                    <ul class="list-unstyled">
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-12 mb-4">
                    <h6 class="fw-bold text-white">Contact Info</h6>
                    <p class="small">Emergency: (555) 911-HELP<br>Appointments: (555) 123-4567<br>Email: info@healthcareplus.com</p>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>