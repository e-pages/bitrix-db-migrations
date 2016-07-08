<?php

class AddSiteTemplateRule
{
    private $siteId = 's1';
    private $condition = 'substr($_SERVER[\'HTTP_HOST\'], 0, 8)===\'landing.\'';
    private $template = 'landing';
    private $sort = '1';
    public function up()
    {
        $siteId = $this->siteId;
        $rsTemplates = CSite::GetTemplateList($siteId);
        $siteTemplates = array();
        while($template = $rsTemplates->Fetch())
        {
            $siteTemplates[]  = $template;
        }

        $siteTemplates[] = array(
            'SITE_ID' => $siteId,
            'CONDITION' => $this->condition,
            'SORT' => $this->sort,
            'TEMPLATE' => $this->template,
        );

        $site = new CSite();
        $site->Update($siteId, array('TEMPLATE' => $siteTemplates));
    }

    public function down()
    {
        $siteId = $this->siteId;
        $rsTemplates = CSite::GetTemplateList($siteId);
        $siteTemplates = array();
        while($template = $rsTemplates->Fetch())
        {
            if ($this->condition === $template['CONDITION']
                && $this->template === $template['TEMPLATE']) {
                continue;
            }
            $siteTemplates[]  = $template;
        }

        $site = new CSite();
        $site->Update($siteId, array('TEMPLATE' => $siteTemplates));
    }
}
