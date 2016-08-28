<?php

/**
 * User: Rodion Abdurakhimov
 * Date: 25/6/16
 * Time: 18:09
 */
class ClearSaleUserAccounts
{
    public function up()
    {
        //Обнулить внутренние счета пользователям
        \Bitrix\Main\Loader::includeModule('sale');
        $dbAccountCurrency = CSaleUserAccount::GetList(
            array(),
            array('>CURRENT_BUDGET' => 0),
            false,
            false,
            array('ID', 'CURRENT_BUDGET', 'CURRENCY')
        );
        while ($arAccountCurrency = $dbAccountCurrency->Fetch()) {
            CSaleUserAccount::Update($arAccountCurrency['ID'], array('CURRENT_BUDGET' => 0.00));
        }
    }
}
