<?php

namespace emilebons\moneybird;


interface ConverterInterface
{
    public function convert($object);
    public function parse(array $array);
}