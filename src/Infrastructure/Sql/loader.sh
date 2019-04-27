#!/usr/bin/env bash

DOCTRINE=vendor/bin/doctrine

$DOCTRINE dbal:import src/Infrastructure/Sql/Views/dw_f_ip_d.sql
$DOCTRINE dbal:import src/Infrastructure/Sql/Views/dw_f_ip_m.sql
$DOCTRINE dbal:import src/Infrastructure/Sql/Views/node_last_check.sql
$DOCTRINE dbal:import src/Infrastructure/Sql/Views/nlc_active_dead.sql

$DOCTRINE dbal:import src/Infrastructure/Sql/StoredProcedures/etl_f_ip.sql
$DOCTRINE dbal:import src/Infrastructure/Sql/StoredProcedures/node_status_update.sql
$DOCTRINE dbal:import src/Infrastructure/Sql/StoredProcedures/smtp_garbage_collector.sql
