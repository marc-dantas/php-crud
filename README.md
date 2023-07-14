# Simple PHP CRUD

## How to use:
- Create a Apache server with PHP installed and a MySQL instance;
- Create a new database called `data`;
- And a table called `users` with the following columns:
    + `username VARCHAR(255) NOT NULL`
    + `passwd VARCHAR(255) NOT NULL`
- Goto `localhost` (Apache) and start at `index.html`.

Final SQL Code:
```sql	
CREATE DATABASE IF NOT EXISTS `data`;
USE `data`;

CREATE TABLE IF NOT EXISTS `users` (
    `username` VARCHAR(255) NOT NULL,
    `passwd` VARCHAR(255) NOT NULL
);
```

## Technologies used:
- [PHP](https://www.php.net/)
- [MySQL](https://www.mysql.com/)
- [Bulma](https://bulma.io/)
