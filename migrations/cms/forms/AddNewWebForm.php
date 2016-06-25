<?php

/**
 * User: Rodion Abdurakhimov
 * Date: 25/6/16
 * Time: 18:12
 */
class AddNewWebForm
{
    public function up()
    {
        \Bitrix\Main\Loader::includeModule('form');

        //Добавить саму сущность формы
        $arFormFields = [
            'NAME' => 'Заявка на сервис',
            'SID' => 'service_form',
            'C_SORT' => '300',
            'BUTTON' => 'Оформить онлайн заявку',
            'USE_CAPTCHA' => 'N',
            'DESCRIPTION' => '',
            'DESCRIPTION_TYPE' => 'text',
            'SHOW_TEMPLATE' => null,
            'SHOW_RESULT_TEMPLATE' => null,
            'PRINT_RESULT_TEMPLATE' => null,
            'EDIT_RESULT_TEMPLATE' => null,
            'FILTER_RESULT_TEMPLATE' => '',
            'TABLE_RESULT_TEMPLATE' => '',
            'USE_RESTRICTIONS' => 'N',
            'RESTRICT_USER' => 0,
            'RESTRICT_TIME' => 0,
            'arRESTRICT_STATUS' => [],
            'STAT_EVENT1' => 'form',
            'STAT_EVENT2' => 'service_form',
            'STAT_EVENT3' => '',
            'arIMAGE' => [
                'name' => '',
                'type' => '',
                'tmp_name' => '',
                'error' => 4,
                'size' => 0,
                'MODULE_ID' => 'form',
                'del' => null,
            ],
            'arSITE' => [
                0 => 's1',
            ],
            'arMAIL_TEMPLATE' => null,
            'FORM_TEMPLATE' => '',
            'USE_DEFAULT_TEMPLATE' => 'Y',
            'arMENU' => [
                'ru' => 'Заявка на сервис',
                'en' => 'Service form',
            ],
            'arGROUP' => [
                2 => '0',
                5 => '0',
                3 => '0',
                4 => '0',
                8 => '0',
                17 => '0',
                21 => '0',
                11 => '0',
                12 => '0',
                6 => '0',
                7 => '0',
            ],
        ];

        $res = intval(CForm::Set($arFormFields, 0, 'N'));

        //Если форма добавлена - добавить ей поля
        if ($res) {
            //Текстовое поле
            $fioField = [
                'FORM_ID' => $res,
                'ACTIVE' => 'Y',
                'TITLE' => 'ФИО',
                'TITLE_TYPE' => 'text',
                'SID' => 'fio',
                'C_SORT' => '200',
                'ADDITIONAL' => 'N',
                'REQUIRED' => 'Y',
                'IN_RESULTS_TABLE' => 'Y',
                'IN_EXCEL_TABLE' => 'Y',
                'FIELD_TYPE' => null,
                'COMMENTS' => '',
                'FILTER_TITLE' => '',
                'RESULTS_TABLE_TITLE' => '',
                'arIMAGE' => [
                    'name' => '',
                    'type' => '',
                    'tmp_name' => '',
                    'error' => 4,
                    'size' => 0,
                    'MODULE_ID' => 'form',
                    'del' => null,
                ],
                'arANSWER' => [
                    0 => [
                        'ID' => '0',
                        'DELETE' => null,
                        'MESSAGE' => 'ФИО',
                        'VALUE' => '',
                        'C_SORT' => '100',
                        'ACTIVE' => 'Y',
                        'FIELD_TYPE' => 'text',
                        'FIELD_WIDTH' => '',
                        'FIELD_HEIGHT' => null,
                        'FIELD_PARAM' => 'Иванов Иван Иванович',
                    ],
                ],
                'arFILTER_USER' => null,
                'arFILTER_ANSWER_TEXT' => null,
                'arFILTER_ANSWER_VALUE' => null,
            ];
            CFormField::Set($fioField, 0, 'N');

            //Радио кнопки
            $productTypeField = [
                'FORM_ID' => $res,
                'ACTIVE' => 'Y',
                'TITLE' => 'Тип товара',
                'TITLE_TYPE' => 'text',
                'SID' => 'product_type',
                'C_SORT' => '100',
                'ADDITIONAL' => 'N',
                'REQUIRED' => 'Y',
                'IN_RESULTS_TABLE' => 'Y',
                'IN_EXCEL_TABLE' => 'Y',
                'FIELD_TYPE' => null,
                'COMMENTS' => '',
                'FILTER_TITLE' => '',
                'RESULTS_TABLE_TITLE' => '',
                'arIMAGE' => [
                    'name' => '',
                    'type' => '',
                    'tmp_name' => '',
                    'error' => 4,
                    'size' => 0,
                    'MODULE_ID' => 'form',
                    'del' => null,
                ],
                'arANSWER' => [
                    0 => [
                        'ID' => '0',
                        'DELETE' => null,
                        'MESSAGE' => 'лодка',
                        'VALUE' => 'boat',
                        'C_SORT' => '100',
                        'ACTIVE' => 'Y',
                        'FIELD_TYPE' => 'radio',
                        'FIELD_WIDTH' => null,
                        'FIELD_HEIGHT' => null,
                        'FIELD_PARAM' => '',
                    ],
                    1 => [
                        'ID' => '0',
                        'DELETE' => null,
                        'MESSAGE' => 'мотор',
                        'VALUE' => 'engine',
                        'C_SORT' => '200',
                        'ACTIVE' => 'Y',
                        'FIELD_TYPE' => 'radio',
                        'FIELD_WIDTH' => null,
                        'FIELD_HEIGHT' => null,
                        'FIELD_PARAM' => '',
                    ],
                    2 => [
                        'ID' => '0',
                        'DELETE' => null,
                        'MESSAGE' => 'аксессуар',
                        'VALUE' => 'accessory',
                        'C_SORT' => '300',
                        'ACTIVE' => 'Y',
                        'FIELD_TYPE' => 'radio',
                        'FIELD_WIDTH' => null,
                        'FIELD_HEIGHT' => null,
                        'FIELD_PARAM' => '',
                    ],
                ],
                'arFILTER_USER' => null,
                'arFILTER_ANSWER_TEXT' => null,
                'arFILTER_ANSWER_VALUE' => null,
            ];
            CFormField::Set($productTypeField, 0, 'N');

            //Textarea
            $reasonField = [
                'FORM_ID' => $res,
                'ACTIVE' => 'Y',
                'TITLE' => 'Причина обращения',
                'TITLE_TYPE' => 'text',
                'SID' => 'reason',
                'C_SORT' => '200',
                'ADDITIONAL' => 'N',
                'REQUIRED' => 'Y',
                'IN_RESULTS_TABLE' => 'Y',
                'IN_EXCEL_TABLE' => 'Y',
                'FIELD_TYPE' => null,
                'COMMENTS' => '',
                'FILTER_TITLE' => '',
                'RESULTS_TABLE_TITLE' => '',
                'arIMAGE' => [
                    'name' => '',
                    'type' => '',
                    'tmp_name' => '',
                    'error' => 4,
                    'size' => 0,
                    'MODULE_ID' => 'form',
                    'del' => null,
                ],
                'arANSWER' => [
                    0 => [
                        'ID' => '0',
                        'DELETE' => null,
                        'MESSAGE' => 'Причина обращения',
                        'VALUE' => '',
                        'C_SORT' => '100',
                        'ACTIVE' => 'Y',
                        'FIELD_TYPE' => 'textarea',
                        'FIELD_WIDTH' => '',
                        'FIELD_HEIGHT' => null,
                        'FIELD_PARAM' => '',
                    ],
                ],
                'arFILTER_USER' => null,
                'arFILTER_ANSWER_TEXT' => null,
                'arFILTER_ANSWER_VALUE' => null,
            ];
            CFormField::Set($reasonField, 0, 'N');

            //Файл
            $infoFileField = [
                'FORM_ID' => $res,
                'ACTIVE' => 'Y',
                'TITLE' => 'Информация о продукции',
                'TITLE_TYPE' => 'text',
                'SID' => 'info',
                'C_SORT' => '300',
                'ADDITIONAL' => 'N',
                'REQUIRED' => null,
                'IN_RESULTS_TABLE' => 'Y',
                'IN_EXCEL_TABLE' => 'Y',
                'FIELD_TYPE' => null,
                'COMMENTS' => '',
                'FILTER_TITLE' => '',
                'RESULTS_TABLE_TITLE' => '',
                'arIMAGE' => [
                    'name' => '',
                    'type' => '',
                    'tmp_name' => '',
                    'error' => 4,
                    'size' => 0,
                    'MODULE_ID' => 'form',
                    'del' => null,
                ],
                'arANSWER' => [
                    0 => [
                        'ID' => '0',
                        'DELETE' => null,
                        'MESSAGE' => 'Информация о продукции',
                        'VALUE' => '',
                        'C_SORT' => '100',
                        'ACTIVE' => 'Y',
                        'FIELD_TYPE' => 'file',
                        'FIELD_WIDTH' => null,
                        'FIELD_HEIGHT' => null,
                        'FIELD_PARAM' => '',
                    ],
                ],
                'arFILTER_USER' => null,
                'arFILTER_ANSWER_TEXT' => null,
                'arFILTER_ANSWER_VALUE' => null,
            ];
            CFormField::Set($infoFileField, 0, 'N');
        }
    }

    public function down()
    {
        \Bitrix\Main\Loader::includeModule('form');

        $by = 'ID';
        $order = 'ASC';
        $formRes = CForm::GetList($by, $order, ['SID' => 'service_form']);
        if ($arForm = $formRes->Fetch()) {
            CForm::Delete($arForm['ID'], 'N');
        }
    }
}
