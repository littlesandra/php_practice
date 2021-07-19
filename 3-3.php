<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // nl2br() 
    //以 HTML 的 <br> 取代分行字元(\n)
    $str01 = "小明:「我重要嗎?」\n 小美:「再重都要。」";
    echo nl2br($str01);
    ?>

    <hr>

    <?php
    //trim()、ltrim()、rtrim()
    $str02 = "   我想妳一定很忙，所以只要看前三個字就好...   ";
    echo trim($str02) . "<br>";
    echo ltrim($str02) . "<br>";
    echo rtrim($str02) . "<br>";
    ?>

    <hr>

    <?php
    //explode()、print_r() 
    $str03 = "人,帥,得,體";
    $arr03 = explode(",", $str03);
    echo $arr03[0] . $arr03[1] . $arr03[2] . $arr03[3] . "<br>";
    print_r($arr03);
    ?>

    <hr>

    <?php
    //implode()、join() 
    $str04_1 = implode("~", $arr03);
    echo $str04_1 . "<br>";
    $str04_2 = join("...", $arr03);
    echo $str04_2 . "<br>";
    ?>

    <hr>

    <?php
    //strlen()、mb_strlen()、strpos()、mb_strpos()、substr()、mb_substr()
    $str05_1 = "abcdefg";
    $str05_2 = "懷疑人生";
    echo strlen($str05_1) . "<br>";
    echo mb_strlen($str05_2) . "<br>";
    echo strpos($str05_1, "c") . "<br>";
    echo mb_strpos($str05_2, "人") . "<br>";
    echo substr($str05_1, 3, 5) . "<br>";
    echo mb_substr($str05_2, 2, 3) . "<br>";
    ?>

</body>

</html>