# Faucet for Noso Coin

Implementation of a faucet for the cryptocoin Noso.

![bulma version](https://img.shields.io/badge/bulma-0.9.0-4169e1.svg)


## Setting the .env

On the folder `config` pleas rename `.env.example` to `.env` and edit the values.

## Using Apache2

Create a virtual host that points to the `webroot` folder

## Using PHP inbuilt web server

If you do not have a `LAMP` or `WAMP` stack, on the root folder of the project issue the following:

```console
$ php -S localhost:8080 -t webroot
```

This will start a web server on port 8080 and will server the contents of webroot

## Using MySql Database
The database is in the db folder
Load the database and write the data to config/.env

