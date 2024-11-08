## Installation
1.  Clone this repository
	```
	git clone https://github.com/ajrulrn/talentvis-challenge.git
	cd talentvis-challenge
    ```
2.  Install dependencies
    ```
    composer install
    ```
3.  Copy environment variable
	```
	cp .env.example .env
	```
4.  Import SQL
	```
    mysql -u <user> -p <database_name> < app.sql
	```
5.  Run App
    ```
    php -S localhost:8000 -t public
    ```
    
## Credentials
```
username: feon
password: 123456789

// or

username: vira
password: 123456789
```