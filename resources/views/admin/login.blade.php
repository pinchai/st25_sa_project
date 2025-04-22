{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <title>Login</title>--}}
{{--</head>--}}
{{--<body>--}}
{{--<center>--}}
{{--    <h3>Login to Admin</h3>--}}
{{--    <form action="/do-login" method="post">--}}
{{--        @csrf--}}
{{--        <label for="name">Username</label>--}}
{{--        <input type="text" id="name" name="name">--}}
{{--        <br>--}}
{{--        <br>--}}
{{--        <label for="password">Password</label>--}}
{{--        <input type="password" id="password" name="password">--}}
{{--        <br>--}}
{{--        <br>--}}
{{--        <input type="submit" value="Login" style="width: 100%">--}}
{{--    </form>--}}
{{--</center>--}}
{{--</body>--}}
{{--</html>--}}

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <h2 class="text-center mb-4">Login</h2>
        <form action="/do-login" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Username</label>
                <input
                    type="text"
                    class="form-control"
                    id="name"
                    name="name"
                    placeholder="Enter your username"
                    required
                >
            </div>

            <div class="mb-3">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    class="form-control"
                    name="password"
                    placeholder="Enter your password"
                    required
                >
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>

<!-- Bootstrap JS (optional, only if you need components like modals, toasts, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

