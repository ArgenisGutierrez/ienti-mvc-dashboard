-- Tabla de roles
CREATE TABLE roles (
  id_rol INT (11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre_rol VARCHAR (255) NOT NULL UNIQUE KEY,

  fyh_creacion DATETIME NULL,
  fyh_modificacion DATETIME NULL,
  estado VARCHAR (11)
)ENGINE=InnoDB;


INSERT INTO roles (
  nombre_rol,fyh_creacion,estado
) VALUES ( 
'ADMINISTRADOR','2025-03-16 23:52:02','1'
);

INSERT INTO roles (
  nombre_rol,fyh_creacion,estado
) VALUES ( 
'USUARIO','2025-03-16 23:52:02','1'
);

-- Tabla Usuarios
CREATE TABLE usuarios (
  id_usuario INT (11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre_usuario VARCHAR (255) NOT NULL UNIQUE KEY,
  id_rol INT NOT NULL ,
  verification_token VARCHAR(255),
  email_usuario VARCHAR(255) NOT NULL UNIQUE KEY,
  password_usuario TEXT NOT NULL,

  fyh_creacion DATETIME NULL,
  fyh_modificacion DATETIME NULL,
  estado VARCHAR (11),
  FOREIGN KEY(id_rol) REFERENCES roles(id_rol) on delete restrict on update cascade
)ENGINE=InnoDB;

INSERT INTO usuarios (
  nombre_usuario,id_rol,email_usuario,password_usuario,fyh_creacion,estado
) VALUES ( 
  'ientiadmin','1','admin@ienti.com.mx','$2y$10$BXuu1n9/MFOyETHgaS06C.V7IUKxglyGXyspBKpX1xYpx7dSS0QsW','2025-03-16 15:21:55','1'
);

-- Tabla Recursos
CREATE TABLE recursos (
  id_recurso INT (11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  descripcion_recurso VARCHAR (255) NOT NULL,
  clasificacion_recurso VARCHAR (255) NOT NULL,
  tipo_recurso VARCHAR (255) NOT NULL,
  contenido_recurso VARCHAR (255) NOT NULL,

  fyh_creacion DATETIME NULL,
  fyh_modificacion DATETIME NULL,
  estado VARCHAR (11)
)ENGINE=InnoDB;
);
