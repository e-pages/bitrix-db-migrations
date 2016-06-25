<?php

/**
 * User: Rodion Abdurakhimov
 * Date: 25/6/16
 * Time: 18:00
 */
class AddEnumIblockPropertyValues
{
    /**
     * Новые значения списка
     * @var array
     */
    public static $arNewBoatsTypeValues = [
        'Плоскодонные',
        'Килевые',
        'Под водомет'
    ];

    public function up()
    {
        $ibpenum = new CIBlockPropertyEnum;

        //Добавить новые значения в список свойства с кодом TIP_LODOK
        $properties = CIBlockProperty::GetList(
            [],
            [
                'IBLOCK_ID' => IBLOCK_ID,
                'CODE' => 'TIP_LODOK'
            ]
        );
        if ($prop_fields = $properties->GetNext()) {
            foreach (self::$arNewBoatsTypeValues as $arNewBoatsTypeValue) {
                $ibpenum->Add([
                    'PROPERTY_ID' => $prop_fields['ID'],
                    'VALUE' => $arNewBoatsTypeValue
                ]);
            }
        }
    }

    public function down()
    {
        //Удалить значения, созданные миграцией
        $property_enums = CIBlockPropertyEnum::GetList(
            [],
            [
                'IBLOCK_ID' => IBLOCK_ID,
                'CODE' => 'TIP_LODOK'
            ]
        );
        while ($enum_fields = $property_enums->GetNext()) {
            if (in_array($enum_fields['VALUE'], self::$arNewBoatsTypeValues)) {
                CIBlockPropertyEnum::Delete($enum_fields['ID']);
            }
        }
    }
}
