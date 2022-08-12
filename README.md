# CakePHP 4 Validation & Application Rules

## Features

- Dependency Injection
- Defer all controller action logic to a Service class
- Custom validation messages for both array validation (POST request or before creating entities) and entity validation (Application RulesChecker validation after entity creation)

### Custom Validation Messages

Instead of a generic message such as:

> The record must be unique

then a custom version might be:

```
There is already a post with title \"${title}\" in the ${table} table
```

Which would render as:
> There is already a post with title "Test" in the Posts table

## Get Started

Clone the repo [https://github.com/toggenation/cakephp4-validation](https://github.com/toggenation/cakephp4-validation)

```
git clone https://github.com/toggenation/cakephp4-validation.git
```
Install deps

```
composer install
```

Configure DB (This is for sqlite)

```php
// config/app_local.php
'Datasources' => [
        'default' => [
            'host' => 'localhost',
            'username' => 'my_app',
            'password' => 'secret',
            'database' => 'my_app',
            'url' => env('DATABASE_TEST_URL', 'sqlite://127.0.0.1/default.sqlite'),
        ],
```

Run Migrations
```
bin/cake migrations migrate
```



## References
* [https://book.cakephp.org/4/en/orm/validation.html](https://book.cakephp.org/4/en/orm/validation.html)
* [https://book.cakephp.org/4/en/core-libraries/validation.html](https://book.cakephp.org/4/en/core-libraries/validation.html)


## Youtube Video
[https://youtu.be/QSPLXiYKj9Y](https://youtu.be/QSPLXiYKj9Y)

### Timings
00:00 Intro create project\
01:30 Add Posts migration\
02:19 Install sqlitebrowser and open default.sqlite database file\
03:43 Run `bin/cake bake all Posts`\
04:40 Run `bin/cake server`\
05:00 View posts index page at http://localhost:8765/posts\
05:35 Attempt to add duplicate title\
05:57 validationDefault rules\
06:59 buildRules Application Rules\
08:04 Disable validator rules and change message\
09:57 Begin dymamic validation message creation\
10:00 Create a function for an application rule\
15:00 Add a function to a validation rule\
16:40 Running a SQL query in a validation function to check for duplicates\
20:28 Moving a RulesChecker rule into a class\
21:41 Create a Custom Rule Object\
31:00 Create a cake console command using `bin/cake bake command AddPost`\
33:00 Create an AddPost utility / service class\
34:34 Use `LocatorAwareTrait` to provide access to table from AddPost service class\
38:00 Adding a record using the `bin/cake add_posts "Title" "Body"` command\
38:44 Formatting Validation errors for display by command\
39:00 Using `Hash::flatten`\
40:00 Using `Text::toList`\
41:00 Handle a Cake command exception\
44:00 Create custom validation Set and use it for validation\