-- Tabla de roles
CREATE TABLE roles (
  id_rol INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre_rol VARCHAR(255) NOT NULL UNIQUE KEY,
  fyh_creacion DATETIME NULL,
  fyh_modificacion DATETIME NULL,
  estado VARCHAR(11)
) ENGINE = InnoDB;

INSERT INTO
  roles (nombre_rol, fyh_creacion, estado)
VALUES
  ('ADMINISTRADOR', '2025-03-16 23:52:02', '1');

INSERT INTO
  roles (nombre_rol, fyh_creacion, estado)
VALUES
  ('USUARIO', '2025-03-16 23:52:02', '1');

-- Tabla Usuarios
CREATE TABLE usuarios (
  id_usuario INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre_usuario VARCHAR(255) NOT NULL UNIQUE KEY,
  id_rol INT NOT NULL,
  verification_token VARCHAR(255),
  email_usuario VARCHAR(255) NOT NULL UNIQUE KEY,
  password_usuario TEXT NOT NULL,
  imagen_usuario VARCHAR(255),
  fyh_creacion DATETIME NULL,
  fyh_modificacion DATETIME NULL,
  estado VARCHAR(11),
  FOREIGN KEY (id_rol) REFERENCES roles (id_rol) on delete restrict on update cascade
) ENGINE = InnoDB;

INSERT INTO
  usuarios (
    nombre_usuario,
    id_rol,
    email_usuario,
    password_usuario,
    fyh_creacion,
    estado
  )
VALUES
  (
    'ientiadmin',
    '1',
    'admin@ienti.com.mx',
    '$2y$10$BXuu1n9/MFOyETHgaS06C.V7IUKxglyGXyspBKpX1xYpx7dSS0QsW',
    '2025-03-16 15:21:55',
    '1'
  );

-- Tabla Categorias
CREATE TABLE categorias (
  id_categoria INT PRIMARY KEY AUTO_INCREMENT,
  nombre_categoria VARCHAR(255) NOT NULL
);

-- Tabla Subcategorias
CREATE TABLE subcategorias (
  id_subcategoria INT PRIMARY KEY AUTO_INCREMENT,
  nombre_subcategoria VARCHAR(255) NOT NULL,
  id_categoria INT NOT NULL,
  FOREIGN KEY (id_categoria) REFERENCES categorias (id_categoria)
);

-- Tabla Recursos
CREATE TABLE recursos (
  id_recurso INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  descripcion_recurso VARCHAR(255) NOT NULL,
  tipo_recurso VARCHAR(255) NOT NULL,
  contenido_recurso VARCHAR(255) NOT NULL,
  fyh_creacion DATETIME NULL,
  fyh_modificacion DATETIME NULL,
  estado VARCHAR(11),
  id_subcategoria INT NOT NULL,
  FOREIGN KEY (id_subcategoria) REFERENCES subcategorias (id_subcategoria)
) ENGINE = InnoDB;

-- Tabla de permisos
CREATE TABLE permisos (
  id_permiso INT PRIMARY KEY AUTO_INCREMENT,
  nombre_permiso VARCHAR(255) UNIQUE NOT NULL,
  descripcion_permiso VARCHAR(255)
);

-- Tabla intermedia roles-permisos
CREATE TABLE role_permiso (
  id_rol INT,
  id_permiso INT,
  PRIMARY KEY (id_rol, id_permiso),
  FOREIGN KEY (id_rol) REFERENCES roles (id_rol),
  FOREIGN KEY (id_permiso) REFERENCES permisos (id_permiso)
);

-- Permisos para Usuarios
INSERT INTO
  permisos (nombre_permiso, descripcion_permiso)
VALUES
  (
    'Crear Usuarios',
    'Permite registrar nuevos usuarios en el sistema'
  ),
  (
    'Ver Usuarios',
    'Permite ver la lista de usuarios y sus detalles'
  ),
  (
    'Editar Usuarios',
    'Permite acceder a la interfaz de edición de usuarios'
  ),
  (
    'Eliminar Usuarios',
    'Permite eliminar un usuario permanentemente'
  );

-- Permisos para Roles
INSERT INTO
  permisos (nombre_permiso, descripcion_permiso)
VALUES
  (
    'Crear Roles',
    'Permite definir nuevos roles en el sistema'
  ),
  (
    'Ver Roles',
    'Permite ver la lista de roles y sus configuraciones'
  ),
  (
    'Editar Roles',
    'Permite modificar permisos asociados a un rol'
  ),
  (
    'Eliminar Roles',
    'Permite eliminar un rol del sistema'
  );

-- Permisos para Recursos
INSERT INTO
  permisos (nombre_permiso, descripcion_permiso)
VALUES
  (
    'Crear Recursos',
    'Permite agregar nuevos recursos al sistema'
  ),
  (
    'Ver Recursos',
    'Permite ver recursos disponibles en el sistema'
  ),
  (
    'Editar Recursos',
    'Permite acceder a la edición de un recurso'
  ),
  (
    'Eliminar Recursos',
    'Permite eliminar un recurso permanentemente'
  );

-- Permisos para Categorias
INSERT INTO
  permisos (nombre_permiso, descripcion_permiso)
VALUES
  (
    'Crear Categorias',
    'Permite agregar nuevas categorias al sistema'
  ),
  (
    'Ver Categorias',
    'Permite ver categorias disponibles en el sistema'
  ),
  (
    'Editar Categorias',
    'Permite acceder a la edición de una categorias'
  ),
  (
    'Eliminar Categorias',
    'Permite eliminar una categorias permanentemente'
  );

-- Permisos para ADMINISTRADOR
INSERT INTO
  role_permiso (id_rol, id_permiso)
VALUES
  (1, 1),
  (1, 2),
  (1, 3),
  (1, 4),
  (1, 5),
  (1, 6),
  (1, 7),
  (1, 8),
  (1, 9),
  (1, 10),
  (1, 11),
  (1, 12),
  (1, 13),
  (1, 14),
  (1, 15),
  (1, 16);
