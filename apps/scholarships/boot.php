<?php
$admin_scholarship_sub_menus = [
    [
        'name' => 'Add Scholarship',
        'link' => U.'scholarships/app/add/'
    ],
    [
        'name' => 'List Scholarships',
        'link' => U.'scholarships/app/list/'
    ]
];

add_menu_admin('Scholarships',U.'scholarships/app','scholarships','fal fa-file',2, $admin_scholarship_sub_menus);