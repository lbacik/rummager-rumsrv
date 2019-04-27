#!/usr/bin/env bash

rm -drf src/Infrastructure/Doctrine/Entities/Rummager/*
rm var/db.sqlite

vendor/bin/doctrine orm:generate-entities src/Infrastructure/Doctrine/Entities/
