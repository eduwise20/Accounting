<?php

$admin_fee_rates_sub_menus = [
    [
        'name' => 'Add Fee Rate',
        'link' => U.'fee_rates/app/add/'
    ]
];

add_menu_admin('Fee Rates',U.'fee_rates/app','fee_rates','fal fa-file',2,$admin_fee_rates_sub_menus);