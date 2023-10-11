<?php

$array = [12, 65, 95, 41, 85, 63, 71, 64];

$arrayA = [12, "le", 95, 12, 85, "le", 71, "toi", 95, "la"];
$arrayB = [85, "toi", 95, "la", 65, 94, 85, "avec", 37, "chat"];

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <title>Introduction PHP - Exo 4</title>
</head>

<body class="dark-template">
    <div class="container">
        <header class="header">
            <h1 class="main-ttl">Introduction PHP - Exo 4</h1>
            <nav class="main-nav">
                <ul class="main-nav-list">
                    <li><a href="index.php" class="main-nav-link">Entrainement</a></li>
                    <li><a href="exo2.php" class="main-nav-link">Donnez moi des fruits</a></li>
                    <li><a href="exo3.php" class="main-nav-link">Donnez moi de la thune</a></li>
                    <li><a href="exo4.php" class="main-nav-link active">Donnez moi des fonctions</a></li>
                    <li><a href="exo5.php" class="main-nav-link">Netflix</a></li>
                    <li><a href="exo6.php" class="main-nav-link">Mini-site</a></li>
                </ul>
            </nav>
        </header>

        <!-- QUESTION 1 -->
        <section class="exercice">
            <h2 class="exercice-ttl">Question 1</h2>
            <p class="exercice-txt">Déclarer une fonction qui prend en paramètre un tableau et retourne la chaîne de caractère HTML permettant d'afficher les valeurs du tableau sous la forme d'une liste.</p>
            <div class="exercice-sandbox">
                
            <?php
            /**
             * Turn array into string as HTML list
             *
             * @param array $array
             * @return string
             */
            function turnArrayIntoString(array $array): string{
                // $result = '<ul> ';
                // foreach($array as $element){
                //     $result .= '<li>'.$element.'</li>';
                // }
                // return $result .= '</ul>';

                // return '<ul>' . implode('', array_map(fn($v) => "<li>{$v}</li>", $array)) . '</ul>';

                return '<ul><li>' . implode('</li><li>', $array) . '</li></ul>';
            }

            echo turnArrayIntoString($array);

            ?>
        
            </div>
        </section>

        <!-- QUESTION 2 -->
        <section class="exercice">
            <h2 class="exercice-ttl">Question 2</h2>
            <p class="exercice-txt">Déclarer une fonction qui prend en paramètre un tableau d'entiers et retourne uniquement les valeurs paires. Afficher les valeurs du tableau sous la forme d'une liste HTML.</p>
            <div class="exercice-sandbox">
                <?php 
                /**
                 * get list even from array.
                 *
                 * @param array $array
                 * @return array
                 */
                function getListEven(array $array): array {
                    // $arrayEven = [];
                    // foreach($array as $value){
                    //     if($value % 2 == 0){
                    //         $arrayEven[] = $value;
                    //     }
                    // }
                    // return $arrayEven;

                    return array_filter($array, fn($v) => is_numeric($v) && !($v % 2));
                }
                echo turnArrayIntoString(getListEven($arrayB));
                
                ?>
            </div>
        </section>

        <!-- QUESTION 3 -->
        <section class="exercice">
            <h2 class="exercice-ttl">Question 3</h2>
            <p class="exercice-txt">Déclarer une fonction qui prend en paramètre un tableau d'entiers et retourne uniquement les entiers d'index pair</p>
            <div class="exercice-sandbox">
                <?php
                function getIntsIndexPair(array $array) :array{
                    // $result = [];
                    // foreach($array as $index => $value) {
                    //     if ($index%2 == 0) {
                    //         $result[] = $value;  
                    //     }
                    // }
                    // return $result;

                    return array_filter($array, fn($k) => !($k%2), ARRAY_FILTER_USE_KEY);
                }

                var_dump(getIntsIndexPair($array ));
                ?>  

            </div>
        </section>

        <!-- QUESTION 4 -->
        <section class="exercice">
            <h2 class="exercice-ttl">Question 4</h2>
            <p class="exercice-txt">Déclarer une fonction qui prend en paramètre un tableau d'entiers. La fonction doit retourner les valeurs du tableau mulipliées par 2.</p>
            <div class="exercice-sandbox">
                <?php
                    /**
                     * Take an array and return it with value multiply by two
                     *
                     * @param array $array
                     * @return array
                     */
                    function multiplyValueByTwo(array $array): array {
                        return array_map(fn($value) => $value * 2, $array);
                    };
                    echo turnArrayIntoString(multiplyValueByTwo($array));
                ?>
            </div>
        </section>

        <!-- QUESTION 4 bis -->
        <section class="exercice">
            <h2 class="exercice-ttl">Question 4 bis</h2>
            <p class="exercice-txt">Déclarer une fonction qui prend en paramètre un tableau d'entiers et un entier. La fonction doit retourner les valeurs du tableau divisées par le second paramètre</p>
            <div class="exercice-sandbox">
                <?php
                /**
                 * function that divides integer values of array by integer value of parameter. 
                 *
                 * @param array $array
                 * @param integer $integer
                 * @return array
                 */
                function divideArray(array $array, int $integer):array{
                    $arrayDivide = [];
                    foreach ($array as $key => $value) {
                        $arrayDivide[] = $value / $integer; 
                    }
                return $arrayDivide;
                }
                var_dump(divideArray($array, 2))
                ?>
            </div>
        </section>

        <!-- QUESTION 5 -->
        <section class="exercice">
            <h2 class="exercice-ttl">Question 5</h2>
            <p class="exercice-txt">Déclarer une fonction qui prend en paramètre un tableau d'entiers ou de chaînes de caractères et retourne le tableau sans doublons</p>
            <div class="exercice-sandbox">
                <?php
                /**
                 * Return an array without Duplicates
                 *
                 * @param array $array
                 * @return array
                 */
                function removeDuplicatedValuesInArray (array $array): array {
                    $newArray = [];
                    foreach ($array as $value) {
                        if (in_array($value, $newArray)) continue;
                        $newArray[] = $value;
                    }
                    return $newArray;
                }
                var_dump(removeDuplicatedValuesInArray($arrayA));

                var_dump(array_unique($arrayA));   

                // var_dump(array_keys(array_count_values($arrayA)));    

                ?>
            </div>
        </section>

        <!-- QUESTION 6 -->
        <section class="exercice">
            <h2 class="exercice-ttl">Question 6</h2>
            <p class="exercice-txt">Déclarer une fonction qui prend en paramètre 2 tableaux et retourne un tableau représentant l'intersection des 2</p>
            <div class="exercice-sandbox">
                <?php

                /**
                 * function returns an array including common elements of given arrays.
                 *
                 * @param array $array1
                 * @param array $array2
                 * @return array
                 */
                    function getIntersectionOfArrays (array $array1, array $array2) : array {
                        // $newArray = [];
                        // foreach ($array1 as $element) {
                        //     if(in_array($element, $array2)) {
                        //         $newArray[] = $element;
                        //     }                            
                        // }
                        // return $newArray;

                        return array_filter($array1, fn($v) => in_array($v, $array2));
                    }

                    var_dump(getIntersectionOfArrays($arrayA, $arrayB));

                    var_dump(array_intersect($arrayA, $arrayB));
?>
            </div>
        </section>

        <!-- QUESTION 7 -->
        <section class="exercice">
            <h2 class="exercice-ttl">Question 7</h2>
            <p class="exercice-txt">Déclarer une fonction qui prend en paramètre 2 tableaux et retourne un tableau des valeurs du premier tableau qui ne sont pas dans le second</p>
            <div class="exercice-sandbox">
                <?php
                /**
                 * Returns first array values which are not in the second one.
                 *
                 * @param array $array
                 * @param array $arrayA
                 * @return array
                 */
                function getDiffFromArrays (array $array, array $arrayA): array {
                    // $arrayDiff = [];
                    // foreach ($array as $value) {
                    //     if (!in_array($value, $arrayA)) {
                    //         $arrayDiff[] = $value;
                    //     }
                    // }
                    // return $arrayDiff;

                    return array_filter($array, fn($v) => !in_array($v, $arrayA));

                    // return array_filter($array, function($v) use ($arrayA) {
                    //     return !in_array($v, $arrayA);
                    // });
                }

                echo turnArrayIntoString(getDiffFromArrays($array, $arrayA));
                
                echo turnArrayIntoString(array_diff($array, $arrayA));
                
                ?>
            </div>
        </section>


        <!-- QUESTION 8 -->
        <section class="exercice">
            <h2 class="exercice-ttl">Question 8</h2>
            <p class="exercice-txt">Réécrire la fonction précédente pour lui ajouter un paramètre booléen facultatif. Si celui-ci est à true, le tableau retourné sera sans doublons</p>
            <div class="exercice-sandbox">
                
            </div>
        </section>


        <!-- QUESTION 9 -->
        <section class="exercice">
            <h2 class="exercice-ttl">Question 9</h2>
            <p class="exercice-txt">Déclarer une fonction qui prend en paramètre un tableau et un entier et retourne les n premiers éléments du tableau.</p>
            <div class="exercice-sandbox">
                
            </div>
        </section>
    </div>
    <div class="copyright">© Guillaume Belleuvre, 2023 - DWWM</div>
</body>

</html>