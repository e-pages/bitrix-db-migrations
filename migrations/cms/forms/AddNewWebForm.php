<?php

/**
 * User: Rodion Abdurakhimov
 * Date: 25/6/16
 * Time: 18:12
 */
class AddNewWebForm
{
    private static $formId = 'awesome_form';
    private static $formName = 'Awesome form';
    private static $formButton = 'Fill';
    private static $sites = array(
        's1',
    );

    public function up()
    {
        \Bitrix\Main\Loader::includeModule('form');
        $form = new CForm();
        $formField = new CFormField();
        $formStatus = new CFormStatus();

        //Добавить саму сущность формы
        $arFormFields = array(
            'NAME' => self::$formName,
            'SID' => self::$formId,
            'C_SORT' => '300',
            'BUTTON' => self::$formButton,
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
            'arRESTRICT_STATUS' => array(),
            'STAT_EVENT1' => 'form',
            'STAT_EVENT2' => self::$formId,
            'STAT_EVENT3' => '',
            'arIMAGE' => array(
                'name' => '',
                'type' => '',
                'tmp_name' => '',
                'error' => 4,
                'size' => 0,
                'MODULE_ID' => 'form',
                'del' => null,
            ),
            'arSITE' => self::$sites,
            'arMAIL_TEMPLATE' => null,
            'FORM_TEMPLATE' => '',
            'USE_DEFAULT_TEMPLATE' => 'Y',
            'arMENU' => array(
                'ru' => self::$formName,
                'en' => self::$formName,
            ),
            'arGROUP' => array(),
        );

        $res = intval($form->Set($arFormFields, 0, 'N'));

        //Если форма добавлена - добавить ей поля
        if ($res) {
            //Текстовое поле
            $fioField = array(
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
                'arIMAGE' => array(
                    'name' => '',
                    'type' => '',
                    'tmp_name' => '',
                    'error' => 4,
                    'size' => 0,
                    'MODULE_ID' => 'form',
                    'del' => null,
                ),
                'arANSWER' => array(
                    0 => array(
                        'ID' => '0',
                        'DELETE' => null,
                        'MESSAGE' => 'ФИО',
                        'VALUE' => '',
                        'C_SORT' => '100',
                        'ACTIVE' => 'Y',
                        'FIELD_TYPE' => 'text',
                        'FIELD_WIDTH' => '',
                        'FIELD_HEIGHT' => null,
                        'FIELD_PARAM' => 'class="'.self::$formId.'_fio"',
                    ),
                ),
                'arFILTER_USER' => null,
                'arFILTER_ANSWER_TEXT' => null,
                'arFILTER_ANSWER_VALUE' => null,
            );
            $formField->Set($fioField, 0, 'N');

            //Радио кнопки
            $productTypeField = array(
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
                'arIMAGE' => array(
                    'name' => '',
                    'type' => '',
                    'tmp_name' => '',
                    'error' => 4,
                    'size' => 0,
                    'MODULE_ID' => 'form',
                    'del' => null,
                ),
                'arANSWER' => array(
                    0 => array(
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
                    ),
                    1 => array(
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
                    ),
                    2 => array(
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
                    ),
                ),
                'arFILTER_USER' => null,
                'arFILTER_ANSWER_TEXT' => null,
                'arFILTER_ANSWER_VALUE' => null,
            );
            $formField->Set($productTypeField, 0, 'N');

            //Textarea
            $reasonField = array(
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
                'arIMAGE' => array(
                    'name' => '',
                    'type' => '',
                    'tmp_name' => '',
                    'error' => 4,
                    'size' => 0,
                    'MODULE_ID' => 'form',
                    'del' => null,
                ),
                'arANSWER' => array(
                    0 => array(
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
                    ),
                ),
                'arFILTER_USER' => null,
                'arFILTER_ANSWER_TEXT' => null,
                'arFILTER_ANSWER_VALUE' => null,
            );
            $formField->Set($reasonField, 0, 'N');

            //Файл
            $infoFileField = array(
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
                'arIMAGE' => array(
                    'name' => '',
                    'type' => '',
                    'tmp_name' => '',
                    'error' => 4,
                    'size' => 0,
                    'MODULE_ID' => 'form',
                    'del' => null,
                ),
                'arANSWER' => array(
                    0 => array(
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
                    ),
                ),
                'arFILTER_USER' => null,
                'arFILTER_ANSWER_TEXT' => null,
                'arFILTER_ANSWER_VALUE' => null,
            );
            $formField->Set($infoFileField, 0, 'N');

            //добавить новый статус результата формы
            $resultStatus = array(
                'FORM_ID' => $res,
                'C_SORT' => '100',
                'ACTIVE' => 'Y',
                'TITLE' => 'Новый',
                'DESCRIPTION' => '',
                'CSS' => 'statusgreen',
                'HANDLER_OUT' => '',
                'HANDLER_IN' => '',
                'DEFAULT_VALUE' => 'Y',
                'arPERMISSION_VIEW' => array(
                    0 => '0',
                ),
                'arPERMISSION_MOVE' => array(
                    0 => '0',
                ),
                'arPERMISSION_EDIT' => null,
                'arPERMISSION_DELETE' => null,
                'arMAIL_TEMPLATE' => null,
            );
            $formStatus->Set($resultStatus, 0, 'N');
            $arTemplates = $form->SetMailTemplate($res, 'Y', self::$formId);
            $form->Set(array('arMAIL_TEMPLATE' => $arTemplates), $res);
        }
    }

    public function down()
    {
        \Bitrix\Main\Loader::includeModule('form');
        $form = new CForm();

        $by = 'ID';
        $order = 'ASC';
        $formRes = $form->GetList($by, $order, array('SID' => self::$formId));
        if ($arForm = $formRes->Fetch()) {
            $form->Delete($arForm['ID'], 'N');
        }
    }
}
