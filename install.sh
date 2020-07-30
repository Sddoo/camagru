#!/bin/bash
MACHINE_NAME="web-serv"

docker-machine create -d virtualbox $MACHINE_NAME
eval $(docker-machine env $MACHINE_NAME) # doesn't work after execution
docker-compose up -d
