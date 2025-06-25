# 📦 FeedbackCenter

A simple Symfony 7 application for collecting feedback and suggestions within a game development studio.

## 📚 Technologies

- PHP 8.3
- Symfony 7
- Docker & Docker Compose
- PostgreSQL
- Adminer
- JWT Authentication (LexikJWTAuthenticationBundle)

## 🚀 Features

- ✅ JWT-based login system (`POST /api/login_check`)
- ✅ API endpoint to fetch currently logged-in user (`GET /api/users/show`)
- ✅ Feedback submission system (WIP)
- ✅ Adminer for database inspection
- ✅ Dockerized setup for easy deployment

---
## 🚀 Running the Project

```bash
# Copy environment configuration
cp .env.dev .env

# Build and start containers
docker compose up --build -d

# Install dependencies
docker compose exec php composer install

# Generate JWT keys
mkdir -p config/jwt
openssl genrsa -out config/jwt/private.pem -aes256 4096
openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem

# Run database migrations
docker compose exec php bin/console doctrine:migrations:migrate

# (Optional) Load fixture data
docker compose exec php bin/console doctrine:fixtures:load
```

---

## 🗂️ Project Structure

- `src/`
  - `Controller/` – API controllers and forms
  - `Entity/` – Doctrine entities
  - `Repository/` – custom entity repositories
- `templates/` – Twig templates (if extended UI is needed)
- `config/` – Symfony and bundle configuration
- `public/` – public entry point (`index.php`)
- `migrations/` – database migration files
- `tests/` – unit and functional tests

---

## 🔐 JWT Authentication

**Login:**
```
POST /api/login_check
{
  "username": "admin@example.com",
  "password": "password"
}
```

**Returns:**
```json
{
  "token": "JWT_TOKEN"
}
```

**Get currently logged-in user:**
```
GET /api/users/show
Authorization: Bearer JWT_TOKEN
```

---

## ✉️ Feedback System (WIP)

Currently under development. Planned features include:

- Submit feedback with description, category, and status
- Assign feedback to users
- Role-based access (author, reviewer, moderator)

---

## 🧪 Testing

Tests are located in the `tests/` directory.

To run tests:
```bash
docker compose exec php ./vendor/bin/phpunit
```

---

## 🧩 Adding New Features

1. Create a new entity:
```bash
docker compose exec php bin/console make:entity
```

2. Create a migration:
```bash
docker compose exec php bin/console make:migration
docker compose exec php bin/console doctrine:migrations:migrate
```

3. Create a controller or endpoint:
```bash
docker compose exec php bin/console make:controller Api/NewFeatureController
```

4. Define routes in `config/routes.yaml` or with PHP attributes.

---

🛠 Work in progress – more features coming soon.
