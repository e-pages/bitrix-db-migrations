<?php

/**
 * User: Rodion Abdurakhimov
 * Date: 25/6/16
 * Time: 18:00.
 */
class AddEnumIblockPropertyValues
{
    /**
     * Новые значения списка.
     *
     * @var array
     */
    public static $arNewBoatsTypeValues = array(
        'Плоскодонные',
        'Килевые',
        'Под водомет',
    );

    private $iBlockId = IBLOCK_ID;
    private $code = 'TIP_LODOK';

    public function up()
    {
        $ibpenum = new CIBlockPropertyEnum();

        //Добавить новые значения в список свойства с кодом TIP_LODOK
        $properties = CIBlockProperty::GetList(
            array(),
            array(
                'IBLOCK_ID' => $this->iBlockId,
                'CODE' => $this->code,
            )
        );
        if ($prop_fields = $properties->GetNext()) {
            foreach (self::$arNewBoatsTypeValues as $arNewBoatsTypeValue) {
                $ibpenum->Add(array(
                    'PROPERTY_ID' => $prop_fields['ID'],
                    'VALUE' => $arNewBoatsTypeValue,
                ));
            }
        }
    }

    public function down()
    {
        //Удалить значения, созданные миграцией
        $property_enums = CIBlockPropertyEnum::GetList(
            array(),
            array(
                'IBLOCK_ID' => $this->iBlockId,
                'CODE' => $this->code,
            )
        );
        while ($enum_fields = $property_enums->GetNext()) {
            if (in_array($enum_fields['VALUE'], self::$arNewBoatsTypeValues)) {
                CIBlockPropertyEnum::Delete($enum_fields['ID']);
            }
        }
    }
}
