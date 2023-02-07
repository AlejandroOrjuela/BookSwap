CREATE TABLE usuario(
    id_u serial primary key,
    nomb_u varchar(50),
    fecha_nac date,
    vendedor boolean,
    clave bytea
);

CREATE TABLE publicacion(
    id_p serial primary key,
    nomb_p varchar(20),
    precio int,
    descr varchar(150),
    disp boolean,
    id_u serial
);

ALTER TABLE pubiclacion ADD CONSTRAINT fk_id_u1 FOREIGN KEY (id_u) REFERENCES usuario(id_u);

CREATE TABLE compra(
    id_c serial primary key,
    nomb_l varchar(20),
    fecha date,
    pagado boolean,
    id_u serial,
    id_p serial
);

ALTER TABLE compra ADD CONSTRAINT fk_id_u2 FOREIGN KEY (id_u) REFERENCES usuario(id_u);
ALTER TABLE compra ADD CONSTRAINT fk_id_p1 FOREIGN KEY (id_p) REFERENCES pubiclacion(id_p);
