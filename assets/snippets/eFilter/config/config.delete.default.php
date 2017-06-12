<?php
if(!defined('MODX_BASE_PATH')){die('What are you doing? Get out of here!');}

//общая форма фильтра
$tplDeleteFilterForm = '<div class="fltr_delete_wrap">
    [+wrapper+]
</div>';


//обертка для слайдеров и диапазонов
$tplSliderOwner = '<div class="fltr_delete_item_wrap fltr_delete_slider_wrap">[+wrapper+] <a href="[+delete_group+]" class="fltr_delete_item_link">Удалить все параметры групы [+name+]</a></div>';
//вывод ссылки для удаление фильтра диапазона или слайдера
$tplSliderInner = '<div class="fltr_delete_item">
от [+min+] до [+max+] <a href="[+link+]" class="fltr_delete_item_link">x</a>
</div>';


//обертка других фильтров
$tplDeleteFilterOwner = '<div class="fltr_delete_item_wrap">[+wrapper+] <a href="[+delete_group+]" class="fltr_delete_item_link">Удалить все параметры групы [+name+]</a></div>';
$tplDeleteFilterInner = '<div class="fltr_delete_item">
[+name+] <a href="[+link+]" class="fltr_delete_item_link">x</a>
</div>';