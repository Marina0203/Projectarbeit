# Projektarbeit

Get going quickly with TYPO3 CMS.

* Frontend - https://projektarbeit.ddev.site
* Backend - https://projektarbeit.ddev.site/typo3
* Mailpit - https://projektarbeit.ddev.site:8302

## Default credentials
TYPO3 backend-user:
```
Username: sunzinet
Password: Test2024!
```

## Quickstart

Start ddev, import db and install packages:

```bash
ddev start
```
```bash
ddev db-import
```
```bash
ddev composer install
```

## Build frontend:

```bash
cd assets && npm ci && npm run build
```

## Using Testing Framework
```bash
ddev ssh
```
This command has to be executed in the ddev container.
```
cd packages/sz_assets && composer install
```
Run all tests:
```bash
packages/sz_assets/Build/Scripts/runTest.sh
```

## Documentation

  * TYPO3 - https://docs.typo3.org/
  * Testing Framework - https://docs.typo3.org/m/typo3/reference-coreapi/12.4/en-us/Testing/Index.html
  * DDEV - https://ddev.readthedocs.io/en/stable/

## License

GPL-2.0 or later
