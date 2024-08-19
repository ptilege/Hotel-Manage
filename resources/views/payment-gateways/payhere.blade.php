<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Roomista - Payment Processing...</title>
</head>
<body>
    <img src="{{asset('images/loading_payment.svg')}}" alt="" width="100" style="position: absolute;top:50%;left:50%;transform:translate(-50%,-50%);">
    <form action="https://www.payhere.lk/pay/checkout" method="post" name="paymentSubmit" id="paymentSubmit">
    {{-- <form action="https://sandbox.payhere.lk/pay/checkout" method="post" name="paymentSubmit" id="paymentSubmit"> --}}
        @foreach ($data as $field => $value)
            <input type="hidden" name="{{$field}}" value="{{$value}}">
        @endforeach
        <input type="submit" style="display: none;" value="Buy Now">
    </form>
</body>

<script>
    window.onload=function(){ 
    window.setTimeout(function() { document.paymentSubmit.submit(); }, 5000);
};
</script>
</html>