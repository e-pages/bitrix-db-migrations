<?php

/**
 * User: Rodion Abdurakhimov
 * Date: 25/6/16
 * Time: 18:05.
 */
class AddNewIBlockSection
{
    private $iBlockId = 1;
    private $sectionCode = 'new-section';
    private $sectionName = 'Новый раздел';

    public function up()
    {
        $bs = new CIBlockSection();
        $arFields = array(
            'ACTIVE' => 'Y',
            'IBLOCK_SECTION_ID' => false,
            'IBLOCK_ID' => $this->iBlockId,
            'NAME' => $this->sectionName,
            'CODE' => $this->sectionCode,
            'SORT' => 500,
        );

        $bs->Add($arFields);
    }

    public function down()
    {
        $arFilter = array(
            'IBLOCK_ID' => $this->iBlockId,
            'CODE' => $this->sectionCode,
        );

        $db_list = CIBlockSection::GetList(array(), $arFilter, false, array('ID'));
        if ($ar_result = $db_list->GetNext()) {
            CIBlockSection::Delete($ar_result['ID']);
        }
    }
}
