Bilemo
========================

To install
--------------

- git clone https://git.romainbayette.com/romain/bilemo.git
- cd bilemo
- composer install
- configure parameters,yml with your credentials
- php bin/console d:d:c
- php bin/console d:s:u --force
- php bin/console app:load-datas


To Use
--------------

http://localhost:port/api/login_check 
with body
```
{
	"username": "test",
	"password": "12345678"`
}
```


now you have your token

To Docs
--------------
http://localhost:port/api/doc

Enjoy :)