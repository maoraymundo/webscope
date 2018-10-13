## Set up your workspace

1. Clone the webscope repo. 
	`git clone https://github.com/maoraymundo/webscope.git`
2. Go inside the directory 
	`cd webscope`
3. Run compose via docker
	`docker run --rm -v $(pwd):/app composer/composer install`
4. Clone laradock under webscope.
	`git clone https://github.com/maoraymundo/laradock`
5. Go inside laradock directory
	`cd laradock`
6. Build the environment
	`docker-compose up -d nginx mysql phpmyadmin workspace`
	`docker-compose exec --user=laradock workspace bash` 
	`php artisan migrate`
7. Go to http://localhost