CREATE DATABASE geopagos_exm1;
USE geopagos_exm1;

CREATE TABLE usuarios (
  codigousuario int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  usuario varchar(100) NOT NULL,
  clave varchar(100) NOT NULL,
  edad int(11) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE favoritos ( 
	codigousuario INT NOT NULL , 
	codigousuariofavorito INT NOT NULL 
) ENGINE = InnoDB;

CREATE TABLE pagos ( 
	codigopago INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
	importe DECIMAL(10,5) NOT NULL DEFAULT '0.00' ,
	fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP 
) ENGINE = InnoDB;

CREATE TABLE usuariospagos ( 
	codigopago INT NOT NULL , 
	codigousuario INT NOT NULL 
) ENGINE = InnoDB;