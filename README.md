# Book reviews API

The book reviews API will have three models: User, Book and Rating.

> A User model already comes with Laravel by default.

## Create models and migrations

```sh
$ php artisan make:model Book -m
$ php artisan make:model Rating -m
```

> The -m flag will create the corresponding migration file for the model.

Open the migration file generated for models and update the **up()** method.

Then run the the command below to run the migrations:

```sh
$ php artisan migrate
```

## Define relationships between models

The relationship between the **User** model and **Book** model is a one-to-many relationship.

```sh
// app/User.php

public function books()
{
  return $this->hasMany(Book::class);
}
```

Inverse relationship on the Book model:

```sh
// app/Book.php

public function user()
{
  return $this->belongsTo(User::class);
}
```

---

A rating can only belong to one book. This is also a one-to-many relationship.

```sh
// app/Book.php

public function ratings()
{
 return $this->hasMany(Rating::class);
}
```

And inverse relationship inside the Rating model:

```sh
// app/Rating.php

public function book()
{
 return $this->belongsTo(Book::class);
}
```

## Allowing mass assignment on some fields

```sh
// app/Book.php
protected $fillable = ['user_id', 'title', 'description'];

// app/Rating.php
protected $fillable = ['book_id', 'user_id', 'rating'];
```

## Adding user authentication

```sh
$ composer require tymon/jwt-auth "1.0.*"
```

Run the command below to publish the package’s config file:

```sh
// 1, create a config/jwt.php file
$ php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"

 // 1, generate a secret key
 // 2, update the .env file with something like JWT_SECRET=some_random_key
$ php artisan jwt:secret
```

Before we can start to use the jwt-auth package, we need to update our **User model** to implement the Tymon\JWTAuth\Contracts\JWTSubject contract.

Update config/auth.php to configure the auth guard to make use of the jwt guard.

Create a new AuthController:

```sh
$ php artisan make:controller AuthController
```

Next, let’s add the register and login routes.

```sh
// routes/api.php

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
```

API routes:

```sh
// routes/api.php

Route::apiResource('books', 'BookController');
Route::post('books/{book}/ratings', 'RatingController@store');
```

## Creating the book and the rating resource

```sh
$ php artisan make:resource BookResource
$ php artisan make:resource RatingResource
```

## Creating the book and the rating controller

```sh
$ php artisan make:controller BookController --api
$ php artisan make:controller RatingController
```
