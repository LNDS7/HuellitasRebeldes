/*
SQLyog Ultimate v13.1.1 (32 bit)
MySQL - 10.4.17-MariaDB : Database - huellitas
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`huellitas` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `huellitas`;

CREATE TABLE usuario (
    idusuario INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    loginusuario VARCHAR(50) NOT NULL,
    nom_usuario VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    clave VARCHAR(255) NOT NULL,  -- Usa un tamaño mayor para contraseñas hash
    rol TINYINT NOT NULL DEFAULT 0  -- 0: Usuario normal, 1: Administrador, 2: Ayudante
);

INSERT INTO usuario (loginusuario, nom_usuario, email, clave, rol) 
VALUES ('Daniel', 'Nombre Usuario 1', 'usuario1@example.com', '111', 0);

INSERT INTO usuario (loginusuario, nom_usuario, email, clave, rol) 
VALUES ('Leonidas', 'Nombre Admin 1', 'admin1@example.com', '222', 1);

INSERT INTO usuario (loginusuario, nom_usuario, email, clave, rol) 
VALUES ('Chris', 'Nombre Ayudante 1', 'ayudante1@example.com', '333', 2);

/*Table structure for table `cita` */



DROP TABLE IF EXISTS `cita`;

CREATE TABLE `cita` (
  `idCita` INT(11) NOT NULL AUTO_INCREMENT,
  `fecha` DATE NOT NULL,
  `hora` TIME NOT NULL,
  `razonCita` VARCHAR(100) NOT NULL,
  `idMascota` INT(11) DEFAULT NULL,
  `idVeterinario` INT(11) DEFAULT NULL,
  PRIMARY KEY (`idCita`),
  KEY `idMascota` (`idMascota`),
  KEY `idVeterinario` (`idVeterinario`),
  CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`idMascota`) REFERENCES `mascota` (`idMascota`) ON DELETE CASCADE,
  CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`idVeterinario`) REFERENCES `veterinario` (`idVeterinario`) ON DELETE CASCADE
) ENGINE=INNODB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `consulta` */

DROP TABLE IF EXISTS `consulta`;

CREATE TABLE `consulta` (
  `idConsulta` INT(11) NOT NULL AUTO_INCREMENT,
  `fecha` DATE NOT NULL,
  `idCita` INT(11) DEFAULT NULL,
  `descripcion` VARCHAR(800) DEFAULT NULL,
  `observaciones` VARCHAR(500) DEFAULT NULL,
  PRIMARY KEY (`idConsulta`),
  KEY `idCita` (`idCita`),
  CONSTRAINT `consulta_ibfk_1` FOREIGN KEY (`idCita`) REFERENCES `cita` (`idCita`) ON DELETE CASCADE
) ENGINE=INNODB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `diagnostico` */

DROP TABLE IF EXISTS `diagnostico`;

CREATE TABLE `diagnostico` (
  `idDiagnostico` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(500) NOT NULL,
  `idConsulta` INT(11) DEFAULT NULL,
  PRIMARY KEY (`idDiagnostico`),
  KEY `idConsulta` (`idConsulta`),
  CONSTRAINT `diagnostico_ibfk_1` FOREIGN KEY (`idConsulta`) REFERENCES `consulta` (`idConsulta`) ON DELETE CASCADE
) ENGINE=INNODB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `dueno` */

DROP TABLE IF EXISTS `dueno`;

CREATE TABLE `dueno` (
  `idDueno` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `apellido` VARCHAR(100) NOT NULL,
  `direccion` VARCHAR(255) DEFAULT NULL,
  `telefono` VARCHAR(15) DEFAULT NULL,
  `email` VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY (`idDueno`)
) ENGINE=INNODB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `mascota` */

DROP TABLE IF EXISTS `mascota`;

CREATE TABLE `mascota` (
  `idMascota` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `fechaNacimiento` DATE DEFAULT NULL,
  `dificultades` VARCHAR(500) DEFAULT NULL,
  `otraInformacion` VARCHAR(500) DEFAULT NULL,
  `razaAnimal` VARCHAR(500) DEFAULT NULL,
  `tipoAnimal` VARCHAR(500) DEFAULT NULL,
  `idDueno` INT(11) DEFAULT NULL,
  PRIMARY KEY (`idMascota`),
  KEY `idDueno` (`idDueno`),
  CONSTRAINT `mascota_ibfk_1` FOREIGN KEY (`idDueno`) REFERENCES `dueno` (`idDueno`) ON DELETE CASCADE
) ENGINE=INNODB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `usuarios` */

/*Table structure for table `veterinario` */

DROP TABLE IF EXISTS `veterinario`;

CREATE TABLE `veterinario` (
  `idVeterinario` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `apellido` VARCHAR(100) NOT NULL,
  `especialidad` VARCHAR(50) NOT NULL,
  `telefono` VARCHAR(15) DEFAULT NULL,
  `email` VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY (`idVeterinario`)
) ENGINE=INNODB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
