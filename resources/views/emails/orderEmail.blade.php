<!DOCTYPE html>
<html>
<head>
    <title>Commande reçue</title>
</head>
<body>
    <h1>Nouvelle commande reçue</h1>

    <h4>Détails du client</h4>
    <p>Prénom: {{$order->user->first_name ?? ''}}</p>
    <p>Nom de famille: {{$order->user->last_name ?? ''}}</p>
    <p>Email: {{$order->user->email ?? ''}}</p>
    <p>Téléphone: {{$order->user->phone ?? ''}}</p>
    <p>Adresse: {{$order->user->address ?? ''}}</p>
    
    <h4>Commande</h4>
    <p>Numéro de commande: {{ $order->order_number }}</p>
    <p>Date de commande: {{ $order->order_date }}</p>
    <p>Temps de livraison estimé: {{ $order->estimated_delivery_time }}</p>
    <p>Méthode de livraison: {{ $order->delivery_method }}</p>
    <p>Prix total de la commande: {{ $order->total_order_price }}</p>

    <h2>Détails de la commande:</h2>

    @foreach($order->orderDetails as $detail)
        <p>Nom du produit: {{ $detail->product_name }}</p>
        <p>Quantité: {{ $detail->product_qty }}</p>
        <p>Prix: {{ $detail->product_price }}</p>
        <hr>
    @endforeach

    <h4>Détails du paiement</h4>

    <p>ID de paiement: {{ $order->payment->payment_id ?? '' }}</p>
    <p>Montant du paiement: {{ $order->payment->payment_amount ?? '' }}</p>
    <p>Méthode de paiement: {{ $order->payment->payment_method ?? '' }}</p>
    
</body>
</html>