@extends('admin.layouts.admin')

@section('content')
<section class="container">
    @php
    $user = Auth::user();
    if ($user->role != 'admin') {
    $orders = $orders->where('rest_id', $user->rest_id);
    }
    $dijonOrders = $orders->where('rest_id', '1')->sortByDesc('order_id');
    $besanconOrders = $orders->where('rest_id', '2')->sortByDesc('order_id');
    $belfortOrders = $orders->where('rest_id', '3')->sortByDesc('order_id');

    
    $dijonOdersTotal = $dijonOrders->sum('total_order_price');
    $besanconOdersTotal = $besanconOrders->sum('total_order_price');
    $belfortOdersTotal = $belfortOrders->sum('total_order_price');
    @endphp
    <div class="row mb-3">
        <div class="col-12">
            <h1>Commandes (Livraison)</h1>
            <form class="mt-3 mb-3" action="/admin/orders-delivery" method="get">
                <div class="row">
                    <div class="col d-flex align-items-center">
                        <label style="margin-right: 5px;" for="date">Date:</label>
                        <input class="form-control" type="date" id="date" name="date" value="{{ request('date') }}">
                    </div>
                    <div class="col">
                        <input class="btn btn-primary" type="submit" value="Recherche">
                    </div>
                </div>
            </form>
        </div>

        <form class="mt-3 mb-3" action="/admin/orders-delivery" method="get">
            <div class="row">
                <div class="col d-flex align-items-center">
                    <label style="margin-right: 5px;" for="date">from:</label>
                    <input class="form-control" type="date" id="date" name="frm_date" value="{{ request('frm_date') }}">

                    <label style="margin-right: 5px; margin-left: 5px;" for="date">to:</label>
                    <input class="form-control" type="date" id="date" name="to_date" value="{{ request('to_date') }}">
                </div>
                <div class="col">
                    <input class="btn btn-primary" type="submit" value="Recherche">
                </div>
            </div>
        </form>
    </div>

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#dijon">Dijon</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#besancon">Besancon</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#belfort">Belfort</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="dijon">
            <!-- Dijon Orders Tab -->
            <div class="row mt-3 mb-3">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total des commandes</h5>
                            <p class="card-text">{{ $dijonOrders->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Sous Total</h5>
                            <p class="card-text">{{ $dijonOdersTotal }} €</p>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Livraison</h5>
                            <p class="card-text">{{ $dijonOrders->where('order_status', 'Delivered')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <input class="form-control" type="text" id="search" placeholder="Recherche par numéro de téléphone client">
                    <table class="table data-tables">
                        <thead>
                            <tr>
                                <th>N ° de commande</th>
                                <th>Téléphone du client</th>
                                <th>Date/heure de la commande</th>
                                <th>Prix total de la</th>
                                <th>temps de livraison estimé</th>
                                <th>Mode de paiement</th>
                                <th>Statut de la</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($dijonOrders->count() == 0)
                            <tr>
                                <td colspan="8" class="text-center">Aucune commande trouvée</td>
                            </tr>
                            @endif
                            @foreach ($dijonOrders as $order)
                            <tr>
                                <td>{{ $order->order_number }}
                                </td>
                                <td>{{ optional($order->user)->phone }}</td>
                                <td>{{ $order->order_date }}<br>{{ $order->order_time }}</td>
                                <td>{{ $order->total_order_price }}</td>
                                <td>{{ $order->estimated_delivery_time }}</td>
                                <td>{{ $order->payment->payment_method ?? '' }}</td>
                                <td>{{ $order->order_status }}</td>
                                <td>
                                    <a href="{{ route('orders.show', ['id' => $order->order_id]) }}">View</a>
                                    @if ($order->order_status != 'Delivered')
                                    <button class="updateOrderStatusButton" data-order-id="{{ $order->order_id }}">Mark as Delivered</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div id="pagination" class="pagination"></div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="besancon">
            <!-- Besancon Orders Tab -->
            <div class="row mt-3 mb-3">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total des commandes</h5>
                            <p class="card-text">{{ $besanconOrders->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Sous Total</h5>
                            <p class="card-text">{{ $besanconOdersTotal }} €</p>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Livraison</h5>
                            <p class="card-text">{{ $besanconOrders->where('order_status', 'Delivered')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <input class="form-control" type="text" id="search" placeholder="Recherche par numéro de téléphone client">
                    <table class="table data-tables">
                        <thead>
                            <tr>
                                <th>N ° de commande</th>
                                <th>Téléphone du client</th>
                                <th>Date/heure de la commande</th>
                                <th>Prix total de la</th>
                                <th>temps de livraison estimé</th>
                                <th>Mode de paiement</th>
                                <th>Statut de la</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($besanconOrders->count() == 0)
                            <tr>
                                <td colspan="8" class="text-center">Aucune commande trouvée</td>
                            </tr>
                            @endif
                            @foreach ($besanconOrders as $order)
                            <tr>
                                <td>{{ $order->order_number }}
                                </td>
                                <td>{{ optional($order->user)->phone }}</td>
                                <td>{{ $order->order_date }}<br>{{ $order->order_time }}</td>
                                <td>{{ $order->total_order_price }}</td>
                                <td>{{ $order->estimated_delivery_time }}</td>
                                <td>{{ $order->payment->payment_method ?? '' }}</td>
                                <td>{{ $order->order_status }}</td>
                                <td>
                                    <a href="{{ route('orders.show', ['id' => $order->order_id]) }}">View</a>
                                    @if ($order->order_status != 'Delivered')
                                    <button class="updateOrderStatusButton" data-order-id="{{ $order->order_id }}">Mark as Delivered</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div id="pagination" class="pagination"></div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="belfort">
            <!-- Belfort Orders Tab -->
            <div class="row mt-3 mb-3">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total des commandes</h5>
                            <p class="card-text">{{ $belfortOrders->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Sous Total</h5>
                            <p class="card-text">{{ $belfortOdersTotal }} €</p>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Livraison</h5>
                            <p class="card-text">{{ $belfortOrders->where('order_status', 'Delivered')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <input class="form-control" type="text" id="search" placeholder="Recherche par numéro de téléphone client">
                    <table class="table data-tables">
                        <thead>
                            <tr>
                                <th>N ° de commande</th>
                                <th>Téléphone du client</th>
                                <th>Date/heure de la commande</th>
                                <th>Prix total de la</th>
                                <th>temps de livraison estimé</th>
                                <th>Mode de paiement</th>
                                <th>Statut de la</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($belfortOrders->count() == 0)
                            <tr>
                                <td colspan="8" class="text-center">Aucune commande trouvée</td>
                            </tr>
                            @endif
                            @foreach ($belfortOrders as $order)
                            <tr>
                                <td>{{ $order->order_number }}
                                </td>
                                <td>{{ optional($order->user)->phone }}</td>
                                <td>{{ $order->order_date }}<br>{{ $order->order_time }}</td>
                                <td>{{ $order->total_order_price }}</td>
                                <td>{{ $order->estimated_delivery_time }}</td>
                                <td>{{ $order->payment->payment_method ?? '' }}</td>
                                <td>{{ $order->order_status }}</td>
                                <td>
                                    <a href="{{ route('orders.show', ['id' => $order->order_id]) }}">View</a>
                                    @if ($order->order_status != 'Delivered')
                                    <button class="updateOrderStatusButton" data-order-id="{{ $order->order_id }}">Mark as Delivered</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div id="pagination" class="pagination"></div>
                </div>
            </div>
        </div>

    </div>
</section>

<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirm Delivery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to mark this order as delivered?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" id="confirmButton">Yes</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var updateOrderStatusButtons = document.getElementsByClassName('updateOrderStatusButton');
        var csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');

        if (updateOrderStatusButtons && csrfTokenMeta) {
            for (var i = 0; i < updateOrderStatusButtons.length; i++) {
                updateOrderStatusButtons[i].addEventListener('click', function() {
                    var confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                    confirmationModal.show();
                });
            }

            document.getElementById('confirmButton').addEventListener('click', function() {
                var orderId = updateOrderStatusButtons[0].getAttribute('data-order-id');
                var status = 'Delivered';

                console.log(orderId, status);

                fetch('/admin/updateOrderStatus', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfTokenMeta.getAttribute('content')
                    },
                    body: JSON.stringify({
                        orderId: orderId,
                        status: status
                    })
                }).then(function(response) {
                    return response.json();
                }).then(function(data) {
                    window.location.reload();
                }).catch(function(error) {
                    console.error('Error:', error);
                });
            });
        }
    });
</script>


<script>
    document.getElementById('search').addEventListener('input', function(e) {
        var search = e.target.value.toLowerCase();
        var rows = Array.from(document.querySelectorAll('table tbody tr'));
        rows.forEach(row => {
            var subcatName = row.cells[1].textContent.toLowerCase();
            row.style.display = subcatName.includes(search) ? '' : 'none';
        });
    });
</script>
@endsection