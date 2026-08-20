#!/bin/bash
set -e

cd /docker-entrypoint-initdb.d

echo "=========================================="
echo "Cargando base de datos employees..."
echo "=========================================="

mysql -u root -p"${MYSQL_ROOT_PASSWORD}" < employees.master

echo "=========================================="
echo "Carga completada."
echo "=========================================="
