robo-cli
========

##Description
Demo cli application to post status updates to twitter.

The objective of this project is to demonstrate how to use composer, install dependencies, and show a simple directory structure and class that follows the PSR-0 Standard. This is part of the [SD PHP](http://sdphp.org) Study Gropu code samples. 

##Requirements:
[Install Composer](http://getcomposer.org/download/)

##Installation:

###Clone the repository
```
git clone git@github.com:onema/robo-cli.git
cd robo-cli
```
Run composer install 
```
php composer.phar install
```

###Configuration
Copy the file ```app/config/parameters.yml.dist``` to ```app/config/parameters.yml``` 

```
cp app/config/parameters.yml.dist app/config/parameters.yml
```

Open the file ```parameters.yml``` and update the relevant fields with you Twitter App info. 
For more information see the [Twitter Developers](https://dev.twitter.com/) site.

**Don't forget to set the permissions to read and write and set the callback url!!**

##Using the console
From the project root, type the following command in the terminal
```
php app/console robocli:tweet --message="Write your status update!! #awesome #app"
```
