<body>
A request has recently been made to change your password.

<a href="{{ route('blog::user.editPassword', ['id' => $id, 'token' => $code]) }}" alt="Password Reset Link" title="Password Reset Link">Password Reset Link</a>
</body>