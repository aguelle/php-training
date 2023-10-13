<?php

/**
 * Turn array into string as HTML list
 *
 * @param array $array
 * @param string $ulClass Optionnal CSS class (or classes) to UL element
 * @param string $liClass Optionnal CSS class (or classes) to LI element
 * @return string
 */
function turnArrayIntoString(array $array, string $ulClass = NULL, string $liClass = NULL): string
{
    // $result = '<ul> ';
    // foreach($array as $element){
    //     $result .= '<li>'.$element.'</li>';
    // }
    // return $result .= '</ul>';

    // return '<ul>' . implode('', array_map(fn($v) => "<li>{$v}</li>", $array)) . '</ul>';

    $ulClass = $ulClass ? " class=\"{$ulClass}\"" : '';
    $liClass = $liClass ? " class=\"{$liClass}\"" : '';
    return "<ul{$ulClass}><li{$liClass}>" . implode("</li><li{$liClass}>", $array) . '</li></ul>';
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


// ---------------
// SERIES
// ---------------

/**
 * Return serie title and main image into HTML string.
 *
 * @param array $serie
 * @param bool $details If true, displays all details (optionnal)
 * @return string
 */
function getSerieHTML(array $serie, bool $details = false): string
{
    $html = '<h3>'
        . '<a href="' . getSerieURL($serie) . "\">{$serie['name']}</a>"
        . '</h3>'
        . "<img class=\"series__img\" src=\"{$serie['image']}\">";

    if ($details) {
        $html .= '<ul>'
            . '<li>Date de lancement : ' . $serie['releaseYear'] . '</li>'
            . '<li>Pays : ' . $serie['country'] . '</li>'
            . '<li>Plateforme : ' . $serie['availableOn'] . '</li>'
            . '<li>Styles : ' . turnArrayIntoString($serie['styles']) . '</li>'
            . '<li>Réalisateurs : ' . turnArrayIntoString($serie['createdBy']) . '</li>'
            . '<li>Acteurs : ' . turnArrayIntoString($serie['actors']) . '</li>'
            . '<li>Durée des épisodes : ' . $serie['episodeDurationInMinutes'] . ' minutes</li>'
            . '<li>Nb de saisons : ' . $serie['numberOfSeasons'] . '</li>'
            . '<li>Nb d\'épisodes : ' . $serie['numberOfEpisods'] . '</li>'
            . '<li>Toujours en cours : ' . ($serie['ongoing'] ? 'oui' : 'non') . '</li>'
            . '</ul>';
    }

    return $html;
}

/**
 * Return HTML to display series into list tags.
 *
 * @param array $series
 * @return string
 */
function getHTMLSeries(array $series): string
{
    return turnArrayIntoString(array_map('getSerieHTML', $series), 'series', 'series__itm');
}

/**
 * Get serie URL page from serie data.
 *
 * @param array $serie
 * @return string
 */
function getSerieURL(array $serie): string
{
    return "?serie={$serie['id']}";
}

/**
 * Returns an array if a serie with the given id exists.
 * Returns NULL if not.
 *
 * @param integer $id
 * @return array|null
 */
function getSerieDataFromId(int $id): ?array
{
    global $series;

    $result = array_filter($series, fn ($s) => $s['id'] === $id);

    if (sizeof($result) !== 1) return NULL;

    return array_values($result)[0];
}

/**
 * Returns all series styles in a new array
 *
 * @param array $series
 * @return array
 */
function getSeriesStyles(array $series): array {
    $arrayStyles = array_unique(array_merge(...array_column($series, 'styles')));
    sort($arrayStyles);
    return $arrayStyles;
}
