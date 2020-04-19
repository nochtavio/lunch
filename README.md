# Lunch API

API to give you a list of recipes with available ingredients.

## Running the Application:

The application is built with docker, so you just need to have docker installed and run

- `./run.sh default` : To run the application. Once it ran, you can access the application on http://localhost:8000
- `./run.sh test` : To run the unit test. It will give you the unit test result.

## Application

Once the application is running, you can access available recipe list with, 

`/api/lunch`

The ingredient and recipes are based on 2 JSON files,

- [ingredients](https://github.com/nochtavio/nochtavio-alief-techtask-php/blob/master/app/config/files/ingredients.json)
- [recipes](https://github.com/nochtavio/nochtavio-alief-techtask-php/blob/master/app/config/files/recipes.json)

Notice that, the date inside those 2 files are passed, so you can mock the current date by passing **date** query string.
Example:

`/api/lunch?date=2019-03-07`

###### note: the date must follow **Y-m-d** format.