<?php

/**
 * User: Rodion Abdurakhimov
 * Date: 25/6/16
 * Time: 18:10
 */
class AddNewCatalogGroup
{
    public function up()
    {
        \Bitrix\Main\Loader::includeModule('catalog');

        //для админов, добавьте в массив идентификаторы нужных групп
        $priceUserGroups = array(1);

        $priceType = array(
            'NAME' => 'DISCOUNT_COUPONS',
            'BASE' => 'N',
            'SORT' => 100,
            'XML_ID' => 'discount-coupons',
            'USER_GROUP' => $priceUserGroups,
            'USER_GROUP_BUY' => $priceUserGroups,
            'USER_LANG' => array(
                'ru' => 'Скидка по купону',
                'en' => '',
            ),
        );

        CCatalogGroup::Add($priceType);
    }

    public function down()
    {
        \Bitrix\Main\Loader::includeModule('catalog');

        $dbPriceType = CCatalogGroup::GetList(
            array("SORT" => "ASC"),
            array("NAME" => "DISCOUNT_COUPONS")
        );
        if ($arPriceType = $dbPriceType->Fetch()) {
            CCatalogGroup::Delete($arPriceType['ID']);
        }
    }
}
