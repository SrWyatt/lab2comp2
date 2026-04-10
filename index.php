<?php
session_start();
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $s = $pdo->prepare("SELECT * FROM usuarios WHERE username = ? AND password = ?");
    $s->execute([$_POST['u'], $_POST['p']]);
    $u = $s->fetch();
    if ($u) {
        $_SESSION['u'] = $u;
        header("Location: dashboard.php");
        exit();
    } else { $err = "Credenciales inválidas"; }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso al Sistema</title>
    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 350px; border-top: 5px solid #0056b3; }
        h2 { text-align: center; color: #333; margin-bottom: 25px; }
        input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #0056b3; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; margin-top: 10px; }
        button:hover { background: #004494; }
        .error { color: #d93025; font-size: 0.85em; text-align: center; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Iniciar Sesión</h2>
        <?php if(isset($err)) echo "<p class='error'>$err</p>"; ?>
        <form method="POST">
            <input name="u" placeholder="Usuario" required>
            <input name="p" type="password" placeholder="Contraseña" required>
            <button type="submit">Ingresar</button>
        </form>
    </div>
</body>
</html>
