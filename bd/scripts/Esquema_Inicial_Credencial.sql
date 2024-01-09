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
	tel_emergencia varchar(12) NULL,
	estatus_registro varchar(3) NULL DEFAULT 'VIG'::character varying,
	creado_por varchar(50) NULL DEFAULT CURRENT_USER,
	fecha_creacion timestamp NULL DEFAULT LOCALTIMESTAMP,
	modificado_por varchar(50) NULL DEFAULT CURRENT_USER,
	fecha_modificacion timestamp NULL DEFAULT LOCALTIMESTAMP,
	CONSTRAINT empleado_pk PRIMARY KEY (id),
	CONSTRAINT empleados_departamento_fk FOREIGN KEY (id_departamento) REFERENCES departamentos(id) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT empleados_encargados_fk FOREIGN KEY (id_encargado) REFERENCES encargados(id) ON DELETE RESTRICT ON UPDATE RESTRICT
);


-- Drop TABLE

-- DROP TABLE credenciales;
CREATE TABLE credenciales (
	id int4 NOT NULL GENERATED ALWAYS AS IDENTITY,
	id_empleado int4 NOT NULL,
	anio_inicio int4 NOT NULL,
	anio_termino int4 NOT NULL,
	ruta_credencial_f varchar(100) NOT NULL,
	ruta_credencial_v varchar(100) NULL,
	estatus_registro varchar(3) NULL DEFAULT 'VIG'::character varying,
	creado_por varchar(50) NULL DEFAULT CURRENT_USER,
	fecha_creacion timestamp NULL DEFAULT LOCALTIMESTAMP,
	modificado_por varchar(50) NULL DEFAULT CURRENT_USER,
	fecha_modificacion timestamp NULL DEFAULT LOCALTIMESTAMP,
	CONSTRAINT credenciales_pk PRIMARY KEY (id),
	CONSTRAINT credenciales_empleados_fk FOREIGN KEY (id_empleado) REFERENCES empleados(id) ON DELETE RESTRICT ON UPDATE RESTRICT
);

INSERT INTO encargados
(nombre, cargo, ruta_firma, estatus_registro, creado_por, fecha_creacion, modificado_por, fecha_modificacion)
VALUES('Lic. Carlos Enrique Iñiguez Rosique', 'Secretario de Administración e Innovación Gubernamental', 'archivos/firmas/encargados/20231220120245.png', 'VIG', 'gu_credencial', '2023-12-19 14:02:17.203', 'gu_credencial', '2023-12-19 14:02:17.203');

INSERT INTO encargados
(nombre, cargo, ruta_firma, estatus_registro, creado_por, fecha_creacion, modificado_por, fecha_modificacion)
VALUES('Lic. Jesús Antonio Palma Sánchez', 'Jefe de Departamento Estadística', 'archivos/firmas/encargados/20231220120245.png', 'VIG', 'gu_credencial', '2023-12-19 14:02:17.203', 'gu_credencial', '2023-12-19 14:02:17.203');

/*
INSERT INTO public.departamentos
(nombre, cp, direccion, estatus_registro, creado_por, fecha_creacion, modificado_por, fecha_modificacion)
VALUES('Dirección General de Imagen Institucional', '86000', 'Palacio de Gobierno, Calle Independencia No.2 Col. Centro', 'VIG', 'gu_credencial', '2023-12-20 14:14:55.693', 'gu_credencial', '2023-12-20 14:14:55.693');
INSERT INTO public.departamentos
(nombre, cp, direccion, estatus_registro, creado_por, fecha_creacion, modificado_por, fecha_modificacion)
VALUES('Secretaría Privada', '86000', 'Palacio de Gobierno, Calle Independencia No.2 Col. Centro', 'VIG', 'gu_credencial', '2023-12-20 14:15:47.749', 'gu_credencial', '2023-12-20 14:15:47.749');
INSERT INTO public.departamentos
(nombre, cp, direccion, estatus_registro, creado_por, fecha_creacion, modificado_por, fecha_modificacion)
VALUES('Secretaría Particular', '86000', 'Palacio de Gobierno, Calle Independencia No.2 Col. Centro', 'VIG', 'gu_credencial', '2023-12-20 14:15:55.436', 'gu_credencial', '2023-12-20 14:15:55.436');
INSERT INTO public.departamentos
(nombre, cp, direccion, estatus_registro, creado_por, fecha_creacion, modificado_por, fecha_modificacion)
VALUES('Coordinación General Ejecutiva de la Gubernatura', '86000', 'Palacio de Gobierno, Calle Independencia No.2 Col. Centro', 'VIG', 'gu_credencial', '2023-12-20 14:16:27.034', 'gu_credencial', '2023-12-20 14:16:27.034');
INSERT INTO public.departamentos
(nombre, cp, direccion, estatus_registro, creado_por, fecha_creacion, modificado_por, fecha_modificacion)
VALUES('Secretaría Técnica', '86000', 'Palacio de Gobierno, Calle Independencia No.2 Col. Centro', 'VIG', 'gu_credencial', '2023-12-20 14:16:34.174', 'gu_credencial', '2023-12-20 14:16:34.174');
INSERT INTO public.departamentos
(nombre, cp, direccion, estatus_registro, creado_por, fecha_creacion, modificado_por, fecha_modificacion)
VALUES('Secretaría de Asuntos Privados del Sr. Gobernador', '86000', 'Palacio de Gobierno, Calle Independencia No.2 Col. Centro', 'VIG', 'gu_credencial', '2023-12-20 14:17:06.283', 'gu_credencial', '2023-12-20 14:17:06.283');
INSERT INTO public.departamentos
(nombre, cp, direccion, estatus_registro, creado_por, fecha_creacion, modificado_por, fecha_modificacion)
VALUES('Unidad de Atención Ciudadana', '86000', 'Palacio de Gobierno, Calle Independencia No.2 Col. Centro', 'VIG', 'gu_credencial', '2023-12-20 14:17:24.486', 'gu_credencial', '2023-12-20 14:17:24.486');
INSERT INTO public.departamentos
(nombre, cp, direccion, estatus_registro, creado_por, fecha_creacion, modificado_por, fecha_modificacion)
VALUES('Unidad de Giras del Sr. Gobernador', '86000', 'Palacio de Gobierno, Calle Independencia No.2 Col. Centro', 'VIG', 'gu_credencial', '2023-12-20 14:17:43.452', 'gu_credencial', '2023-12-20 14:17:43.452');
INSERT INTO public.departamentos
(nombre, cp, direccion, estatus_registro, creado_por, fecha_creacion, modificado_por, fecha_modificacion)
VALUES('Unidad de Imagen', '86000', 'Palacio de Gobierno, Calle Independencia No.2 Col. Centro', 'VIG', 'gu_credencial', '2023-12-20 14:18:12.616', 'gu_credencial', '2023-12-20 14:18:12.616');
INSERT INTO public.departamentos
(nombre, cp, direccion, estatus_registro, creado_por, fecha_creacion, modificado_por, fecha_modificacion)
VALUES('Unidad de Transparencia', '86000', 'Palacio de Gobierno, Calle Independencia No.2 Col. Centro', 'VIG', 'gu_credencial', '2023-12-20 14:18:30.099', 'gu_credencial', '2023-12-20 14:18:30.099');
INSERT INTO public.departamentos
(nombre, cp, direccion, estatus_registro, creado_por, fecha_creacion, modificado_por, fecha_modificacion)
VALUES('Unidad de Ayudantía', '86000', 'Palacio de Gobierno, Calle Independencia No.2 Col. Centro', 'VIG', 'gu_credencial', '2023-12-20 14:19:02.546', 'gu_credencial', '2023-12-20 14:19:02.546');
INSERT INTO public.departamentos
(nombre, cp, direccion, estatus_registro, creado_por, fecha_creacion, modificado_por, fecha_modificacion)
VALUES('Unidad de Avanzada', '86000', 'Palacio de Gobierno, Calle Independencia No.2 Col. Centro', 'VIG', 'gu_credencial', '2023-12-20 14:19:15.029', 'gu_credencial', '2023-12-20 14:19:15.029');
INSERT INTO public.departamentos
(nombre, cp, direccion, estatus_registro, creado_por, fecha_creacion, modificado_por, fecha_modificacion)
VALUES('Unidad de Soporte Técnico, Informático y de Comunicaciones', '86000', 'Palacio de Gobierno, Calle Independencia No.2 Col. Centro', 'VIG', 'gu_credencial', '2023-12-20 14:19:46.925', 'gu_credencial', '2023-12-20 14:19:46.925');

*/
