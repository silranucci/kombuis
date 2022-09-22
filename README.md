## Introduction

**Kombuis** is a clone of Grocy. 

It is the manager of your kitchen.

It allows you to:
- keep track of the foods in your pantry (how much and where they are), 
- manage the weekly menu
- make a shopping list based on the missing ingredientsin your pantry necessary to cook a given recipe. 

> **NOTE**: It is intended as a purely personal project and with self-teaching purposes (at least for now). 
> If you need a real ERP system, use [Grocy](https://grocy.info/).

## Setup

If you've just downloaded the code, congratulations!

To get it working, follow these steps:

**Download Composer dependencies**

Make sure you have [Composer installed](https://getcomposer.org/download/)
and then run:

```
composer install
```

You may alternatively need to run `php composer.phar install`, depending
on how you installed Composer.

**Start the built-in web server**

You can use Nginx or Apache, but the built-in web server works
great:

```
symfony serve 
```

**Start webpack encore**

```
yarn watch
```

**Setup the Database**

Make sure you have [Docker](https://docs.docker.com/get-started/#download-and-install-docker) and
[Docker Compose]() installed and then run:

```
docker-compose up
```

Now check out the site at `http://localhost:8000`

Have fun!

**(optional) Add bash alias for better DX**

For better DX to avoid having to use `./vendor/bin/phpunit` all the time create a bash alias:

```bash
alias phpunit=./vendor/bin/phpunit
```

From now on you will be able to run local PHPUnit from your project directory by executing `phpunit` command. Add alias command to your bash profile if you don't want to run it every time you enter a new terminal.

## Have Ideas, Feedback or an Issue?

If you have suggestions or questions, please feel free to
open an issue on this repository. I will sincerely appreciate.

## Thanks!


