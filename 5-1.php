<?php
//單向選擇 if
$a = 5;
if ($a > 0) echo '$a 變數的值是正數'; //只有一行時可加可不加{}
echo "<br>";
if ($a > 0) {
    echo '$a 變數的值大於 0';
}

echo "<hr>";

echo "<hr />";
//雙向選擇 if ... else 
$a = -5;
if ($a > 0) {
    echo '$a 變數的值是正數';
} else {
    echo '$a 變數的值是負數';
}

echo "<hr>";

//多向選擇 if ... else if ... else
//寫法 elseif 或 else if 都可以
$score = 85;
if ($score >= 60 && $score < 70) {
    echo '丙等';
} elseif ($score >= 70 && $score < 80) {
    echo '乙等';
} elseif ($score >= 80 && $score < 90) {
    echo '甲等';
} elseif ($score >= 90) {
    echo '優等';
} else {
    echo '不及格';
}

echo "<hr />";
