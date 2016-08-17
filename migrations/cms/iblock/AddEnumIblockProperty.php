<?php

/**
 * User: Rodion Abdurakhimov
 * Date: 25/7/2
 * Time: 16:54
 */
class AddIBlockProperty
{
    /**
     * Новые значения списка
     * @var array
     */
    public static $listPropertyValues = array(
        'OPTION_1' => 'Option 1',
        'OPTION_2' => 'Option 2',
        'OPTION_3' => 'Option 3',
    );
    public static $listPropertyName = 'List of options';
    public static $listPropertyCode = 'OPTIONS_LIST';
    public static $iBlockId = 1;

    public function up()
    {
        \Bitrix\Main\Loader::includeModule('iblock');
        $iBlock = CIBlock::GetList(array(), array('ID' => self::$iBlockId))->GetNext();
        if ($iBlock['ID']) {
            $ibp = new CIBlockProperty;
            $ibpEnum = new CIBlockPropertyEnum;
            $arFields = array(
                'NAME' => self::$listPropertyName,
                'ACTIVE' => 'Y',
                'SORT' => '100',
                'CODE' => self::$listPropertyCode,
                'PROPERTY_TYPE' => 'L',
                'FILTRABLE' => 'Y',
                'IBLOCK_ID' => $iBlock['ID']
            );
            $ibp->Add($arFields);
            $properties = CIBlockProperty::GetList(
                array(),
                array(
                    'IBLOCK_ID' => $iBlock['ID'],
                    'CODE' => self::$listPropertyCode
                )
            );
            if ($propFields = $properties->GetNext()) {
                foreach (self::$listPropertyValues as $listPropertyId => $listPropertyValue) {
                    $ibpEnum->Add(array(
                        'PROPERTY_ID' => $propFields['ID'],
                        'VALUE' => $listPropertyValue,
                        'XML_ID' => $listPropertyId,
                    ));
                }
            }
        }
    }
    public function down()
    {
        \Bitrix\Main\Loader::includeModule('iblock');
        $iBlock = CIBlock::GetList(array(), array('ID' => self::$iBlockId))->GetNext();
        if ($iBlock['ID']) {
            $properties = CIBlockProperty::GetList(
                array(),
                array('IBLOCK_ID' => $iBlock['ID'], 'CODE' => self::$listPropertyCode)
            );
            if ($propFields = $properties->GetNext()) {
                CIBlockProperty::Delete($propFields['ID']);
            }
        }
    }
}
