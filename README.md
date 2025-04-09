
# T's Virtual Kitchen

A website that lets users browse, filter and interact with recipes, using a simple account system. Once logged in, users can add and edit recipes.

Built using laravel with the php framework for server-side, with MySQL for the database (not included here), and HTML/CSS/JavaScript for client-side.

## Lessons Learned

- how the hell laravel works
- how to actually implement a MVC (model/view/controller) system
- how the hell blade works
- (sort of) how the hell laravel breeze works (WORST MISTAKE OF MY LIFE)
- pain.


## Run Locally (for whatever reason)

Download XAMPP

Clone the project (mine's in /XAMPP/htdocs)

```bash
  git clone https://github.com/Tzar-T70/vkitchen
```

Change database values to your liking (if you dont use MySQL):

```.env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=v-kitchen
DB_USERNAME=root
DB_PASSWORD=
```

Go to the project directory

```bash
  cd vkitchen
```

Run Migrations (creates database tables)

```bash
  php artisan migrate
```
Run Seeder (if you want some test data)

```bash
    php artisan db:seed
```


Start the server

```bash
  php artisan serve
```

Hit the link in the terminal!!!!
