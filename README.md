# PasswordManager
This project is made for a raspberry pi so you can connect to it through it's local ip and see the website. The idea is that you can store your passwords in this site so you dont have to remember them or write them down in a paper

Some years later Update. It was a nice project. Useful. May be bad, unsafe, ugly but i still use it. Its like the paper that everyone has with his passwords. I do it in my website. Huge flex

# Step 1
Use raspberry pi imager in order to pass the software in the raspberry.
# Step 2
Connect to your WiFi and then find your raspberry's ip using the command: 
```
hostname -I
```
Then you also have to update your raspberry using the commands:
```
sudo apt-get update
sudo apt-get upgrade
```
# Step 3
Enable the shh connection in your raspberry pi. Go to Preferences > Raspberry Pi Configuration > Interface > SHH > Enable. Then you can disconnect the display and use the ssh connection in order to control the raspberry.
```
ssh pi@'raspberry's ip'
```
# Step 4
We have to install the Apache server and the php my admin to use the raspberry as a server. To do that use the commands:
```
sudo apt install apache2 -y
```
Then install the myslq server with the command:
```
sudo apt-get install mysql-server
```
Plus you have to grant access in order to connect properly.
```
sudo mysql -u root

>GRANT ALL PRIVILEGES ON *.* TO 'username'@'localhost' IDENTIFIED BY 'password' WITH GRANT OPTION;
```
After doing that you can actually see the default website that Apache server provides if you search in your browser your raspberry's ip. Then use the this command to install phpmyadmin.
```
sudo apt install phpmyadmin
```
Last use this command in order to see the phpmyadmin in the browser.
```
sudo ln -s /usr/share/phpmyadmin /var/www/html
```
# Step 5
Create the databases needed. Do to http://"raspberry ip"/myphpadmin, login, and then create a db. The name that i am using in LocalWebSite. Then create two tables. The first one has the name Login and it has 4 columns (id, username, password, salt). Set the id as primary and the rest as VARCHAR(255). The second table is called Data and it contains 7 columns (id, userid, platform, username, password, email, otherdata). id column is once again primary and the rest are VARCHAR(255).
# Step 6
In this step we have to place the code into the /var/www/html location. So to the Deskot and use the command:
```
git clone https://github.com/NickNterm/PasswordManager.git
```
So you will have a folder in desktop that contain all the files needed. Use this commands to caopy everything in the html folder:
```
cd home/pi/Desktop/PasswordManager/img
sudo cp ng-hacker.jpg logo.jpg /var/www/html
cd home/pi/Desktop/PasswordManager/src
sudo cp formhandler.php index.php loginstyle.css main.php mainstyle.css register.php /var/www/html
```
# Step 7
Last step in order to have a properly working site is to add a .htaccess file. This file is going to make the final domain look better. to edit this file you have to go in the html folder.
```
cd /var/www/html
sudo nano .htaccess 
```
Then add these lines in the file.
```
RewriteRule Pattern Substitution

RewriteEngine on
RewriteRule ^signup$ register.php
RewriteRule ^logedin$ main.php
```
Last enable the rewrite in the apache by using the command:
```
sudo a2enmod rewrite
```
# Step 8 
So in this step we are going to make our site globaly reachable cause now you see it only when you are connected to the same wifi. To do that first we have to change the port that the apache server is Listening. To do that edit the file:
```
sudo nano /etc/apache2/ports.conf
```
And change the line from:
```
Listen 80
```
To:
```
Listen 7575
```
Aftrer restarting the server by ``` sudo service apache2 restart ``` you can see that the site is reachable anymore. that why we change the port its sending the site. In the domain that we previously seeing the site we have to add a ":7575" (example: 192.168.51.109:7575).
# Step 9
This step is all about port forwarding the raspberry pi port. You can do that by going to your router settings and set the port to forward. Plus you have to make the raspberry's ip static cause after each reset the router is going to give another ip to raspberry. To do that edit the file ```sudo nano /etc/dhcpcd.conf``` accordingly.
