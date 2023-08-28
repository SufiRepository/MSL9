<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <!-- Google Font: Source Sans Pro -->
    {{-- <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte3/plugins/fontawesome-free/css/all.min.css') }}" />
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte3/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte3/dist/css/adminlte.min.css') }}" />
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte3/plugins/bs-stepper/css/bs-stepper.min.css') }}">
    <style>
        .register-background {
            background-image: url("{{ asset('images') }}/citybg.jpg");
            background-size: cover;
        }
    </style>

</head>

<body class="hold-transition register-background">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header text-center">
                        <h3>Housemen Placement Application</h3>
                    </div>
                    <div class="card-body">
                        <div class="bs-stepper">
                            <div class="bs-stepper-header" role="tablist">
                                <!-- First Step: User Details -->
                                <div class="step" data-target="#user-details-part">
                                    <button type="button" class="step-trigger" role="tab"
                                        aria-controls="user-details-part" id="user-details-part-trigger">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label">User Details</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <!-- Second Step: Family Details -->
                                <div class="step" data-target="#family-details-part">
                                    <button type="button" class="step-trigger" role="tab"
                                        aria-controls="family-details-part" id="family-details-part-trigger">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">Family Details</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <!-- Third Step: Upload File -->
                                <div class="step" data-target="#upload-file-part">
                                    <button type="button" class="step-trigger" role="tab"
                                        aria-controls="upload-file-part" id="upload-file-part-trigger">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">Upload File</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <!-- Fourth Step: Select Hospital -->
                                <div class="step" data-target="#select-hospital-part">
                                    <button type="button" class="step-trigger" role="tab"
                                        aria-controls="select-hospital-part" id="select-hospital-part-trigger">
                                        <span class="bs-stepper-circle">4</span>
                                        <span class="bs-stepper-label">Select Hospital</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <!-- Fifth Step: Terms and Conditions -->
                                <div class="step" data-target="#terms-condition-part">
                                    <button type="button" class="step-trigger" role="tab"
                                        aria-controls="terms-condition-part" id="terms-condition-part-trigger">
                                        <span class="bs-stepper-circle">5</span>
                                        <span class="bs-stepper-label">Terms and Conditions</span>
                                    </button>
                                </div>
                            </div>
                            <div class="bs-stepper-content">
                                <!-- Step 1: User Details -->
                                <div id="user-details-part" class="content" role="tabpanel"
                                    aria-labelledby="user-details-part-trigger">
                                    <div class="form-group">
                                        <label for="full-name">Full Name</label>
                                        <input type="text" class="form-control" id="full-name"
                                            placeholder="Enter your full name">
                                    </div>
                                    <div class="form-group">
                                        <label for="birthdate">Date of Birth</label>
                                        <input type="date" class="form-control" id="birthdate">
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select class="form-control" id="gender">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                                </div>

                                <!-- Step 2: Family Details -->
                                <div id="family-details-part" class="content" role="tabpanel"
                                    aria-labelledby="family-details-part-trigger">
                                    <div class="form-group">
                                        <label for="father-name">Father's Name</label>
                                        <input type="text" class="form-control" id="father-name"
                                            placeholder="Enter father's name">
                                    </div>
                                    <div class="form-group">
                                        <label for="mother-name">Mother's Name</label>
                                        <input type="text" class="form-control" id="mother-name"
                                            placeholder="Enter mother's name">
                                    </div>
                                    <div class="form-group">
                                        <label for="siblings-count">Number of Siblings</label>
                                        <input type="number" class="form-control" id="siblings-count"
                                            min="0">
                                    </div>
                                    <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                                    <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                                </div>

                                <!-- Step 3: Upload File -->
                                <div id="upload-file-part" class="content" role="tabpanel"
                                    aria-labelledby="upload-file-part-trigger">
                                    <div class="form-group">
                                        <label for="file-upload">Upload File</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="file-upload">
                                                <label class="custom-file-label" for="file-upload">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                                    <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                                </div>

                                <!-- Step 4: Select Hospital -->
                                <div id="select-hospital-part" class="content" role="tabpanel"
                                    aria-labelledby="select-hospital-part-trigger">
                                    <div class="form-group">
                                        <label for="hospital-select">Select Hospital</label>
                                        <select class="form-control" id="hospital-select">
                                            <option value="" disabled selected>Select a hospital</option>
                                            <option value="hospital-a">Hospital A</option>
                                            <option value="hospital-b">Hospital B</option>
                                            <option value="hospital-c">Hospital C</option>
                                            <!-- Add more hospital options as needed -->
                                        </select>
                                    </div>
                                    <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                                    <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                                </div>

                                <!-- Step 5: Terms and Conditions -->
                                <div id="terms-condition-part" class="content" role="tabpanel"
                                    aria-labelledby="terms-condition-part-trigger">
                                    <h4>Terms and Conditions</h4>
                                    <p>Please read and agree to the terms and conditions before submitting your
                                        application:</p>
                                    <ul>
                                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                        <li>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</li>
                                        <li>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                                            eu fugiat nulla pariatur.</li>
                                        <li>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                                            deserunt mollit anim id est laborum.</li>
                                    </ul>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="agree-checkbox">
                                        <label class="form-check-label" for="agree-checkbox">I agree to the terms and
                                            conditions</label>
                                    </div>
                                    <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nextBtn = document.getElementById('nextBtn');
            const formTabs = document.getElementById('formTabs');
            const form = document.getElementById('registrationForm');
            const formTabLinks = formTabs.querySelectorAll('.nav-link');

            nextBtn.addEventListener('click', function() {
                // Validate form fields here if needed
                // Update the active tab
                const currentTab = formTabs.querySelector('.active');
                const nextTab = currentTab.nextElementSibling;
                currentTab.classList.remove('active');
                nextTab.classList.add('active');
                // Submit the form or navigate to the next page
                form.submit();
            });

            // Prevent tab clicks from triggering navigation
            formTabLinks.forEach(function(tabLink) {
                tabLink.addEventListener('click', function(event) {
                    event.preventDefault();
                });
            });
        });

        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function() {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })
    </script>



    <!-- jQuery -->
    <script src="{{ URL::asset('adminlte3/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ URL::asset('adminlte3/plugins//bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ URL::asset('adminlte3/dist/js/adminlte.js') }}"></script>
    <!-- BS-Stepper -->
    <script src="{{ URL::asset('adminlte3/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>

</body>

</html>
