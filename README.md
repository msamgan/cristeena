# Cristeena Application Skeleton

[![Build Status](https://img.shields.io/travis/cakephp/app/master.svg?style=flat-square)](https://travis-ci.org/cakephp/app)

A skeleton for creating backend applications with [CakePHP](https://cakephp.org) 3.x. with basic user module for 3 different roles.

The framework source code can be found here: [samgan-khan/cristeena](https://github.com/msamgan/cristeena).

## Demo

check out the [demo here](https://cristeena.codebysamgan.com/)

## Installation

1. Download [Composer](https://getcomposer.org/doc/00-intro.md) or update `composer self-update`.
2. Run `php composer.phar create-project --prefer-dist samgan-khan/cristeena [app_name]`.

If Composer is installed globally, run

```bash
composer create-project --prefer-dist samgan-khan/cristeena
```

In case you want to use a custom app dir name (e.g. `/myapp/`):

```bash
composer create-project --prefer-dist samgan-khan/cristeena myapp
```

You can now either use your machine's webserver to view the default home page, or start
up the built-in webserver with:

```bash
bin/cake server -p 8765
```

Then visit `http://localhost:8765` to see the welcome page.

## Update

Since this skeleton is a starting point for your application and various files
would have been modified as per your needs, there isn't a way to provide
automated upgrades, so you have to do any updates manually.

## Configuration

Read and edit `config/app.php` and setup the `'Datasources'` and any other
configuration relevant for your application.

## Layout

The app skeleton uses a CakePHP 3.x. framework by default.

## Documentation

For detailed documentation visit [here](https://codebysamgan.com/cristeena-documetation/)
