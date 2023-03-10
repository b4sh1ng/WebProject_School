# Crontab hinzufügen das täglich um 18 Uhr ein Backup erstellt.
# BackUp Format: Kontake-Backip-dd.mm.yy-hh.mm.sql
current_date=$(date +%d.%m.%y-%H.%M)
backUpName="Kontakte-Backup-$current_date.sql"
mysqldump --user=inf21 --password=test1 --lock-tables --databases ot > $backUpName