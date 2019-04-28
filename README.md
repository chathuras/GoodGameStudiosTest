# Chathura Sandeepa - Goodgame Studios Backend Test - Comment System

## How to run this

### Method 1

* install virtualbox.
* install vagrant.
* navigate to the project root directory via terminal and execute
```sh
vagrant up
```
* wait until it completes.
* vagrant script taken from puphpet.com and sometimes it gives problems, if this didn't worked please try method 2
* add 192.168.56.101 chathura.dev to /etc/hosts

#### mysql script should automatically executed if not

* visit http://192.168.56.101/adminer/
* mysql un: root , pw: root, click login. (values on config.php is correct for comment_system db.)
* click on "sql command" and copy everything on 'db.sql' and paste on big text area and click execute.
* visit chathura.dev

### Method 2

* need php 5.5
* add virtual host.

```
<VirtualHost *:80>
  ServerName chathura.dev
  ServerAlias www.chathura.dev

  DocumentRoot "/var/www/chathura/public"

  <Directory "/var/www/chathura/public">
    AllowOverride All
    Require all granted
  </Directory>

  SetEnv APPLICATION_ENV development

</VirtualHost>
```

* execute db.sql to setup the db and the table.
* add 127.0.0.1 chathura.dev to /etc/hosts
* edit /System/App/config.php for db credentials. also check .htaccess for APPLICATION_ENV.
* apache mod_rewrite, mod_env should be enabled (if not)
* visit chathura.dev

## What has been implemented and what are I think out of scope

* built an MVC with PSR-0 autoloading, no 3rd party libraries or frameworks are used,
 not even jquery used vanilla-js.com (pure JavaScript) instead. ;-) , MVC is so minimal and it only has required things that
 needs to run this project.

* used mysqli for db connection and there is only one table to store comments, i think the requirement is comments only system.
 so there wasn't chance to use sql join.

* since the focus is not much to frontend development, handling views / layouts are not rich enough, not much css and
 no pagination. comments adding only cannot edit or delete via the system.

* converting text urls to hyperlinks with 100% accuracy is very complex subject due to various TLDs. so using a simple regex,
 do not expect 100% accuracy. converted hyperlink does not store back to db.

* exception handling is not present, no unit testing since PHPUnit is external library and time consuming
 to write manually.

* comments doc blocks are in few places only. since it mentioned in the test
 "not all of the source code must have all the quality features".

* no client side (JavaScript) form validation. validation done via php. targeted browser compatibility is IE9+ ,
 haven't tested on IE though.

Cost - few Redbulls :P

This README can found on https://gist.github.com/chathuras/20d8bfc8e5029e839cbb as well.