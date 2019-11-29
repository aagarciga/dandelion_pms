# Dandelion PMS
Dandelion property management system (Symfony 5.0)

## Coding rules (Use Test Driven Development)

If you're organizing your code well, then all classes will fall into one of two types.   
1. The first type - a model class - is a class whose job is basically to hold data... 
but not do much work. Our entities are model classes.   
2. The second type - a service class - is a class whose main job is to do work, 
but it doesn't hold much data, other than maybe some configuration.

## Commands

- Start the Development Server:
```
    symfony serve --port=7887 -d --no-tls
```
- Stop the development server: 
``` 
    symfony server:stop
```
- Running Tests:
```
    php .\bin\phpunit
```
- Creating the test database:
```
    php bin/console doctrine:schema:create --env=test
```
