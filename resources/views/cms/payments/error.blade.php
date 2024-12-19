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
        data-cancel="cancelCallback" data-complete="completeCallback"></script>

    <script>
        function completeCallback(data) {
            alert(data);

        }


        function cancelCallback(data) {
            alert(data);

        }

        function errorCallback(data) {
            alert(data);
        }

        Checkout.configure({
            session: {
                id: '{{ $sessiontId }}'
            }
        });
    </script>
</body>

</html>
