<?php

/**
 * User: Rodion Abdurakhimov
 * Date: 25/7/2
 * Time: 16:54
 */
class AddIblockProperty
{
    /**
     * Новые значения списка
     * @var array
     */
    public static $arNewBoatsTypeValues = [
        'Y',
    ];

    public function up()
    {
        $iblock = CIBlock::GetList([], ['ID' => IBLOCK_ID])->GetNext();
        if ($iblock['ID']) {
            $ibp = new CIBlockProperty;
            $ibpenum = new CIBlockPropertyEnum;

            $arFields = [
                'NAME' => 'Товар-растение',
                'ACTIVE' => 'Y',
                'SORT' => '100',
                'CODE' => 'PRODUCT_PLANT',
                'PROPERTY_TYPE' => 'L',
                'FILTRABLE' => 'Y',
                'IBLOCK_ID' => $iblock['ID']
            ];
            $ibp->Add($arFields);

            $properties = CIBlockProperty::GetList(
                [],
                [
                    'IBLOCK_ID' => $iblock['ID'],
                    'CODE' => 'PRODUCT_PLANT'
                ]
            );
            if ($prop_fields = $properties->GetNext()) {
                foreach (self::$arNewBoatsTypeValues as $newBoatsTypeValue) {
                    $ibpenum->Add([
                        'PROPERTY_ID' => $prop_fields['ID'],
                        'VALUE' => $newBoatsTypeValue,
                        'XML_ID' => $newBoatsTypeValue
                    ]);
                }
            }
        }
    }

    public function down()
    {
        $iblock = CIBlock::GetList([], ['ID' => IBLOCK_ID])->GetNext();
        if ($iblock['ID']) {
            $properties = CIBlockProperty::GetList(
                ['sort' => 'asc', 'name' => 'asc'],
                ['IBLOCK_ID' => $iblock['ID'], 'CODE' => 'PRODUCT_PLANT']
            );
            if ($prop_fields = $properties->GetNext()) {
                CIBlockProperty::Delete($prop_fields['ID']);
            }
        }
    }
}
