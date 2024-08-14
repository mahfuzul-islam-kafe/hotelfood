@extends('maccount-head')

@section('mac-body')

<style>
    ul {
        list-style: none;
        padding: 0;
        margin: 0;
        
    }

    li {
        margin: 0;
        padding: 5px;
    }

    .btnorder {
        width: 100%;
        display: flex;
        text-decoration: none;
        padding: 20px 10px;
        border: 1px solid var(--sec-color);
        color: black;
        font-size: 18px;
        background-color: var(--sec-color);
    }

    .logoutbtn {
        width: 100%;
        background-color: transparent;
        color: black;
        padding: 20px 10px;
        border: 1px solid var(--sec-color);
        background-color: var(--sec-color);
        font-size: 18px;
        text-align: left;
    }
    .bg-gree {
        background-color: #ff883e;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <h3 class="pmclr p-3">MON COMPTE CENTRAL SUSHI</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <ul>
           
        <li>
                <a class="btnorder" href="{{ route('my-orders') }}">Historique de commandes</a>
            </li>
            <li>
                <a class="btnorder" href="{{ route('profile') }}">Mes informations personnelles</a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logoutbtn">Déconnexion</button>
                </form>
            </li>
        </ul>
    </div>
    <div class="col-md-9">
        @yield('mac-content')
    </div>
</div>

@endsection