<?php
// ./vendor/bin/phpunit --bootstrap vendor/autoload.php PeselTest.php
use PHPUnit\Framework\TestCase;

require_once "Pesel.php";

class PeselTest extends TestCase
{

    public function testPeselLength()
    {
        $pesel = New Pesel();
        $bad_number = 8310257081;
        $length = $pesel->checkInput($bad_number);

        $good_number = 20233143600;
        $length_2 = $pesel->checkInput($good_number);

        $wrong_length = $pesel->checkInput(12345);
        $not_numeric = $pesel->checkInput('ABC');

        $this->assertFalse($length);
        $this->assertFalse($wrong_length);
        $this->assertFalse($not_numeric);
        $this->assertEquals(11, count($length_2));
    }

    public function testGenerateBirthDate()
    {
        $pesel = New Pesel();
        $birthdate = $pesel->generateRandomBirthDate();

        $arr_birthdate = explode("-", $birthdate);

        $this->assertEquals(10, strlen($birthdate));
        $this->assertLessThan(13, $arr_birthdate[1]);
        $this->assertLessThan(32, $arr_birthdate[2]);
    }

    public function testGenerateRandomGender()
    {
        $pesel = New Pesel();
        $gender = $pesel->generateRandomGender();
        $arr_gender = ['m', 'f'];

        $this->assertContains($gender, $arr_gender);
    }

    public function testMultiplier()
    {
        $pesel = New Pesel();
        $number = 2023314360;
        $checksum = $pesel->sumPesel($number);

        $bad_number = 8310257081;
        $checksum_2 = $pesel->sumPesel($bad_number);
        
        $this->assertEquals(110, $checksum);
        $this->assertEquals(101, $checksum_2);
    }

    public function testBirthdate()
    {
        $pesel = New Pesel();
        $birthdate = '1983-10-25';
        $result = $pesel->checkBirthDate($birthdate);

        // milinial
        $birthdate_2000 = '2020-03-31';
        $result2 = $pesel->checkBirthDate($birthdate_2000);

        $birthdate_2100 = '2100-03-31';
        $result3 = $pesel->checkBirthDate($birthdate_2100);

        $birthdate_2200 = '2200-03-31';
        $result4 = $pesel->checkBirthDate($birthdate_2200);

        $birthdate_1820 = '1820-03-31';
        $result5 = $pesel->checkBirthDate($birthdate_1820);

        $this->assertEquals('831025', $result);
        $this->assertEquals('202331', $result2);
        $this->assertEquals('004331', $result3);
        $this->assertEquals('006331', $result4);
        $this->assertEquals('208331', $result5);
    }

    public function testGender()
    {
        $pesel = New Pesel();
        $male = 'm';
        $female = 'f';

        $m = $pesel->checkGender($male);
        $f = $pesel->checkGender($female);

        $this->assertNotEquals(0, ($m % 2));
        $this->assertEquals(0, ($f % 2));
    }

    public function testGenerateRandom()
    {
        $pesel = New Pesel();
        $random_number = $pesel->generateRandomNumber();
        $count_random_number = strlen($random_number);

        $this->assertNotEquals(0, $random_number);
        $this->assertEquals(3, $count_random_number);
        $this->assertGreaterThan(99, $random_number);
    }

    public function testValidateCheckSum()
    {
        $pesel = New Pesel();
        $wrong_sum = 101;
        $result = $pesel->validateChecksum($wrong_sum);

        $correct_sum = 110;
        $result_2 = $pesel->validateChecksum($correct_sum);

        $this->assertFalse($result);
        $this->assertTrue($result_2);
    }

}