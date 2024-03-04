#!/bin/bash

## Description: Restore db
## Usage: db-restore
## Example: "ddev db-restore"

ddev import-db --src=./.ddev/backup/db-dump.sql.gz
