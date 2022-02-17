<?php

Class Pesel
{
    public function getPesel($birthdate, $gender)
    {
        echo "Date: {$birthdate} <br>";
        echo "Gender: {$gender} <br><br>";

        $yymmdd = $this->checkBirthDate($birthdate);
        $zzz = $this->generateRandomNumber();
        $x = $this->checkGender($gender);
        $sum = $this->sumPesel($yymmdd.$zzz.$x);
        $q = substr($sum, -1);

        echo "YYMMDD ZZZ X Q <br>";

        echo "YYMMDD = {$yymmdd} <br>";
        echo "ZZZ = {$zzz} <br>";
        echo "X = {$x} <br>";
        echo "Q = {$q} <br><br>";

        echo "checksum = {$sum} <br>";

        $pesel = $yymmdd.$zzz.$x.$q;

        $is_valid = $this->validateChecksum($sum);
        
        if ($is_valid) {
            echo "{$pesel} is valid";
        } else {
            echo "{$pesel} is in-valid";
        }    

    }

    public function generateRandomBirthDate()
    {
        $start = strtotime('1800-01-01');
        $end = time();
        $timestamp = mt_rand($start, $end);

        return date('Y-m-d', $timestamp);
    }

    public function generateRandomGender()
    {
        $gender_list = ['m', 'f'];
        $key = array_rand($gender_list);  

        return $gender_list[$key];
    }

    public function checkInput($pesel)
    {
        $arr = str_split($pesel);

        if (count($arr) != 11 || !is_numeric($pesel)) {
            return false;
        }

        return $arr;
    }

    public function generateRandomNumber()
    {
        $digits = 3;
        return rand(pow(10, $digits-1), pow(10, $digits)-1);
    }

    public function checkGender($gender)
    {
        $lwr_gender = strtolower($gender);
        $odds = [1,3,5,7,9];
        $even = [2,4,6,8];

        $key_odds = array_rand($odds);  
        $val_odds = $odds[$key_odds];

        $key_even = array_rand($even);  
        $val_even = $even[$key_even];

        if ($lwr_gender == 'm') {
            return $val_odds;
        } elseif ($lwr_gender == 'f') {
            return $val_even;
        }
    }

    public function checkBirthDate($birthdate)
    {
        $arr = explode("-", $birthdate);

        if ($arr[0] >= 2000 && $arr[0] <= 2099) {
            $month = $arr[1] + 20;
        } elseif ($arr[0] >= 2100 && $arr[0] <= 2199) {
            $month = $arr[1] + 40;
        } elseif ($arr[0] >= 2200 && $arr[0] <= 2299) {
            $month = $arr[1] + 60;
        } elseif ($arr[0] >= 1800 && $arr[0] <= 1899) {
            $month = $arr[1] + 80;
        } else {
            $month = $arr[1];
        }

        $year = substr($arr[0], -2, 2);
        
        $day = $arr[2];
        
        // format YY MM DD
        return $year.$month.$day;
    }

    public function validateChecksum($sum) 
    {
        $checksum = (10 - ($sum % 10)) % 10;
        $last_digit_sum = substr($sum, -1);

        if ($checksum == $last_digit_sum) {
            return true;
        } else {
            return false;
        }
    }

    public function sumPesel($pesel)
    {
        $arr = str_split($pesel);

        $limit = count($arr) - 1;
        $sum = 0;

        for ($i=0; $i <= $limit; $i++) {
            $sum += $arr[$i] * self::multiplier($i + 1);
        }

        return $sum;
    }

    private static function multiplier($index) {
        switch ($index % 4) {
            case 1: 
                return 1;
                break;
            case 2: 
                return 3;
                break;
            case 3: 
                return 7;
                break;
            case 0: 
                return 9;
                break;
        }
    }    
}


$pesel = New Pesel();

$birthdate = $pesel->generateRandomBirthDate();
$gender = $pesel->generateRandomGender();

$pesel->getPesel($birthdate, $gender);