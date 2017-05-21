<?php
if(!defined('MODX_BASE_PATH')){die('What are you doing? Get out of here!');}

//общая форма фильтра
$tplDeleteFilterForm = '<div class="fltr_delete_wrap">
    [+wrapper+]
</div>';


//обертка для слайдеров и диапазонов
$tplSliderOwner = '<div class="fltr_delete_item_wrap fltr_delete_slider_wrap">[+wrapper+]</div>';
//вывод ссылки для удаление фильтра диапазона или слайдера
$tplSliderInner = '<div class="fltr_delete_item">
от [+min+] до [+max+] <a href="[+link+]" class="fltr_delete_item_link">x</a>
</div>';


//обертка других фильтров
$tplDeleteFilterOwner = '<div class="fltr_delete_item_wrap">[+wrapper+]</div>';
$tplDeleteFilterInner = '<div class="fltr_delete_item">
[+value+] <a href="[+link+]" class="fltr_delete_item_link">x</a>
</div>';