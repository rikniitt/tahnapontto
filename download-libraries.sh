#!/usr/bin/env bash

dir="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

# Download the needed libraries. This script and
# the gitignore lines can be removed after download.
libs=(
  'https://raw.githubusercontent.com/klein/klein.php/v1.2.0/klein.php' \
  'https://raw.githubusercontent.com/j4mie/idiorm/master/idiorm.php' \
  'https://raw.githubusercontent.com/j4mie/paris/master/paris.php'
)

for url in "${libs[@]}"; do
  file=$( basename "$url" )
  echo "Download $url"
  wget -O "$dir/system/$file" "$url"
done
