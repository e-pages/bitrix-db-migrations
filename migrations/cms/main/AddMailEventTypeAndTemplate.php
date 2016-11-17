<?php

use Exception;

class AddMailEventTypeAndTemplate
{
    private static $messageText = <<<'EOT'
Вы подписаны на новости сайта #SITE_NAME#

За подписку вы получаете постоянную скидку #DISCOUNT#. Для увеличения размера скидки делайте покупки в нашем магазине.
Номер скидочной карты #DISCOUNT_CARD_NUMBER#

Спасибо за вашу поддержку.

Ваша регистрационная информация:

Login: #LOGIN#

Вы можете изменить пароль, перейдя по следующей ссылке:
http://#SERVER_NAME#/auth/index.php?change_password=yes&lang=ru&USER_CHECKWORD=#CHECKWORD#&USER_LOGIN=#URL_LOGIN#

Сообщение сгенерировано автоматически.
Отписаться от рассылки можно в личном кабинете на сайте http://#SERVER_NAME#/personal/subscribe/ .
EOT;

    private static $eventData = array(
        'EVENT_NAME' => 'PE_DISCOUNT_SUBSCRIPTION',
        'EVENT_TITLE' => 'Подписка со скидкой',
        'EVENT_DESCRIPTION' => "#LOGIN#\n#URL_LOGIN#\n#CHECKWORD#\n#EMAIL#\n#DISCOUNT#\n#DISCOUNT_CARD_NUMBER#\n",
        'MESSAGE_TITLE' => 'Вы подписаны на новости сайта #SITE_NAME#',
    );

    public function up()
    {
        $connection = \Bitrix\Main\Application::getConnection();
        $connection->startTransaction();
        CEventType::Add(array(
            'EVENT_NAME' => static::$eventData['EVENT_NAME'],
            'NAME' => static::$eventData['EVENT_TITLE'],
            'LID' => 'ru',
            'DESCRIPTION' => static::$eventData['EVENT_DESCRIPTION'],
        ));

        $cEventMessage = new CEventMessage();
        $addResult = $cEventMessage->Add(
            array(
                'ACTIVE' => 'Y',
                'EVENT_NAME' => static::$eventData['EVENT_NAME'],
                'LID' => array('s1'),
                'EMAIL_FROM' => '#DEFAULT_EMAIL_FROM#',
                'EMAIL_TO' => '#EMAIL#',
                'BCC' => '',
                'SUBJECT' => static::$eventData['MESSAGE_TITLE'],
                'BODY_TYPE' => 'text',
                'MESSAGE' => static::$messageText,
            )
        );
        if (false === $addResult) {
            $connection->rollbackTransaction();
            throw new Exception('Failed to add EventMessage: '.$cEventMessage->LAST_ERROR);
        }
        $connection->commitTransaction();
    }

    public function down()
    {
        $connection = \Bitrix\Main\Application::getConnection();
        $connection->startTransaction();
        CEventType::Delete(static::$eventData['EVENT_NAME']);

        $dbEventMessages = \Bitrix\Main\Mail\Internal\EventMessageTable::getList(array(
            'filter' => array('EVENT_NAME' => static::$eventData['EVENT_NAME']),
            'select' => array('ID'),
        ));
        while ($eventMessage = $dbEventMessages->fetch()) {
            if (!CEventMessage::Delete(intval($eventMessage['ID']))) {
                $connection->rollbackTransaction();
                throw new Exception('Failed to delete EventMessage');
            }
        }
        $connection->commitTransaction();
    }
}
