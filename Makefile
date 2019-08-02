clean:
	rm -rf var/*
	mkdir var/cache/ var/logs/
	chmod -R 777 var
install:
	php composer install
	cp pre-commit .git/hooks/pre-commit

all:
	make install
	make clean

