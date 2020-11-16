<?php

$admin_section_sub_menus = [
    [
        'name' => 'Add Section',
        'link' => U.'sections/app/add/'
    ],
    [
        'name' => 'List Sections',
        'link' => U.'sections/app/list/'
    ]
];

add_menu_admin('Sections',U.'sections/app','sections','fal fa-file',2,$admin_section_sub_menus);