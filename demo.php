<?php

    require_once('res/ParserClass.php');

    $txt_rep = array(
        'name' => 'Mario',
        'txt_r' => 'The %s of %s'
    );

    $str1 = "It's me {name}";
    $str2 = "I love soundtrack of {txt_r}";

    try {

        $parser = new ParsingText($txt_rep);

        echo $parser->parseText($str1);
        echo "<br />".
        echo $parser->parseText($str2, array('Legend', 'Zelda'));

    } catch (Exception $e) {

        echo 'Caught exception: '.$e->getMessage();

    }
