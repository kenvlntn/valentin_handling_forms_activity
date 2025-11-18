<?php
session_start();

$lockFile = 'active_session.lock';

if (isset($_POST['logout'])) {
    if (file_exists($lockFile)) {
        unlink($lockFile);
    }
    session_unset();
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}


$message = "";
$current_lock_user = "";


if (file_exists($lockFile)) {
    $current_lock_user = file_get_contents($lockFile);
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($current_lock_user) && $current_lock_user !== $username) {
        $message = "$current_lock_user is already logged in. Wait for him to logout to first";
    } else {
        file_put_contents($lockFile, $username);
        
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple Login System</title>
    <style>
        body { font-family: sans-serif; }
        .error { color: black; font-size: 1.2em; }
        input { margin-bottom: 10px; display: block; }
        button { margin-top: 10px; cursor: pointer; }
    </style>
</head>
<body>

    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
        
        
        <form method="post" style="margin-bottom: 20px;">
            <label for="username_logged">Username</label>
            <input type="text" name="username" id="username_logged">
            
            <label for="password_logged">Password</label>
            <input type="password" name="password" id="password_logged">

             <button type="submit" name="login">Login</button>
             <br>
             <button type="submit" name="logout">Logout</button>
        </form>
        
        <?php if ($message): ?>
            <p class="error"><?php echo $message; ?></p>
        <?php endif; ?>

        <h3>User logged in: <?php echo htmlspecialchars($_SESSION['username']); ?></h3>
        
        <h3>Password:</h3>
        <div style="word-break: break-all;">
            <?php echo $_SESSION['password_hash']; ?>
        </div>

    <?php else: ?>

        
        <form method="post">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
            
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>

            <button type="submit" name="login">Login</button>
            <br>
            <button type="submit" name="logout">Logout</button>
        </form>

        <?php if ($message): ?>
            <p class="error"><?php echo $message; ?></p>
        <?php endif; ?>

    <?php endif; ?>

</body>
</html>