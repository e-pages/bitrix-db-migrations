<?php

use Bitrix\Main\GroupTable;

class AddUserGroups
{
    private static $groups = array(
        'DISCOUNT_FIRST' => 'Скидка первая',
        'DISCOUNT_SECOND' => 'Скидка вторая',
        'DISCOUNT_THIRD' => 'Скидка третья',
    );
    public function up()
    {
        foreach (static::$groups as $groupCode => $groupName) {
            GroupTable::add(array(
                'ACTIVE' => 'Y',
                'STRING_ID' => $groupCode,
                'NAME' => $groupName,
            ));
        }
    }

    public function down()
    {
        $filter = array('LOGIC' => 'OR');
        foreach (array_keys(static::$groups) as $groupCode) {
            $filter[] = array('STRING_ID' => $groupCode);
        }
        $dbGroups = GroupTable::getList(array(
            'select' => array('ID'),
            'filter' => $filter
        ));
        while ($group = $dbGroups->fetch()) {
            GroupTable::delete($group['ID']);
        }
    }
}
