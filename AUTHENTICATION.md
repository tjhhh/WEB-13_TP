# Todo List Application with Authentication

## Features
- User Registration and Login
- Authentication using Laravel Sanctum
- Protected CRUD operations for tasks
- Only authenticated users can create, read, update, and delete tasks

## Authentication Middleware

This application uses Laravel's built-in `auth` middleware along with Sanctum to ensure that only authenticated users can perform CRUD operations on tasks.

### Protected Routes
All task-related routes are protected by the `auth` middleware:

```php
Route::middleware(['auth'])->group(function () {
    Route::get('/', [TaskController::class, 'index']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit']);
    Route::put('/tasks/{task}', [TaskController::class, 'update']);
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
});
```

### How it Works
1. **Registration**: New users can register at `/register`
2. **Login**: Users login at `/login` 
3. **Authentication Check**: The `auth` middleware checks if the user is authenticated before allowing access to task routes
4. **Redirect**: Unauthenticated users are automatically redirected to the login page
5. **Logout**: Users can logout, which invalidates their session

### Testing Authentication
1. Try accessing the home page without logging in - you'll be redirected to login
2. Register a new account at `/register`
3. Login with your credentials
4. Now you can access all CRUD functionality for tasks
5. Click logout to end your session

## Setup Instructions
1. Install dependencies: `composer install`
2. Configure database in `.env` file
3. Run migrations: `php artisan migrate`
4. Start server: `php artisan serve`
5. Visit `http://127.0.0.1:8000/register` to create an account
