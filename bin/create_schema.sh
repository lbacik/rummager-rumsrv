#!/usr/bin/env bash

# vendor/bin/doctrine orm:schema-tool:drop --force

vendor/bin/doctrine orm:schema-tool:create

php src/Infrastructure/Doctrine/DataFixtures/Loader/Execute.php

src/Infrastructure/Sql/loader.sh
