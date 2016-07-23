<?php

/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 7/23/16
 * Time: 12:07 PM
 */
class Cnk
{
    /**This function returns array with all possible variations of k elements from given array ignoring oder
     * @param $array
     * @param $k
     */
    public function getCnk($array, $k){
        $n = count ($array);
        $indexes = [];
        $tempArray = [];
        for ($i=1; $i<= pow(2,$n); $i++){
            $string = strval(decbin($i));
            if (substr_count($string, '1') == $k){
                while (strlen($string) != $n){
                    $string = '0' . $string;
                }
                $temp = [];
                for ($j=0; $j< $k; $j++){
                    $indexes[$j] = stripos($string, '1');
                    $string[$indexes[$j]] = 0;
                    $temp[] = $array[$indexes[$j]];
                }
                $tempArray[] = $temp;
            }
        }
        return $tempArray;
    }
}

$array = [1,2,3,4,5,6,7,8,9];

$cnk = new Cnk();
echo '<pre>';
var_dump($cnk->getCnk($array, 3));
echo '</pre>';