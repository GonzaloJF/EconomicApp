CREATE SCHEMA economicapp;

CREATE TABLE economicapp.usuarios(idusuario UUID DEFAULT gen_random_uuid() PRIMARY KEY, email VARCHAR ,username VARCHAR, nombre VARCHAR, lastname VARCHAR, telefono VARCHAR, contraseña TEXT);

CREATE TABLE economicapp.bancos(idbancos UUID DEFAULT gen_random_uuid()  PRIMARY KEY, nombre VARCHAR, codigobanco VARCHAR(20));

CREATE TABLE economicapp.cuentasbancarias(idcuenta UUID DEFAULT gen_random_uuid()  PRIMARY KEY, numero_cuenta VARCHAR, saldo NUMERIC, idbancos UUID, idusuario UUID, CONSTRAINT fk_idbancos FOREIGN KEY(idbancos) REFERENCES economicapp.bancos(idbancos), CONSTRAINT fk_idusuario FOREIGN KEY (idusuario) REFERENCES economicapp.usuarios(idusuario));

ALTER TABLE economicapp.usuarios DROP COLUMN contraseña;

ALTER TABLE economicapp.usuarios ADD COLUMN contrasena;

