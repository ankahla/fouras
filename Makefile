DOCKER_COMPOSE = docker-compose --file=containers/docker-compose.yml
EXEC_PHP       = $(DOCKER_COMPOSE) exec php7.4
SYMFONY        = $(EXEC_PHP) bin/console
ENV            = dev
COMPOSER       = $(EXEC_PHP) composer
PWD            = $(shell pwd)

RED      = \033[0;31m
GREEN    = \033[0;32m
YELLOW   = \033[0;33m
BLUE     = \033[0;34m
PURPLE   = \033[0;35m
CYAN     = \033[0;36m
WHITE    = \033[0;37m
NO_COLOR = \033[m

B_GREEN  = \033[42m
B_YELLOW = \033[43m
B_BLUE   = \033[44m
B_PURPLE = \033[45m
B_CYAN   = \033[46m
B_WHITE  = \033[47m

start: ## Start the project
	@$(DOCKER_COMPOSE) up -d --remove-orphans --no-recreate

stop: ## Start the project
	@$(DOCKER_COMPOSE) stop

status:
	@$(DOCKER_COMPOSE) ps

restart: ## Start the project
	make stop
	make start

clean:
	@$(EXEC_PHP) rm -rf var/* web/cms/tmp/* web/cms/administrator/logs/*
	@$(EXEC_PHP) mkdir var/cache/ var/log/
	@$(EXEC_PHP) chmod -R 777 web/uploads web/media var web/cms/tmp web/cms/administrator/logs

install:
	@$(EXEC_PHP) php composer install
	@$(EXEC_PHP) cp pre-commit .git/hooks/pre-commit
	@$(EXEC_PHP) cp commit-msg .git/hooks/commit-msg
	@$(EXEC_PHP) unzip -q -o web/cms/cms.zip -d web/cms/

all:
	make install
	make clean

## Run phpstan
phpstan: vendor
	@echo "$(BLUE)Running phpstan...$(NO_COLOR)"
	@$(EXEC_PHP) php -d memory_limit=-1 bin/phpstan analyse src

phpstan_chunk: vendor ## Run phpstan on modified files
ifneq ($(CHANGED_PHP_FILES_SPACE_SEPARATED),)
	@echo "$(BLUE)Running phpstan...$(NO_COLOR)"
	@$(EXEC_PHP) php -d memory_limit=-1 bin/phpstan analyse $(CHANGED_PHP_FILES_SPACE_SEPARATED)
endif

## Run phpcs
phpcs: vendor
	@$(EXEC_PHP) bin/php-cs-fixer fix --config=.php_cs.php --dry-run --diff-format=udiff -v

phpcs-fix: vendor
	@echo "$(BLUE)Running php cs fixer...$(NO_COLOR)"
	@$(EXEC_PHP) ./vendor/bin/php-cs-fixer fix --config=.php_cs.php -v
phpcs-fix_chunk: vendor
ifneq ($(CHANGED_PHP_FILES_SPACE_SEPARATED),)
	@echo "$(BLUE)Running php cs fixer...$(NO_COLOR)"
	@$(EXEC_PHP) bin/php-cs-fixer fix --config=.php_cs.php -v $(CHANGED_PHP_FILES_SPACE_SEPARATED)
endif

## Get into php container interactive mode
cli:
	@$(EXEC_PHP) bash

tu:
	@$(EXEC_PHP) bin/phpunit tests
