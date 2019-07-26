git pull
sudo docker start sersoong-httpd-xdebug sersoong-mysql
code ../
xdg-open http://localhost:8000
nohup dbeaver >/dev/null 2>&1 &