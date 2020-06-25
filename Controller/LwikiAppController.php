<?php

class LwikiAppController extends AppController
{


    public function alertMesasge($array)
    {
        foreach ($array as $key => $value) {
            return $value;
        }
    }
}