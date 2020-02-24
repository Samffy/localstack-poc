# Localstack POC in PHP

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)

This project is a proof of concept to test localstack using PHP.  
This work is based mainly on [Symfony Console component](https://symfony.com/doc/current/components/console.html) and [localstack/localstack](https://github.com/localstack/localstack).

## Installation

Retrieve repository : 

```
$ git clone git@github.com:Samffy/localstack-poc.git
```

Go to the project directory : 

```
$ cd localstack-poc
```

Create your `.env` file based on [`.env.dist`](.env.dist) (AWS credentials could be what you want as their will be set on localstack using the Docker Compose environments variables).

Build and launch project using : 

```
$ make build
$ make start
```

Localstack dasboard is available at : http://127.0.0.1:8055

Available Services:  
 - S3 with a bucket named `demo` on region `eu-west-1` (host: `http://localstack:4572`)

## How to test ?

Access the PHP container using : 

```
$ make shell
```

Try to send a file on the S3 demo bucket : 

```
$ bin/console aws:s3:put src/Resources/localstack-logo.png
```

## Developer tools

This project use `Makefile` to simplify application usage.  
[Take a look](Makefile), you will find some useful commands.
