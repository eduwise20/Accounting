<?php

$admin_category_sub_menus = [
    [
        'name' => 'Add Category',
        'link' => U.'categories/main/add'
    ],
    [
        'name' => 'Add Subcategory',
        'link' => U.'categories/sub/add'
    ],
    [
        'name' => 'List Categories',
        'link' => U.'categories/main/list'
    ],
    [
        'name' => 'List Subcategories',
        'link' => U.'categories/sub/list'
    ]
];

add_menu_admin('Categories', U.'categories', 'categories', 'fal fa-file', 3, $admin_category_sub_menus); 