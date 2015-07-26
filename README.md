# url_shortener
An URL Shortener.
Demo: http://shrt.xyz
Its completly javascript free.


INFORMATION: If you use Nginx instead of Apache2 you must write this line(s) in your nginx configuration file:

location /s {
rewrite ^/s/(.*)$ /index.php?site=$1;
}
