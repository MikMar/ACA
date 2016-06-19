<?php


    function getAllPossibleSums($tempArray, $tempOdd){
        $sumArray = [];
        $size = count($tempArray);
        for ($i=1;$i<pow(2,$size);$i++) {
            $index = $size-1;
            $temp = $i; // each i in binary code is the number that we need to detect indexes for sum
            // for example 7 is 111 in binary it means that we should take last 3 items in main array
            while ($temp != 0){
                if ($temp%2 == 1){
                    if ($sumArray[$i-1] == 0 && $temp/2 < 1){
                    } else {
                        $sumArray[$i-1] += $tempArray[$index];
                    }
                }
                $index--;
                $temp /= 2;
            }
        }

        sort($sumArray);
        array_splice($sumArray, 0, $tempOdd); // removing all odd elements
        return $sumArray;
    }

    function kthTerm($n, $k) {
        $oddElements = 0; // in forst step there is no odd elements they will appear n next getAllSums
        $mainArray = [1, $n];
        $powArray = [1, $n];
        $i = 2;
        $term = 2;
        while ($i<$k){
            $pow = pow($n, $term);
            $allPossibleSums = getAllPossibleSums($powArray, $oddElements);
            for($j=0;$j<count($allPossibleSums);$j++){
                $mainArray[$i++] = $allPossibleSums[$j];
            }
            $mainArray[$i++] = $pow;
            $term++;
            $powArray[] = $pow;
            $oddElements += count($allPossibleSums); // collectiong odd elements from all sums
        }
        for ($i=0;$i<$k;$i++){
            echo $mainArray[$i] . ' ';
        }
    }

    kthTerm(3, 100);