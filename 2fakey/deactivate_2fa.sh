mysql --user=$2 --password=$3 <<querry
USE $4
UPDATE daten SET 2fa_key='NULL' WHERE loginid='$1'
querry