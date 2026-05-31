--Creacion de la base de datos
CREATE DATABASE economicapp;

\c economicapp;

CREATE TABLE users(
  user_id UUID DEFAULT gen_random_uuid() PRIMARY KEY UNIQUE,
  name_user varchar(100) NOT NULL,
  last_name varchar(100) NOT NULL,
  email varchar(100) NOT NULL UNIQUE,
  password_user TEXT NOT NULL
);

CREATE TABLE banco(
  bank_id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  bank_name VARCHAR(100) NOT NULL,
  bank_code VARCHAR(50) NOT NULL UNIQUE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE cuentas(
  cuenta_id UUID DEFAULT gen_random_uuid() PRIMARY KEY,

  user_id UUID NOT NULL,
  bank_id UUID NOT NULL,

  account_number VARCHAR(100) NOT NULL UNIQUE,
  saldo NUMERIC(12,2) DEFAULT 0.00,

  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT fk_user
    FOREIGN KEY(user_id)
    REFERENCES users(user_id)
    ON DELETE CASCADE,

  CONSTRAINT fk_bank
    FOREIGN KEY(bank_id)
    REFERENCES banco(bank_id)
    ON DELETE CASCADE
);

INSERT INTO banco (bank_name, bank_code) VALUES
('Banco de Chile', '001'),
('Banco Estado', '012'),
('Banco BCI', '016'),
('Scotiabank Chile', '014'),
('Banco Santander Chile', '037'),
('Itaú Chile', '039'),
('Banco Security', '049'),
('Banco Falabella', '051'),
('Banco Ripley', '053'),
('Banco Consorcio', '055'),
('Banco Internacional', '031'),
('Banco BICE', '028'),
('HSBC Chile', '027');