# Laravel 11 JWT Authentication Setup

## Step 1: Install Laravel 11
If you haven't installed Laravel 11 yet, create a new project:

```bash
composer create-project laravel/laravel myapp
cd myapp
```

## Step 2: Install `tymon/jwt-auth` Package
Install the JWT authentication package:

```bash
composer require tymon/jwt-auth
```

## Step 3: Publish the JWT Configuration
Publish the JWT configuration file:

```bash
php artisan vendor:publish --provider="PHPOpenSourceSaver\JWTAuth\Providers\LaravelServiceProvider"
```

This will create the `config/jwt.php` file.

## Step 4: Generate JWT Secret Key
Run the following command to generate the JWT secret key:

```bash
php artisan jwt:secret
```

This will update your `.env` file with a new secret:

```
JWT_SECRET=your_generated_secret_key
```

## Step 5: Configure Authentication Guards
Edit `config/auth.php` and update the `guards` section:

```php
'guards' => [
    'api' => [
        'driver' => 'jwt',
        'provider' => 'users',
    ],
],
```

## Step 6: Modify `User.php` Model
Add the `JWTSubject` interface and required methods:

```php
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    // Add the required methods
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
```

## Step 7: Create Authentication Controller
Generate the AuthController:

```bash
php artisan make:controller AuthController
```

Then, implement authentication methods:

```php
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // Register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User created successfully']);
    }

    // Login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['token' => $token]);
    }

    // Get Authenticated User
    public function me()
    {
        return response()->json(Auth::user());
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    // Refresh Token
    public function refresh()
    {
        return response()->json([
            'token' => JWTAuth::refresh()
        ]);
    }
}
```

## Step 8: Define API Routes
Edit `routes/api.php`:

```php
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});
```

## Step 9: Test JWT Authentication
Use **Postman** or **cURL** to test authentication:

### 1. Register a User
`POST http://127.0.0.1:8000/api/register`

```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password"
}
```

### 2. Login
`POST http://127.0.0.1:8000/api/login`

```json
{
    "email": "john@example.com",
    "password": "password"
}
```

Response:

```json
{
    "token": "your_jwt_token"
}
```

### 3. Access Protected Route (`me`)
`GET http://127.0.0.1:8000/api/me`

Add this header:

```
Authorization: Bearer your_jwt_token
```

### 4. Logout
`POST http://127.0.0.1:8000/api/logout`

### 5. Refresh Token
`POST http://127.0.0.1:8000/api/refresh`

## Step 10: Final Setup
- Ensure `.env` has the correct configurations:

  ```
  JWT_SECRET=your_secret_key
  ```

- Run migrations if necessary:

  ```bash
  php artisan migrate
  ```

- Start Laravel’s built-in server:

  ```bash
  php artisan serve
  ```

## Done!
Now your Laravel 11 project is set up with JWT authentication. 🚀
