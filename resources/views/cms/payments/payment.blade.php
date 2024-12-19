<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Photome</title>
</head>

<body>
    <script src="https://test-gateway.mastercard.com/static/checkout/checkout.min.js" data-error="errorCallback"
        data-cancel="cancelCallback" data-complete="completeCallback" data-afterRedirect="afterRedirectCallback"></script>

    <script>
        function afterRedirectCallback(data) {
            console.log(data);
        }

        function completeCallback(data) {
            console.log(data);

        }


        function cancelCallback(data) {
            console.log(data);


        }

        function errorCallback(data) {
            console.log(data);

        }

        Checkout.configure({
            session: {
                id: '{{ $data }}'
            }
        });

        Checkout.showPaymentPage();
    </script>

</body>

</html>
