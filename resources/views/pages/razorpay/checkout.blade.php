<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout</title>
</head>

<body>



    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var options = {
            "key": "{{ env('RAZORPAY_KEY') }}", // Enter the Key ID generated from the Dashboard
            "currency": "INR",
            "name": "Glosense", //your business name
            // "description": "Test Transaction",
            // "image": "{{ asset('images/logo/logo.png') }}",
            "order_id": "{{ $rzrOdId }}",
            "callback_url": "{{ route('razorpay.callback') }}?order_id=" + "{{ $orderId }}",
            "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
                "name": "{{ $userName ?? '' }}", //your customer's name
                "email": "{{ $userEmail ?? '' }}",
                "contact": "{{ $userNumber ?? '' }}", //Provide the customer's phone number for better conversion rates 
            },
            // "notes": {
            //     "address": "Razorpay Corporate Office"
            // },
            "theme": {
                "color": "#00546a"
            }
        };

        callRazorpay(options)

        function callRazorpay(options) {
            var rzp1 = new Razorpay(options);
            rzp1.open();
        }
    </script>
</body>

</html>
