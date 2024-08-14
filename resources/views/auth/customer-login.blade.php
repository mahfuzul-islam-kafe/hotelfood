@extends('app')

@section('content')
<style>
    .myiconac svg {
        fill: #000
    }

    .hidden1 {
        display: none;
    }

    body {
        padding: 2em;
    }

    /* Shared */
    .loginBtn {
        box-sizing: border-box;
        position: relative;
        /* width: 13em;  - apply for fixed size */
        margin: 0.2em;
        padding: 0 15px 0 46px;
        border: none;
        text-align: left;
        line-height: 34px;
        white-space: nowrap;
        border-radius: 0.2em;
        font-size: 16px;
        color: #FFF;
    }

    .loginBtn:before {
        content: "";
        box-sizing: border-box;
        position: absolute;
        top: 0;
        left: 0;
        width: 34px;
        height: 100%;
    }

    .loginBtn:focus {
        outline: none;
    }

    .loginBtn:active {
        box-shadow: inset 0 0 0 32px rgba(0, 0, 0, 0.1);
    }


    /* Facebook */
    .loginBtn--facebook {
        background-color: #4C69BA;
        background-image: linear-gradient(#4C69BA, #3B55A0);
        /*font-family: "Helvetica neue", Helvetica Neue, Helvetica, Arial, sans-serif;*/
        text-shadow: 0 -1px 0 #354C8C;
    }

    .loginBtn--facebook:before {
        border-right: #364e92 1px solid;
        background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/14082/icon_facebook.png') 6px 6px no-repeat;
    }

    .loginBtn--facebook:hover,
    .loginBtn--facebook:focus {
        background-color: #5B7BD5;
        background-image: linear-gradient(#5B7BD5, #4864B1);
    }


    /* Google */
    .loginBtn--google {
        /*font-family: "Roboto", Roboto, arial, sans-serif;*/
        background: #DD4B39;
    }

    .loginBtn--google:before {
        border-right: #BB3F30 1px solid;
        background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/14082/icon_google.png') 6px 6px no-repeat;
    }

    .loginBtn--google:hover,
    .loginBtn--google:focus {
        background: #E74B37;
    }
    .loginmob{
        display: none;
    }
    @media only screen and (max-width: 768px) {
        .logindev{
            display: none;
        }
        .loginmob{
            display: block;
        }
    }
    .containerline {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
}

.circle-a {
    width: 20px;
    height: 20px;
    border-radius: 50%;
}

.line-a {
    flex-grow: 1;
    height: 2px;
}
</style>
<div class="row pt-3 pb-3 m-md-5">
<div class="col-12">
        <div class="containerline">
    <div class="circle-a" style="background: var(--sec-color);"></div>
    <div class="line-a" style="background: var(--primary-color);"></div>
    <div class="circle-a" style="background: var(--primary-color);"></div>
    <div class="line-a" style="background: var(--primary-color);"></div>
    <div class="circle-a" style="background: var(--primary-color);"></div>
</div>        </div>
</div>
<section class="loginframe logindev">
    <div class="row">

        <div class="col-12">
            <div class="pmclr p5 text-center mb-5">
                <h5>Plus que quelques étapes pour finaliser votre commande…</h5>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex mb-3 justify-content-center">
                        <div style="width: 40px; height: 40px;">
                        <svg version="1.0" xmlns="http://www.w3.org/2000/svg" wid40="40px" height="40px" viewBox="0 0 50.000000 50.000000" preserveAspectRatio="xMidYMid meet">
          <g transform="translate(0.000000,50.000000) scale(0.100000,-0.100000)" fill="var(--primary-color)" stroke="none">
            <path d="M155 456 c-60 -28 -87 -56 -114 -116 -36 -79 -19 -183 42 -249 33 -36 115 -71 167 -71 52 0 134 35 167 71 34 37 63 110 63 159 0 52 -35 134 -71 167 -37 34 -110 63 -159 63 -27 0 -65 -10 -95 -24z m173 -12 c174 -72 174 -316 0 -388 -133 -56 -287 47 -288 192 -1 147 154 253 288 196z"></path>
            <path d="M202 393 c-30 -26 -36 -63 -14 -98 l18 -29 -41 -21 c-36 -18 -40 -24 -43 -62 l-3 -43 131 0 131 0 -3 43 c-3 38 -7 44 -43 62 l-41 21 18 29 c32 52 -2 115 -62 115 -15 0 -37 -8 -48 -17z m95 -29 c15 -24 15 -29 2 -53 -11 -20 -22 -26 -49 -26 -27 0 -38 6 -49 26 -13 24 -13 29 2 53 12 18 26 26 47 26 21 0 35 -8 47 -26z m16 -125 c40 -11 65 -45 54 -73 -5 -13 -26 -16 -117 -16 l-111 0 3 38 c3 32 7 38 38 49 44 15 85 16 133 2z"></path>
          </g>
        </svg>
                        </div>
                    </div>
                    <div class="pmclr p5 text-center">
                        <h3>CONNECTEZ-VOUS A VOTRE COMPTE<br>CENTRAL SUSHI</h3>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 p-3">
                    <h3 class="text-center p-2 mb-3 mt-3 pmclr">SE CONNECTER</h3>
                    <form method="POST" action="{{ route('login') }}" id="emailform">
                        @csrf
                        <div class="row pmclr sushiform p-md-3 p-2">
                            <div class="mb-3 d-flex">
                                <label for="">Adresse mail:</label>
                                <!-- <input name="email" type="text" value="@if(session('email')){{session('useremail')}}@endif"> -->
                                <input placeholder="Entrez votre adresse mail.." name="email" type="email" id="email" value="{{ old('email', session('checkemail')) }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-3 d-flex">
                                <label for="">Mot de passe:</label>
                                <input placeholder="Entrez votre mot de passe.." name="password" type="password" id="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3 d-flex p-3 justify-content-center">

                            </div>
                            <div class="mb-3 d-flex justify-content-center mt-5">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <button type="submit" class="btn sushibtn">ME CONNECTER</button>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="/register" role="button" class="btn sushibtn">NOUVEAU COMPTE</a>
                                    </div>
                                </div>


                            </div>
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" style="color: #ff883e;" href="{{ route('password.request') }}">
                                {{ __('Mot de passe oublié?') }}
                            </a>
                            @endif
                            <div class="mb-3 d-flex justify-content-center mt-5">
                                <p>En vous connectant à votre compte, vous pourrez mémoriser votre commande dans votre espace pour gagner du temps la prochaine, modifier vos infos personnelles, et bien d’autres avantages…</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-12" style="margin-top: 59px;">
                    <div class="pmclr p5 text-center">
                        <h3>COMMANDEZ EN TANT QU’INVITE</h3>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 p-3">
                    <h3 class="text-center p-2 mb-3 mt-3 pmclr">SE CONNECTER</h3>
                    <form method="POST" action="{{ route('register-guest') }}" id="emailform">
                        @csrf
                        <div class="row pmclr sushiform p-md-3 p-2">
                            <div class="mb-3 d-flex">
                                <label for="">Nom:</label>
                                <input placeholder="Entrez Votre Nom.." name="name" type="text" id="name" value="" required>
                            </div>
                            <div class="mb-3 d-flex">
                                <label for="">Prénom:</label>
                                <input placeholder="Entrez Votre Prénom.." name="prenom" type="text" id="prenom" value="" required>
                            </div>
                            @if(session('method') == 'delivery')
                            <div class="mb-3 d-flex">
                                <label for="">Adresse de livraison:</label>
                                <input placeholder="Entrez Votre Adresse de livraison.." name="address" type="text" id="address" value="{{ session('address') ?? 'Adresse de livraison..' }}" disabled required>
                                @if(session('address'))
                                <button type="button" class="btn goback p-0" data-bs-toggle="modal" data-bs-target="#exampleModaladdress">Changer</button>
                                @else
                                <button type="button" class="btn goback p-0" data-bs-toggle="modal" data-bs-target="#exampleModaladdress">Ajouter</button>
                                @endif
                            </div>
                            @endif
                            <div class="mb-3 d-flex">
                                <label for="phone">Numéro de téléphone:</label>
                                <input placeholder="+33" name="phone" type="text" id="phone" value="+33" pattern="(\+33|0)[1-9](\d{2}){4}" required>
                            </div>
                            @if(session('method') == 'delivery')
                            <div class="mb-3 d-flex">
                                <label for="">Infos complémentaires:</label>
                                <textarea name="info" id="info" cols="30" rows="10" placeholder="Précisez toutes les indications dont pourrait avoir besoin notre livreur : sonnette, numéro d’appartement, numéro de bâtiment…"></textarea>
                            </div>
                            @endif
                            <div class="mb-3 d-flex p-3 justify-content-center">
                                <button type="submit" class="sushibtn">SUIVANT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="loginframe loginmob">
    <div class="row">
        <div class="col-12">
            <div class="pmclr p5 text-center mb-5">
                <h3>Plus que quelques étapes pour finaliser votre commande…</h3>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12 p-3">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">SE CONNECTER</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">S'INSCRIRE</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                    
                        <div class="row pt-3">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex mb-3 justify-content-center">
                                            <div class="myiconac"><svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                                                </svg></div>
                                        </div>
                                        <div class="pmclr p5 text-center">
                                            <h3>CONNECTEZ-VOUS A VOTRE COMPTE<br>CENTRAL SUSHI</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-md-12 p-3">
                                        <h3 class="text-center p-2 mb-3 mt-3 pmclr">SE CONNECTER</h3>
                                        <form method="POST" action="{{ route('login') }}" id="emailform">
                                            @csrf
                                            <div class="row pmclr sushiform p-md-3 p-2">
                                                <div class="mb-3 d-flex">
                                                    <label for="">Adresse mail:</label>
                                                    <!-- <input name="email" type="text" value="@if(session('email')){{session('useremail')}}@endif"> -->
                                                    <input placeholder="Entrez votre adresse mail.." name="email" type="email" id="email" value="{{ old('email', session('checkemail')) }}" required autocomplete="email" autofocus>
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="mb-3 d-flex">
                                                    <label for="">Mot de passe:</label>
                                                    <input placeholder="Entrez votre mot de passe.." name="password" type="password" id="password" required autocomplete="current-password">
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 d-flex p-3 justify-content-center">

                                                </div>
                                                <div class="mb-3 d-flex justify-content-center mt-5">
                                                    <div class="row">
                                                        <div class="col-6 mb-3">
                                                            <button type="submit" class="btn sushibtn">ME CONNECTER</button>
                                                        </div>
                                                        <div class="col-6">
                                                            <a href="/register" role="button" class="btn sushibtn">NOUVEAU COMPTE</a>
                                                        </div>
                                                    </div>


                                                </div>
                                                @if (Route::has('password.request'))
                                                <a class="btn btn-link" style="color: #ff883e;" href="{{ route('password.request') }}">
                                                    {{ __('Mot de passe oublié?') }}
                                                </a>
                                                @endif
                                                <div class="mb-3 d-flex justify-content-center mt-5">
                                                    <p>En vous connectant à votre compte, vous pourrez mémoriser votre commande dans votre espace pour gagner du temps la prochaine, modifier vos infos personnelles, et bien d’autres avantages…</p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                    <div class="col-md-6 pt-3">
                        <div class="row">
                            <div class="col-12">

                                <div class="pmclr p5 text-center">
                                    <h3>COMMANDEZ EN TANT QU’INVITE</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-12 p-3">
                                <h3 class="text-center p-2 mb-3 mt-3 pmclr">SE CONNECTER</h3>
                                <form method="POST" action="{{ route('register-guest') }}" id="emailform">
                                    @csrf
                                    <div class="row pmclr sushiform p-md-3 p-2">
                                        <div class="mb-3 d-flex">
                                            <label for="">Nom:</label>
                                            <input placeholder="Entrez Votre Nom.." name="name" type="text" id="name" value="" required>
                                        </div>
                                        <div class="mb-3 d-flex">
                                            <label for="">Prénom:</label>
                                            <input placeholder="Entrez Votre Prénom.." name="prenom" type="text" id="prenom" value="" required>
                                        </div>
                                        @if(session('method') == 'delivery')
                                        <div class="mb-3 d-flex">
                                            <label for="">Adresse de livraison:</label>
                                            <input placeholder="Entrez Votre Adresse de livraison.." name="address" type="text" id="address" value="{{ session('address') ?? 'Adresse de livraison..' }}" disabled required>
                                            @if(session('address'))
                                            <button type="button" class="btn goback p-0" data-bs-toggle="modal" data-bs-target="#exampleModaladdress">Changer</button>
                                            @else
                                            <button type="button" class="btn goback p-0" data-bs-toggle="modal" data-bs-target="#exampleModaladdress">Ajouter</button>
                                            @endif
                                        </div>
                                        @endif
                                        <div class="mb-3 d-flex">
                                            <label for="phone">Numéro de téléphone:</label>
                                            <input placeholder="+33" name="phone" type="text" id="phone" value="+33" pattern="(\+33|0)[1-9](\d{2}){4}" required>
                                        </div>
                                        @if(session('method') == 'delivery')
                                        <div class="mb-3 d-flex">
                                            <label for="">Infos complémentaires:</label>
                                            <textarea name="info" id="info" cols="30" rows="10" placeholder="Précisez toutes les indications dont pourrait avoir besoin notre livreur : sonnette, numéro d’appartement, numéro de bâtiment…"></textarea>
                                        </div>
                                        @endif
                                        <div class="mb-3 d-flex p-3 justify-content-center">
                                            <button type="submit" class="sushibtn">SUIVANT</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

</section>
<!-- Modal -->
<div class="modal fade" id="exampleModaladdress" tabindex="-1" aria-labelledby="exampleModaladdress" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Changement d'adresse</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <style>
                .newlocationicon {
                    background-color: transparent;
                    border: none;
                    color: var(--sec-color);
                    position: absolute;
                    top: 0;
                    right: 72px;
                    font-size: 24px;
                    margin-top: 0px !important;
                    padding-top: 9px !important;
                }
            </style>
            <div class="modal-body">
                <h5 class="text-center p-2">LIVRAISON</h5>
                <div class="input-container" style="display: flex; align-items: center;">
                    <input type="text" id="map-address-input" placeholder="Entrez votre addresse...">
                    <button id="checkDZ" style="background-color: var(--sec-color); border: none; margin-left: 5px;" class="p-2">Entrer</button>
                    <button onclick="getCurrentLocation()" class="mt-2 p-2 newlocationicon"><i class="fa-solid fa-location-crosshairs"></i></button>
                </div>

            </div>
            <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn goback p-0">Save changes</button>
      </div> -->
        </div>
    </div>
</div>

@endsection