<?php

class AddIBlock
{
    private static $iBlockData = array(
        'NAME' => 'Баннеры каталога',
        'CODE' => 'CATALOG_BANNER',
        'TYPE' => 'banners',
    );

    public function up()
    {
        $cIBlock = new CIBlock();
        $dbIBlock = $cIBlock->GetList(
            array(),
            array('CODE' => static::$iBlockData['CODE'])
        );
        if ($dbIBlock->Fetch()) {
            return;
        }

        $iBlockId = $cIBlock->Add(array(
            'NAME' => static::$iBlockData['NAME'],
            'CODE' => static::$iBlockData['CODE'],
            'IBLOCK_TYPE_ID' => static::$iBlockData['TYPE'],
            'VERSION' => 2,
            'SITE_ID' => array('s1'),
            'GROUP_ID' => array('2' => 'R'),
        ));

        if (false === $iBlockId) {
            throw new Exception($cIBlock->LAST_ERROR);
        }

        $fields = CIBlock::GetFields($iBlockId);
        $fields['PREVIEW_PICTURE']['IS_REQUIRED'] = 'Y';
        $fields['DETAIL_PICTURE']['IS_REQUIRED'] = 'Y';
        CIBlock::SetFields($iBlockId, $fields);

        $ibp = new CIBlockProperty();
        $ibp->Add(array(
            'NAME' => 'Ссылка',
            'ACTIVE' => 'Y',
            'IS_REQUIRED' => 'Y',
            'SORT' => '100',
            'CODE' => 'URL',
            'PROPERTY_TYPE' => 'S',
            'FILTRABLE' => 'Y',
            'IBLOCK_ID' => $iBlockId,
        ));
    }

    public function down()
    {
        $dbIBlock = CIBlock::GetList(
            array(),
            array('CODE' => static::$iBlockData['CODE'])
        );
        if ($iBlock = $dbIBlock->Fetch()) {
            CIBlock::Delete($iBlock['ID']);
        }
    }
}
