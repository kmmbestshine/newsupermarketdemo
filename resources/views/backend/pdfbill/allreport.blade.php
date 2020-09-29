<!doctype html>
<html><head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head><body>
<h2 align="center">{{$report_type}} Sales Report From {{$start}} To {{$end}}</h2>
<table border="1" align="center" cellpadding="5">
    <thead>
    <tr>
        <th>S.N.</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Price</th>
        @if($report_type= "Cash And Credit")
         <th>Status</th>
         @endif
        <th>sales By</th>
        <th>sales Date</th>
        <th>Buyer</th>
        <th>Buyer Ph</th>
        <th>Place</th>
        
    </tr>
    </thead>
    <tbody>
    <?php $i=1 ?>
    @foreach($report as $all)
    <tr>
        <td>{{$i++}}</td>
        <td>{{$all->name}}</td>
        <td>{{$all->quantity}}</td>
        <td>{{$all->price}}</td>
        <td>
        @if($report_type= "Cash And Credit" && $all->sales_status == 1)
         Cash
         @else
         Credit
         @endif
         </td>
        <td>{{$all->saller_name}}</td>
        <td>{{$all->created_at}}</td>
        <td>
        @if($all->sales_status == 1)
         -
         @else
         {{$all->customerName}}
         @endif
         </td>
         <td>
        @if($all->sales_status == 1)
         -
         @else
         {{$all->phone_no}}
         @endif
         </td>
         <td>
        @if($all->sales_status == 1)
         -
         @else
         {{$all->address}}
         @endif
         </td>
    </tr>
    @endforeach
    <tr>
        <td colspan="3"> Grand Total </td>
        <td>
            <?php $total=0 ?>
            @if($report)
                @foreach($report as $s)
                    @php
                        $price = $s->price;
                        $total += $price;
                    @endphp
                @endforeach
                Rs. {{$total}}
            @endif
        </td>
        <td></td>
        <td></td>
    </tr>
    </tbody>
</table>
</body></html>


