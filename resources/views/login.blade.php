<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
      data-sidebar-image="none" data-bs-theme="dark" data-body-image="img-1" data-preloader="disable">

<head>

    <meta charset="utf-8"/>
    <title>Sign In | {{env('APP_NAME')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="TshrXD" name="author"/>
    @include('layout.header-links')

</head>

<body>

<div class="auth-page-wrapper pt-5 mt-5">
    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">



            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4 card-bg-fill">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Welcome Back !</h5>
                                <p class="text-muted">Sign in to continue to {{env('APP_NAME')}}.</p>
                            </div>
                            <div class="p-2 mt-4">
                                <form id="loginForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="username" name="email"
                                               placeholder="Enter email">
                                    </div>

                                    <div class="mb-3">

                                        <label class="form-label" for="password-input">Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control pe-5 password-input"
                                                   name="password" placeholder="Enter password" id="password-input">
                                            <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon showPass"
                                                    type="button" id="password-addon"><i
                                                        class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                    </div>

                                    {{--                                    <div class="form-check">--}}
                                    {{--                                        <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">--}}
                                    {{--                                        <label class="form-check-label" for="auth-remember-check">Remember me</label>--}}
                                    {{--                                    </div>--}}

                                    <div class="mt-4">
                                        <button class="btn btn-primary w-100" type="submit">Sign In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                    <div class="mt-4 text-center">
                        <p class="mb-0">Don't have an account ? <a href="{{route('register')}}" class="fw-semibold text-primary text-decoration-underline"> Signup </a> </p>
                    </div>


                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0 text-muted">&copy;
                            <script>document.write(new Date().getFullYear())</script>
                            {{env('APP_NAME')}}. Crafted with <i class="mdi mdi-heart text-danger"></i> by TshrXD
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
</div>
<!-- end auth-page-wrapper -->

@include('layout.footer-links')
</body>

</html>
<script !src="">
    $("#loginForm").validate({
        rules: {
            email: {required: true, email: true},
            password: {required: true}
        },
        messages: {
            email: {required: "Please enter email address", email: "Please enter your email address properly"},
            password: {required: "Please enter your password"},
        },
        errorClass: "text-danger",
        submitHandler: function (form, e) {
            e.preventDefault();
            let data = new FormData(form);
            $.ajax({
                url: '{{route("login-check")}}',
                type: "POST",
                dataType: "JSON",
                data: data,
                cache: false,
                async: false,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $("#loginBtn").attr('disabled', 'disabled');
                },
                success: function (data) {
                    if (data.status == 1) {
                        Swal.fire({
                            title: 'Success',
                            text: data.message,
                            icon: 'success',
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        });
                        $("#loginForm").trigger('reset');
                        window.location.reload();
                    } else {
                        Swal.fire({
                            title: 'Failed',
                            text: data.message,
                            icon: 'warning',
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        })
                    }
                },
                complete: function () {
                    $("#loginBtn").removeAttr('disabled');
                }
            });
        }
    })
    $(document).on('click', '.showPass', function () {
        const password = document.querySelectorAll(".password-input");

        $.each(password, function (index, value) {

            const type = value.getAttribute("type") === "password" ? "text" : "password";
            value.setAttribute("type", type);

        });


    });
</script>
