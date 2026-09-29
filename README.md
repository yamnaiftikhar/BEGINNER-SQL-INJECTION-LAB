# BEGINNER-SQL-INJECTION-LAB
A tiny intentionally vulnerable PHP login application for LOCAL classroom training.
Run:
1. Install PHP + SQLite:
   sudo apt update && sudo apt install php php-sqlite3 -y

2. Start the lab:
   cd simple_sqli_lab
   php -S 0.0.0.0:8080

3. Open:
   http://127.0.0.1:8080

Normal login:
   Username: admin
   Password: 1234

SQL injection demonstration:
   Username: ' OR '1'='1'--
   Password: anything

Wireshark:
   Capture the loopback interface (lo) and filter:
   http
   Then submit the login form and inspect the HTTP request.

WARNING:
This application is intentionally vulnerable. Run it only on an isolated/local
training environment and do not expose it to the Internet.
