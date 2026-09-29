<?php
// INTENTIONALLY VULNERABLE - FOR LOCAL CLASSROOM TRAINING ONLY
$db = new SQLite3(__DIR__ . '/lab.db');

$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT,
    password TEXT
)");

$count = $db->querySingle("SELECT COUNT(*) FROM users");
if ($count == 0) {
    $db->exec("INSERT INTO users (username,password) VALUES ('admin','1234')");
    $db->exec("INSERT INTO users (username,password) VALUES ('student','student123')");
}

$message = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Deliberately unsafe SQL concatenation for the lab.
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $db->query($query);

    if ($result && $result->fetchArray(SQLITE3_ASSOC)) {
        $message = "Login successful!";
    } else {
        $message = "Invalid username or password.";
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Beginner SQL Injection Lab</title>
<style>
body { font-family: Arial; margin: 60px; max-width: 600px; }
input { padding: 8px; margin: 5px 0; width: 280px; }
button { padding: 8px 18px; }
.box { padding: 15px; border: 1px solid #aaa; margin-top: 20px; }
</style>
</head>
<body>
<h1>Beginner SQL Injection Lab</h1>
<p>Local classroom training application.</p>

<form method="post">
    <label>Username</label><br>
    <input name="username" placeholder="admin"><br>
    <label>Password</label><br>
    <input name="password" type="text" placeholder="1234"><br>
    <button name="login">Login</button>
</form>

<?php if ($message): ?>
<div class="box"><strong><?= htmlspecialchars($message) ?></strong></div>
<?php endif; ?>

<div class="box">
<strong>Normal test:</strong><br>
Username: admin<br>
Password: 1234
</div>
</body>
</html>
