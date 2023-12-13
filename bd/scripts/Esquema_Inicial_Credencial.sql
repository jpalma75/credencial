-- Drop table

-- DROP TABLE encargado;

CREATE TABLE encargado (
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

ALTER TABLE encargado ADD estatus_registro varchar(3) NULL DEFAULT 'VIG'::character varying;

-- Drop table

-- DROP TABLE empleado;

CREATE TABLE empleado (
	id int4 NOT NULL GENERATED ALWAYS AS IDENTITY,
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
	CONSTRAINT empleado_pk PRIMARY KEY (id)
);

ALTER TABLE empleado ADD tel_emergencia varchar(12) NULL;

ALTER TABLE empleado_departamento ADD id int4 NOT NULL GENERATED ALWAYS AS IDENTITY;

ALTER TABLE departamentos ADD modificado_por varchar(50) NULL DEFAULT CURRENT_USER;

ALTER TABLE empleado ADD ruta_firma varchar(100) NULL;

ALTER TABLE empleado ADD fecha_termino_vigencia date NOT NULL;

ALTER TABLE empleado ADD creado_por varchar(50) NULL DEFAULT CURRENT_USER;

ALTER TABLE empleado ADD categoria varchar(40) NOT NULL COLLATE "es-MX-x-icu";

ALTER TABLE encargado ADD creado_por varchar(50) NULL DEFAULT CURRENT_USER;

ALTER TABLE encargado ADD ruta_firma varchar(100) NULL;

ALTER TABLE empleado ADD curp varchar(19) NOT NULL COLLATE "es-MX-x-icu";

ALTER TABLE empleado ADD ruta_foto varchar(100) NULL;

ALTER TABLE empleado ADD id int4 NOT NULL GENERATED ALWAYS AS IDENTITY;

ALTER TABLE empleado ADD tipo_sanguineo varchar(3) NULL COLLATE "es-MX-x-icu";

ALTER TABLE empleado ADD fecha_creacion timestamp NULL DEFAULT LOCALTIMESTAMP;

ALTER TABLE empleado_departamento ADD id_departamento int4 NOT NULL;

ALTER TABLE encargado ADD nombre varchar(150) NOT NULL COLLATE "es-MX-x-icu";

ALTER TABLE empleado_departamento ADD id_encargado int4 NOT NULL;

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

ALTER TABLE empleado ADD ap_paterno varchar(50) NOT NULL COLLATE "es-MX-x-icu";

ALTER TABLE empleado_departamento ADD fecha_creacion timestamp NULL DEFAULT LOCALTIMESTAMP;

ALTER TABLE encargado ADD id int4 NOT NULL GENERATED ALWAYS AS IDENTITY;

ALTER TABLE encargado ADD cargo varchar(100) NOT NULL COLLATE "es-MX-x-icu";

ALTER TABLE empleado ADD nombre varchar(50) NOT NULL COLLATE "es-MX-x-icu";

ALTER TABLE departamentos ADD estatus_registro varchar(3) NOT NULL DEFAULT 'VIG'::character varying;

-- Drop table

-- DROP TABLE empleado_departamento;

CREATE TABLE empleado_departamento (
	id int4 NOT NULL GENERATED ALWAYS AS IDENTITY,
	id_empleado int4 NOT NULL,
	id_departamento int4 NOT NULL,
	id_encargado int4 NOT NULL,
	estatus_registro varchar(3) NULL DEFAULT 'VIG'::character varying,
	creado_por varchar(50) NULL DEFAULT CURRENT_USER,
	fecha_creacion timestamp NULL DEFAULT LOCALTIMESTAMP,
	modificado_por varchar(50) NULL DEFAULT CURRENT_USER,
	fecha_modificacion timestamp NULL DEFAULT LOCALTIMESTAMP,
	CONSTRAINT empleado_departamento_pk PRIMARY KEY (id),
	CONSTRAINT empleado_departamento_fk FOREIGN KEY (id_empleado) REFERENCES empleado(id) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT empleado_departamento_fk_1 FOREIGN KEY (id_encargado) REFERENCES encargado(id) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT empleado_departamento_fk_2 FOREIGN KEY (id_departamento) REFERENCES departamentos(id) ON DELETE RESTRICT ON UPDATE RESTRICT
);

ALTER TABLE empleado ADD num_seguro varchar(8) NOT NULL COLLATE "es-MX-x-icu";

ALTER TABLE departamentos ADD creado_por varchar(50) NOT NULL DEFAULT CURRENT_USER;

ALTER TABLE departamentos ADD direccion varchar(200) NOT NULL COLLATE "es-MX-x-icu";

ALTER TABLE empleado ADD fecha_inicio_vigencia date NOT NULL;

ALTER TABLE empleado_departamento ADD estatus_registro varchar(3) NULL DEFAULT 'VIG'::character varying;

ALTER TABLE empleado ADD estatus_registro varchar(3) NULL DEFAULT 'VIG'::character varying;

ALTER TABLE empleado ADD modificado_por varchar(50) NULL DEFAULT CURRENT_USER;

ALTER TABLE encargado ADD fecha_creacion timestamp NULL DEFAULT LOCALTIMESTAMP;

ALTER TABLE encargado ADD modificado_por varchar(50) NULL DEFAULT CURRENT_USER;

ALTER TABLE empleado ADD ap_materno varchar(50) NULL COLLATE "es-MX-x-icu";

ALTER TABLE departamentos ADD fecha_modificacion timestamp NULL DEFAULT LOCALTIMESTAMP;

ALTER TABLE empleado_departamento ADD id_empleado int4 NOT NULL;

ALTER TABLE empleado ADD fecha_modificacion timestamp NULL DEFAULT LOCALTIMESTAMP;

ALTER TABLE empleado_departamento ADD fecha_modificacion timestamp NULL DEFAULT LOCALTIMESTAMP;

ALTER TABLE empleado_departamento ADD modificado_por varchar(50) NULL DEFAULT CURRENT_USER;

ALTER TABLE departamentos ADD fecha_creacion timestamp NOT NULL DEFAULT LOCALTIMESTAMP;

ALTER TABLE encargado ADD fecha_modificacion timestamp NULL DEFAULT LOCALTIMESTAMP;

ALTER TABLE empleado_departamento ADD creado_por varchar(50) NULL DEFAULT CURRENT_USER;
