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
