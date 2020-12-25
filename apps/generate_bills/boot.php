<?php

$admin_bills_sub_menus = [
    [
        'name' => 'Generate Bills',
        'link' => U.'generate_bills/app/generate_bills/'
    ]
];

add_menu_admin('Bills',U.'generate_bills/app','generate_bills','fal fa-file',2,$admin_bills_sub_menus);