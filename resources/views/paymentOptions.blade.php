@extends('app')

@section('content')
<style>
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
    <div class="line-a" style="background: var(--sec-color);"></div>
    <div class="circle-a" style="background: var(--sec-color);"></div>
    <div class="line-a" style="background: var(--sec-color);"></div>
    <div class="circle-a" style="background: var(--sec-color);"></div>
</div>        </div>
</div>
<section class="loginframe">
    <div class="row">
        <div class="col-12">
            <div class="pmclr p5 text-center mb-5">
                <h3>C’est bientôt fini… Finalisez le paiement de votre commande</h3>
            </div>
        </div>
    </div>
    
    @if(isset($order->order_id))
    <div class="row">
        <div class="col-12">
            <div class="pmclr p5 text-center mb-5">
                
            <a href="{{route('place-order', ['payment_method'=>'especes'] )}}" role="button" class="btn sushibtn">ESPECES</a>

         </div>
        </div>
    </div>

    
    @if(session('method') == 'takeaway')
    <div class="row">
        <div class="col-12">
            <div class="pmclr p5 text-center mb-5">
                <a href="{{route('place-order', ['payment_method'=>'au-restaurant'] )}}" role="button" class="btn sushibtn">Directement au restaurant</a>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="pmclr p5 text-center mb-5">
                @if(session('restaurent') == 1 || session('restaurent') == 2)
            <a href="{{route('payment-options-redirect', ['order_id' => $order->order_id,'payment_method'=>'cb-en-ligne'])}}" role="button" class="btn sushibtn">CB en ligne</a>
            @endif
            </div>
        </div>
    </div>

    @else
    
    <div class="row">
        <div class="col-12">
            <div class="pmclr p5 text-center mb-5">
                
            <a href="{{route('place-order', ['payment_method'=>'especes'] )}}" role="button" class="btn sushibtn">ESPECES</a>

         </div>
        </div>
    </div>

    
    @if(session('method') == 'takeaway')
    <div class="row">
        <div class="col-12">
            <div class="pmclr p5 text-center mb-5">
                <a href="{{route('place-order', ['payment_method'=>'au-restaurant'] )}}" role="button" class="btn sushibtn">Directement au restaurant</a>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="pmclr p5 text-center mb-5">
                @if(session('restaurent') == 1 || session('restaurent') == 2)
            <a href="{{route('place-order', ['payment_method'=>'cb-en-ligne'] )}}" role="button" class="btn sushibtn">CB en ligne</a>
            @endif
            </div>
        </div>
    </div>

    @endif

</section>

</section>


@endsection