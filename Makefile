up:
	docker run -d  --name="mongo"   -p 27017:27017   mongo:3.0.2;
	docker  run -it  --name="node" --link mongo:mongo  -p 8080:8080 -v $(CURDIR):/var/node delermando/node:v5 /bin/bash
down:
	docker  kill `docker ps -a -q` && docker  rm `docker ps -a -q`;
kill:
	docker  kill `docker ps -a -q`;
restart:
	docker  kill `docker ps -a -q`  && docker restart node mongo;
