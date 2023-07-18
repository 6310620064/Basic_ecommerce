<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>    
    <title>Document</title>
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }
        body {
            font-family: "THSarabunNew";
        }
        .pdf_head
        {
            text-align:center;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class ="pdf_head">
        <h1>Order No. {{$order->order_no}} </h1>
    </div>
    <h3>Name : {{$order->user->name}}</h3>
    <h3>Address : {{$order->shipping_address->address}}</h3>
    <h3>Phone : {{substr($order->shipping_address->Phone,0,3) . '-' . substr($order->shipping_address->Phone,3,3). '-' . substr($order->shipping_address->Phone, 6)}}</h3> 
    <h3>Tracking No. : {{$order->tracking_no}}</h3>    
    <h3>Payment Status : {{$order->payment_status}}</h3>      
    <table>
        <thead>
            <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
        </thead>
        <tbody>
            @foreach($items as $items)
            <tr>
                <td>{{$items->product->name}}</td>
                <td>{{number_format($items->price,2)}} ฿</td>
                <td>{{$items->quantity}} </td>
                <td>{{number_format($items->sub_total,2)}} ฿</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="1" style="text-align: center;"><strong>Total Price</strong></td>
                <td colspan="3"><strong> {{number_format($order->total_price,2)}} ฿</strong></td>
            </tr>
        </tfoot>
    </table>


</body>
</html>