<?php

/**
 * User: Rodion Abdurakhimov
 * Date: 25/6/16
 * Time: 17:58
 */
class UpdateIblockProperty
{
    public function up()
    {
        $properties = CIBlockProperty::GetList(
            [],
            [
                'IBLOCK_ID' => IBLOCK_ID,
                'CODE' => 'MANUFACTURER'
            ]
        );
        if ($prop_fields = $properties->GetNext()) {
            $arFields = [
                'SORT' => 9999,
            ];
            $ibp = new CIBlockProperty;
            $ibp->Update($prop_fields['ID'], $arFields);
        }
    }

    public function down()
    {
        $properties = CIBlockProperty::GetList(
            [],
            [
                'IBLOCK_ID' => IBLOCK_ID_CATALOG,
                'CODE' => 'MANUFACTURER'
            ]
        );
        if ($prop_fields = $properties->GetNext()) {
            $arFields = [
                'SORT' => 1000, // значение сортировки до миграции
            ];
            $ibp = new CIBlockProperty;
            $ibp->Update($prop_fields['ID'], $arFields);
        }
    }
}
