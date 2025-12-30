#!/bin/sh
set -eu

RAW_SQL="/backup/sql_backup.sql"
TARGET_DB="${MARIADB_DATABASE:-dev_domainedesbec}"

if [ ! -f "$RAW_SQL" ]; then
  echo "[import] Missing dump at $RAW_SQL" >&2
  exit 1
fi

echo "[import] Extracting database '$TARGET_DB' from dump..."
FILTERED_SQL="/tmp/${TARGET_DB}.sql"

awk -v target="$TARGET_DB" '
  BEGIN { seen=0; hdr_count=0 }
  {
    if (seen==0) {
      header[hdr_count++] = $0
    }

    if ($0 ~ /^-- Current Database: `[^`]+`/) {
      match($0, /`([^`]+)`/, m)
      db = m[1]

      if (seen==0 && db==target) {
        for (i=0; i<hdr_count; i++) print header[i]
        seen=1
        next
      }

      if (seen==1 && db!=target) {
        exit
      }
    }

    if (seen==1) {
      print $0
    }
  }
' "$RAW_SQL" > "$FILTERED_SQL"

if [ ! -s "$FILTERED_SQL" ]; then
  echo "[import] Could not extract DB '$TARGET_DB' from dump. Aborting." >&2
  exit 1
fi

echo "[import] Importing '$TARGET_DB'..."
mariadb -uroot -p"$MARIADB_ROOT_PASSWORD" < "$FILTERED_SQL"

echo "[import] Done."
