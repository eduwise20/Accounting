<?php

$admin_student_type_sub_menus = [
    [
        'name' => 'Add Student Type',
        'link' => U.'student_types/app/add/'
    ],
    [
        'name' => 'List Student Types',
        'link' => U.'student_types/app/list/'
    ]
];

add_menu_admin('Student Types',U.'student_types/app','student_types','fal fa-user-graduate',2,$admin_student_type_sub_menus);