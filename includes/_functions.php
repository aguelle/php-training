<?php

/**
 * Turn array into string as HTML list
 *
 * @param array $array
 * @return string
 */
function turnArrayIntoString(array $array): string
{
    // $result = '<ul> ';
    // foreach($array as $element){
    //     $result .= '<li>'.$element.'</li>';
    // }
    // return $result .= '</ul>';

    // return '<ul>' . implode('', array_map(fn($v) => "<li>{$v}</li>", $array)) . '</ul>';

    return '<ul><li>' . implode('</li><li>', $array) . '</li></ul>';
}

/**
 * get list even from array.
 *
 * @param array $array
 * @return array
 */
function getListEven(array $array): array
{
    // $arrayEven = [];
    // foreach($array as $value){
    //     if($value % 2 == 0){
    //         $arrayEven[] = $value;
    //     }
    // }
    // return $arrayEven;

    return array_filter($array, fn ($v) => is_numeric($v) && !($v % 2));
}


function getIntsIndexPair(array $array): array
{
    // $result = [];
    // foreach($array as $index => $value) {
    //     if ($index%2 == 0) {
    //         $result[] = $value;  
    //     }
    // }
    // return $result;

    return array_filter($array, fn ($k) => !($k % 2), ARRAY_FILTER_USE_KEY);
}


/**
 * Take an array and return it with value multiply by two
 *
 * @param array $array
 * @return array
 */
function multiplyValueByTwo(array $array): array
{
    return array_map(fn ($value) => $value * 2, $array);
}


/**
 * function that divides integer values of array by integer value of parameter. 
 *
 * @param array $array
 * @param integer $integer
 * @return array
 */
function divideArray(array $array, int $integer): array
{
    $arrayDivide = [];
    foreach ($array as $key => $value) {
        $arrayDivide[] = $value / $integer;
    }
    return $arrayDivide;
}


/**
 * Return an array without Duplicates
 *
 * @param array $array
 * @return array
 */
function removeDuplicatedValuesInArray(array $array): array
{
    $newArray = [];
    foreach ($array as $value) {
        if (in_array($value, $newArray)) continue;
        $newArray[] = $value;
    }
    return $newArray;
}


/**
 * function returns an array including common elements of given arrays.
 *
 * @param array $array1
 * @param array $array2
 * @return array
 */
function getIntersectionOfArrays(array $array1, array $array2): array
{
    // $newArray = [];
    // foreach ($array1 as $element) {
    //     if(in_array($element, $array2)) {
    //         $newArray[] = $element;
    //     }                            
    // }
    // return $newArray;

    return array_filter($array1, fn ($v) => in_array($v, $array2));
}


/**
 * Returns first array values which are not in the second one.
 *
 * @param array $array
 * @param array $arrayA
 * @param bool $unique facultative parameter : when set to true, the function deduplicates the resulted array
 * @return array
 */
function getDiffFromArrays(array $array, array $arrayA, bool $unique = false): array
{
    $arrayDiff = [];
    foreach ($array as $value) {
        if (
            !in_array($value, $arrayA) && (!$unique || ($unique && !in_array($value, $arrayDiff)))
        ) {
            $arrayDiff[] = $value;
        }
    }

    return $arrayDiff;

    // return $unique ? array_unique($arrayDiff) : $arrayDiff;

    return array_filter($array, fn ($v) => !in_array($v, $arrayA));

    // return array_filter($array, function($v) use ($arrayA) {
    //     return !in_array($v, $arrayA);
    // });
}


/**
 * Extract N first values of given array, depending on given Int.
 *
 * @param array $array
 * @param integer $length - N
 * @return array
 */
function extractNFirstValueArray(array $array, int $length): array
{
    $newArray = [];
    $length = min($length, sizeof($array));
    while ($length > sizeof($newArray)) {
        $newArray[] = array_shift($array);
    }
    return $newArray;

    // return array_filter($array, fn($k) => $k <= $length - 1, ARRAY_FILTER_USE_KEY);
};
