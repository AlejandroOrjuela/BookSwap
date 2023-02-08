CREATE TABLE usuario(
    id_u varchar(20) primary key,
    nomb_u varchar(50),
    fecha_nac date,
    vendedor boolean,
    clave bytea
);

CREATE TABLE publicacion(
    id_p varchar(10) primary key,
    nomb_p varchar(20),
    precio int,
    descr varchar(150),
    disp boolean,
    id_u varchar(20)
);

ALTER TABLE publicacion ADD CONSTRAINT fk_id_u1 FOREIGN KEY (id_u) REFERENCES usuario(id_u);

CREATE TABLE compra(
    id_c serial primary key,
    fecha date,
    pagado boolean,
    id_u varchar(10),
    id_p varchar(10)
);

ALTER TABLE compra ADD CONSTRAINT fk_id_u2 FOREIGN KEY (id_u) REFERENCES usuario(id_u);
ALTER TABLE compra ADD CONSTRAINT fk_id_p1 FOREIGN KEY (id_p) REFERENCES pubiclacion(id_p);
