Bilemo
========================
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/b7f2d8be76204676913357acbad6cbee)](https://www.codacy.com/app/romainromss_2/bilemo?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=romainromss/bilemo&amp;utm_campaign=Badge_Grade)

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