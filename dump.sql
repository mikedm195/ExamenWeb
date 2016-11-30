CREATE TABLE exf_cliente (
    id_cliente int not null AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(20) not null,
    apPaterno varchar(20) not null,
    apMaterno varchar(20) not null,
    foto varchar(50),
    telefono varchar(20),
    membresia varchar(20)
);

CREATE TABLE exf_producto (
    id_producto int not null AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(20) not null,
    descripcion varchar(50) not null,
    foto varchar(50),
    cantidad int not null,
    precio float not null,
    impuesto int not null
);

CREATE TABLE exf_tienda (
    id_tienda int not null AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(20) not null,
    ubicacion varchar(50) not null,
    foto varchar(50),
    propietario int not null,
    telefono float not null
);

CREATE TABLE exf_promocion (
    id_promocion int not null AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(20) not null,
    fechaInicio Date not null,
    fechaFin Date not null,
    promocionMiembro int,
    promocionNoMiembro int
);

CREATE TABLE exf_tienda_producto (
    id_tienda_producto int not null AUTO_INCREMENT PRIMARY KEY,
    id_tienda int not null,
    id_producto int not null,
    FOREIGN KEY (id_tienda)
      REFERENCES exf_tienda(id_tienda)
      ON DELETE CASCADE,
    FOREIGN KEY (id_producto)
      REFERENCES exf_producto(id_producto)
      ON DELETE CASCADE
);

CREATE TABLE exf_reporte (
    id_reporte int not null AUTO_INCREMENT PRIMARY KEY,
    id_tienda_producto int not null,
    FOREIGN KEY (id_tienda_producto)
      REFERENCES exf_tienda_producto(id_tienda_producto)
      ON DELETE CASCADE
);

