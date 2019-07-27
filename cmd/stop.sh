ID=`ps -ax | grep dbeaver | grep -v "grep" | grep "java" | awk {'print $1'}`
for id in $ID
do
sudo kill -9 $id
done

ID=`ps -ax | grep visual-studio-code | grep -v "grep" | awk {'print $1'}`
for id in $ID
do
sudo kill -9 $id
done

sudo docker stop sersoong-httpd-xdebug sersoong-mysql
git add -A
git commit -m "a"
git commit --amend
git push