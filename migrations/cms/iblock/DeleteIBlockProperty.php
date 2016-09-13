<?php

class DeleteIBlockProperty
{
    private $iBlockId = 1;
    private $properties = array(
        'PROP_1' => array(
            'NAME' => 'Property 1',
            'TYPE' => 'L',
        ),
        'PROP_2' => array(
            'NAME' => 'Property 2',
            'TYPE' => 'L',
        ),
    );

    public function up()
    {
        \Bitrix\Main\Loader::includeModule('iblock');
        $iBlock = CIBlock::GetList(array(), array('ID' => $this->iBlockId))->Fetch();
        if (false === $iBlock) {
            throw new \Exception('Can not find iBlock with id '.$this->iBlockId);
        }
        foreach (array_keys($this->properties) as $propertyCode) {
            $dbProperty = CIBlockProperty::GetList(
                array(),
                array(
                    'IBLOCK_ID' => $this->iBlockId,
                    'CODE' => $propertyCode
                )
            );
            if ($property = $dbProperty->Fetch()) {
                CIBlockProperty::Delete($property['ID']);
            }
        }
    }

    public function down()
    {
        \Bitrix\Main\Loader::includeModule('iblock');
        $ibp = new CIBlockProperty;
        $iBlock = CIBlock::GetList(array(), array('ID' => $this->iBlockId))->Fetch();
        if (false === $iBlock) {
            throw new \Exception('Can not find iBlock with id '.$this->iBlockId);
        }
        foreach ($this->properties as $propertyCode => $property) {
            $arFields = array(
                'NAME' => $property['NAME'],
                'ACTIVE' => 'Y',
                'SORT' => '100',
                'CODE' => $propertyCode,
                'PROPERTY_TYPE' => $property['TYPE'],
                'FILTRABLE' => 'Y',
                'IBLOCK_ID' => $this->iBlockId
            );
            $ibp->Add($arFields);
        }
    }
}