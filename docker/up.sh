#!/bin/bash
[ ! -f .env ] && cp .env.example .env
source .env
#export UID=$(id -u)
#export GID=$(id -g)
docker-compose -p $PROJECT up
