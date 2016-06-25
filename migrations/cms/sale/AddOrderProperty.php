<?php

/**
 * User: Rodion Abdurakhimov
 * Date: 25/6/16
 * Time: 18:07
 */
class AddOrderProperty
{
    public function up()
    {
        \Bitrix\Main\Loader::includeModule('sale');

        $arFields = [
            'PERSON_TYPE_ID' => 1,
            'NAME' => 'Оплата с внутреннего счета',
            'TYPE' => 'TEXT',
            'REQUIED' => 'N',
            'DEFAULT_VALUE' => '0',
            'SORT' => 100,
            'CODE' => 'FIRST_WITHDRAW',
            'USER_PROPS' => 'N',
            'IS_LOCATION' => 'N',
            'IS_LOCATION4TAX' => 'N',
            'PROPS_GROUP_ID' => 1,
            'SIZE1' => 0,
            'SIZE2' => 0,
            'DESCRIPTION' => '',
            'IS_EMAIL' => 'N',
            'IS_PROFILE_NAME' => 'N',
            'IS_PAYER' => 'N',
            'UTIL' => 'Y'
        ];

        CSaleOrderProps::Add($arFields);
    }

    public function down()
    {
        \Bitrix\Main\Loader::includeModule('sale');

        $db_props = CSaleOrderProps::GetList(
            ['SORT' => 'ASC'],
            [
                'CODE' => 'FIRST_WITHDRAW'
            ],
            false,
            false,
            ['ID']
        );

        if ($props = $db_props->Fetch()) {
            CSaleOrderProps::Delete($props['ID']);
        }
    }
}
