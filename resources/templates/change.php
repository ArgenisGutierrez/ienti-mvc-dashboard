<!DOCTYPE html>
<html>
<head>
    <title>Solicitud de cambio de contraseña</title>
</head>
<body>
    <h1>Hola <?php echo htmlspecialchars($nombre) ?></h1>
    <p>Para cambiar tu contraseña haz click en el siguiente enlace</p>
    <a href="<?php echo $link ?>">Cambiar mi contraseña</a>
    
    <p>En caso de no haber solicitado un cambio de contraseña, le sugerimos que lo contacte con el administrador y cambie su contraseña por seguridad.</p>
</body>
</html>
