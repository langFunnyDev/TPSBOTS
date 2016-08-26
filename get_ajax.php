<?php 
header("Content-type: text/plain; charset=utf8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
sleep(2);
echo "Ура получилось! Спасибо sitear.ru!<br>";
while(list ($key, $val) = each ($_POST))
{
                $val = iconv("UTF-8","CP1251", $_POST[$key]);
                echo "<b>".$key.":</b> "."<pre>".stripslashes($val)."</pre>";
}
