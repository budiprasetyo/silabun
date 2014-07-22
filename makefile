# TODO
# * check idle process:
#       ps -fU postgres | grep "postgres: postgres"
#   then kill process order by procpid (we will in the last row)
#       select pg_terminate_backend(procpid) from pg_stat_activity order by procpid
#	echo "select pg_terminate_backend(procpid) from pg_stat_activity where procpid <> pg_backend_pid()" \
#    | psql -h localhost -U postgres || true

patch-apply:
	ls -1 docs/patch/patch*.sql | xargs -I {} mysql -h localhost -u root dsp_lpj {}
# 	ls -1 docs/patch*.sql | xargs -I {} psql -h localhost -U postgres -d pal -f {}
# 	chmod 777 upload
# 	chmod 777 upload/file_bapp
# 	chmod 777 upload/file_bapk
# 	chmod 777 upload/file_ktp
# 	chmod 777 upload/file_pks
# db-backup:
# 	echo "select pg_terminate_backend(procpid) from pg_stat_activity where procpid <> pg_backend_pid()" \
#    | psql -h localhost -U postgres || true
# 	echo "vacuum full" | psql -h localhost -U postgres || true
# 	time pg_dumpall -h localhost -U postgres -l pal -c \
# 		| 7z a -mx9 -si docs/pal.sql.7z
# db-backup-schema:
# 	echo "select pg_terminate_backend(procpid) from pg_stat_activity where procpid <> pg_backend_pid()" \
#     | psql -h localhost -U postgres || true
# 	echo "vacuum full" | psql -h localhost -U postgres || true
# 	time pg_dumpall --schema-only -h localhost -U postgres -l pal -c \
# 		> docs/pal.schema.sql
# db-restore:
# 	echo "select pg_terminate_backend(procpid) from pg_stat_activity where procpid <> pg_backend_pid()" \
#     | psql -h localhost -U postgres || true
# 	dropdb -h localhost -U postgres pal
# 	createdb -h localhost -U postgres pal
# 	time 7z e -so docs/pal.sql.7z \
# 		| psql -h localhost -U postgres -d pal
# 	echo "vacuum full" | psql -h localhost -U postgres || true
# db-init:
# 	echo "select pg_terminate_backend(procpid) from pg_stat_activity where procpid <> pg_backend_pid()" \
#     | psql -h localhost -U postgres || true
# 	dropdb -h localhost -U postgres pal
# 	createdb -h localhost -U postgres pal
# php-syntax:
# 	@find . -name "*.php" -exec php -l "{}" \; \
# 		| grep -v 'No syntax errors detected'
# php-quick-syntax:
# 	@find application -name "*.php" -exec php -l "{}" \; \
# 		| grep -v 'No syntax errors detected'
# 	@find vendor -name "*.php" -exec php -l "{}" \; \
# 		| grep -v 'No syntax errors detected'
