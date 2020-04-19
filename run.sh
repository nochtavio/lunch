#!/bin/bash

set -e

operator=$1

case $operator in
    "default")
        docker-compose up --build
        ;;
    "test")
        docker-compose down
        docker-compose up -d
        docker-compose exec -e -T app sh -c "php bin/phpunit"
        if [ $? != 0 ]; then
            printf "\nTests failed!\n\n"
            EXIT_CODE=1
        else
            printf "\nTests passed\n\n"
        fi
        docker-compose down
        ;;
    *)
        printf "Unidentified Action :( !! \n\n"
        EXIT_CODE=1
        ;;
esac