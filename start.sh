#!/bin/bash
app="transactionmanager"

docker build -t $app .

if docker ps | awk -v app="app" 'NR>1{  ($(NF) == app )  }'; then
    docker stop "$app" && docker rm -f "$app"
fi

docker run -d --restart=always -p 48893:80 \
    --name=$app \
    -v $PWD:/var/www $app
