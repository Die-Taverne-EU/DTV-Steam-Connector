# Docker Deployment Guide for Dockerized Laravel 12 Starter

This guide will help you deploy the Dockerized Laravel 12 Starter application using Docker. The application consists of a Laravel backend, React frontend, MySQL database, and Redis server, all running in separate containers.

## Prerequisites

- Docker installed on your machine
- Docker Compose installed on your machine
- Git (optional, for cloning the repository)

## Setup Steps

1. **Clone or create the project**

   Either clone the repository

2. **Set up environment variables**

   ```bash
   cp .env.example .env
   ```

   Then edit `.env` to set your desired database credentials and Pusher API keys.

3. **Build and start the containers**

   ```bash
   docker-compose up -d
   ```

4. **Install JavaScript dependencies and build assets**

   ```bash
   docker-compose exec app npm install
   docker-compose exec app npm run dev
   ```
## Accessing the Application

Once all containers are up and running, you can access the application at:

```
http://localhost:8080
```

## Container Management

- **Start containers**
  ```bash
  docker-compose up -d
  ```

- **Stop containers**
  ```bash
  docker-compose down
  ```

- **View logs**
  ```bash
  docker-compose logs -f
  ```

- **Access a container shell**
  ```bash
  docker-compose exec app bash
  ```

## Scheduled Tasks

To ensure the cleaning of expired boards, set up a cron job to run the scheduler:

```bash
docker-compose exec app php artisan schedule:run
```

For production, you might want to add this to your server's crontab:

```
* * * * * docker-compose -f /path/to/docker-compose.yml exec -T app php artisan schedule:run >> /dev/null 2>&1
```

## Real-time Updates

This application uses Pusher for real-time updates. Make sure to:

1. Create a Pusher account at [https://pusher.com/](https://pusher.com/)
2. Get your App ID, Key, Secret, and Cluster
3. Update your `.env` file with these credentials

## Scaling the Application

For production environments, consider:

1. Using a reverse proxy like Traefik or Nginx Proxy Manager
2. Implementing SSL certificates for secure connections
3. Setting up proper monitoring for your containers
4. Configuring backups for your database volume

## Troubleshooting

- **Database connection issues**
  Make sure the database container is running and the credentials in the `.env` file are correct.

- **File permission issues**
  If you encounter permission issues, ensure the proper ownership of directories:
  ```bash
  docker-compose exec app chown -R www-data:www-data /var/www/html/storage
  ```

- **WebSocket connection errors**
  Verify your Pusher credentials and make sure ports are not blocked by firewalls.
