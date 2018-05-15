# test-maison-du-monde

## Docker environment:
credit: https://github.com/eko/docker-symfony

## Installation
hosts: symfony.localhost

command to launch:

> $ docker-compose up

Api Url: symfony.localhost

## Unique Name
I specify in my entities that their name should be unique
if that should not be the case, it could be remove in the entities php files

## Custom Route 
http://symfony.localhost/categories/{id}/products/
This Route has GET Parameters for the pagination:

http://symfony.localhost/categories/1/products/?page=3&limit=20
* page: Number of the Page
* limit: Number of elements returns
By Default the page contains 20 Elements

## Post Products Route
Be Careful, with ApiPlatform, in order to associate categories in new products,
you need to use referenceId instead of Id
Here is an exemple
>{
  "name": "my product",
  "price": 9,
  "currency": "euros",
  "stock": 10,
  "categories": [
    "/categories/1"
  ]
}

the referenceId is the apiUrl of the resource
In our case: '/categories/{categoryId}'
