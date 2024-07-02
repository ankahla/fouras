FROM docker:20.10-dind as base
MAINTAINER ANOUAR KAHLA

USER root

RUN apk add make

WORKDIR /var/app/containers

From base as dev

RUN echo "you should now run docker-compose up -d inside the dind container"

From base AS prod

CMD ["/start.sh"]
