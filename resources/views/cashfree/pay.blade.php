<!DOCTYPE html>
<html>
<head>
    <title>Cashfree Payment</title>
</head>
<body>
    <h3>Redirecting to Cashfree...</h3>

    <form id="cashfreeForm" method="POST" action="{{ $url }}">
        @foreach($postData as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
    </form>

    <script>
        document.getElementById('cashfreeForm').submit();
    </script>
</body>
</html>
