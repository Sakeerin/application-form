<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Application Received</title>
</head>
<body>
    <h2>Thank you for your application!</h2>
    <p>Dear {{ $name }},</p>
    <p>We have received your application for the position: <strong>{{ $position }}</strong>.</p>
    <p>Submission date and time: {{ $datetime }}</p>
    <p>We will review your information and contact you soon.</p>
    <br>
    <p>Best regards,<br>Vbeyond Developments Public Company Limited</p>
</body>
</html>
