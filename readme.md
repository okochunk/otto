# Pesel
PESEL (Polish Powszechny Elektroniczny System Ewidencji Ludności, Universal Electronic System for Registration of the Population) 

## Usage 
```
$pesel = New Pesel();

// using static paramter birthdate & gender
$pesel->getPesel('1983-10-25', 'f');
```

if want to use generate birtdate & gender use this
```
// instance Pesel object
$pesel = New Pesel();

// generate random birthdate with format 'yyyy-dd-mm'
$birthdate = $pesel->generateRandomBirthDate();

// generate random gender in ex: m / f
$gender = $pesel->generateRandomGender();

$pesel->getPesel($birthdate, $gender);
```

## Access Sample
http://url/pesel.php
![sample](https://www.dropbox.com/s/gq1otvtdve8shat/sample1.png?dl=0)


## Run Test
```
./vendor/bin/phpunit --bootstrap vendor/autoload.php PeselTest.php
```

![sample](https://www.dropbox.com/s/pxic2jmffn5wlng/test1.png?dl=0)