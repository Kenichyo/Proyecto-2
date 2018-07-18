create database proyectosmart;

use proyectosmart;

create table usuario(
	id int(8) primary key not null,
    nombre varchar(10) not null,
    apellido varchar(10) not null,
    pass varchar(8) not null,
    email varchar(20) not null
);

create table adaptador(
	sn int primary key not null,
    id_user int(8) not null, 
    hora1 int(2),
    minuto1 int(2),
    hora2 int(2),
    minuto2 int(2),
    hora3 int(2),
    minuto3 int(2),
    FOREIGN KEY (id_user) REFERENCES usuario(id)
);

create table dispensador(
	sn int primary key not null,
    id_user int(8) not null, 
    hora1 int(2),
    minuto1 int(2),
    cantidad1 int(3),
    hora2 int(2),
    minuto2 int(2),
    cantidad2 int(3),
    FOREIGN KEY (id_user) REFERENCES usuario(id)
);
