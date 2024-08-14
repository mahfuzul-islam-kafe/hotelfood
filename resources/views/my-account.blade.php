@extends('mac-sidebar')

@section('mac-content')
<style>
  .table {

    --bs-table-color: #e4d4bf;
    --bs-table-bg: #00000030;
  }

  .my-card {
    background-color: #00000030;
    border-radius: 10px;
    border: 1px solid #e4d4bf;
    padding: 20px;
  }
  .accordion-item {
    border-color: var(--sec-color);
  }
</style>
<div class="row">
  <div class="col-12">
    <section class="row p-md-3 p-2">
      <!-- bootstrap accordion for each order -->
      <div class="accordion" id="accordionExample">
        @foreach($orders as $order)
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              <div class="row">
                <div class="col-12">
                  <p class="pmclr pt-3">Le {{$order->created_at->format('d/m/Y')}} à Central Sushi {{$order->restaurent->restaurent_name}}</p>
                  <p class="pmclr pb-3">Commande N°: {{$order->order_number}}</p>
                </div>
              </div>
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <div class="row">
                <div class="col-md-12">
                  
                    
                    
                        @foreach($order->orderDetails as $orderDetail)
                        
                          <p class="pmclr p-1">{{ $orderDetail->product_name }} x {{ $orderDetail->product_qty }}</p>
                          
                          
                       
                        @endforeach
                      
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>

    </section>
  </div>
</div>
@endsection