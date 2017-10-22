<!-- resources/views/emails/password.blade.php -->
Click here to reset your password: {{ route('canvas.auth.password.reset', $token) }}