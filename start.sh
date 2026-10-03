#!/bin/sh
set -eu
project_dir=$(CDPATH= cd -- "$(dirname -- "$0")" && pwd)
cd "$project_dir"
exec php -d display_errors=0 -d log_errors=1 -d error_reporting=32767 -S "127.0.0.1:${PORT:-8000}" -t "$project_dir" "$project_dir/router.php"
