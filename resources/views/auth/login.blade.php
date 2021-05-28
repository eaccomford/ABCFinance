<!doctype html>
<html>
<head>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
   
    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<style>
        /* Made with love by Mutiullah Samim*/

            @import url('https://fonts.googleapis.com/css?family=Numans');

            html,body{
            background-image: url({{asset('imgages/img1.jpg')}});
            background-size: cover;
            background-repeat: no-repeat;
            height: 100%;
            font-family: 'Numans', sans-serif;
            }

            .container{
            height: 100%;
            align-content: center;
            }

            .card{
            height: 370px;
            margin-top: auto;
            margin-bottom: auto;
            width: 400px;
            background-color: rgba(0,0,0,0.5) !important;
            }

            .social_icon span{
            font-size: 60px;
            margin-left: 10px;
            color: #FFC312;
            }

            .social_icon span:hover{
            color: white;
            cursor: pointer;
            }

            .card-header h3{
            color: white;
            }

            .social_icon{
            position: absolute;
            right: 20px;
            top: -45px;
            }

            .input-group-prepend span{
            width: 50px;
            background-color: #FFC312;
            color: black;
            border:0 !important;
            }

            input:focus{
            outline: 0 0 0 0  !important;
            box-shadow: 0 0 0 0 !important;

            }

            .remember{
            color: white;
            }

            .remember input
            {
            width: 20px;
            height: 20px;
            margin-left: 15px;
            margin-right: 5px;
            }

            .login_btn{
            color: black;
            background-color: #FFC312;
            width: 100px;
            }

            .login_btn:hover{
            color: black;
            background-color: white;
            }

            .links{
            color: white;
            }

            .links a{
            margin-left: 4px;
            }
</style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Sign In</h3>
                    <div class="d-flex justify-content-end social_icon">
                        <h3>ABC Microfinance </h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="email">
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        
                        <div class="form-group row mb-0 mt-5">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn float-right login_btn">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link float-right" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>