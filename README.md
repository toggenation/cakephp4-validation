# 

00:00 Intro create project
01:30 Add Posts migration
02:19 Install sqlitebrowser and open default.sqlite database file
03:43 Run `bin/cake bake all Posts`
04:40 Run `bin/cake server`
05:00 View posts index page at http://localhost:8765/posts
05:35 Attempt to add duplicate title
05:57 validationDefault rules
06:59 buildRules Application Rules
08:04 Disable validator rules and change message 
09:57 Begin dymamic validation message creation
10:00 Create a function for an application rule
15:00 Add a function to a validation rule
16:40 Running a SQL query in a validation function to check for duplicates
20:28 Moving a RulesChecker rule into a class
21:41 Create a Custom Rule Object
31:00 Create a cake console command using `bin/cake bake command AddPost`
33:00 Create an AddPost utility / service class
34:34 Use `LocatorAwareTrait` to provide access to table from AddPost service class
38:00 Adding a record using the `bin/cake add_posts "Title" "Body"` command
38:44 Formatting Validation errors for display by command
39:00 Using `Hash::flatten`
40:00 Using `Text::toList`

44:00 Create custom validation Set and use it for validation

