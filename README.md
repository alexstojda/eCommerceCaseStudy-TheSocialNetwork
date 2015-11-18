# eCommerceCaseStudy
The eCommerce case study


## Local xampp setup:
1. Open xampp control panel
2. Open apache config (httpd.conf)
3. Add the following lines at the end of the file:
```
<VirtualHost *:80>
DocumentRoot "C:\xampp\htdocs\eCommerceCaseStudy\public"
ServerName devbana.tk
ServerAlias www.devbana.tk
</VirtualHost>
```
4. Go to C:\Windows\System32\drivers\etc and edit the hosts file
5. add the following line:
```
127.0.0.1           devbana.tk
```

Yay you are done!

## Setting up XDebug with PHPStorm

Already comes installed with XAMPP, all you need is to enable it :)

#### XAMPP php.ini Changes
1. Open xampp control panel
2. Hit apache config button and choose php.ini
3. ```Ctrl+F``` and find [XDebug]  (at bottom if you feel like scrolling)
4. remove everything because we don't need profiler, that's too advanced bruh
5. Copy & Paste these lines
```
       [XDebug]
       zend_extension = "C:\xampp\php\ext\php_xdebug.dll"
       xdebug.remote_enable = 1
       xdebug.remote_handler = "dbgp"
       xdebug.remote_host = "127.0.0.1"
```
- Finally Restart apache and rejoice.
 - Easy test is var_dump. If you session dump at the top looks different, Xdebug is working great.

#### PHPStorm config
1. Open Run->Edit Configurations
2. In defaults, choose PHP Web Application and write the start url as ```http://devbana.tk```
3. Click on the 3 dots near server now
 - Add a new entry as [name wtvr] with host ```localhost``` on port ```80``` with ```XDebug```
  - Ignore path mapping, we're local
4. Back in PHP Web App config choose your new server
5. You can now run debug which will open a new XDebug session and send you to our index page.
 - Add breakpoints as you wish, dig through objects and step through as much as your heart desires.