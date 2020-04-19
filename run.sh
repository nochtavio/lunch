#!/bin/bash

set -e

operator=$1

case $operator in
    "default")
        docker-compose up --build
        ;;
    *)
        printf "Unidentified Action :( !! \n\n"
        EXIT_CODE=1
        ;;
esac