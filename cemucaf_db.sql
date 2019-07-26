
CREATE TABLE IF NOT EXISTS persona (
  persona INT(11) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  nombre1 varchar(70) NOT NULL COMMENT 'PRIMER NOMBRE DE LA PERSONA',
  nombre2 varchar(50) NOT NULL COMMENT 'OTROS NOMBRES DE LA PERSONA',
  apellido1 varchar(50) NOT NULL COMMENT 'PRIMER APELLIDO DE LA PERSONA',
  apellido2 varchar(50) DEFAULT NULL COMMENT 'OTROS APELLIDOS DE LA PERSONA',
  apellido_casada varchar(50) DEFAULT NULL,
  email text COMMENT 'INDICA EL EMAIL',
  add_user INT(11)  DEFAULT NULL COMMENT 'INDICA QUE PERSONA HIZO EL REGISTRO',
  add_fecha datetime DEFAULT NULL COMMENT 'FECHA EN QUE SE HIZO EL REGISTRO',
  mod_user INT(11)  DEFAULT NULL COMMENT 'PERSONA QUE MODIFICO POR ULTIMA VEZ EL REGISTRO',
  mod_fecha datetime DEFAULT NULL COMMENT 'FECHA EN QUE SE MODIFICO EL REGISTRO POR ULTIMA VEZ',
  PRIMARY KEY (persona),
  KEY persona_add_use_f (add_user),
  KEY persona_mod_use_f (mod_user)
)  ENGINE=InnoDB CHARSET=latin1 COMMENT='ADMINISTRA TODA PERSONA QUE SE QUIERA INGRESAR EN EL SISTEMA SIN SER USUARIO';

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
   CONSTRAINT usuario_per_f FOREIGN KEY ( persona ) REFERENCES persona ( persona ) ON DELETE RESTRICT ON UPDATE RESTRICT,
   CONSTRAINT usuario_add_use_f FOREIGN KEY ( add_user ) REFERENCES persona ( persona ) ON DELETE RESTRICT ON UPDATE RESTRICT,
   CONSTRAINT usuario_mod_use_f FOREIGN KEY ( mod_user ) REFERENCES persona ( persona ) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB CHARSET=latin1 COMMENT='TABLA QUE ADMINISTRA LOS USUARIOS ';

INSERT INTO usuario (persona, codigo_alumno, bloqueado, nombre, usuario, password, tipo, add_user, add_fecha, mod_user, mod_fecha) VALUES
(1, '102', 'N', 'root', '', 'd41d8cd98f00b204e9800998ecf8427e', 'admin', 1, '2018-09-01 00:00:00', 1, '2018-11-09 03:30:05');


CREATE TABLE IF NOT EXISTS etnia (
  etnia int(11) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(255),
  descripcion VARCHAR(255),
  activo ENUM('Y','N'),
  add_user int(11) DEFAULT NULL,
  add_fecha datetime DEFAULT NULL,
  mod_user int(11) DEFAULT NULL,
  mod_fecha datetime DEFAULT NULL,
  PRIMARY KEY (etnia),
  CONSTRAINT etnia_add_use_f FOREIGN KEY (add_user) REFERENCES persona (persona) ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT etnia_mod_use_f FOREIGN KEY (mod_user) REFERENCES persona (persona) ON UPDATE RESTRICT ON DELETE RESTRICT
);


CREATE TABLE IF NOT EXISTS departamento (
  departamento int(11) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(255),
  descripcion VARCHAR(255),
  activo ENUM('Y','N'),
  add_user int(11) DEFAULT NULL,
  add_fecha datetime DEFAULT NULL,
  mod_user int(11) DEFAULT NULL,
  mod_fecha datetime DEFAULT NULL,
  PRIMARY KEY (departamento),
  CONSTRAINT departamento_add_use_f FOREIGN KEY (add_user) REFERENCES persona (persona) ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT departamento_mod_use_f FOREIGN KEY (mod_user) REFERENCES persona (persona) ON UPDATE RESTRICT ON DELETE RESTRICT
);


CREATE TABLE IF NOT EXISTS municipio (
  municipio int(11) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(255),
  activo ENUM('Y','N'),
  descripcion VARCHAR(255),
  add_user int(11) DEFAULT NULL,
  add_fecha datetime DEFAULT NULL,
  mod_user int(11) DEFAULT NULL,
  mod_fecha datetime DEFAULT NULL,
  PRIMARY KEY (municipio),
  CONSTRAINT municipio_add_use_f FOREIGN KEY (add_user) REFERENCES persona (persona) ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT municipio_mod_use_f FOREIGN KEY (mod_user) REFERENCES persona (persona) ON UPDATE RESTRICT ON DELETE RESTRICT
);


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
  CONSTRAINT alumno_add_use_f FOREIGN KEY (add_user) REFERENCES persona (persona) ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT alumno_mod_use_f FOREIGN KEY (mod_user) REFERENCES persona (persona) ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT alumno_gru_etn_f FOREIGN KEY (grupo_etnico) REFERENCES etnia (etnia) ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT alumno_idi_mat_f FOREIGN KEY (idioma_materno) REFERENCES etnia (etnia) ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT alumno_dep_f FOREIGN KEY (departamento) REFERENCES departamento (departamento) ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT alumno_mun_f FOREIGN KEY (municipio) REFERENCES municipio (municipio) ON UPDATE RESTRICT ON DELETE RESTRICT  
);


CREATE TABLE IF NOT EXISTS curso( 
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
  CONSTRAINT curso_add_use_f FOREIGN KEY (add_user) REFERENCES persona (persona) ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT curso_mod_use_f FOREIGN KEY (mod_user) REFERENCES persona (persona) ON UPDATE RESTRICT ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS curso_horario( 
  horario int(11) NOT NULL AUTO_INCREMENT,
  curso int(11) NOT NULL ,
  dia ENUM('LUNES','MARTES','MIERCOLES','JUEVES','VIERNES','SABADO','DOMINGO'),
  hora_inicio TIME NOT NULL COMMENT 'HORA EN LA QUE INICIA EL HORARIO',
  hora_fin    TIME NOT NULL COMMENT 'HORA EN LA QUE FINALIZA EL HORARIO',
  add_user int(11) DEFAULT NULL,
  add_fecha datetime DEFAULT NULL,
  mod_user int(11) DEFAULT NULL,
  mod_fecha datetime DEFAULT NULL,
  PRIMARY KEY (horario),
  CONSTRAINT curso_add_use_f FOREIGN KEY (add_user) REFERENCES persona (persona) ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT curso_mod_use_f FOREIGN KEY (mod_user) REFERENCES persona (persona) ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT hor_cur_hor_f FOREIGN KEY (curso) REFERENCES curso (curso) 
);

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
  CONSTRAINT curso_alumno_add_use_f FOREIGN KEY (add_user) REFERENCES persona (persona),
  CONSTRAINT curso_alumno_use_f FOREIGN KEY (mod_user) REFERENCES persona (persona)
);


CREATE TABLE noticia (
	noticia SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK QUE IDENTIFICA AL REGISTRO EN ESTA TABLA',
	orden SMALLINT(6) NOT NULL COMMENT 'ORDEN DE LA NOTICIA',
	link VARCHAR(200) NULL DEFAULT NULL COMMENT 'CAMPO QUE GUARDA EL LINK',
	imagen VARCHAR(200) NULL DEFAULT NULL COMMENT 'CAMPO QUE GUARDA EL PATH DE LA IMAGEN',
	activo ENUM('Y','N') NOT NULL DEFAULT 'Y' COMMENT 'INDICA SI LA NOTICIA ESTÁ ACTIVA',
	add_user INT(10) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'FK ID DEL USUARIO QUE INSERTO LA TUPLA',
	add_fecha DATETIME NOT NULL COMMENT 'FECHA EN LA QUE SE INSERTO LA TUPLA',
	mod_user INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'FK ID DEL USUARIO QUE MODIFICO LA TUPLA',
	mod_fecha DATETIME NULL DEFAULT NULL COMMENT 'FECHA EN LA QUE SE MODIFICO LA TUPLA',
	PRIMARY KEY (noticia),
	INDEX noticia_add_use_f (add_user),
	INDEX noticia_mod_use_f (mod_user),
	CONSTRAINT noticia_add_use_f FOREIGN KEY (add_user) REFERENCES persona (persona),
	CONSTRAINT noticia_mod_use_f FOREIGN KEY (mod_user) REFERENCES persona (persona)
);

ALTER TABLE curso
 	ADD COLUMN tecnico_docente VARCHAR(200) COMMENT 'TECNICO DOCENTE QUE ATIENDE' AFTER fecha_fin;












