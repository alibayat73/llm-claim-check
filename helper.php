<?php

function getFromTerminal(): false|string
{
    $line = fgets(fopen ("php://stdin","r"));
    fclose(fopen ("php://stdin","r"));

    return $line;
}