<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Thanks for posting your prescription!</h1>
    <p>We have updated the Quotation in relation to your prescription. Please read it and verify your prescription.</p>
    <h4>Your prescription Token Number is </h4>
    @foreach ($requestData as $key => $value)
    <p><strong>{{ $value }}</strong> </p>
    @endforeach
    <p>Thank you  joining us!</p>
</body>
</html>
