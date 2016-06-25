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
        $priceUserGroups = [1];

        $priceType = [
            'NAME' => 'DISCOUNT_COUPONS',
            'BASE' => 'N',
            'SORT' => 100,
            'XML_ID' => 'discount-coupons',
            'USER_GROUP' => $priceUserGroups,
            'USER_GROUP_BUY' => $priceUserGroups,
            'USER_LANG' => [
                'ru' => 'Скидка по купону',
                'en' => '',
            ],
        ];

        CCatalogGroup::Add($priceType);
    }

    public function down()
    {
        \Bitrix\Main\Loader::includeModule('catalog');

        $dbPriceType = CCatalogGroup::GetList(
            ["SORT" => "ASC"],
            ["NAME" => "DISCOUNT_COUPONS"]
        );
        if ($arPriceType = $dbPriceType->Fetch()) {
            CCatalogGroup::Delete($arPriceType['ID']);
        }
    }
}
