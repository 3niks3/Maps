<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Page</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <!-- Font-awesomeCSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

        <!-- Custom CSS -->

        <script>
            let map;

            console.log(document.getElementById("map"))

            function initMap() {
                map = new google.maps.Map(document.getElementById("map"), {
                    center: { lat: -34.397, lng: 150.644 },
                    zoom: 8,
                });
            }


        </script>
    </head>
    <body>

    <div class="container-fluid g-0">
        <div class="container-fluid g-0">
            <header>

                <div class="row g-0">
                    <div class="col">
                        <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark p-2">
                            <a class="navbar-brand" href="/">
                                <i class="fas fa-home"></i>
                            </a>
                        </nav>
                    </div>
                </div>

            </header>
        </div>

        <div class="container-fluid g-3">
            <main>

                <!-- Content -->
                <div class="row mt-2 ">
                    <div class="col">

                        <div class="card">
                            <div class="card-body">

                                <div class="row row-cols-lg-auto mt-2 g-3 align-items-center">
                                    <div class="col-6 offset-3">
                                        <h2>Sign in</h2>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-6 col-12 overflow-auto offset-0 offset-sm-3">
                                        <form method="post" action="/auth" id="sign-in-form">
                                            <div class="mb-3">
                                                <label for="email-input" class="form-label">Email address</label>
                                                <input type="email" name="email" class="form-control" id="email" aria-describedby="email">
                                                <div class="invalid-feedback" data-input-field="#email"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password-input" class="form-label">Password</label>
                                                <input type="password" name="password" class="form-control" id="password" aria-describedby="password">
                                                <div class="invalid-feedback" data-input-field="#password"></div>
                                            </div>

                                            <div class="invalid-feedback" data-input-field="#general"></div>
                                            <button type="submit" class="btn btn-primary">Sign in</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <!-- Content end-->

            </main>
        </div>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    <!--Jquery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--Axios -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.js" integrity="sha512-otOZr2EcknK9a5aa3BbMR9XOjYKtxxscwyRHN6zmdXuRfJ5uApkHB7cz1laWk2g8RKLzV9qv/fl3RPwfCuoxHQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    </script>

    <script>
        $('form#sign-in-form').submit(function(e){
            e.preventDefault();
            let target = $(this).attr('action');
            let data = new FormData(this);

            $('form#sign-in-form').find('input').removeClass('is-invalid')
            $('form#sign-in-form').find('div.invalid-feedback').html('').hide();

            console.log(data)

            axios.post(target,data).then(function(response){
                let status = response.data.status;
                let messages = response.data.messages||{};

                console.log(messages);

                if(!status)
                {
                    $.each(messages ,function(field, error) {
                        let error_field = $('form#sign-in-form').find('#'+field).addClass('is-invalid')
                        let error_field_id = error_field.attr('id');

                        $('form#sign-in-form').find('div.invalid-feedback[data-input-field="#'+field+'"]').append('<p>'+error+'</p>').show();
                    })

                    return false;
                }

                console.log('redirect')
                window.location.replace('/profile');

                console.log(response);
            }).catch(function (error) {
                console.log(error);
            });
        });
    </script>


    </body>
</html>
