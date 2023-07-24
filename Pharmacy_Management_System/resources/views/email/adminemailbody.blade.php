<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Quotation States</h1>
    <p>User have updated the Quotation States. Please check it Quotation.</p>
    @foreach ($requestData as $key => $value)
    <p>{{ $key }}:<strong>{{ $value }}</strong></p>
    @endforeach
    <p>Thank you !</p>
</body>
</html>
