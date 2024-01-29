<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout</title>
</head>

<body>

    <script src="https://sdk.cashfree.com/js/v3/cashfree.js"></script>
    <script>
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
