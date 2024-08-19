
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset your Roomista password</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">

<div style="max-width: 600px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <div style="text-align: center; background-color: #00427F; padding: 10px; border-radius: 10px;">
        <img src="https://roomista.com/images/logo.png" alt="Roomista Logo" style="max-width: 150px;">
    </div>
    <h1 style="text-align: center; color: #333;">Reset your Roomista password</h1>
    <p style="text-align: center; color: #555;">Don't worry, we've got you covered! To reset your password, simply click the button below:</p>
    <div style="text-align: center; margin-top: 20px;">
        <a href="{{ route('forget-password-link', ['token' => $token]) }}" style="background-color: #4CAF50; color: white; padding: 12px 20px; text-align: center; text-decoration: none; display: inline-block; border-radius: 4px; font-weight: bold;">Reset Password</a>
    </div>
    <p style="text-align: center; margin-top: 20px; color: #555;">If you did not request a password reset, please ignore this email.</p>
    <div class="mt-5">
        <p style="color: #555;">Thanks,<br>
The Roomista Team</p>
    </div>
</div>

</body>
</html>

