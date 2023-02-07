CREATE TABLE administradores(
    cod_adm varchar(12) primary key,
    nomb_adm varchar(50),
    clave bytea
);

CREATE TABLE docentes(
    cod_doc varchar(12) primary key,
    nomb_doc varchar(50),
    fecha_nac date,
    edad int,
    genero varchar(15),
    clave bytea
);

CREATE TABLE estudiantes(
    cod_est varchar(10) primary key,
    nomb_est varchar(50),
    fecha_nac date,
    edad int,
    genero varchar(15)
);

CREATE TABLE cursos(
    cod_cur varchar(15) primary key,
    nomb_cur varchar(50)
);

CREATE TABLE desarrollos(
    cod_des varchar (20) primary key,
    año int,
    ciclo int,
    cod_doc varchar(12),
    cod_cur varchar(15)
);
ALTER TABLE desarrollos ADD CONSTRAINT fk_cod_doc FOREIGN KEY (cod_doc) REFERENCES docentes(cod_doc) ON UPDATE CASCADE;
ALTER TABLE desarrollos ADD CONSTRAINT fk_cod_cur FOREIGN KEY (cod_cur) REFERENCES cursos(cod_cur) ON UPDATE CASCADE;

CREATE TABLE inscritos(
    cod_est varchar(10),
    cod_des varchar(20),
    definitiva float DEFAULT 0 NOT NULL,
    primary key(cod_est, cod_des) 
);

ALTER TABLE inscritos ADD CONSTRAINT fk_cod_est1 FOREIGN KEY (cod_est) REFERENCES estudiantes(cod_est) ON UPDATE CASCADE;
ALTER TABLE inscritos ADD CONSTRAINT fk_cod_des1 FOREIGN KEY (cod_des) REFERENCES desarrollos(cod_des) ON UPDATE CASCADE;

CREATE TABLE calificaciones(
    cod_cal int primary key,
    descripcion varchar(30),
    porcentaje int,
    poscision int,
    cod_des varchar(20)
);
ALTER TABLE calificaciones ADD CONSTRAINT fk_cod_des1 FOREIGN KEY (cod_des) REFERENCES desarrollos(cod_des) ON UPDATE CASCADE;

CREATE TABLE notas(
    cod_est varchar(10),
    cod_des varchar(15),
    cod_cal int,
    valor float,
    primary key(cod_des, cod_est, cod_cal)
);
ALTER TABLE notas ADD CONSTRAINT fk_cod_est2 FOREIGN KEY (cod_est) REFERENCES estudiantes(cod_est) ON UPDATE CASCADE;
ALTER TABLE notas ADD CONSTRAINT fk_cod_des2 FOREIGN KEY (cod_des) REFERENCES desarrollos(cod_des) ON UPDATE CASCADE;
ALTER TABLE notas ADD CONSTRAINT fk_cod_cal FOREIGN KEY (cod_cal) REFERENCES calificaciones(cod_cal) ON UPDATE CASCADE;

CREATE TABLE bitacora(
	accion_num serial primary key,
	nomb_doc varchar(12),
	accion varchar(20),
	nomb_cur varchar(20),
	fecha_cur int,
	ciclo int,
	nomb_est varchar(10),
	fecha date
);


-- TRIGGERS

-- clave por defecto
CREATE OR REPLACE FUNCTION clave_default() RETURNS TRIGGER AS $clave_default$
  DECLARE
  BEGIN
   
   NEW.clave := 'unillanos';
 
   RETURN NEW;
  END;
$clave_default$ LANGUAGE plpgsql;


CREATE TRIGGER clave_default BEFORE INSERT OR UPDATE 
ON docentes FOR EACH ROW 
EXECUTE PROCEDURE clave_default();


-- calculo de la edad

CREATE OR REPLACE FUNCTION edad_c() RETURNS TRIGGER AS $edad_c$
  DECLARE
  BEGIN
   
   NEW.edad :=date_part('year', CURRENT_DATE)-date_part('year', NEW.fecha_nac);
 
   RETURN NEW;
  END;
$edad_c$ LANGUAGE plpgsql;

CREATE TRIGGER edad_c BEFORE INSERT OR UPDATE 
ON estudiantes FOR EACH ROW 
EXECUTE PROCEDURE edad_c();

CREATE TRIGGER edad_c BEFORE INSERT OR UPDATE 
ON docentes FOR EACH ROW 
EXECUTE PROCEDURE edad_c();


-- Generar, actualizar y borrar notas

CREATE OR REPLACE FUNCTION  definirNotas()
RETURNS TRIGGER AS $$
DECLARE
	cal calificaciones%ROWTYPE;
BEGIN
	FOR cal.cod_cal IN SELECT cod_cal FROM calificaciones WHERE cod_des = NEW.cod_des
	LOOP
		INSERT INTO notas values(NEW.cod_est, NEW.cod_des, cal.cod_cal, 0);
	END LOOP;
RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION  borrarNotas()
RETURNS TRIGGER AS $$
DECLARE
	cal calificaciones%ROWTYPE;
BEGIN
	FOR cal.cod_cal IN SELECT cod_cal FROM calificaciones WHERE cod_des = OLD.cod_des
	LOOP
		DELETE FROM notas WHERE cod_cal = cal.cod_cal AND cod_est = OLD.cod_est;
	END LOOP;
RETURN OLD;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION  definitiva()
RETURNS TRIGGER AS $$
DECLARE
	cal calificaciones%ROWTYPE;
	defin FLOAT DEFAULT 0;
BEGIN
	FOR cal.cod_cal IN SELECT cod_cal FROM calificaciones WHERE cod_des = NEW.cod_des
	LOOP
		defin = defin + ((SELECT valor FROM notas WHERE cod_cal = cal.cod_cal AND cod_est = NEW.cod_est) * ((SELECT porcentaje FROM calificaciones WHERE cod_cal = cal.cod_cal))/100);
	END LOOP;
	UPDATE inscritos SET definitiva = defin WHERE cod_est = NEW.cod_est AND cod_des = NEW.cod_des;
RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER nuevasNotas AFTER INSERT
ON inscritos FOR EACH ROW
EXECUTE PROCEDURE definirNotas();

CREATE TRIGGER eliminarNotas BEFORE DELETE
ON inscritos FOR EACH ROW
EXECUTE PROCEDURE borrarNotas();

CREATE TRIGGER generarDefinitiva AFTER UPDATE
ON notas FOR EACH ROW
EXECUTE PROCEDURE definitiva();


-- Actualizar bitacora

CREATE OR REPLACE FUNCTION entrada()
RETURNS TRIGGER AS $$
BEGIN
	IF(TG_OP = 'DELETE')THEN
		INSERT INTO bitacora(nomb_doc, accion, nomb_cur, fecha_cur, ciclo, nomb_est, fecha) values((SELECT nomb_doc FROM docentes WHERE cod_doc = (SELECT cod_doc FROM desarrollos WHERE cod_des = OLD.cod_des)),'ELIMINÓ DEL CURSO ', (SELECT nomb_cur FROM cursos WHERE cod_cur = (SELECT cod_cur FROM desarrollos WHERE cod_des = OLD.cod_des)), (SELECT año FROM desarrollos WHERE cod_des = OLD.cod_des), (SELECT ciclo FROM desarrollos WHERE cod_des = OLD.cod_des), (SELECT nomb_est FROM estudiantes WHERE cod_est = OLD.cod_est), now());
		RETURN OLD;
	ELSEIF (TG_OP = 'UPDATE')THEN
		INSERT INTO bitacora(nomb_doc, accion, nomb_cur, fecha_cur, ciclo, nomb_est, fecha) values((SELECT nomb_doc FROM docentes WHERE cod_doc = (SELECT cod_doc FROM desarrollos WHERE cod_des = NEW.cod_des)),'CALIFICÓ EN  ', (SELECT nomb_cur FROM cursos WHERE cod_cur = (SELECT cod_cur FROM desarrollos WHERE cod_des = NEW.cod_des)), (SELECT año FROM desarrollos WHERE cod_des = NEW.cod_des), (SELECT ciclo FROM desarrollos WHERE cod_des = NEW.cod_des), (SELECT nomb_est FROM estudiantes WHERE cod_est = NEW.cod_est), now());
		RETURN NEW;
	ELSEIF (TG_OP = 'INSERT')THEN
		INSERT INTO bitacora(nomb_doc, accion, nomb_cur, fecha_cur, ciclo, nomb_est, fecha) values((SELECT nomb_doc FROM docentes WHERE cod_doc = (SELECT cod_doc FROM desarrollos WHERE cod_des = NEW.cod_des)),'REGISTRÓ EN EL CURSO  ', (SELECT nomb_cur FROM cursos WHERE cod_cur = (SELECT cod_cur FROM desarrollos WHERE cod_des = NEW.cod_des)), (SELECT año FROM desarrollos WHERE cod_des = NEW.cod_des), (SELECT ciclo FROM desarrollos WHERE cod_des = NEW.cod_des), (SELECT nomb_est FROM estudiantes WHERE cod_est = NEW.cod_est), now());
		RETURN NEW;
	END IF;
	RETURN NULL;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER agragarBitacora AFTER INSERT OR UPDATE OR DELETE
ON inscritos FOR EACH ROW
EXECUTE PROCEDURE entrada();

