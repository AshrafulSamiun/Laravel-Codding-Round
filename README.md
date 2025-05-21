# Laravel Coding Round

This repository contains a simple Laravel 10 project that demonstrates:
- Blog Post CRUD APIs
- User Registration API
- Task Management APIs

---
## Dependency 
    Laravel 10 requires:

        -PHP ≥ 8.1
        -Composer ≥ 2.0

##  Setup Instructions

1. **Clone the Repository**
   ```bash
   git clone https://github.com/AshrafulSamiun/Laravel-Codding-Round.git
   cd your-repo-name
2. **Run composer install**
3. **Configure .env file **
    Please change  APP_URL=http://localhost to your server url if it host on server url
    Please change the database credential to .env file
    - DB_CONNECTION=mysql
    - DB_HOST=127.0.0.1
    - DB_PORT=3306
    - DB_DATABASE=blog_post
    - DB_USERNAME=your user name
    - DB_PASSWORD=your password here

4. Run migrations: php artisan migrate
5. Serve app: php artisan serve


📚 API Endpoints
📝 Blog Posts

    POST /api/posts – Create a new blog post

    GET /api/posts – Get all blog posts

    GET /api/posts/{id} – Get a single blog post by ID

👤 User Registration

    POST /api/register – Register a new user

✅ Tasks

    POST /api/tasks – Create a new task

    PATCH /api/tasks/{id} – Mark task as completed

    GET /api/tasks/pending – List all pending tasks

    
📁 Folder Structure

    app/Models/ – Eloquent models

    app/Http/Controllers/ – API controllers

    database/migrations/ – Table migration files

    routes/api.php – API route definitions