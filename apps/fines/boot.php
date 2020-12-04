<?php

$svg = '<svg id="Capa_1" enable-background="new 0 0 507.333 507.333" height="24" viewBox="0 0 507.333 507.333" width="24" xmlns="http://www.w3.org/2000/svg">
<g><path id="XMLID_1114_" d="m77.309 225.131c0 6.77 4.905 12.405 11.345 13.567v-27.133c-6.44 1.162-11.345 6.797-11.345 13.566z" fill="#2196f3"/>
<path id="XMLID_1115_" d="m130 284.203v-1.477c0-6.77-4.905-12.405-11.346-13.566v28.61c6.441-1.162 11.346-6.797 11.346-13.567z" fill="#2196f3"/>
<path id="XMLID_1118_" d="m0 115v277.333h507.333v-277.333zm47.309 110.132c0-23.327 18.332-42.448 41.345-43.725v-19.407h30v19.333h41.346v30h-41.346v27.668c23.014 1.277 41.346 20.399 41.346 43.726v1.477c0 23.327-18.332 42.449-41.346 43.725v18.071h-30v-18h-41.345v-30h41.345v-29.144c-23.013-1.276-41.345-20.398-41.345-43.724zm386.024 10.535v30h-236.667v-30zm-236.667-28.333v-30h130.667v30zm236.667 86.666v30h-236.667v-30z" fill="#2196f3"/>
</g></svg>';

$admin_fine_sub_menus = [
    [
        'name' => 'Add Fine',
        'link' => U.'fines/app/add/'
    ],
    [
        'name' => 'List Fines',
        'link' => U.'fines/app/list/'
    ],
    [
        'name' => 'Assign Fine to Student',
        'link' => U.'fines/app_assign_fine/add/'
    ]
];

add_menu_admin_svg('Fines',U.'fines/app','fines',$svg,2, $admin_fine_sub_menus);