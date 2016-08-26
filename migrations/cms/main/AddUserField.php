<?php

/**
 * User: Rodion Abdurakhimov
 * Date: 25/6/16
 * Time: 17:42
 */
class AddUserField
{
    //IBLOCK_1_SECTION - раздел
    //HLBLOCK_1 - highload-блок
    //USER - пользователь
    private $arFields = array(
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
        'SETTINGS' => array(
            'DEFAULT_VALUE' => '',
            'SIZE' => '20',
            'ROWS' => '1',
            'MIN_LENGTH' => '0',
            'MAX_LENGTH' => '0',
            'REGEXP' => '',
        ),
        'EDIT_FORM_LABEL' => array(
            'ru' => 'UF_BONUS_STATUS',
            'en' => 'UF_BONUS_STATUS',
        ),
        'LIST_COLUMN_LABEL' => array(
            'ru' => 'UF_BONUS_STATUS',
            'en' => 'UF_BONUS_STATUS',
        ),
        'LIST_FILTER_LABEL' => array(
            'ru' => 'UF_BONUS_STATUS',
            'en' => 'UF_BONUS_STATUS',
        ),
        'ERROR_MESSAGE' => array(
            'ru' => '',
            'en' => '',
        ),
        'HELP_MESSAGE' => array(
            'ru' => 'UF_BONUS_STATUS',
            'en' => 'UF_BONUS_STATUS',
        ),
    );

    public function up()
    {
        $obUserField = new CUserTypeEntity;
        $obUserField->Add($this->arFields);
    }

    public function down()
    {
        $rsData = CUserTypeEntity::GetList(
            array($by => $order),
            array('FIELD_NAME' => $this->arFields['FIELD_NAME'])
        );
        if ($arRes = $rsData->Fetch()) {
            $obCUserTypeEntity = new CUserTypeEntity;
            $obCUserTypeEntity->Delete($arRes['ID']);
        }
    }
}
