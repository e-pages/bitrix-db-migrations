<?php

/**
 * User: Rodion Abdurakhimov
 * Date: 25/6/16
 * Time: 18:18
 */
class RawSql
{
    public function up()
    {
        global $DB;
        $DB->query('INSERT ep_discount_coupons (coupon, used) VALUES ("HR0PDK15", "N")');
    }

    public function down()
    {
        global $DB;
        $DB->query('TRUNCATE TABLE ep_discount_coupons');
    }
}
