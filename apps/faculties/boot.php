<?php

$admin_faculty_sub_menus = [
    [
        'name' => 'Add Faculty',
        'link' => U.'faculties/app/add/'
    ],
    [
        'name' => 'List Faculties',
        'link' => U.'faculties/app/list/'
    ]
];

add_menu_admin('Faculties',U.'faculties/app','faculties','fal fa-file',2,$admin_faculty_sub_menus);