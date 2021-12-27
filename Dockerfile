FROM openjdk:8-jdk-alpine
MAINTAINER Ahmad Hafis <1941720107@student.polinema.ac.id>
RUN mkdir -p /app
WORKDIR /app

COPY project-UAS /app