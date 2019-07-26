-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 09-11-2018 a las 09:46:19
-- Versión del servidor: 5.7.19
-- Versión de PHP: 5.6.31

-- Autor: Tito De Leon
-- Cel: 5430-6466
-- Base de datos: cemucaf

CREATE TABLE IF NOT EXISTS acceso (
  acceso int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK',
  modulo int(5) UNSIGNED NOT NULL COMMENT 'MODULO AL QUE PERTENECE EL ACCESO',
  codigo varchar(25) NOT NULL COMMENT 'CODIGO PARA IDENTIFICAR EN PROGRAMACION A QUIEN PERTENECE',
  orden int(5) UNSIGNED NOT NULL COMMENT 'INDICA EN QUÉ ORDEN SE QUIERE MOSTRAR EN EL MENÚ',
  acceso_pertenece int(10) UNSIGNED DEFAULT NULL COMMENT 'ACCESO PADRE AL QUE PERTENECE EL ACCESO',
  path varchar(150) DEFAULT NULL COMMENT 'PATH DE A DONDE SE DIRIGE EN EL MENU',
  publico enum('Y','N') NOT NULL DEFAULT 'N' COMMENT 'INDICA SI ES PUBLICO O NO EL ACCESO',
  privado enum('Y','N') NOT NULL DEFAULT 'Y' COMMENT 'INDICA SI SALE EN EL MENÚ YA QUE ESTÁ LOGINEADO',
  activo enum('Y','N') NOT NULL DEFAULT 'Y' COMMENT 'DETERMINA SI ESTÁ ACTIVO O NO',
  add_user int(11) NOT NULL COMMENT 'USUARIO QUE HIZO EL REGISTRÓ ',
  add_fecha datetime NOT NULL COMMENT 'FECHA QUE SE HIZO EL REGISTRO',
  mod_user int(11) DEFAULT NULL COMMENT 'USUARIO QUE MODIFICO EL REGISTRO',
  mod_fecha datetime DEFAULT NULL COMMENT 'FECHA QUE SE HIZO LA MODIFICACIÓN',
  PRIMARY KEY (acceso),
  UNIQUE KEY acceso_codigo (modulo,codigo),
  KEY acceso_mod_i (modulo),
  KEY acceso_acc_per_i (acceso_pertenece),
  KEY acceso_pub_i (publico),
  KEY acceso_pri_i (privado),
  KEY acceso_act_i (activo),
  KEY acceso_add_use_i (add_user),
  KEY acceso_mod_use_i (mod_user)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='TABLA DE ACCESOS DE TODAS LAS PANTALLAS DEL SITIO';


CREATE TABLE IF NOT EXISTS alumno (
  alumno int(11) NOT NULL AUTO_INCREMENT,
  nombres varchar(70) NOT NULL,
  apellidos varchar(70) NOT NULL,
  identificacion varchar(30) NOT NULL,
  edad int(50) DEFAULT NULL,
  genero enum('F','M') DEFAULT NULL,
  grupo_etnico smallint(5) UNSIGNED DEFAULT NULL,
  idioma_materno smallint(5) UNSIGNED DEFAULT NULL,
  estado_civil enum('soltero','casado') DEFAULT NULL,
  profesion_oficio varchar(255) NOT NULL,
  telefono int(12) NOT NULL,
  correo_electronico varchar(75) DEFAULT NULL,
  direccion varchar(200) DEFAULT NULL,
  municipio smallint(5) UNSIGNED DEFAULT NULL,
  departamento smallint(5) UNSIGNED DEFAULT NULL,
  area_geografica enum('U','R') DEFAULT 'U' COMMENT 'U=URBANA, R=RURAL',
  trabaja_actualmente enum('Y','N') DEFAULT 'Y',
  discapasidad enum('V','F','D','M','A','N') DEFAULT 'N' COMMENT 'V = VISUAL, F = FISICA, D = DEL HABLA, M = MULTIPLE, A = AUDITIVA, N = NINGUNA',
  imagen_alumno_path text COMMENT 'PATH DE ALUMNO',
  fecha_incripcion date DEFAULT NULL,
  programa enum('PEAC','NUFED','MODALIDADES_FLEXIBLES','CEMUCAF') DEFAULT NULL,
  modalidad enum('PRESENCIAL','SEMIPRESENCIAL','A_DISTANCIA') DEFAULT NULL,
  activo enum('Y','N') DEFAULT 'Y' COMMENT 'INDICA SI ESTA ACTIVO',
  add_user int(11) DEFAULT NULL,
  add_fecha datetime DEFAULT NULL,
  mod_user int(11) DEFAULT NULL,
  mod_fecha datetime DEFAULT NULL,
  PRIMARY KEY (alumno),
  KEY alumno_add_use_f (add_user),
  KEY alumno_mod_use_f (mod_user),
  KEY alumno_gru_etn_f (grupo_etnico),
  KEY alumno_idi_mat_f (idioma_materno),
  KEY alumno_dep_f (departamento),
  KEY alumno_mun_f (municipio)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS asignacion_alumno (
  asignacion_alumno int(11) NOT NULL AUTO_INCREMENT,
  alumno int(11) NOT NULL,
  add_user int(11) DEFAULT NULL,
  add_fecha datetime DEFAULT NULL,
  mod_user int(11) DEFAULT NULL,
  mod_fecha datetime DEFAULT NULL,
  PRIMARY KEY (asignacion_alumno),
  KEY asignacion_persona_add_use_f (add_user),
  KEY asignacion_persona_mod_use_f (mod_user),
  KEY asignacion_persona_asi_per_f (alumno)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS asignacion_curso (
  asignacion_curso int(11) NOT NULL AUTO_INCREMENT,
  asignacion_alumno int(11) NOT NULL,
  nombre_docente varchar(255) DEFAULT NULL,
  programa enum('PEAC','NUFED','MODALIDADES_FLEXIBLES','CEMUCAF') DEFAULT NULL,
  modalidad enum('PRESENCIAL','SEMIPRESENCIAL','A_DISTANCIA') DEFAULT NULL,
  curso varchar(150) DEFAULT NULL,
  fecha_inicio date DEFAULT NULL,
  fecha_fin date DEFAULT NULL,
  add_user int(11) DEFAULT NULL,
  add_fecha datetime DEFAULT NULL,
  mod_user int(11) DEFAULT NULL,
  mod_fecha datetime DEFAULT NULL,
  PRIMARY KEY (asignacion_curso),
  KEY asignacion_persona_add_use_f (add_user),
  KEY asignacion_persona_mod_use_f (mod_user),
  KEY asignacion_persona_asi_cur_f (asignacion_alumno)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS configuracion (
  modulo int(5) UNSIGNED NOT NULL COMMENT 'PK FK',
  codigo varchar(20) NOT NULL COMMENT 'IDENTIFICADOR DE LA CONFIGURACION',
  tipo_dato enum('texto','fecha','descripcion','lista','checkbox') NOT NULL DEFAULT 'texto' COMMENT 'TIPO DE DATO QUE SE INGRESA EN LA CONFIGURACION',
  valores varchar(300) DEFAULT NULL COMMENT 'INDICA LOS POSIBLES VALORES DEL TIPO DE DATO LISTA',
  valor text NOT NULL COMMENT 'VALOR DEL DATO QUE SE INGRESA EN LA CONFIGURACION',
  add_user int(11) NOT NULL COMMENT 'PERSONA QUE HIZO EL REGISTRO',
  add_fecha datetime NOT NULL COMMENT 'FECHA EN QUE SE HIZO EL REGISTRO',
  mod_user int(11) DEFAULT NULL COMMENT 'USUARIO QUE MODIFICO EL REGISTRO',
  mod_fecha datetime DEFAULT NULL COMMENT 'FECHA EN QUE SE MODIFICO EL REGISTRO',
  PRIMARY KEY (modulo,codigo),
  UNIQUE KEY configuracion_modulo_codigo (modulo,codigo),
  KEY configuracion_mod_i (modulo),
  KEY configuracion_add_use_i (add_user),
  KEY configuracion_mod_use_i (mod_user)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='ADMINISTRA LAS CONFIGURACIONES DE CADA MODULO';


CREATE TABLE IF NOT EXISTS curso (
  curso int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(200) NOT NULL COMMENT 'NOMBRE DEL CURSO',
  fecha_inicio date DEFAULT NULL COMMENT 'FECHA EN QUE INICIA EL CURSO',
  fecha_fin date DEFAULT NULL COMMENT 'FECHA EN QUE FINALIZA EL CURSO',
  activo enum('Y','N') DEFAULT NULL,
  add_user int(11) DEFAULT NULL,
  add_fecha datetime DEFAULT NULL,
  mod_user int(11) DEFAULT NULL,
  mod_fecha datetime DEFAULT NULL,
  PRIMARY KEY (curso),
  KEY cur_add_use_f (add_user),
  KEY cur_mod_use_f (mod_user)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS curso_alumno (
  curso_alumno smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK ID QUE IDENTIFICA EL REGISTRO EN LA TABLA',
  curso int(11) NOT NULL,
  alumno int(11) NOT NULL,
  asignado enum('Y','N') NOT NULL DEFAULT 'N' COMMENT 'INDICA SI EL ESTUDIANTE YA SE ASIGNO',
  add_user int(10) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'FK ID DEL USUARIO QUE INSERTO LA TUPLA',
  add_fecha datetime NOT NULL COMMENT 'FECHA EN LA QUE SE INSERTO LA TUPLA',
  mod_user int(10) UNSIGNED DEFAULT NULL COMMENT 'FK ID DEL USUARIO QUE MODIFICO LA TUPLA',
  mod_fecha datetime DEFAULT NULL COMMENT 'FECHA EN LA QUE SE MODIFICO LA TUPLA',
  PRIMARY KEY (curso_alumno),
  KEY cur_alu_add_use_f (add_user),
  KEY cur_alu_mod_use_f (mod_user),
  KEY cur_alu_cur_f (curso),
  KEY cur_alu_alu_f (alumno)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS curso_horario (
  horario int(11) NOT NULL AUTO_INCREMENT,
  curso int(11) NOT NULL,
  dia enum('LUNES','MARTES','MIERCOLES','JUEVES','VIERNES','SABADO','DOMINGO') DEFAULT NULL,
  hora_inicio time NOT NULL COMMENT 'HORA EN LA QUE INICIA EL HORARIO',
  hora_fin time NOT NULL COMMENT 'HORA EN LA QUE FINALIZA EL HORARIO',
  add_user int(11) DEFAULT NULL,
  add_fecha datetime DEFAULT NULL,
  mod_user int(11) DEFAULT NULL,
  mod_fecha datetime DEFAULT NULL,
  PRIMARY KEY (horario),
  KEY curso_add_use_f (add_user),
  KEY curso_mod_use_f (mod_user),
  KEY hor_cur_hor_f (curso)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS departamento (
  departamento int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(255) DEFAULT NULL,
  descripcion text COMMENT 'INDICA LA DESCRIPCION',
  activo enum('Y','N') DEFAULT NULL,
  add_user int(11) DEFAULT NULL,
  add_fecha datetime DEFAULT NULL,
  mod_user int(11) DEFAULT NULL,
  mod_fecha datetime DEFAULT NULL,
  PRIMARY KEY (departamento),
  KEY departamento_add_use_f (add_user),
  KEY departamento_mod_use_f (mod_user)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS etnia (
  etnia int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(255) DEFAULT NULL,
  descripcion varchar(255) DEFAULT NULL,
  activo enum('Y','N') DEFAULT NULL,
  add_user int(11) DEFAULT NULL,
  add_fecha datetime DEFAULT NULL,
  mod_user int(11) DEFAULT NULL,
  mod_fecha datetime DEFAULT NULL,
  PRIMARY KEY (etnia),
  KEY etnia_add_use_f (add_user),
  KEY etnia_mod_use_f (mod_user)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS modulo (
  modulo int(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK',
  codigo varchar(15) NOT NULL COMMENT 'INDICA EL CODIGO PARA IDENTIFICAR EL MODULO DENTRO DEL CODIGO',
  orden int(5) NOT NULL COMMENT 'ORDEN EN EL QUE APARECEN EN EL SISTEMA',
  publico enum('Y','N') NOT NULL DEFAULT 'N' COMMENT 'INDICA SI EL MODULO SE PRESENTA EN LA PARTE PÚBLICA',
  privado enum('Y','N') NOT NULL DEFAULT 'N' COMMENT 'INDICA SI EL MODULO SE PRESENTA CUANDO ESTÁ LOGINEADO',
  activo enum('Y','N') NOT NULL DEFAULT 'Y' COMMENT 'INDICA SI EL MODULO ESTÁ ACTIVO',
  add_user int(11) DEFAULT NULL COMMENT 'USUARIO QUE REGISTRO EL MODULO',
  add_fecha datetime NOT NULL COMMENT 'INDICA LA FECHA EN QUE SE INGRESO EL MÓDULO',
  mod_user int(11) DEFAULT NULL COMMENT 'USUARIO QUE HIZO LA ULTIMA MODIFICACION EN EL REGISTRO',
  mod_fecha datetime DEFAULT NULL COMMENT 'FECHA EN QUE SE HIZO LA ULTIMA MODIFICACION',
  PRIMARY KEY (modulo),
  UNIQUE KEY modulo_cod_u (codigo),
  KEY modulo_add_use_f (add_user),
  KEY modulo_mod_use_f (mod_user)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='TABLA QUE ADMINISTRA LOS MÓDULOS DEL SISTEMA';


CREATE TABLE IF NOT EXISTS municipio (
  municipio int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(255) DEFAULT NULL,
  descripcion text COMMENT 'DESCRIPCION DEL MUNICIPIO',
  activo enum('Y','N') DEFAULT NULL,
  add_user int(11) DEFAULT NULL,
  add_fecha datetime DEFAULT NULL,
  mod_user int(11) DEFAULT NULL,
  mod_fecha datetime DEFAULT NULL,
  PRIMARY KEY (municipio),
  KEY municipio_add_use_f (add_user),
  KEY municipio_mod_use_f (mod_user)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS persona (
  persona int(11) NOT NULL AUTO_INCREMENT,
  nombre1 varchar(70) NOT NULL,
  nombre2 varchar(50) NOT NULL,
  apellido1 varchar(50) NOT NULL,
  apellido2 varchar(50) DEFAULT NULL,
  apellido_casada varchar(50) DEFAULT NULL,
  email text COMMENT 'INDICA EL EMAIL',
  add_user int(11) DEFAULT NULL,
  add_fecha datetime DEFAULT NULL,
  mod_user int(11) DEFAULT NULL,
  mod_fecha datetime DEFAULT NULL,
  PRIMARY KEY (persona),
  KEY persona_add_use_f (add_user),
  KEY persona_mod_use_f (mod_user)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla persona
--

INSERT INTO persona (persona, nombre1, nombre2, apellido1, apellido2, apellido_casada, email, add_user, add_fecha, mod_user, mod_fecha) VALUES
(1, 'root', 'root', 'root', 'test', '', '', 1, '2018-09-01 00:00:00', 1, '2018-11-09 03:30:04');


CREATE TABLE IF NOT EXISTS usuario (
  persona int(11) NOT NULL AUTO_INCREMENT,
  codigo_alumno varchar(255) NOT NULL,
  bloqueado enum('Y','N') NOT NULL DEFAULT 'N',
  nombre varchar(255) NOT NULL,
  usuario varchar(75) NOT NULL,
  password varchar(70) NOT NULL,
  tipo enum('admin','normal') NOT NULL DEFAULT 'normal',
  add_user int(11) DEFAULT NULL,
  add_fecha datetime DEFAULT NULL,
  mod_user int(11) DEFAULT NULL,
  mod_fecha datetime DEFAULT NULL,
  PRIMARY KEY (persona),
  KEY usuario_add_use_f (add_user),
  KEY usuario_mod_use_f (mod_user)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;



INSERT INTO usuario (persona, codigo_alumno, bloqueado, nombre, usuario, password, tipo, add_user, add_fecha, mod_user, mod_fecha) VALUES
(1, '102', 'N', 'root', '', 'd41d8cd98f00b204e9800998ecf8427e', 'admin', 1, '2018-09-01 00:00:00', 1, '2018-11-09 03:30:05'),


ALTER TABLE acceso
  ADD CONSTRAINT acceso_acc_per_f FOREIGN KEY (acceso_pertenece) REFERENCES acceso (acceso),
  ADD CONSTRAINT acceso_add_use_f FOREIGN KEY (add_user) REFERENCES persona (persona),
  ADD CONSTRAINT acceso_mod_f FOREIGN KEY (modulo) REFERENCES modulo (modulo),
  ADD CONSTRAINT acceso_mod_use_f FOREIGN KEY (mod_user) REFERENCES persona (persona);

--
-- Filtros para la tabla configuracion
--
ALTER TABLE configuracion
  ADD CONSTRAINT configuracion_add_use_f FOREIGN KEY (add_user) REFERENCES persona (persona),
  ADD CONSTRAINT configuracion_mod_f FOREIGN KEY (modulo) REFERENCES modulo (modulo),
  ADD CONSTRAINT configuracion_mod_use_f FOREIGN KEY (mod_user) REFERENCES persona (persona);

--
-- Filtros para la tabla modulo
--
ALTER TABLE modulo
  ADD CONSTRAINT modulo_add_use_f FOREIGN KEY (add_user) REFERENCES persona (persona),
  ADD CONSTRAINT modulo_mod_use_f FOREIGN KEY (mod_user) REFERENCES persona (persona);

--
-- Filtros para la tabla persona
--
ALTER TABLE persona
  ADD CONSTRAINT persona_add_use_f FOREIGN KEY (add_user) REFERENCES persona (persona),
  ADD CONSTRAINT persona_mod_use_f FOREIGN KEY (mod_user) REFERENCES persona (persona);

--
-- Filtros para la tabla usuario
--
ALTER TABLE usuario
  ADD CONSTRAINT usuario_add_use_f FOREIGN KEY (add_user) REFERENCES persona (persona),
  ADD CONSTRAINT usuario_mod_use_f FOREIGN KEY (mod_user) REFERENCES persona (persona);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
