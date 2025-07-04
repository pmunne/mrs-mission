# Mars Rover Mission

This project is a technical project to simulate the control of a rover space veichle in a expediton.
Translates a sequence of commands into rover instructions on a 200x200 board. 

---

## Technologies used

- PHP 8.4
- Laravel 12
- Docker (PHP, MYSQL, NGINX)
- PHPUnit (unit + feature testing)

The .env will not be in the git ignore to secure proper functionality. 

---

## Features 

### Backend
- Move the rover typing (f, r, l)
- Obstacle detection
- Api enpoint logic
- Board wrapping on edges
- Input validation
- Tested with PHP unit

### Frontend
- Mission configuration to start from (initial position, direction, obstacles and command string)
- Dynamic rover grid: 
    - Rover Path
    - Obstacles 
- Command input
- Reset mission


## Installation guide

```bash 
git clone https://github.com/pmunne/mrs-mission.git
cd mrs-mission
docker-compose up -d --build
cd ./frontend
npm install
npm run build
```

## Access
frontend:
```bash 
http://localhost:8080
```
backend endpoint:
```bash 
http://localhost:8080/api/rover/start
```

## Testing
```bash
docker exec -it mrs-mission-php bash
php artisan test 
```



---

## Author 
Pau Munné Martínez 