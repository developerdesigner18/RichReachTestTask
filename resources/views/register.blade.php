<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
      data-sidebar-image="none" data-bs-theme="dark" data-body-image="img-1" data-preloader="disable">

<head>

    <meta charset="utf-8"/>
    <title>Sign In | {{env('APP_NAME')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="Themesbrand" name="author"/>
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
                                <h5 class="text-primary">Welcome!</h5>
                                <p class="text-muted">Sign up to continue to {{env('APP_NAME')}}.</p>
                            </div>
                            <div class="p-2 mt-4">
                                <form id="registerForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="useremail" class="form-label">Email <span
                                                    class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" id="useremail"
                                               placeholder="Enter email address">

                                    </div>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Name <span
                                                    class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="Enter Name">
                                    </div>



                                    <div class="mb-3">
                                        <label class="form-label" for="password-input">Password<span
                                                    class="text-danger">*</span></label>
                                        <div class="position-relative auth-pass-inputgroup">
                                            <input type="password" class="form-control pe-5 password-input"
                                                   name="password" onpaste="return false" placeholder="Enter password"
                                                   id="password-input" aria-describedby="passwordInput">
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon showPass"
                                                    type="button" id="password-addon"><i
                                                        class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password-input">Confirm Password <span
                                                    class="text-danger">*</span></label>
                                        <div class="position-relative auth-pass-inputgroup">
                                            <input type="password" class="form-control pe-5 password-input"
                                                   name="password_confirmation" placeholder="Enter Confirm password">
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon showPass"
                                                    type="button" id="password-addon"><i
                                                        class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                    </div>


                                    <div class="mt-4">
                                        <button class="btn btn-success w-100" type="submit">Sign Up</button>
                                    </div>


                                </form>

                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                    <div class="mt-4 text-center">
                        <p class="mb-0">Already have an account ? <a href="{{route('login')}}"
                                                                     class="fw-semibold text-primary text-decoration-underline">
                                Signin </a></p>
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
    $("#registerForm").validate({
        rules: {
            email: {required: true, email: true},
            name: {required: true},
            password: {required: true, minlength: 8},
            password_confirmation: {required: true, minlength: 8, equalTo: "#password-input"}
        },
        messages: {
            email: {required: "Please enter email address", email: "Please enter your email address properly"},
            name: {required: "Please enter your name"},
            password: {required: "Please enter your password"},
            password_confirmation: {required: "Please enter Confirm password"},
        },
        errorClass: "text-danger",
        submitHandler: function (form, e) {
            e.preventDefault();
            let data = new FormData(form);
            $.ajax({
                url: '{{route("register.create")}}',
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
                        $("#registerForm").trigger('reset');
                        window.location.href = 'login';
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
<script !src="">

</script>
