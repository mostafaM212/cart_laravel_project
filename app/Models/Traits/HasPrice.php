<?php

namespace App\Models\Traits ;

use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
use App\Cart\Money as MyMoney ;
use NumberFormatter;

trait HasPrice
{
    public function getFormattedPriceAttribute(){

        return $this->price->formatted() ;

//        return Money::USD($this->price) ;
    }
    /*
    * here we will change the price  that comming form database before send it to use
     * and give it to use
    */
    public function getPriceAttribute($value){
        /*
         * here i have made an object of my money class
         */
        return new MyMoney($value);
    }

}
