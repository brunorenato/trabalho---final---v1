CREATE DATABASE mercado;
CREATE TABLE tbl_produtos(
id int(4) not null auto_increment primary key,
produto varchar(30) not null,
preco double not null
);