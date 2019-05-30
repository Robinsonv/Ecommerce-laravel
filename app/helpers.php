<?php 

function presetPrice($price){
    $realPrice = (int)$price;

    return money_format('$%i', $realPrice / 100);
}

function setActiveCategory($category)
{
    return request()->category == $category ? 'active' : '';
}