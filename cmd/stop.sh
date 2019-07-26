ID=`ps -ef | grep dbeaver`
for id in ID
do
kill -9 $id
done

sudo killall code
sudo docker stop sersoong-httpd-xdebug sersoong-mysql
git add -A
git commit -m "a"
git commit --amend
git push