<!doctype html>
<html lang="en">


@include('dashboard.partials.head')

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="{{ asset('back-assets') }}/images/logos/sofa-logo/sofa-high-resolution-logo-transparent.png" width="180"
                                        alt="">
                                </a>
                                
                                <p class="text-center">learning new skills</p>
                                <form action="{{ route("") }}" method="POST">
                                    <div class="mb-3">
                                        <label for="Email" class="form-label">Username</label>
                                        <input type="email" name="email" class="form-control" id="Email"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-4">
                                        <label for="Password" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="Password">
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input primary" type="checkbox" value="1"
                                                id="flexCheckChecked" name="remeberMe" checked>
                                            <label class="form-check-label text-dark" for="flexCheckChecked">
                                                Remeber this Device
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign
                                        In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('back-assets') }}/libs/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('back-assets') }}/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
