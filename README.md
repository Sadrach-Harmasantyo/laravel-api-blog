# Backend Blog API

## 📌 Introduction

Backend Blog API is a simple REST API that provides **CRUD (Create, Read, Update, Delete)** features for **Post** and **User**. The API uses **API Key Authentication** for secure access. This API is built using **Laravel** and **Filament**.

## 🚀 Tech Stack

-   **Laravel** 11
-   **Filament** 3
-   **MySQL** (Database)
-   **API Key Middleware**

## 🔑 Authentication

This API is protected by **API Key Authentication**. To access the API, you need to provide a valid API Key in the `X-API-KEY` header:

```bash
X-API-KEY: YOUR_API_KEY
```

Without a valid API Key, access will be **denied** with a **401 Unauthorized** status.

## 📂 API Endpoints

### 1️⃣ **User Management**

| Method     | Endpoint          | Description            |
| ---------- | ----------------- | ---------------------- |
| **POST**   | `/api/register`   | Register & get API Key |
| **POST**   | `/api/login`      | Login & get API Key    |
| **GET**    | `/api/users`      | Get all user           |
| **GET**    | `/api/users/{id}` | Get detail user        |
| **PUT**    | `/api/users/{id}` | Update user            |
| **DELETE** | `/api/users/{id}` | Delete user            |

### 2️⃣ **Post Management**

| Method     | Endpoint          | Description     |
| ---------- | ----------------- | --------------- |
| **GET**    | `/api/posts`      | Get all post    |
| **GET**    | `/api/posts/{id}` | Get detail post |
| **POST**   | `/api/posts`      | Create new post |
| **PUT**    | `/api/posts/{id}` | Update post     |
| **DELETE** | `/api/posts/{id}` | Delete post     |

## 🔐 Example Request

### **1️⃣ Register User**

#### Request:

```bash
POST /api/register
```

#### Body:

```json
{
    "name": "test",
    "email": "test@email.com",
    "password": "123123123"
}
```

#### Response:

```json
{
    "success": true,
    "message": "User created successfully",
    "data": {
        "name": "test",
        "email": "test@email.com",
        "api_key": "HDO3H7ZSTG0w8N9aakYNdncrqSinvwQDUYbTLr1IOJO9GTaDXAGMy1R8mGyP",
        "updated_at": "2025-02-17T19:41:20.000000Z",
        "created_at": "2025-02-17T19:41:20.000000Z",
        "id": 8
    }
}
```

### **2️⃣ Login User**

#### Request:

```bash
POST /api/login
```

#### Body:

```json
{
    "email": "random@email.com",
    "password": "123123123"
}
```

#### Response:

```json
{
    "success": true,
    "message": "User logged in successfully",
    "data": {
        "id": 7,
        "name": "user random edit",
        "email": "random@email.com",
        "email_verified_at": null,
        "api_key": "HM2mW5tIRGzhOG9ujT8grF8YCYowV7HO32huv2NLthhQRxkyzIQMYYtjg6qt",
        "created_at": "2025-02-17T19:37:00.000000Z",
        "updated_at": "2025-02-17T20:09:14.000000Z"
    }
}
```

### **3️⃣ Create Post (With API Key)**

#### Request:

```bash
POST /api/posts
```

#### Headers:

```text
X-API-KEY: YOUR_API_KEY
```

#### Body:

```json
{
    "title": "Post",
    "content": "Content",
    "user_id": 7
}
```

#### Response:

```json
{
    "success": true,
    "message": "Post created successfully",
    "data": {
        "id": 9,
        "user_id": 7,
        "title": "Post",
        "content": "Content",
        "created_at": "2025-02-17T20:11:06.000000Z",
        "updated_at": "2025-02-17T20:11:06.000000Z"
    }
}
```

### **4️⃣ Get All Posts (With API Key)**

#### Request:

```bash
GET /api/posts
```

#### Headers:

```text
X-API-KEY: YOUR_API_KEY
```

#### Response:

```json
{
    "success": true,
    "message": "List of posts retrieved successfully",
    "data": [
        {
            "id": 9,
            "user_id": 7,
            "title": "Post",
            "content": "Content",
            "created_at": "2025-02-17T20:11:06.000000Z",
            "updated_at": "2025-02-17T20:11:06.000000Z",
            "user": {
                "id": 7,
                "name": "test",
                "email": "test@email.com",
                "email_verified_at": null,
                "api_key": "random_api_key",
                "created_at": "2025-02-17T19:37:00.000000Z",
                "updated_at": "2025-02-17T20:09:14.000000Z"
            }
        },
        {
            "id": 7,
            "user_id": 2,
            "title": "Youtube Post",
            "content": "Youtube Post Content",
            "created_at": "2025-02-17T18:34:08.000000Z",
            "updated_at": "2025-02-17T18:39:45.000000Z",
            "user": {
                "id": 2,
                "name": "user random edit",
                "email": "random@email.com",
                "email_verified_at": null,
                "api_key": "random_api_key",
                "created_at": "2025-02-17T19:37:00.000000Z",
                "updated_at": "2025-02-17T20:09:14.000000Z"
            }
        }
    ]
}
```

### **5️⃣ Get Detail Post (With API Key)**

#### Request:

```bash
GET /api/posts/{id}
```

#### Headers:

```text
X-API-KEY: YOUR_API_KEY
```

#### Response:

```json
{
    "success": true,
    "message": "Post retrieved successfully",
    "data": {
        "id": 9,
        "user_id": 7,
        "title": "Post",
        "content": "Content",
        "created_at": "2025-02-17T20:11:06.000000Z",
        "updated_at": "2025-02-17T20:11:06.000000Z",
        "user": {
            "id": 7,
            "name": "test",
            "email": "test@email.com",
            "email_verified_at": null,
            "api_key": "random_api_key",
            "created_at": "2025-02-17T19:37:00.000000Z",
            "updated_at": "2025-02-17T20:09:14.000000Z"
        }
    }
}
```

### **6️⃣ Update Post (With API Key)**

#### Request:

```bash
PUT /api/posts/{id}
```

#### Headers:

```text
X-API-KEY: YOUR_API_KEY
```

#### Response:

```json
{
    "success": true,
    "message": "Post updated successfully",
    "data": {
        "id": 7,
        "user_id": 2,
        "title": "Youtube Post",
        "content": "Youtube Post Content",
        "created_at": "2025-02-17T18:34:08.000000Z",
        "updated_at": "2025-02-17T18:39:45.000000Z"
    }
}
```

### **7️⃣ Delete Post (With API Key)**

#### Request:

```bash
DELETE /api/posts/{id}
```

#### Headers:

```text
X-API-KEY: YOUR_API_KEY
```

#### Response:

```json
{
    "success": true,
    "message": "Post deleted successfully",
    "data": []
}
```

### **8️⃣ Get All Users (With API Key)**

#### Request:

```bash
GET /api/users
```

#### Headers:

```text
X-API-KEY: YOUR_API_KEY
```

#### Response:

```json
{
    "success": true,
    "message": "List of users retrieved successfully",
    "data": [
        {
            "id": 7,
            "name": "test",
            "email": "test@email.com",
            "email_verified_at": null,
            "api_key": "random_api_key",
            "created_at": "2025-02-17T19:37:00.000000Z",
            "updated_at": "2025-02-17T20:09:14.000000Z"
        },
        {
            "id": 2,
            "name": "random",
            "email": "random@email.com",
            "email_verified_at": null,
            "api_key": "random_api_key",
            "created_at": "2025-02-17T19:37:00.000000Z",
            "updated_at": "2025-02-17T20:09:14.000000Z"
        }
    ]
}
```

### **9️⃣ Get Detail User (With API Key)**

#### Request:

```bash
GET /api/users/{id}
```

#### Headers:

```text
X-API-KEY: YOUR_API_KEY
```

#### Response:

```json
{
    "success": true,
    "message": "User details retrieved successfully",
    "data": {
        "id": 2,
        "name": "user 2",
        "email": "user2@email.com",
        "email_verified_at": null,
        "api_key": "random_api_key",
        "created_at": "2025-02-17T17:08:55.000000Z",
        "updated_at": "2025-02-17T17:38:21.000000Z",
        "posts": [
            {
                "id": 3,
                "user_id": 2,
                "title": "Post from user 2",
                "content": "Content Post from user 2",
                "created_at": "2025-02-17T17:12:17.000000Z",
                "updated_at": "2025-02-17T17:13:23.000000Z"
            }
        ]
    }
}
```

### **1️⃣0️⃣ Update User (With API Key)**

#### Request:

```bash
PUT /api/users/{id}
```

#### Headers:

```text
X-API-KEY: YOUR_API_KEY
```

#### Response:

```json
{
    "success": true,
    "message": "User updated successfully",
    "data": {
        "id": 7,
        "name": "user random edit",
        "email": "random@email.com",
        "email_verified_at": null,
        "api_key": "random_api_key",
        "created_at": "2025-02-17T19:37:00.000000Z",
        "updated_at": "2025-02-17T20:09:14.000000Z"
    }
}
```

### **1️⃣1️⃣ Delete User (With API Key)**

#### Request:

```bash
DELETE /api/users/{id}
```

#### Headers:

```text
X-API-KEY: YOUR_API_KEY
```

#### Response:

```json
{
    "success": true,
    "message": "User deleted successfully",
    "data": []
}
```

## 🛠 Setup & Installation

### **1️⃣ Clone Repository**

```bash
git clone https://github.com/yourusername/backend-blog.git
cd backend-blog
```

### **2️⃣ Install Dependencies**

```bash
composer install
```

### **3️⃣ Setup Environment**

```bash
cp .env.example .env
php artisan key:generate
```

### **4️⃣ Setup Database**

Edit file `.env`:

```env
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

Run migration:

```bash
php artisan migrate
```

### **5️⃣ Start Server**

```bash
php artisan serve
```

API will be available at `http://127.0.0.1:8000`
