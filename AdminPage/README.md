
# go into the project
cd WeUniform

# create a .env file
cp .env.example .env

# install composer dependencies
composer update

# install npm dependencies
npm install

# generate a key for your application
php artisan key:generate

# generate Server secret for JWT
php artisan jwt:secret
# run the migration files to generate the schema
php artisan migrate --seed

import file weuniform.sql into db

# run webpack and watch for changes
npm run watch

# run serve
php aritsan serve 

# email: admin@gmail.com
# password: 123456

```

Good Luck :)
