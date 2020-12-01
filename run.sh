#!/bin/sh
docker build -t message-service-appwrite .

docker run --rm -i -v "$(pwd)/app":/usr/local/src/app:ro -p 80:80 message-service-appwrite
