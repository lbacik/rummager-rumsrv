#!/usr/bin/env bash

SCRIPT_DIR=`dirname "$0"`

DOCTRINE=vendor/bin/doctrine

$DOCTRINE dbal:import ${SCRIPT_DIR}/Views/dw_f_ip_d.sql
$DOCTRINE dbal:import ${SCRIPT_DIR}/Views/dw_f_ip_m.sql
$DOCTRINE dbal:import ${SCRIPT_DIR}/Views/node_last_check.sql
$DOCTRINE dbal:import ${SCRIPT_DIR}/Views/nlc_active_dead.sql

$DOCTRINE dbal:import ${SCRIPT_DIR}/StoredProcedures/etl_f_ip.sql
$DOCTRINE dbal:import ${SCRIPT_DIR}/StoredProcedures/node_status_update.sql
$DOCTRINE dbal:import ${SCRIPT_DIR}/StoredProcedures/smtp_garbage_collector.sql
