<!DOCTYPE html>
<html>
<head>
    <title>Confirmación de cuenta</title>
</head>
<body>
    <h1>Hola <?php echo htmlspecialchars($nombre) ?></h1>
    <p>Por favor confirma tu cuenta haciendo clic en el siguiente enlace:</p>
    <a href="<?php echo $link ?>">Confirmar cuenta</a>
</body>
</html>
