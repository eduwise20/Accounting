<?php
$admin_fine_sub_menus = [
    [
        'name' => 'Add Fine',
        'link' => U.'fines/app/add/'
    ],
    [
        'name' => 'List Fines',
        'link' => U.'fines/app/list/'
    ]
];

add_menu_admin('Fines',U.'fines/app','fines','fal fa-file',2, $admin_fine_sub_menus);