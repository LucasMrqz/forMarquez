<?php
try{
    $sel = "Wb6NTsS!H&3S#TKp8sxgy_Xwo!vf@s";
//$lien = new PDO('mysql:host=localhost;dbname=formarquez','root','');
$lien = new PDO('mysql:host=mysql-formarquez.alwaysdata.net;dbname=formarquez_formarquez','362427','Lm13015*mrs');
$lien->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
  die("Une érreur a été trouvé : " . $e->getMessage());
}

?>

