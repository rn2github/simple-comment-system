# simple-comment-system
Simple comment system using PHP

# Description

- Comments are serialized and stored in a file(data/comments.dat)
- Below is a diagram for data structure for comments

![rn2github-simple-comment-system](https://user-images.githubusercontent.com/42101695/43681313-7a3146fa-9804-11e8-80a9-70f407622afe.jpg)


# Installation
1. Clone this repository and place the folder under the document root
```sh
git@github.com:rn2github/simple-comment-system.git
mv simple-comment-system /path/to/documentroot/comments
```

2. Install [composer](https://getcomposer.org/doc/00-intro.md) and run composer update under the folder
```sh
composer update
```

3. Give permission(read and write) for "data" directory
```sh
chown -R apache.apache data <= If web server is run by different user, user and group name (apache) are different
chmod -R 744 data
```
Note: For linux users, the command below might need to be run
```sh
setenforce 0
```
[Here's](https://www.tecmint.com/disable-selinux-temporarily-permanently-in-centos-rhel-fedora/) why for more details

4. Visit the page 
```sh
E.g. http://localhost/comments
```

# Screenshot

![screencapture-localhost-8080-comments-index-php-2018-08-04-15_20_38](https://user-images.githubusercontent.com/42101695/43681331-eab44030-9804-11e8-9ecc-c27d05fee362.png)

