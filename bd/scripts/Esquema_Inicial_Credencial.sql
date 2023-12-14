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
	id_encargado int4 NULL,
	nombre varchar(100) NOT NULL COLLATE "es-MX-x-icu",
	cp varchar(6) NOT NULL,
	direccion varchar(200) NOT NULL COLLATE "es-MX-x-icu",
	estatus_registro varchar(3) NOT NULL DEFAULT 'VIG'::character varying,
	creado_por varchar(50) NOT NULL DEFAULT CURRENT_USER,
	fecha_creacion timestamp NOT NULL DEFAULT LOCALTIMESTAMP,
	modificado_por varchar(50) NULL DEFAULT CURRENT_USER,
	fecha_modificacion timestamp NULL DEFAULT LOCALTIMESTAMP,	
	CONSTRAINT departamentos_pk PRIMARY KEY (id),
	CONSTRAINT departamentos_encargado_fk FOREIGN KEY (id_encargado) REFERENCES encargados(id) ON DELETE RESTRICT ON UPDATE RESTRICT
);


-- empleados definition

-- Drop table

-- DROP TABLE empleados;

CREATE TABLE empleados (
	id int4 NOT NULL GENERATED ALWAYS AS IDENTITY,
	id_departamento int4 NOT NULL,
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
	ruta_credencial varchar(100) NULL,
	tel_emergencia varchar(12) NULL,
	estatus_registro varchar(3) NULL DEFAULT 'VIG'::character varying,
	creado_por varchar(50) NULL DEFAULT CURRENT_USER,
	fecha_creacion timestamp NULL DEFAULT LOCALTIMESTAMP,
	modificado_por varchar(50) NULL DEFAULT CURRENT_USER,
	fecha_modificacion timestamp NULL DEFAULT LOCALTIMESTAMP,
	CONSTRAINT empleado_pk PRIMARY KEY (id),
	CONSTRAINT empleados_departamento_fk FOREIGN KEY (id_departamento) REFERENCES departamentos(id) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT empleados_empleados_fk FOREIGN KEY (id_empleado_anterior) REFERENCES empleados(id)
);