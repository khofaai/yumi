# yumi-console
This package used for [chibi framework](https://github.com/akiyamaSM/chibi)
## Installation
```
composer require yumi/console
```
this package uses `symfony/console` package

## Documentations

Each `Command` extends from `YumiCommand::class`. and each `Command` execute a `fire` function when that command executed

## Commands

### Create Controller

[name] is you controller name, by default yumi add 'Controller' to controller name.

```bash
php yumi create:controller [name]
```

this will be created inside "app/Controllers/" for [chibi framework](https://github.com/akiyamaSM/chibi)

### Create Model

- [name] : is you model name, by default yumi.
- --table : by default is empty, but its here where you specify table name for this model

```bash
php yumi create:model [name] --table=tableName
```

this will be created inside "app/" for [chibi framework](https://github.com/akiyamaSM/chibi)

### Create Hurdle
_not yet available_
### Create Listener
_not yet available_
### Create Event
_not yet available_
### Create view
_not yet available_

### List Routes
_not yet available_
### List Configuration
_not yet available_