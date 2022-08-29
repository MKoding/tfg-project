#!/bin/bash

name=$1
max=$2
interval=$3

[ -z "$1" ] && echo "Usage example: bash wait-for-service.sh mysql 5 1"
[ -z "$2" ] && max=30
[ -z "$3" ] && interval=1

echo "Waiting for service '$name' to become healthy,
      checking every $interval second(s) for max. $max times"

while true; do
  ((i++))
  echo "[$i/$max] ...";
  status=$(docker inspect --format "{{json .State.Status }}" "$(docker ps --filter name="$name" -q)")

  if echo "$status" | grep -q '"running"'; then
   echo "SUCCESS";
   break
  fi

  if [ $i == $max ]; then
    echo "FAIL";
    exit 1
  fi

  sleep $interval;
done
