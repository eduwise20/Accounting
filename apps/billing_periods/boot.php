<?php

$admin_billing_period_sub_menus = [
    [
        'name' => 'Add Billing Period',
        'link' => U.'billing_periods/app/add'
    ],
    [
        'name' => 'List Billing Period',
        'link' => U.'billing_periods/app/list'
    ]
];

add_menu_admin('Billing Period', U.'billing_periods', 'billing_periods', 'fal fa-calendar-alt', 1, $admin_billing_period_sub_menus); 