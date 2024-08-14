<!doctype html>
<html lang="en">
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Include Bootstrap CSS and other styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <style>
        .bg-one {
            min-height: 100vh;
            background: linear-gradient(63deg, rgba(255, 136, 62, 1) 0%, rgba(169, 90, 41, 1) 3%, rgba(133, 71, 32, 1) 5%, rgba(96, 51, 23, 1) 11%, rgba(41, 22, 10, 1) 17%, rgba(0, 0, 0, 1) 23%, rgba(20, 5, 3, 1) 64%, rgba(30, 8, 5, 1) 81%, rgba(50, 14, 8, 1) 85%, rgba(81, 22, 12, 1) 91%, rgba(128, 34, 19, 1) 96%, rgba(186, 50, 28, 1) 100%)
        }
        .btn-new {
            background: #ff883e;
            color: #fff;
            font-size: 18px;
        }
        .btn-new:hover {
            background: #ff883e;
            color: #fff;
            font-size: 18px;
        }
    </style>
</head>

<body>

    <!-- Page content -->
    <div id="page-content-wrapper" class="container-fluid bg-one">
        <div class="row pt-5 justify-content-center align-items-center">
            <div class="col-md-4">
                <img src="{{ asset('images/logoBOT.png') }}" style="width: 150px">
            </div>
        </div>
        <div class="row mt-5 mb-5 p-3">
            <div class="col-12 ">
                <form method="post" action="{{route('login')}}">
                    @csrf
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-4 mb-3">
                        <input class="form-control" type="text" name="email" placeholder="username">
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-4 mb-3">
                        <input class="form-control" type="password" name="password" placeholder="password">
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-4 mb-3">
                        <button class="btn btn-new" type="submit">Login</button>
                        </div>
                    </div>
                    
                    
                    

                </form>
            </div>

        </div>
        <!-- Your page content goes here -->
        <!-- resources/views/layouts/partials/header.blade.php -->

    </div>
    </div>
    <!-- Include Bootstrap JS and other scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>