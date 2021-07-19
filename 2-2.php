<?php
//陣列變數
$arrName = ["Alex", "Bill", "Carl", "Darren"];
echo "<div style = 'color:red;'>" . $arrName[0] . "</div><br/>";
echo $arrName[1] . "<br/>";
echo $arrName[2] . "<br/>";
echo $arrName[3] . "<br/>";

//可以整合 HTML 標籤
echo "<br /><br />";

//物件變數
$obj = ["name" => "Darren", "age" => 17];
echo "姓名：" . $obj['name'] . "， 年齡：" . $obj['age'];
