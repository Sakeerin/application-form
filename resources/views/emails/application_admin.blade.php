<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Application Submitted</title>
</head>
<body>
    <h2>New Application Submitted</h2>
    <p>A new application has been submitted.</p>
    <ul>
        <li><strong>Name:</strong> {{ $name }}</li>
        <li><strong>Email:</strong> {{ $email }}</li>
        <li><strong>Position:</strong> {{ $position }}</li>
        <li><strong>Submission date and time:</strong> {{ $datetime }}</li>
    </ul>
    <p>Please review the application in HR System.</p>
    <p>Best regards,<br>HR Apply Online System</p>
</body>
</html>
