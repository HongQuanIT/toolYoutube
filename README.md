# toolYoutube
### To can run project with docker. Pls step by step : 
1. Set `dev.local` to file host.
2. Create strucre in root
+ `logs`
+ `certs`
+ `deploy`
+ `sources`
+ + `dev`
+ + `...`
3. To `deploy`. Run `./laradock.sh up` to pull images from dockerhub and start services.
4. Database : :8080 hqtool hqtool
5. Rabbitmq : :15672 guest guest
6. Redis : :9987 laradock laradock
