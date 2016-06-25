<?php

/**
 * User: Rodion Abdurakhimov
 * Date: 25/6/16
 * Time: 17:42
 */
class AddUserField
{
    public function up()
    {
        //IBLOCK_1_SECTION - раздел
        //HLBLOCK_1 - highload-блок
        //USER - пользователь

        $arFields = [
            'ENTITY_ID' => 'HLBLOCK_1',
            'FIELD_NAME' => 'UF_BONUS_STATUS',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => '',
            'SORT' => '100',
            'MULTIPLE' => null,
            'MANDATORY' => null,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => null,
            'EDIT_IN_LIST' => null,
            'IS_SEARCHABLE' => null,
            'SETTINGS' => [
                'DEFAULT_VALUE' => '',
                'SIZE' => '20',
                'ROWS' => '1',
                'MIN_LENGTH' => '0',
                'MAX_LENGTH' => '0',
                'REGEXP' => '',
            ],
            'EDIT_FORM_LABEL' => [
                'ru' => 'UF_BONUS_STATUS',
                'en' => 'UF_BONUS_STATUS',
            ],
            'LIST_COLUMN_LABEL' => [
                'ru' => 'UF_BONUS_STATUS',
                'en' => 'UF_BONUS_STATUS',
            ],
            'LIST_FILTER_LABEL' => [
                'ru' => 'UF_BONUS_STATUS',
                'en' => 'UF_BONUS_STATUS',
            ],
            'ERROR_MESSAGE' => [
                'ru' => '',
                'en' => '',
            ],
            'HELP_MESSAGE' => [
                'ru' => 'UF_BONUS_STATUS',
                'en' => 'UF_BONUS_STATUS',
            ],
        ];

        $obUserField = new CUserTypeEntity;
        $obUserField->Add($arFields);
    }

    public function down()
    {
        $rsData = CUserTypeEntity::GetList(
            [$by => $order],
            ['FIELD_NAME' => 'UF_BONUS_STATUS']
        );
        if ($arRes = $rsData->Fetch()) {
            $obCUserTypeEntity = new CUserTypeEntity;
            $obCUserTypeEntity->Delete($arRes['ID']);
        }
    }
}
