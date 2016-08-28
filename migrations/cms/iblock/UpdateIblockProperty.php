<?php

/**
 * User: Rodion Abdurakhimov
 * Date: 25/6/16
 * Time: 17:58
 */
class UpdateIblockProperty
{
    private $iBlockId = 1;
    private $code = 'MANUFACTURER';

    public function up()
    {
        $properties = CIBlockProperty::GetList(
            array(),
            array(
                'IBLOCK_ID' => $this->iBlockId,
                'CODE' => $this->code,
            )
        );
        if ($prop_fields = $properties->GetNext()) {
            $arFields = array(
                'SORT' => 5000,
            );
            $ibp = new CIBlockProperty;
            $ibp->Update($prop_fields['ID'], $arFields);
        }
    }

    public function down()
    {
        $properties = CIBlockProperty::GetList(
            array(),
            array(
                'IBLOCK_ID' => $this->iBlockId,
                'CODE' => $this->code,
            )
        );
        if ($prop_fields = $properties->GetNext()) {
            $arFields = array(
                'SORT' => 500, // значение сортировки до миграции
            );
            $ibp = new CIBlockProperty;
            $ibp->Update($prop_fields['ID'], $arFields);
        }
    }
}
