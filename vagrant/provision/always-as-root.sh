#!/usr/bin/env bash

#== Bash helpers ==

function info {
  echo " "
  echo "--> $1"
  echo " "
}

#== Provision script ==

info "Provision-script user: `whoami`"

info "Restart Apache"
service apache2 restart

info "Start Web Socket Server"
php /apps/bin/server server/start -d