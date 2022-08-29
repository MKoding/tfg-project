#!/usr/bin/env bash

C_RESET='\033[0m'
C_RED='\033[31m'
C_GREEN='\033[32m'
C_YELLOW='\033[33m'

function __run() #(step, name, cmd)
{
    local color output exitcode

    printf "${C_YELLOW}[%s]${C_RESET} %-20s" "$1" "$2"
    output=$(eval "$3" 2>&1)
    exitcode=$?

    if [[ 0 == $exitcode || 130 == $exitcode ]]; then
        echo -e "${C_GREEN}OK!${C_RESET}"
    else
        echo -e "${C_RED}NEEDS REFACTOR!${C_RESET}\n\n$output"
        exit 1
    fi
}

ignore="\( -path ./bootstrap -prune -o -path ./config -prune -o -path ./database -prune -o -path ./docker-compose -prune -o -path ./node-modules -prune -o -path ./public -prune -o -path ./resources -prune -o -path ./scripts -prune -o -path ./storage -prune -o -path ./vendor -prune \)"
files="find . ${ignore} -o -type f -name '*.php' -print"
phpcs="vendor/bin/phpcs --report=code --colors --report-width=80 --standard=PSR2"

__run "1/3" "php lint" "${files} | xargs -r php -l"
__run "2/3" "code sniffer" "${files} | xargs -r ${phpcs} --ignore=*.blade.php"
__run "3/3" "phpstan" "${files} | xargs -r vendor/bin/phpstan analyse"