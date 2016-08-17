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
    private $textProperties = array(
        'PROPERTY_CODE' => 'Property name',
    );
    private $iBlockId = 1;

    public function up()
    {
        \Bitrix\Main\Loader::includeModule('iblock');
        $iBlock = CIBlock::GetList(array(), array('ID' => self::$iBlockId))->GetNext();

        if ($iBlock['ID']) {
            $ibp = new CIBlockProperty;

            foreach ($this->textProperties as $propCode => $property) {
                $arFields = array(
                    'NAME' => $property,
                    'ACTIVE' => 'Y',
                    'SORT' => '100',
                    'CODE' => $propCode,
                    'PROPERTY_TYPE' => 'S',
                    'FILTRABLE' => 'Y',
                    'IBLOCK_ID' => $iBlock['ID']
                );

                $ibp->Add($arFields);
            }
        }
    }

    public function down()
    {
        \Bitrix\Main\Loader::includeModule('iblock');
        $iBlock = CIBlock::GetList(array(), array('ID' => self::$iBlockId))->GetNext();

        if ($iBlock['ID']) {
            foreach (array_keys($this->textProperties) as $propCode) {
                $properties = CIBlockProperty::GetList(
                    array(),
                    array('IBLOCK_ID' => $iBlock['ID'], 'CODE' => $propCode)
                );
                if ($propFields = $properties->GetNext()) {
                    CIBlockProperty::Delete($propFields['ID']);
                }
            }
        }
    }
}
