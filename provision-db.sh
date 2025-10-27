#!/usr/bin/env bash
set -e

echo "=== Actualizando paquetes ==="
sudo apt update -y

echo "=== Instalando PostgreSQL ==="
sudo apt install -y postgresql postgresql-contrib

echo "=== Iniciando servicio de PostgreSQL ==="
sudo systemctl enable postgresql
sudo systemctl start postgresql

echo "=== Creando usuario y base de datos ==="
sudo -u postgres psql <<EOF
CREATE USER vagrant_user WITH PASSWORD 'vagrant_pass';
CREATE DATABASE webapp_db OWNER vagrant_user;
\connect webapp_db
CREATE TABLE personas (id serial PRIMARY KEY, nombre text, ciudad text);
INSERT INTO personas (nombre, ciudad) VALUES
('María','Bogotá'),
('Carlos','Medellín'),
('Ana','Cali');
EOF

echo "=== Provisionamiento de PostgreSQL completado correctamente ==="

