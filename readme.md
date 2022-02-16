# Pesel
PESEL (Polish Powszechny Elektroniczny System Ewidencji Ludności, Universal Electronic System for Registration of the Population) 

## Usage 
$pesel = New Pesel();
$pesel->getPesel('1983-10-25', 'f');

## Access Sample
http://url/pesel.php
![sample](https://www.dropbox.com/s/gq1otvtdve8shat/sample1.png?dl=0)


## Run Test
```
./vendor/bin/phpunit --bootstrap vendor/autoload.php PeselTest.php
```

![sample](https://www.dropbox.com/s/pxic2jmffn5wlng/test1.png?dl=0)