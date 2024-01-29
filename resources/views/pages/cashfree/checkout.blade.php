<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout</title>
</head>

<body>

    <h2>Raiyan {{ $CashfreeEnvironment }}</h2>
    <h2>Memon {{ $payment_session_id }}</h2>

    <script src="https://sdk.cashfree.com/js/v3/cashfree.js"></script>
    <script>
        alert("{{ $payment_session_id }}");
        const cashfree = Cashfree({
            mode: "{{ $CashfreeEnvironment }}" == "Test" ? "sandbox" : "production"
        });
        let checkoutOptions = {
            paymentSessionId: "{{ $payment_session_id }}",
        }
        cashfree.checkout(checkoutOptions)
    </script>
</body>

</html>
