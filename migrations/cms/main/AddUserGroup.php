<?php

/**
 * User: Rodion Abdurakhimov
 * Date: 25/6/16
 * Time: 17:48
 */
class AddUserGroup
{
    public function up()
    {
        $groupFields = [
            'ACTIVE' => 'Y',
            'C_SORT' => '100',
            'NAME' => 'Скидка по купону',
            'DESCRIPTION' => 'Группа для пользователей, которые зарегистрировались по купону',
            'STRING_ID' => 'discount-coupons',
            'SECURITY_POLICY' => 'a:0:{}',
        ];

        $group = new CGroup;
        $group->Add($groupFields);
    }

    public function down()
    {
        $group = new CGroup();
        $rsGroups = $group->GetList($by = "c_sort", $order = "asc", ["STRING_ID" => 'discount-coupons']);
        $groupData = $rsGroups->Fetch();

        if (count($groupData) > 0) {
            $group->Delete($groupData['ID']);
        }
    }
}
