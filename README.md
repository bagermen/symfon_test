#Information

This test is to validate your level as a backend and frontend developer.

The backend test focus on PHP Symfony 2/3 version and SQL.

The frontend test focus on Typescript/Javascript Angular 2 and Bootstrap Css.

*You should read completely this file before starting.*

You should know how to use Symfony 2/3 and a base of FOSRestBundle and JMSSerializerBundle.
You should know the basic of Angular 2.

Do one commit per task with the task information in the comment.

You have 2 hours to make the test, do as much as you can.
*You can do the tasks in the order you want.*

Once you are done send a zip back with the entire folder but with the angular/node_modules, symfony_demo/vendor, symfony_demo/var/logs and symfony_demo/var/cache folders.

#Backend Test

Requirements: php >=5.6

Go to the symfony_demo folder

Install vendor dependencies

```
php composer.phar install
```

To run the server do:

```
php bin/console server:start
```

Run phpunit 

```
vendor/bin/phpunit
```

You should get this output

```
PHPUnit 4.8.31 by Sebastian Bergmann and contributors.

..........F.FFSS.................
```

Some test are failing, this is part of the test.

Tasks:

PHP#1 Fix failure of Tests\AppBundle\Controller\Api\PostControllerTest::testListActionOptimization

PHP#2 Fix failure Tests\AppBundle\Controller\Api\UserControllerTest::testGetNoPassword

PHP#3 Rename the "@JMS\*" annotation from the src/AppBundle/Entity folder to "@Serializer\*"

PHP#4 Prefix all Api controllers routes (the one in the folder src/AppBundle/Controller/Api) with "/api"

PHP#5 Use the JMS exclusion strategy "ALL" for the entities in (src/AppBundle/Entity)

PHP#6 Fix failure Tests\AppBundle\Controller\Api\UserControllerTest::testGetRoles

PHP#7 Fix failure of Tests\AppBundle\Controller\Api\UserControllerTest::testSetRoles403 (User can only change it's own role)

PHP#8 Make a controller that allow to get all the comments of a post and its unit tests

SQL#1 Update the user.lastActivityDate null value

Using the content of the dump.sql (database name is ugm_recruitment_test) file update the user.lastActivityDate when it's null 
base on the most user_recipient.updatedAt of a user and fallback on the user.updatedAt value if no user_recipient is found.
Put your queries in updateLastActivityDate.sql (you can do as many query as you want) but keep in mind that is must be efficient.

#Angular test

Requirements: nodejs >= 6.9

In the angular folder

```
npm install
```

Here is a list of generator command to help you

Scaffold  | Usage
---       | ---
Component | `npm run ng g component my-new-component`
Directive | `npm run ng g directive my-new-directive`
Pipe      | `npm run ng g pipe my-new-pipe`
Service   | `npm run ng g service my-new-service`
Class     | `npm run ng g class my-new-class`
Interface | `npm run ng g interface my-new-interface`
Enum      | `npm run ng g enum my-new-enum`
Module    | `npm run ng g module my-module`

To start angular dev server (you should have start the php server first)

```
npm start
```

Using the php api above

NG#1 Complete the app/home/home.component.html to about the same as http://localhost:8000/en/blog/

Just the posts list section without the pager. (see ./postsList.png)

NG#2 Create a post page that is accessible when you click on the title of a post (base on the post id)

Just the post content. (see ./post.png)

*See https://angular.io/docs/ts/latest/api/router/index/ActivatedRoute-interface.html to get route params from route*

NG#3 Add the list of comments at the bottom of the post page using the controller you made in PHP#8

Just the comments list no function to create a comment. (see ./comments.png)

NG#4 Hide the Http service trough a "Api" service and use the "Api" service in components that are currently use the Http service.
