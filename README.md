# eCommerceCaseStudy
The eCommerce case study


# Local xampp setup:
1. Open xampp control panel
2. Open apache config (httpd.conf)
3. Add the following lines at the end of the file:
<VirtualHost *:80>
DocumentRoot "C:\xampp\htdocs\eCommerceCaseStudy\public"
ServerName devbana.tk
ServerAlias www.devbana.tk

# Other directives here

</VirtualHost>
4. Go to C:\Windows\System32\drivers\etc and edit the hosts file
5. add the following line:
127.0.0.1           devbana.tk

Yay you are done!