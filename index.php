<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/css/all.css" class="rel">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"  />
    <link rel="stylesheet" href="./css/custom.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<body>
    <div class="content position-relative">
        <div class="animate__animated animate__fadeIn  content-login col-5  position-absolute start-50 translate-middle justify-content-center" style="top: 300px; min-height: 520px; width: 420px;">
        <div class="col text-center"><img src="asset/zen.png" width="250px" height="100px" style="margin-top: 40px"></div>     
            <div class="d-flex justify-content-center reg" style="margin-top: 20px">  
                <form method="POST" action="includes/data_model.php" style="width: 350px; margin-top: 45px;">
                    <div class="col">
                        <label for="username" class="form-label">Username</label>
                    </div>
                    <div class="input-group col-12">
                    <span class="input-group-text" id=""><i class="fa fa-user p-1"></i></span>
                        <input name="username" type="text" class="form-control"  style="height: 45px;" required>
                    </div>
                    <div class="col mt-2">
                        <label for="password" class="form-label">Password</label>
                    </div>
                    <div class="input-group col-12">
                    <span class="input-group-text" id=""><i class="fa fa-key p-1"></i></span>
                        <input name="password" type="password" class="form-control" id="pass"  style="height: 45px; border: none;" required>
                        <span class="input-group-text" style="background-color:white; color:grey;">
                        <a class="text-dark" id="icon-click">
                            <i class="fas fa-eye p-1" id="eye"></i>
                        </a>
                    </span>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100 mt-5" style="height: 50px;" name="masuk">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
    <script>
    $(document).ready(function(){
        $("#icon-click").click(function(){
            $("#eye").toggleClass('fa-eye-slash');
            var x = document.getElementById("pass");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>