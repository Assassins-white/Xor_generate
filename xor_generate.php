<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>异或生成器</title>
</head>
<body>
    <form action="<?php __FILE__;?>" method="post">
        <input type="text" name="keyword">
        <input type="submit">
    </form>
    
    
</body>
</html>


<?php
function GetRandStr($length){
    $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $len = strlen($str)-1;
    $randstr = '';
    for ($i=0;$i<$length;$i++) {
        $num=mt_rand(0,$len);
        $randstr .= $str[$num];
    }
    return $randstr;
}

function filterNonPrintableChar($str){
    $i = 0;
    $newStr = '';
    while (isset($str[$i])) {
        $char = $str[$i];
        $asc = ord($char);
        if ($asc > 31 && $asc < 127 || $asc > 127) {
            $newStr .= $char;
        }
        $i++;
    }
    return $newStr;
}

$keyword = $_POST['keyword'];


while (!empty($keyword)) {
    $length = mb_strlen($keyword);
    $random = GetRandStr($length);
    $xor1 = ("$keyword"^"$random");
    $xor1 = filterNonPrintableChar($xor1);
    $length2 = strlen($xor1);
    $xor2 = ("$random"^"$xor1");
    if($length === $length2 && $xor2 == $keyword){
        echo 'keyword: '.$keyword . '<hr>';
        echo "<table border=\"2\"><tr><th>Xor1</th><th>Xor2</th></tr><tr><td>$random</td><td>$xor1</td></tr></table>";
        echo '<br/>鼠标左击三下选中内容';
        break;
    }else{
        continue;
    }
}?>
