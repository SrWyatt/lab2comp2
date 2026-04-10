<?php
session_start();
include 'db.php';

if (!isset($_SESSION['u']) || $_SESSION['u']['rol'] != 'admin') { 
    header("Location: index.php"); 
    exit(); 
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $s1 = $pdo->prepare("UPDATE usuarios SET username = ? WHERE id = ?");
        $s1->execute([$_POST['username'], $id]);

        $s2 = $pdo->prepare("UPDATE perfiles SET 
            nombre_completo = ?, 
            direccion = ?, 
            telefono = ?, 
            departamento = ?, 
            cumpleanos = ?, 
            fecha_inicio = ?, 
            fecha_fin = ? 
            WHERE usuario_id = ?");
        
        $s2->execute([
            $_POST['nombre'], 
            $_POST['dir'], 
            $_POST['tel'], 
            $_POST['depto'], 
            $_POST['cumple'], 
            $_POST['f_i'], 
            $_POST['f_f'], 
            $id
        ]);

        header("Location: dashboard.php");
        exit();
    } catch (Exception $e) {
        $error = "Error: " . $e->getMessage();
    }
}

$stmt = $pdo->prepare("SELECT u.username, p.* FROM usuarios u JOIN perfiles p ON u.id = p.usuario_id WHERE u.id = ?");
$stmt->execute([$id]);
$d = $stmt->fetch();

if (!$d) { die("Registro no encontrado."); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Registro</title>
    <style>
        body { background-color: #f8f9fa; color: #333; font-family: 'Segoe UI', Arial, sans-serif; margin: 0; padding: 40px; }
        .container { max-width: 700px; background: #fff; padding: 30px; border-radius: 8px; border: 1px solid #dee2e6; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin: auto; }
        h2 { border-bottom: 2px solid #0056b3; padding-bottom: 10px; color: #0056b3; font-weight: 500; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .full { grid-column: span 2; }
        label { display: block; margin-bottom: 5px; font-weight: 600; font-size: 0.9em; color: #495057; }
        input { width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px; box-sizing: border-box; font-size: 1em; }
        input:focus { border-color: #80bdff; outline: none; }
        .footer { margin-top: 30px; display: flex; justify-content: flex-end; align-items: center; gap: 15px; }
        .btn-save { padding: 10px 25px; background-color: #0056b3; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 1em; }
        .btn-save:hover { background-color: #004494; }
        .btn-cancel { color: #6c757d; text-decoration: none; font-size: 0.9em; }
        .btn-cancel:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="container">
    <h2>Editar Usuario: <?=$d['username']?></h2>
    
    <form method="POST">
        <div class="form-grid">
            <div class="full">
                <label>Nombre de Usuario</label>
                <input name="username" value="<?=$d['username']?>" required>
            </div>

            <div class="full">
                <label>Nombre Completo</label>
                <input name="nombre" value="<?=$d['nombre_completo']?>" required>
            </div>

            <div>
                <label>Teléfono</label>
                <input name="tel" value="<?=$d['telefono']?>">
            </div>

            <div>
                <label>Departamento</label>
                <input name="depto" value="<?=$d['departamento']?>">
            </div>

            <div class="full">
                <label>Dirección</label>
                <input name="dir" value="<?=$d['direccion']?>">
            </div>

            <div>
                <label>Fecha de Nacimiento</label>
                <input type="date" name="cumple" value="<?=$d['cumpleanos']?>">
            </div>

            <div></div>

            <div>
                <label>Fecha Inicio</label>
                <input type="date" name="f_i" value="<?=$d['fecha_inicio']?>">
            </div>

            <div>
                <label>Fecha Fin</label>
                <input type="date" name="f_f" value="<?=$d['fecha_fin']?>">
            </div>
        </div>

        <div class="footer">
            <a href="dashboard.php" class="btn-cancel">Cancelar</a>
            <button type="submit" class="btn-save">Actualizar Datos</button>
        </div>
    </form>
</div>

</body>
</html>
