<?php
session_start();
include 'db.php';
if (!isset($_SESSION['u'])) { header("Location: index.php"); exit(); }
$u = $_SESSION['u'];

if ($u['rol'] == 'admin' && isset($_GET['del'])) {
    $pdo->prepare("DELETE FROM usuarios WHERE id = ?")->execute([$_GET['del']]);
    header("Location: dashboard.php");
    exit();
}

if ($_POST && isset($_POST['nuevo_user']) && $u['rol'] == 'admin') {
    $pdo->prepare("INSERT INTO usuarios (username, password, rol) VALUES (?, '123456', 'user')")->execute([$_POST['username']]);
    $uid = $pdo->lastInsertId();
    $pdo->prepare("INSERT INTO perfiles (usuario_id, nombre_completo, departamento, telefono) VALUES (?, ?, ?, ?)")
        ->execute([$uid, $_POST['nombre'], $_POST['depto'], $_POST['tel']]);
}

$sql = ($u['rol'] == 'admin') 
    ? "SELECT u.id, u.username, u.rol, p.* FROM usuarios u JOIN perfiles p ON u.id = p.usuario_id" 
    : "SELECT u.id, u.username, u.rol, p.* FROM usuarios u JOIN perfiles p ON u.id = p.usuario_id WHERE u.id = ".$u['id'];
$res = $pdo->query($sql)->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Administrativo</title>
    <style>
        body { background: #f8f9fa; color: #333; font-family: 'Segoe UI', sans-serif; margin: 0; padding: 20px; }
        header { background: #fff; padding: 15px 30px; border-bottom: 1px solid #dee2e6; display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .btn { padding: 8px 16px; text-decoration: none; border-radius: 4px; font-size: 0.9em; transition: 0.2s; }
        .btn-edit { border: 1px solid #0056b3; color: #0056b3; }
        .btn-edit:hover { background: #0056b3; color: #fff; }
        .btn-del { border: 1px solid #dc3545; color: #dc3545; margin-left: 5px; }
        .btn-del:hover { background: #dc3545; color: #fff; }
        .btn-logout { background: #6c757d; color: #fff; }
        
        .container { max-width: 1200px; margin: auto; }
        .card { background: #fff; padding: 20px; border-radius: 8px; border: 1px solid #dee2e6; margin-bottom: 30px; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background: #f1f3f5; padding: 12px; text-align: left; font-size: 0.85em; color: #495057; border-bottom: 2px solid #dee2e6; }
        td { padding: 12px; border-bottom: 1px solid #eee; font-size: 0.95em; }
        tr:hover { background: #fcfcfc; }
        
        input { padding: 8px; border: 1px solid #ddd; border-radius: 4px; margin-right: 5px; }
        .form-add { display: flex; gap: 10px; align-items: center; }
        .badge { background: #e7f1ff; color: #0056b3; padding: 2px 8px; border-radius: 12px; font-size: 0.8em; font-weight: bold; }
    </style>
</head>
<body>

<header>
    <h2 style="margin:0; font-weight: 500;">Gestión de Usuarios</h2>
    <div>
        <span style="margin-right: 20px;">Sesión: <strong><?=$u['username']?></strong> (<?=ucfirst($u['rol'])?>)</span>
        <a href="logout.php" class="btn btn-logout">Cerrar Sesión</a>
    </div>
</header>

<div class="container">
    <?php if($u['rol'] == 'admin'): ?>
        <div class="card">
            <h4 style="margin-top:0">Añadir Nuevo Registro</h4>
            <form method="POST" class="form-add">
                <input name="username" placeholder="Usuario" required>
                <input name="nombre" placeholder="Nombre completo" required>
                <input name="depto" placeholder="Departamento" required>
                <input name="tel" placeholder="Teléfono">
                <button name="nuevo_user" class="btn" style="background:#28a745; color:white; border:none; cursor:pointer;">Registrar</button>
            </form>
        </div>
    <?php endif; ?>

    <div class="card" style="padding:0">
        <table>
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Departamento</th>
                    <th>Teléfono</th>
                    <th>Fin de Contrato</th>
                    <?php if($u['rol'] == 'admin') echo "<th>Operaciones</th>"; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach($res as $r): ?>
                <tr>
                    <td><span class="badge"><?=$r['username']?></span></td>
                    <td><?=$r['nombre_completo']?></td>
                    <td><?=$r['departamento']?></td>
                    <td><?=$r['telefono']?></td>
                    <td><?=$r['fecha_fin']?></td>
                    <?php if($u['rol'] == 'admin'): ?>
                        <td>
                            <a href="editar.php?id=<?=$r['usuario_id']?>" class="btn btn-edit">Editar</a>
                            <?php if($r['username'] != 'admin'): ?>
                                <a href="?del=<?=$r['usuario_id']?>" class="btn btn-del" onclick="return confirm('¿Eliminar registro?')">Borrar</a>
                            <?php endif; ?>
                        </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
