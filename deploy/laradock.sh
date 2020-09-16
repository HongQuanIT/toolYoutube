#!/usr/bin/env bash

# REQRUIED:
#    1. docker
#    2. docker-compose

# This shell script is a Laradock tool to simplify
# the usage of Laradock with agn project, thin wrapper of docker-compose

# prints colored text
print_style () {
    if [ "$2" == "info" ] ; then
        COLOR="96m"
    elif [ "$2" == "success" ] ; then
        COLOR="92m"
    elif [ "$2" == "warning" ] ; then
        COLOR="93m"
    elif [ "$2" == "danger" ] ; then
        COLOR="91m"
    else #default color
        COLOR="0m"
    fi

    STARTCOLOR="\e[$COLOR"
    ENDCOLOR="\e[0m"

    printf "$STARTCOLOR%b$ENDCOLOR" "$1"
}

display_options () {
    printf "Available options :\n";
    print_style "   up [services]" "success"; printf ": Runs docker compose to up services.\n"
    print_style "   down [services]" "success"; printf ": Down all services.\n"
    print_style "   exec [service]" "success"; printf ": Opens bash on the workspace with user laradock.\n"
    print_style "   start|restart [services]" "success"; printf ": Start|Restart services.\n"
    print_style "   stop [services]" "success"; printf ": Stop services.\n"
    print_style "   site-init [site]" "success"; printf ": Init new site: overwrite and update .env file, composer install, generate key.\n"
    print_style "   dump-server [site]" "success"; printf ": Start dump-server for debugging for specific site.\n"
    print_style "   tinker [site]" "success"; printf ": Start tinker for code testing for specific site.\n"

}


##### VARIABLES #####
script_folder="$( cd "$(dirname "$0")" ; pwd -P )"
export COMPOSE_FILE="docker-compose.yml"
domain="${DEPLOY_DOMAIN:-local}"
vesion="1.0.0"

##### COMMANDS #####

cd $script_folder

# up
if [ "$1" == "up" ]; then
    print_style "Initializing Docker Compose and up services ...\n" "info"
    print_style "Author : DANG HONG QUAN \n" "info"
    print_style "Vesion : $vesion \n" "info"

    if [ -z $2 ]; then
        if [[ "$OSTYPE" == "cygwin" || "$OSTYPE" == "msys" || "$OSTYPE" == "win32" ]]; then
            cd $script_folder
            docker-compose up -d $(<services_win.txt)
        else
            # Linux or Mac
            docker-compose up -d
        fi
    else
        docker-compose up -d ${@:2}
    fi

# down
elif [ "$1" == "down" ]; then
    print_style "Downing All services and Docker Compose ...\n" "info"
    print_style "Author : DANG HONG QUAN \n" "info"
    print_style "Vesion : $vesion \n" "info"
    docker-compose down

# exec
elif [ "$1" == "exec" ]; then
    if [ -z "$4" ]; then
        if [ -z $2 ] &&  [ -z $3 ]; then
            docker-compose exec --user=root workspace bash
        else
            if [ -z $3 ]; then
                docker-compose exec $2 bash
            else
                docker-compose exec --user=$3 $2 bash
            fi
        fi
    else
        docker-compose exec --user=$3 $2 bash -c ''"$4"''
    fi

# start
elif [ "$1" == "start" ]; then
    print_style "Starting containers ...\n" "info"
    print_style "Author : DANG HONG QUAN \n" "info"
    print_style "Vesion : $vesion \n" "info"
    docker-compose start ${@:2}

# stop
elif [ "$1" == "stop" ]; then
    print_style "Stopping containers ...\n" "info"
    print_style "Author : DANG HONG QUAN \n" "info"
    print_style "Vesion : $vesion \n" "info"
    docker-compose stop ${@:2}

# restart
elif [ "$1" == "restart" ]; then
    print_style "Restarting containers ...\n" "info"
    if [ -z $2 ]; then
        docker-compose restart nginx php-fpm php-worker workspace
    else
        docker-compose restart ${@:2}
    fi


# artisan
elif [ "$1" == "artisan" ]; then
    print_style "Run artisan command in workspace ...\n" "info"
    docker-compose exec --user=root workspace bash -c 'cd /var/www/'"$2"' && php artisan '"$3"


# site-init
elif [ "$1" == "site-init" ]; then
    print_style "Initializing site $2 ...\n" "info"

    # init site
    print_style "Init site ...\n"
    $script_folder/laradock.sh exec workspace root 'cd /var/www/'"$2"' && yes | cp -rf .env.example .env && composer install'

    # update .env
    print_style "Update .env ...\n"
    sed -i s/APP_URL=.*/APP_URL=http:\\/\\/$2.$domain/ ../sources/$2/.env
    sed -i s/DB_DATABASE=.*/DB_DATABASE=$2/ ../sources/$2/.env
    sed -i s/DB_USERNAME=.*/DB_USERNAME=$2/ ../sources/$2/.env
    sed -i s/DB_PASSWORD=.*/DB_PASSWORD=secret$2/ ../sources/$2/.env
    sed -i s/CACHE_PREFIX=.*/CACHE_PREFIX=$2/ ../sources/$2/.env
    sed -i s/SESSION_PREFIX=.*/SESSION_PREFIX=$2/ ../sources/$2/.env
    sed -i s/SESSION_DOMAIN=.*/SESSION_DOMAIN=$2.$domain/ ../sources/$2/.env
    sed -i s/RABBITMQ_VHOST=.*/RABBITMQ_VHOST=\\/$2/ ../sources/$2/.env

    # this is for external site only
    internal=${2%-ext}
    sed -i s/INTERNAL_URL=.*/INTERNAL_URL=http:\\/\\/$internal.$domain\\// ../multi/$2/.env

    # update Laravel
    $script_folder/laradock.sh exec workspace root 'cd /var/www/'"$2"' && php artisan optimize && php artisan key:generate && composer install'

    print_style "Done!\n"

# dump-server
elif [ "$1" == "dump-server" ]; then
    docker-compose exec php-fpm bash -c 'cd /var/www/'"$2"' && php artisan dump-server'

# tinker
elif [ "$1" == "tinker" ]; then
    docker-compose exec php-fpm bash -c 'cd /var/www/'"$2"' && php artisan tinker'

# refresh
elif [ "$1" == "refresh" ]; then
    npm_mode='dev'

    if [ "$3" ]; then
        npm_mode="$3"
    fi
    print_style "Refreshing site $2 with npm_run_mode $npm_mode ...\n" "info"
    $script_folder/laradock.sh exec workspace root 'cd /var/www/'"$2"
    ' && php artisan optimize && php artisan migrate:fresh --seed && php artisan passport:install && npm run '"$npm_mode"

else
    print_style "Invalid arguments.\n" "danger"
    display_options
    exit 1
fi
