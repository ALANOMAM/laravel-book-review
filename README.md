# ✨ Brief description

- This project is a simple BOOK REVIEW TOOL.

- Once you have setup the project you wil find yourself with a list of seeded books, the ability to find a book by typing the title on the search bar, and an ability to FILTER the books by rating, populaity accross different time spans.

- You can click on a book to have more information about that specific book, once inside you can add a review if you want, your added review will be auhomatically added to the list of reviews linked to that specific book.The form used to add a review has some backend validation, so be carefull wht yo write :) .

- No words are hardcoded, so even though the primary language is italian, if you go to src/resources/lang and delete the "ita" folder, the whole project will be in english.

- I used bootstrap and a little css for styling.

# ⚙️ Setup Instructions

## 1-When inside the project add the "vendor" folder by running run

### `docker-compose run --rm composer install`

## 2-Add the .env file inside the src folder and fix the database connection inside

    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=book-review-database
    DB_USERNAME=book-review-user
    DB_PASSWORD=secret

## 3-Start the app containers, except bootstrap

### `docker-compose up -d --build server php mysql`

## 4-Fix possible permission issues with the app containers still up

### `docker-compose exec php chmod -R 775 storage bootstrap/cache`

### `docker-compose exec php chown -R www-data:www-data storage bootstrap/cache`

## 5-Generate the app key with the app containers still up

### `docker-compose exec php php artisan key:generate`

## 6-Enter the php conatiner and run the migrations and seeders to have some books and reviews

### `docker-compose exec php php artisan migrate:refresh --seed`

## 7-Set up the boostrap part and install node_modules folder

### `docker-compose run --rm npm install`

### `docker-compose up -d npm`

The app runs in the development mode.\
Open [http://localhost:8081](http://localhost:8081) to view it in your browser.

## 8-To stop all the app containers

### `docker-compose down`
