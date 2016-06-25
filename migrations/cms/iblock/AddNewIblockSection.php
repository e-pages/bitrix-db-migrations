<?php

/**
 * User: Rodion Abdurakhimov
 * Date: 25/6/16
 * Time: 18:05
 */
class AddNewIblockSection
{
    public function up()
    {
        $bs = new CIBlockSection;
        $arFields = [
            "ACTIVE" => 'Y',
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID" => IBLOCK_ID,
            "NAME" => 'Новый раздел',
            'CODE' => 'new-section',
            "SORT" => 500
        ];

        $bs->Add($arFields);
    }

    public function down()
    {
        $arFilter = [
            'IBLOCK_ID' => IBLOCK_ID,
            'CODE' => 'new-section'
        ];

        $db_list = CIBlockSection::GetList([], $arFilter, false, ['ID']);
        if ($ar_result = $db_list->GetNext()) {
            CIBlockSection::Delete($ar_result['ID']);
        }
    }
}
