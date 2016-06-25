<?php

/**
 * User: Rodion Abdurakhimov
 * Date: 25/6/16
 * Time: 17:50
 */
class AddAgent
{
    public function up()
    {
        CAgent::AddAgent(
            'AgentFunction',
            'main',
            'N',
            86400,
            '25.06.2016 00:00:00',
            'Y',
            '25.06.2016 00:00:00',
            30
        );
    }

    public function down()
    {
        $rsAgent = CAgent::GetList(
            [],
            ['NAME' => 'AgentFunction']
        );

        if ($arAgent = $rsAgent->Fetch()) {
            CAgent::Delete($arAgent['ID']);
        }
    }
}
