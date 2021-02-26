<?php

session_start();

/**
 * BaseController
 */
class BaseController
{
    
    /**
     * convertMoneyToDatabase
     *
     * @param  mixed $value
     * @return void
     */
    protected function convertMoneyToDatabase($value)
    {

        $value = str_replace('.', '', $value);
        $value = str_replace(',', '.', $value);
        return $value;
    }
    
    /**
     * removeMaskMoneyToView
     *
     * @param  mixed $value
     * @return void
     */
    protected function removeMaskMoneyToView($value)
    {
        $value = str_replace('$', '', $value);
        $value = str_replace(',', '', $value);
        return $value;
    }
}
