# Crontab hinzufügen das täglich um 18 Uhr ein Backup erstellt.
# if edited with windows use comman: sed -i 's/\r//g' backup.sh on this file!
# BackUp Format: Kontake-Backip-dd.mm.yy-hh.mm.sql
current_date=$(date +%d.%m.%y-%H.%M)
backUpName="../backup/Kontakte-Backup-$current_date.sql"
mysqldump --user=$1 --password=$2 --lock-tables --compact --add-drop-database --add-drop-table --databases $3 > $backUpName
