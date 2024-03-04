# TYPO3 Distribution - GitLab Project Template

Get going quickly with TYPO3 CMS and GitLab.

* Frontend - https://sunzinet-typo3-template.ddev.site
* Backend - https://sunzinet-typo3-template.ddev.site/typo3
* Install - https://sunzinet-typo3-template.ddev.site/typo3/install.php
* Mailpit - https://sunzinet-typo3-template.ddev.site:8302

## Default credentials

Make sure to change these and also the encryption key in the
`config/system/additional.production.php`.

TYPO3 backend-user:
```
Username: sunzinet
Password: wH!u*MLf4E5N#:,xf6^.,fwW~e7T@mD=aQq
```

Installtool:
```
joh316
```

## Quickstart

Start ddev, import db and install packages (formerly known as `make init`):

```bash
ddev start && ddev db-import && ddev composer install
```

For a fresh restart

```bash
ddev stop && ddev remove && ddev start && ddev db-import && ddev composer install
```

Prepare and build frontend:

```
npm install
npm run build:production
```

## DDEV commands

Removes orphan and deleted records:
```bash
ddev cleanup
```

Executes a composer command within the web container:
```bash
ddev composer
```

Export project db to zipped sql file (.ddev/backup/db-dump.sql.gz):
```bash
ddev db-export
```
```bash
ddev db-export OtherConnection
```

Import previously exported sql file into the project (.ddev/backup/db-dump.sql.gz):
```bash
ddev db-import
```

Update database schema (set -a or --all to allow destructive changes):
```bash
ddev db-update
```
```bash
ddev db-update -a
```
```bash
ddev db-update --all
```

Get a detailed description of a running ddev project:
```bash
ddev describe
```

Execute a shell command in the container for a service. Uses the web service by default:
```bash
ddev exec
```

Fix file and folder permissions (also accepts relative and absolute paths):
```bash
ddev fix-perms
```
```bash
ddev fix-perms public/fileadmin
```
```bash
ddev fix-perms /var/www/html/public/fileadmin
```

Flush all TYPO3 caches:
```bash
ddev flush
```

Restart the project:
```bash
ddev restart
```

Run sequelace with current project database:
```bash
ddev sequelace
```

Run a shell command in the container for a service. Uses web service by default:
```bash
ddev exec
```
```bash
ddev exec ls -lahF
```

Starts a shell session in the container for a service. Uses web service by default:
```bash
ddev ssh
```

Start a ddev project:
```bash
ddev start
```

Stop and remove the containers of a project. Does not lose or harm anything:
```bash
ddev stop
```

Run TYPO3 CLI (typo3)/TYPO3 Console (typo3cms) command inside the web container:
```bash
ddev typo3
```

## Files and folders

The folder `packages` contains all your local extension/packages.
Require these packages simply by using `composer req vendor/package:@dev`

`assets` contains all scss, javascript, images and fonts which will be processed
by webpack and stored in `packages/*/Resources/Public/`.


## Deployer

`deploy.yaml` contains an example configuration for deployer
(PHP deployment tool). It's recommended to run [deployer](https://deployer.org/)
in GitLab CI.

Run deployer locally (only for testing):
```
./vendor/bin/dep deploy -vvv staging
```

## Documentation

  * TYPO3 - https://docs.typo3.org/
  * DDEV - https://ddev.readthedocs.io/en/stable/
  * Colima - https://ddev.readthedocs.io/en/stable/users/install/docker-installation/#colima
  * Webpack - https://webpack.js.org/concepts/
  * Deployer - https://deployer.org/docs/7.x/basics
  * Sequel Ace - https://sequel-ace.com/

## License

GPL-2.0 or later
