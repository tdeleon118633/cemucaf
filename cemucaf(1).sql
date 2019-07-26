-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 08-11-2018 a las 07:04:01
-- Versión del servidor: 5.7.19
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cemucaf`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso`
--

DROP TABLE IF EXISTS `acceso`;
CREATE TABLE IF NOT EXISTS `acceso` (
  `acceso` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `modulo` int(5) UNSIGNED NOT NULL COMMENT 'MODULO AL QUE PERTENECE EL ACCESO',
  `codigo` varchar(25) NOT NULL COMMENT 'CODIGO PARA IDENTIFICAR EN PROGRAMACION A QUIEN PERTENECE',
  `orden` int(5) UNSIGNED NOT NULL COMMENT 'INDICA EN QUÉ ORDEN SE QUIERE MOSTRAR EN EL MENÚ',
  `acceso_pertenece` int(10) UNSIGNED DEFAULT NULL COMMENT 'ACCESO PADRE AL QUE PERTENECE EL ACCESO',
  `path` varchar(150) DEFAULT NULL COMMENT 'PATH DE A DONDE SE DIRIGE EN EL MENU',
  `publico` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT 'INDICA SI ES PUBLICO O NO EL ACCESO',
  `privado` enum('Y','N') NOT NULL DEFAULT 'Y' COMMENT 'INDICA SI SALE EN EL MENÚ YA QUE ESTÁ LOGINEADO',
  `activo` enum('Y','N') NOT NULL DEFAULT 'Y' COMMENT 'DETERMINA SI ESTÁ ACTIVO O NO',
  `add_user` int(11) NOT NULL COMMENT 'USUARIO QUE HIZO EL REGISTRÓ ',
  `add_fecha` datetime NOT NULL COMMENT 'FECHA QUE SE HIZO EL REGISTRO',
  `mod_user` int(11) DEFAULT NULL COMMENT 'USUARIO QUE MODIFICO EL REGISTRO',
  `mod_fecha` datetime DEFAULT NULL COMMENT 'FECHA QUE SE HIZO LA MODIFICACIÓN',
  PRIMARY KEY (`acceso`),
  UNIQUE KEY `acceso_codigo` (`modulo`,`codigo`),
  KEY `acceso_mod_i` (`modulo`),
  KEY `acceso_acc_per_i` (`acceso_pertenece`),
  KEY `acceso_pub_i` (`publico`),
  KEY `acceso_pri_i` (`privado`),
  KEY `acceso_act_i` (`activo`),
  KEY `acceso_add_use_i` (`add_user`),
  KEY `acceso_mod_use_i` (`mod_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='TABLA DE ACCESOS DE TODAS LAS PANTALLAS DEL SITIO';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

DROP TABLE IF EXISTS `alumno`;
CREATE TABLE IF NOT EXISTS `alumno` (
  `alumno` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(70) NOT NULL,
  `apellidos` varchar(70) NOT NULL,
  `identificacion` varchar(30) NOT NULL,
  `edad` int(50) DEFAULT NULL,
  `genero` enum('F','M') DEFAULT NULL,
  `grupo_etnico` smallint(5) UNSIGNED DEFAULT NULL,
  `idioma_materno` smallint(5) UNSIGNED DEFAULT NULL,
  `estado_civil` enum('soltero','casado') DEFAULT NULL,
  `profesion_oficio` varchar(255) NOT NULL,
  `telefono` int(12) NOT NULL,
  `correo_electronico` varchar(75) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `municipio` smallint(5) UNSIGNED DEFAULT NULL,
  `departamento` smallint(5) UNSIGNED DEFAULT NULL,
  `area_geografica` enum('U','R') DEFAULT 'U' COMMENT 'U=URBANA, R=RURAL',
  `trabaja_actualmente` enum('Y','N') DEFAULT 'Y',
  `discapasidad` enum('V','F','D','M','A','N') DEFAULT 'N' COMMENT 'V = VISUAL, F = FISICA, D = DEL HABLA, M = MULTIPLE, A = AUDITIVA, N = NINGUNA',
  `imagen_alumno_path` text COMMENT 'PATH DE ALUMNO',
  `fecha_incripcion` date DEFAULT NULL,
  `programa` enum('PEAC','NUFED','MODALIDADES_FLEXIBLES','CEMUCAF') DEFAULT NULL,
  `modalidad` enum('PRESENCIAL','SEMIPRESENCIAL','A_DISTANCIA') DEFAULT NULL,
  `activo` enum('Y','N') DEFAULT 'Y' COMMENT 'INDICA SI ESTA ACTIVO',
  `add_user` int(11) DEFAULT NULL,
  `add_fecha` datetime DEFAULT NULL,
  `mod_user` int(11) DEFAULT NULL,
  `mod_fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`alumno`),
  KEY `alumno_add_use_f` (`add_user`),
  KEY `alumno_mod_use_f` (`mod_user`),
  KEY `alumno_gru_etn_f` (`grupo_etnico`),
  KEY `alumno_idi_mat_f` (`idioma_materno`),
  KEY `alumno_dep_f` (`departamento`),
  KEY `alumno_mun_f` (`municipio`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`alumno`, `nombres`, `apellidos`, `identificacion`, `edad`, `genero`, `grupo_etnico`, `idioma_materno`, `estado_civil`, `profesion_oficio`, `telefono`, `correo_electronico`, `direccion`, `municipio`, `departamento`, `area_geografica`, `trabaja_actualmente`, `discapasidad`, `imagen_alumno_path`, `fecha_incripcion`, `programa`, `modalidad`, `activo`, `add_user`, `add_fecha`, `mod_user`, `mod_fecha`) VALUES
(1, 'Tito ', 'De Leon', '54306466', 29, 'M', 1, 1, 'soltero', '', 54306466, '', '', 1, 1, 'U', 'Y', 'N', 'attach/programa_curso/programa_curso_1.jpg', NULL, 'CEMUCAF', 'PRESENCIAL', 'Y', 1, '2018-10-31 22:19:54', 1, '2018-11-03 15:17:15'),
(2, 'Timoteo Armando', 'Perez Solis', '12345645', 39, 'M', 1, 1, 'soltero', 'Costurera', 54306456, 'mtest@gmail.com', 'zona 21', 1, 3, 'U', 'Y', 'N', 'attach/programa_curso/programa_curso_2.jpg', '2018-11-02', 'CEMUCAF', 'PRESENCIAL', 'Y', 1, '2018-11-02 00:00:00', 1, '2018-11-03 15:17:36'),
(3, 'Luz Eugenia', 'Hernandez', '123', 12, 'F', 1, 1, 'casado', '123', 123, '123', '123', 1, 3, 'U', 'Y', 'F', 'attach/programa_curso/programa_curso_3.jpg', NULL, NULL, NULL, 'Y', 1, '2018-11-02 16:16:54', 1, '2018-11-03 16:59:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion_alumno`
--

DROP TABLE IF EXISTS `asignacion_alumno`;
CREATE TABLE IF NOT EXISTS `asignacion_alumno` (
  `asignacion_alumno` int(11) NOT NULL AUTO_INCREMENT,
  `alumno` int(11) NOT NULL,
  `add_user` int(11) DEFAULT NULL,
  `add_fecha` datetime DEFAULT NULL,
  `mod_user` int(11) DEFAULT NULL,
  `mod_fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`asignacion_alumno`),
  KEY `asignacion_persona_add_use_f` (`add_user`),
  KEY `asignacion_persona_mod_use_f` (`mod_user`),
  KEY `asignacion_persona_asi_per_f` (`alumno`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asignacion_alumno`
--

INSERT INTO `asignacion_alumno` (`asignacion_alumno`, `alumno`, `add_user`, `add_fecha`, `mod_user`, `mod_fecha`) VALUES
(1, 1, 1, '2018-11-01 21:39:03', NULL, NULL),
(2, 120, 1, '2018-11-01 22:02:09', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion_curso`
--

DROP TABLE IF EXISTS `asignacion_curso`;
CREATE TABLE IF NOT EXISTS `asignacion_curso` (
  `asignacion_curso` int(11) NOT NULL AUTO_INCREMENT,
  `asignacion_alumno` int(11) NOT NULL,
  `nombre_docente` varchar(255) DEFAULT NULL,
  `programa` enum('PEAC','NUFED','MODALIDADES_FLEXIBLES','CEMUCAF') DEFAULT NULL,
  `modalidad` enum('PRESENCIAL','SEMIPRESENCIAL','A_DISTANCIA') DEFAULT NULL,
  `curso` varchar(150) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `add_user` int(11) DEFAULT NULL,
  `add_fecha` datetime DEFAULT NULL,
  `mod_user` int(11) DEFAULT NULL,
  `mod_fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`asignacion_curso`),
  KEY `asignacion_persona_add_use_f` (`add_user`),
  KEY `asignacion_persona_mod_use_f` (`mod_user`),
  KEY `asignacion_persona_asi_cur_f` (`asignacion_alumno`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asignacion_curso`
--

INSERT INTO `asignacion_curso` (`asignacion_curso`, `asignacion_alumno`, `nombre_docente`, `programa`, `modalidad`, `curso`, `fecha_inicio`, `fecha_fin`, `add_user`, `add_fecha`, `mod_user`, `mod_fecha`) VALUES
(1, 1, 'Pedro de Alvarado', 'CEMUCAF', 'PRESENCIAL', 'Programacion', '2018-11-01', '2018-11-01', 1, '2018-11-01 21:58:26', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
CREATE TABLE IF NOT EXISTS `configuracion` (
  `modulo` int(5) UNSIGNED NOT NULL COMMENT 'PK FK',
  `codigo` varchar(20) NOT NULL COMMENT 'IDENTIFICADOR DE LA CONFIGURACION',
  `tipo_dato` enum('texto','fecha','descripcion','lista','checkbox') NOT NULL DEFAULT 'texto' COMMENT 'TIPO DE DATO QUE SE INGRESA EN LA CONFIGURACION',
  `valores` varchar(300) DEFAULT NULL COMMENT 'INDICA LOS POSIBLES VALORES DEL TIPO DE DATO LISTA',
  `valor` text NOT NULL COMMENT 'VALOR DEL DATO QUE SE INGRESA EN LA CONFIGURACION',
  `add_user` int(11) NOT NULL COMMENT 'PERSONA QUE HIZO EL REGISTRO',
  `add_fecha` datetime NOT NULL COMMENT 'FECHA EN QUE SE HIZO EL REGISTRO',
  `mod_user` int(11) DEFAULT NULL COMMENT 'USUARIO QUE MODIFICO EL REGISTRO',
  `mod_fecha` datetime DEFAULT NULL COMMENT 'FECHA EN QUE SE MODIFICO EL REGISTRO',
  PRIMARY KEY (`modulo`,`codigo`),
  UNIQUE KEY `configuracion_modulo_codigo` (`modulo`,`codigo`),
  KEY `configuracion_mod_i` (`modulo`),
  KEY `configuracion_add_use_i` (`add_user`),
  KEY `configuracion_mod_use_i` (`mod_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='ADMINISTRA LAS CONFIGURACIONES DE CADA MODULO';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `curso` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL COMMENT 'NOMBRE DEL CURSO',
  `fecha_inicio` date DEFAULT NULL COMMENT 'FECHA EN QUE INICIA EL CURSO',
  `fecha_fin` date DEFAULT NULL COMMENT 'FECHA EN QUE FINALIZA EL CURSO',
  `activo` enum('Y','N') DEFAULT NULL,
  `add_user` int(11) DEFAULT NULL,
  `add_fecha` datetime DEFAULT NULL,
  `mod_user` int(11) DEFAULT NULL,
  `mod_fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`curso`),
  KEY `cur_add_use_f` (`add_user`),
  KEY `cur_mod_use_f` (`mod_user`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`curso`, `nombre`, `fecha_inicio`, `fecha_fin`, `activo`, `add_user`, `add_fecha`, `mod_user`, `mod_fecha`) VALUES
(1, 'Emprendimiento l + Electricidad Domiciliar', '2018-05-01', '2018-11-02', 'Y', 1, '2018-11-06 01:04:58', 1, '2018-11-07 18:45:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_alumno`
--

DROP TABLE IF EXISTS `curso_alumno`;
CREATE TABLE IF NOT EXISTS `curso_alumno` (
  `curso_alumno` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK ID QUE IDENTIFICA EL REGISTRO EN LA TABLA',
  `curso` int(11) NOT NULL,
  `alumno` int(11) NOT NULL,
  `asignado` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT 'INDICA SI EL ESTUDIANTE YA SE ASIGNO',
  `add_user` int(10) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'FK ID DEL USUARIO QUE INSERTO LA TUPLA',
  `add_fecha` datetime NOT NULL COMMENT 'FECHA EN LA QUE SE INSERTO LA TUPLA',
  `mod_user` int(10) UNSIGNED DEFAULT NULL COMMENT 'FK ID DEL USUARIO QUE MODIFICO LA TUPLA',
  `mod_fecha` datetime DEFAULT NULL COMMENT 'FECHA EN LA QUE SE MODIFICO LA TUPLA',
  PRIMARY KEY (`curso_alumno`),
  KEY `cur_alu_add_use_f` (`add_user`),
  KEY `cur_alu_mod_use_f` (`mod_user`),
  KEY `cur_alu_cur_f` (`curso`),
  KEY `cur_alu_alu_f` (`alumno`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `curso_alumno`
--

INSERT INTO `curso_alumno` (`curso_alumno`, `curso`, `alumno`, `asignado`, `add_user`, `add_fecha`, `mod_user`, `mod_fecha`) VALUES
(1, 1, 1, 'N', 1, '2018-11-07 21:07:29', NULL, NULL),
(2, 1, 2, 'N', 1, '2018-11-07 21:07:39', NULL, NULL),
(3, 1, 3, 'N', 1, '2018-11-07 21:08:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_horario`
--

DROP TABLE IF EXISTS `curso_horario`;
CREATE TABLE IF NOT EXISTS `curso_horario` (
  `horario` int(11) NOT NULL AUTO_INCREMENT,
  `curso` int(11) NOT NULL,
  `dia` enum('LUNES','MARTES','MIERCOLES','JUEVES','VIERNES','SABADO','DOMINGO') DEFAULT NULL,
  `hora_inicio` time NOT NULL COMMENT 'HORA EN LA QUE INICIA EL HORARIO',
  `hora_fin` time NOT NULL COMMENT 'HORA EN LA QUE FINALIZA EL HORARIO',
  `add_user` int(11) DEFAULT NULL,
  `add_fecha` datetime DEFAULT NULL,
  `mod_user` int(11) DEFAULT NULL,
  `mod_fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`horario`),
  KEY `curso_add_use_f` (`add_user`),
  KEY `curso_mod_use_f` (`mod_user`),
  KEY `hor_cur_hor_f` (`curso`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `curso_horario`
--

INSERT INTO `curso_horario` (`horario`, `curso`, `dia`, `hora_inicio`, `hora_fin`, `add_user`, `add_fecha`, `mod_user`, `mod_fecha`) VALUES
(1, 1, 'VIERNES', '18:00:00', '21:45:00', 1, '2018-11-06 00:31:47', 1, '2018-11-07 20:36:22'),
(5, 1, 'MIERCOLES', '01:00:00', '05:00:00', 1, '2018-11-07 19:40:50', 1, '2018-11-07 20:36:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

DROP TABLE IF EXISTS `departamento`;
CREATE TABLE IF NOT EXISTS `departamento` (
  `departamento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` text COMMENT 'INDICA LA DESCRIPCION',
  `activo` enum('Y','N') DEFAULT NULL,
  `add_user` int(11) DEFAULT NULL,
  `add_fecha` datetime DEFAULT NULL,
  `mod_user` int(11) DEFAULT NULL,
  `mod_fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`departamento`),
  KEY `departamento_add_use_f` (`add_user`),
  KEY `departamento_mod_use_f` (`mod_user`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`departamento`, `nombre`, `descripcion`, `activo`, `add_user`, `add_fecha`, `mod_user`, `mod_fecha`) VALUES
(1, 'Guatemala', '', 'Y', 1, '2018-10-31 21:43:45', 1, '2018-11-06 13:44:14'),
(2, 'Guatemala', 'dafafdsfasdf', 'Y', 1, '2018-11-01 17:18:37', NULL, NULL),
(3, 'Guatemala', 'Esto es una descripcion', 'Y', 1, '2018-11-01 17:18:48', 1, '2018-11-01 17:37:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etnia`
--

DROP TABLE IF EXISTS `etnia`;
CREATE TABLE IF NOT EXISTS `etnia` (
  `etnia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `activo` enum('Y','N') DEFAULT NULL,
  `add_user` int(11) DEFAULT NULL,
  `add_fecha` datetime DEFAULT NULL,
  `mod_user` int(11) DEFAULT NULL,
  `mod_fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`etnia`),
  KEY `etnia_add_use_f` (`add_user`),
  KEY `etnia_mod_use_f` (`mod_user`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `etnia`
--

INSERT INTO `etnia` (`etnia`, `nombre`, `descripcion`, `activo`, `add_user`, `add_fecha`, `mod_user`, `mod_fecha`) VALUES
(1, '20 AKATEKO', 'adsfadsfdsafasdfadsfasdfsadfdsafdsaf 123', 'Y', NULL, '2018-11-01 16:15:17', 1, '2018-11-02 11:53:55'),
(2, '21 XINKA', '', 'Y', 1, '2018-11-03 11:48:28', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

DROP TABLE IF EXISTS `modulo`;
CREATE TABLE IF NOT EXISTS `modulo` (
  `modulo` int(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `codigo` varchar(15) NOT NULL COMMENT 'INDICA EL CODIGO PARA IDENTIFICAR EL MODULO DENTRO DEL CODIGO',
  `orden` int(5) NOT NULL COMMENT 'ORDEN EN EL QUE APARECEN EN EL SISTEMA',
  `publico` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT 'INDICA SI EL MODULO SE PRESENTA EN LA PARTE PÚBLICA',
  `privado` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT 'INDICA SI EL MODULO SE PRESENTA CUANDO ESTÁ LOGINEADO',
  `activo` enum('Y','N') NOT NULL DEFAULT 'Y' COMMENT 'INDICA SI EL MODULO ESTÁ ACTIVO',
  `add_user` int(11) DEFAULT NULL COMMENT 'USUARIO QUE REGISTRO EL MODULO',
  `add_fecha` datetime NOT NULL COMMENT 'INDICA LA FECHA EN QUE SE INGRESO EL MÓDULO',
  `mod_user` int(11) DEFAULT NULL COMMENT 'USUARIO QUE HIZO LA ULTIMA MODIFICACION EN EL REGISTRO',
  `mod_fecha` datetime DEFAULT NULL COMMENT 'FECHA EN QUE SE HIZO LA ULTIMA MODIFICACION',
  PRIMARY KEY (`modulo`),
  UNIQUE KEY `modulo_cod_u` (`codigo`),
  KEY `modulo_add_use_f` (`add_user`),
  KEY `modulo_mod_use_f` (`mod_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='TABLA QUE ADMINISTRA LOS MÓDULOS DEL SISTEMA';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

DROP TABLE IF EXISTS `municipio`;
CREATE TABLE IF NOT EXISTS `municipio` (
  `municipio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` text COMMENT 'DESCRIPCION DEL MUNICIPIO',
  `activo` enum('Y','N') DEFAULT NULL,
  `add_user` int(11) DEFAULT NULL,
  `add_fecha` datetime DEFAULT NULL,
  `mod_user` int(11) DEFAULT NULL,
  `mod_fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`municipio`),
  KEY `municipio_add_use_f` (`add_user`),
  KEY `municipio_mod_use_f` (`mod_user`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`municipio`, `nombre`, `descripcion`, `activo`, `add_user`, `add_fecha`, `mod_user`, `mod_fecha`) VALUES
(1, 'Guatemala', 'test', 'Y', 1, '2018-11-02 15:46:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

DROP TABLE IF EXISTS `persona`;
CREATE TABLE IF NOT EXISTS `persona` (
  `persona` int(11) NOT NULL AUTO_INCREMENT,
  `nombre1` varchar(70) NOT NULL,
  `nombre2` varchar(50) NOT NULL,
  `apellido1` varchar(50) NOT NULL,
  `apellido2` varchar(50) DEFAULT NULL,
  `apellido_casada` varchar(50) DEFAULT NULL,
  `email` text COMMENT 'INDICA EL EMAIL',
  `add_user` int(11) DEFAULT NULL,
  `add_fecha` datetime DEFAULT NULL,
  `mod_user` int(11) DEFAULT NULL,
  `mod_fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`persona`),
  KEY `persona_add_use_f` (`add_user`),
  KEY `persona_mod_use_f` (`mod_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`persona`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `apellido_casada`, `email`, `add_user`, `add_fecha`, `mod_user`, `mod_fecha`) VALUES
(1, 'root', 'root', 'root', 'test', '', '', 1, '2018-09-01 00:00:00', 1, '2018-11-03 15:14:21'),
(2, 'Tito ', 'Eliasib', 'De Leon', 'Lopez', '', 'tdeleon@homeland.com.gt', 1, '2018-09-01 16:34:35', 1, '2018-11-07 20:39:14'),
(3, 'Adelaira', 'Vivian', 'Ixcoi', 'zots', '', 'aixco@gmail.com', 1, '2018-11-03 11:43:18', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `persona` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_alumno` varchar(255) NOT NULL,
  `bloqueado` enum('Y','N') NOT NULL DEFAULT 'N',
  `nombre` varchar(255) NOT NULL,
  `usuario` varchar(75) NOT NULL,
  `password` varchar(70) NOT NULL,
  `tipo` enum('admin','normal') NOT NULL DEFAULT 'normal',
  `add_user` int(11) DEFAULT NULL,
  `add_fecha` datetime DEFAULT NULL,
  `mod_user` int(11) DEFAULT NULL,
  `mod_fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`persona`),
  KEY `usuario_add_use_f` (`add_user`),
  KEY `usuario_mod_use_f` (`mod_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`persona`, `codigo_alumno`, `bloqueado`, `nombre`, `usuario`, `password`, `tipo`, `add_user`, `add_fecha`, `mod_user`, `mod_fecha`) VALUES
(1, '102', 'N', 'root', 'root', '098f6bcd4621d373cade4e832627b4f6', 'admin', 1, '2018-09-01 00:00:00', 1, '2018-11-03 15:14:22'),
(2, '101', 'N', 'tdeleon', 'tdeleon', '25f9e794323b453885f5181f1b624d0b', 'admin', 1, '2018-09-01 16:37:40', 1, '2018-11-07 20:39:15'),
(3, '155', 'N', 'aixcoi', 'aixcoi', '098f6bcd4621d373cade4e832627b4f6', 'admin', 1, '2018-11-03 11:44:58', NULL, NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acceso`
--
ALTER TABLE `acceso`
  ADD CONSTRAINT `acceso_acc_per_f` FOREIGN KEY (`acceso_pertenece`) REFERENCES `acceso` (`acceso`),
  ADD CONSTRAINT `acceso_add_use_f` FOREIGN KEY (`add_user`) REFERENCES `persona` (`persona`),
  ADD CONSTRAINT `acceso_mod_f` FOREIGN KEY (`modulo`) REFERENCES `modulo` (`modulo`),
  ADD CONSTRAINT `acceso_mod_use_f` FOREIGN KEY (`mod_user`) REFERENCES `persona` (`persona`);

--
-- Filtros para la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD CONSTRAINT `configuracion_add_use_f` FOREIGN KEY (`add_user`) REFERENCES `persona` (`persona`),
  ADD CONSTRAINT `configuracion_mod_f` FOREIGN KEY (`modulo`) REFERENCES `modulo` (`modulo`),
  ADD CONSTRAINT `configuracion_mod_use_f` FOREIGN KEY (`mod_user`) REFERENCES `persona` (`persona`);

--
-- Filtros para la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD CONSTRAINT `modulo_add_use_f` FOREIGN KEY (`add_user`) REFERENCES `persona` (`persona`),
  ADD CONSTRAINT `modulo_mod_use_f` FOREIGN KEY (`mod_user`) REFERENCES `persona` (`persona`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_add_use_f` FOREIGN KEY (`add_user`) REFERENCES `persona` (`persona`),
  ADD CONSTRAINT `persona_mod_use_f` FOREIGN KEY (`mod_user`) REFERENCES `persona` (`persona`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_add_use_f` FOREIGN KEY (`add_user`) REFERENCES `persona` (`persona`),
  ADD CONSTRAINT `usuario_mod_use_f` FOREIGN KEY (`mod_user`) REFERENCES `persona` (`persona`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
