CREATE ROLE gu_credencial WITH
  LOGIN
  SUPERUSER
  INHERIT
  CREATEDB
  CREATEROLE
  NOREPLICATION;


CREATE DATABASE db_credencial
    WITH 
    OWNER = gu_credencial
    ENCODING = 'UTF8'
    LC_COLLATE = 'Spanish_Spain.1252'
    LC_CTYPE = 'Spanish_Spain.1252'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1;

-- encargados definition

-- Drop table

-- DROP TABLE encargados;

CREATE TABLE encargados (
	id int4 NOT NULL GENERATED ALWAYS AS IDENTITY,
	nombre varchar(150) NOT NULL COLLATE "es-MX-x-icu",
	cargo varchar(100) NOT NULL COLLATE "es-MX-x-icu",
	ruta_firma varchar(100) NULL,
	estatus_registro varchar(3) NULL DEFAULT 'VIG'::character varying,
	creado_por varchar(50) NULL DEFAULT CURRENT_USER,
	fecha_creacion timestamp NULL DEFAULT LOCALTIMESTAMP,
	modificado_por varchar(50) NULL DEFAULT CURRENT_USER,
	fecha_modificacion timestamp NULL DEFAULT LOCALTIMESTAMP,
	CONSTRAINT encargado_pk PRIMARY KEY (id)
);


-- departamentos definition

-- Drop table

-- DROP TABLE departamentos;

CREATE TABLE departamentos (
	id int4 NOT NULL GENERATED ALWAYS AS IDENTITY,	
	nombre varchar(100) NOT NULL COLLATE "es-MX-x-icu",
	cp varchar(6) NOT NULL,
	direccion varchar(200) NOT NULL COLLATE "es-MX-x-icu",
	estatus_registro varchar(3) NOT NULL DEFAULT 'VIG'::character varying,
	creado_por varchar(50) NOT NULL DEFAULT CURRENT_USER,
	fecha_creacion timestamp NOT NULL DEFAULT LOCALTIMESTAMP,
	modificado_por varchar(50) NULL DEFAULT CURRENT_USER,
	fecha_modificacion timestamp NULL DEFAULT LOCALTIMESTAMP,	
	CONSTRAINT departamentos_pk PRIMARY KEY (id)	
);


-- empleados definition

-- Drop table

-- DROP TABLE empleados;

CREATE TABLE empleados (
	id int4 NOT NULL GENERATED ALWAYS AS IDENTITY,
	id_departamento int4 NOT NULL,
	id_encargado int4 NOT NULL,
	id_empleado_anterior int4 NULL,
	nombre varchar(50) NOT NULL COLLATE "es-MX-x-icu",
	ap_paterno varchar(50) NOT NULL COLLATE "es-MX-x-icu",
	ap_materno varchar(50) NULL COLLATE "es-MX-x-icu",
	curp varchar(19) NOT NULL COLLATE "es-MX-x-icu",
	tipo_sanguineo varchar(3) NULL COLLATE "es-MX-x-icu",
	num_seguro varchar(8) NOT NULL COLLATE "es-MX-x-icu",
	categoria varchar(40) NOT NULL COLLATE "es-MX-x-icu",
	fecha_inicio_vigencia date NOT NULL,
	fecha_termino_vigencia date NOT NULL,
	ruta_firma varchar(100) NULL,
	ruta_foto varchar(100) NULL,
	ruta_credencial_f varchar(100) NULL,
	ruta_credencial_v varchar(100) NULL,
	tel_emergencia varchar(12) NULL,
	estatus_registro varchar(3) NULL DEFAULT 'VIG'::character varying,
	creado_por varchar(50) NULL DEFAULT CURRENT_USER,
	fecha_creacion timestamp NULL DEFAULT LOCALTIMESTAMP,
	modificado_por varchar(50) NULL DEFAULT CURRENT_USER,
	fecha_modificacion timestamp NULL DEFAULT LOCALTIMESTAMP,
	CONSTRAINT empleado_pk PRIMARY KEY (id),
	CONSTRAINT empleados_departamento_fk FOREIGN KEY (id_departamento) REFERENCES departamentos(id) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT empleados_empleados_fk FOREIGN KEY (id_empleado_anterior) REFERENCES empleados(id),
	CONSTRAINT empleados_encargados_fk FOREIGN KEY (id_encargado) REFERENCES encargados(id) ON DELETE RESTRICT ON UPDATE RESTRICT
);


INSERT INTO encargados
(nombre, cargo, ruta_firma, estatus_registro, creado_por, fecha_creacion, modificado_por, fecha_modificacion)
VALUES('Lic. Carlos Enrique Iñiguez Rosique', 'Secretario de Administración e Innovación Gubernamental', 'archivos/firmas/encargados/20231220120245.png', 'VIG', 'gu_credencial', '2023-12-19 14:02:17.203', 'gu_credencial', '2023-12-19 14:02:17.203');


/*
INSERT INTO departamentos
(nombre, cp, direccion, estatus_registro, creado_por, fecha_creacion, modificado_por, fecha_modificacion, id_encargado)
VALUES('Secretaría Particular', '86000', 'Palacio de Gobierno, Calle Independencia No.2 Col. Centro', 'VIG', 'gu_credencial', '2023-12-13 12:56:35.579', 'gu_credencial', '2023-12-13 12:56:35.579', NULL);
INSERT INTO departamentos
(nombre, cp, direccion, estatus_registro, creado_por, fecha_creacion, modificado_por, fecha_modificacion, id_encargado)
VALUES('Secretaría Técnica', '86000', 'Palacio de Gobierno, Calle Independencia No.2 Col. Centro', 'VIG', 'gu_credencial', '2023-12-13 12:57:05.899', 'gu_credencial', '2023-12-13 12:57:05.899', NULL);
*/