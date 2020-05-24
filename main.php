<?php

include "connexionDB.php";

$idcon = connexpdo("postgres","isen2020");
$query1 = "SELECT * from notes";
$notes = $idcon->query($query1);


header ("Content-type: image/png");
$image = imagecreate(700,500);

$gris = imagecolorallocate($image, 150,150,150);
$orange = imagecolorallocate($image, 255, 128, 0);
$bleu = imagecolorallocate($image, 0, 0, 255);
$bleuclair = imagecolorallocate($image, 156, 227, 254);
$noir = imagecolorallocate($image, 0, 0, 0);
$blanc = imagecolorallocate($image, 255, 255, 255);



$lastXE1 = 50;
$lastYE1 = 100;
$lastNoteE1 = 0;
$lastXE2 = 50;
$lastYE2 = 100;
$lastNoteE2 = 0;

$nbNoteE1 = 0;
$totNoteE1 = 0;
$nbNoteE2 = 0;
$totNoteE2 = 0;
foreach ($notes as $data){
    if($data["etudiant"] == "E1"){
        if($data["semestre"] == "S1"){$lastYE1 -= $data["note"];}
        $diff = $data["note"] - $lastNoteE1;
        $lastNoteE1 = $data["note"];
        imageline($image,$lastXE1,$lastYE1,$lastXE1+50,$lastYE1+$diff,$blanc);
        $lastXE1=$lastXE1+50;
        $lastYE1 = $lastYE1+$diff;

        $totNoteE1 += $data["note"];
        $nbNoteE1 += 1;
    }else{
        if($data["semestre"] == "S1"){$lastYE2 -= $data["note"];}
        $diff = $data["note"] - $lastNoteE2;
        $lastNoteE2 = $data["note"];
        imageline($image, $lastXE2,$lastYE2,$lastXE2+50,$lastYE2+$diff,$bleu);
        $lastXE2=$lastXE2+50;
        $lastYE2 = $lastYE2+$diff;

        $totNoteE2 += $data["note"];
        $nbNoteE2 += 1;
    }
}

imagestring($image,5,200,10,'Notes des etudiants E1 et E2', $noir);
imagestring($image,5,350,250,"Moyenne des notes de E1 : ".$totNoteE1/$nbNoteE1,$noir);
imagestring($image,5,350,300,"Moyenne des notes de E2 : ".$totNoteE2/$nbNoteE2,$noir);

imagestring($image,5,50,250,"E1",$blanc);
imagestring($image,5,50,300,"E2",$bleu);

imagepng($image);
?>