# EZRating

A light bundle for implementing user rating in a Symfony application.

## Install

In the console use the command

```shell
composer require tigralt/ezratingbundle
```

Or in your `composer.json` add the requirement

```json
"require": {
    "tigralt/ezratingbundle": "dev-master"
}
```

Then register the bundle in your `AppKernel`
```php
public function registerBundles()
{
    ...
    $bundles = array(
        ...
        new Tigralt\EZRatingBundle\EZRatingBundle(),
    );
    ...
    return $bundles;
}
```


## Information

The rating architecture is divided in two objects:

* The rating thread
* The user rating

A rating thread is a type of rating. For example: An user is rated on his activity, then a rating thread named "Activity" will be created to contain all rating about "Activity".
A user rating is the rating from an user.

## Data

Rating thread:

* Name
* Associated ratings

Rating:

* UserID
* Rating
* Comment
* Metadata

----
The metadata in the rating is an array that can support any type of data.

## Usage

In order to use the rating bundle, you have to call the rating manager in your controller
```php
$rating_manager = $this->get("ezrating.manager");
```

### Add rating thread

```php
$rating_manager->addRatingThread("TheRatingThreadName");
```

### Add rating

```php
$rating_manager->addRating($thread_id, $user_id, $rating_number, "This is a comment", array("meta" => "data"));
```

### Find all rating on a user
```php
$ratings = $rating_manager->getAllFromUser($user_id);
```

### Get all rating thread
```php
$rating_threads = $rating_manager->getAllRatingThreads();
```
