<?php

/**
 * User: Rodion Abdurakhimov
 * Date: 25/6/16
 * Time: 17:52
 */
class SetOption
{
    public function up()
    {
        $arDefaultSettings = [
            'weight_in_mkad_less_15' => 250,
            'weight_in_mkad_less_50' => 500,
            'weight_in_mkad_less_100' => 600,
            'weight_in_mkad_less_300' => 700,
            'weight_in_mkad_less_1000' => 1000,
            'weight_in_mkad_less_1500' => 1500,
        ];

        foreach ($arDefaultSettings as $optionCode => $defaultSetting) {
            COption::SetOptionInt('sale', $optionCode, $defaultSetting);
        }
    }

    public function down()
    {
        $arDefaultSettings = [
            'weight_in_mkad_less_15' => 0,
            'weight_in_mkad_less_50' => 0,
            'weight_in_mkad_less_100' => 0,
            'weight_in_mkad_less_300' => 0,
            'weight_in_mkad_less_1000' => 0,
            'weight_in_mkad_less_1500' => 0,
        ];

        foreach ($arDefaultSettings as $optionCode => $defaultSetting) {
            COption::SetOptionInt('sale', $optionCode, $defaultSetting);
        }
    }
}
