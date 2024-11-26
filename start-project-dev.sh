#!/bin/bash

docker rm -f mysql laravel-app nginx-webserver
docker-compose up --build

