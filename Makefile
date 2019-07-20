clean:
	rm -rf app/cache/ app/logs/
	mkdir app/cache/ app/logs/
	chmod -R 777 app/cache/ app/logs/
install:
	php composer install

all:
	make install
	make clean

