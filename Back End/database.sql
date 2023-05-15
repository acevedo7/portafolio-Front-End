CREATE DATABASE portafoliodb;

CREATE TABLE usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(40) NOT NULL,
    clave VARCHAR(40) NOT NULL,
    imagen varchar(50) NOT NULL,
    curso VARCHAR(50) NOT NULL,
    ciudad VARCHAR(50) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ALTER TABLE usuarios ADD COLUMN imagen varchar(50) NOT NULL;

ALTER TABLE usuarios ADD COLUMN usuario VARCHAR(40) NOT NULL;

CREATE TABLE articulo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    titulo VARCHAR(20) NOT NULL,
    parafo VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE articulo ADD CONSTRAINT fk_usuarios_articulo FOREIGN KEY (id_usuario) REFERENCES usuarios (id);

CREATE TABLE estadistica (
  id INT PRIMARY KEY AUTO_INCREMENT,
  valorhtml INT(11) NOT NULL,
  valorcss INT(11) NOT NULL,
  valorjavascript INT(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;