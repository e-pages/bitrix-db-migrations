<?php

/**
 * User: Rodion Abdurakhimov
 * Date: 25/6/16
 * Time: 17:54
 */
class AddIblockProperty
{
    /**
     * Массив свойств одного типа, которые нужно создать
     * @var array
     */
    protected $propertiesText = [
        'PRODUCT_TYPE' => 'Тип товара',
    ];

    public function up()
    {
        $iblock = CIBlock::GetList([], ['ID' => IBLOCK_ID])->GetNext();

        if ($iblock['ID']) {
            $ibp = new CIBlockProperty;

            foreach ($this->propertiesText as $propCode => $property) {
                $arFields = [
                    'NAME' => $property,
                    'ACTIVE' => 'Y',
                    'SORT' => '100',
                    'CODE' => $propCode,
                    'PROPERTY_TYPE' => 'S',
                    'FILTRABLE' => 'Y',
                    'IBLOCK_ID' => $iblock['ID']
                ];

                $ibp->Add($arFields);
            }
        }
    }

    public function down()
    {
        $iblock = CIBlock::GetList([], ['ID' => IBLOCK_ID])->GetNext();

        if ($iblock['ID']) {
            foreach (array_keys($this->propertiesText) as $propCode) {
                $properties = CIBlockProperty::GetList(
                    ['sort' => 'asc', 'name' => 'asc'],
                    ['IBLOCK_ID' => $iblock['ID'], 'CODE' => $propCode]
                );
                if ($prop_fields = $properties->GetNext()) {
                    CIBlockProperty::Delete($prop_fields['ID']);
                }
            }
        }
    }
}
