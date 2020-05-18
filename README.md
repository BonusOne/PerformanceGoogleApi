# Performance Media Test

Performance Media Test to get JSON file with data, save to local dastabase and update Google Sheets


## Requirements
- PHP >7.2.5
- MySQL
- Composer

## Installation

- Copy repository
- Change the `.env--sample` file to configure mysql and swiftmailer and rename to `.env` or `.env.local`
- `composer install`
- `php bin/console doctrine:migrations:migrate`

On Apache must have .htaccess:
```
RewriteEngine on
   
# if a directory or a file exists, use it directly
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
   
# otherwise forward it to index.php
RewriteRule . index.php
```


## DOCS

Performance Media Test based on Symfony 5.* with:
```json
"php": "^7.2.5",
"ext-PDO": "^7.3",
"ext-ctype": "*",
"ext-curl": "^7.3",
"ext-iconv": "*",
"ext-json": "^1.7",
"ext-openssl": "^7.3",
"deployer/recipes": "^6.2",
"doctrine/annotations": "^1.10",
"doctrine/doctrine-bundle": "^2.0",
"google/apiclient": "^2.4",
"jms/serializer-bundle": "^3.5",
"nelmio/api-doc-bundle": "^3.6",
"sensio/framework-extra-bundle": "^5.5",
"symfony/apache-pack": "^1.0",
"symfony/console": "5.0.*",
"symfony/dotenv": "5.0.*",
"symfony/flex": "^1.3.1",
"symfony/framework-bundle": "5.0.*",
"symfony/monolog-bundle": "^3.5",
"symfony/orm-pack": "^1.0",
"symfony/swiftmailer-bundle": "^3.4",
"symfony/templating": "5.0.*",
"symfony/translation": "5.0.*",
"symfony/yaml": "5.0.*"
```
