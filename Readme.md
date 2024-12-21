## Installation and setup 

Clone Repository and move into it
```
git clone https://github.com/Drooggie/template-docker-laravel.git && cd template-docker-laravel
``` 

The `rename_app.sh` script will rename the folder you're currently in, update container names, and change the database name in the `.env.example` file.
Make sure the script is executable and then run it:
```
chmod +x ./rename_app.sh && ./rename_app.sh
```


Run this command for building and starting containers
```
docker compose up -d --build && docker compose logs -f app
```  
<br />

Then you can see your app in <a href="http://localhost:8888/"> localhost:8888</a>