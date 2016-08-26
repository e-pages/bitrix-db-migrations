<?php

/**
 * User: Rodion Abdurakhimov
 * Date: 25/6/16
 * Time: 18:20
 */
class AddNewDealStages
{
    protected static $arNewStatuses = array(
        'Новая стадия 1',
        'Новая стадия 2',
        'Новая стадия 3',
    );

    public function up()
    {
        Bitrix\Main\Loader::includeModule('crm');

        $arLastStatus = Bitrix\Crm\StatusTable::getList(array(
            'order' => array(
                'SORT' => 'DESC'
            ),
            'filter' => array(
                'ENTITY_ID' => 'DEAL_STAGE'
            )
        ))->fetchAll();

        $maxSort = 0;
        $maxStatusId = 0;
        foreach ($arLastStatus as $lastStatus) {
            if (is_numeric($lastStatus['STATUS_ID']) && $maxStatusId < $lastStatus['STATUS_ID']) {
                $maxStatusId = $lastStatus['STATUS_ID'];
            }
            if ($maxSort < $lastStatus['SORT']) {
                $maxSort = $lastStatus['SORT'];
            }
        }
        foreach (self::$arNewStatuses as $newStatus) {
            $maxSort += 10;
            $maxStatusId++;

            Bitrix\Crm\StatusTable::add(array(
                'ENTITY_ID' => 'DEAL_STAGE',
                'NAME' => $newStatus,
                'STATUS_ID' => (string)$maxStatusId,
                'SORT' => $maxSort
            ));
        }
    }

    public function down()
    {
        Bitrix\Main\Loader::includeModule('crm');

        $statuses = Bitrix\Crm\StatusTable::getList(array(
            'filter' => array(
                'NAME' => self::$arNewStatuses
            )
        ))->fetchAll();

        global $DB;

        foreach ($statuses as $status) {
            $DB->query('DELETE FROM b_crm_status WHERE NAME = "' . $status['NAME']
                . '" AND STATUS_ID = "' . $status['STATUS_ID'] . '"');
        }
    }
}
