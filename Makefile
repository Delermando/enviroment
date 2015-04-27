up:
	docker  run -it  --name="node"  -p 8080:8080 -v $(CURDIR):/var/node delermando/node:v3 /bin/bash;
down:
	docker  kill `docker ps -a -q` && docker  rm `docker ps -a -q`
restart:
	docker  kill `docker ps -a -q` && docker  rm `docker ps -a -q` && docker  run -it  --name="node"  -p 8080:8080 -v $(CURDIR):/var/node delermando/node:v3 /bin/bash;
