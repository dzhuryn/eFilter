<?php
if(!defined('MODX_BASE_PATH')){die('What are you doing? Get out of here!');}

//общая форма фильтра
$tplFilterForm = '<form id="eFiltr" class="eFiltr eFiltr_form" action="[+url+]" method="get">[+wrapper+]</form>';

//кнопка "сброса" фильтра
$tplFilterReset = '<div class="eFiltr_reset"><a href="[+reset_url+]">Сбросить фильтр</a></div>';

//название категории фильтра
$filterCatName = '<div class="fltr_cat_zagol">[+cat_name+]</div>';


//чекбоксы
$tplRowCheckbox = '
	<label class="[+disabled+]">
		<input type="checkbox" name="f[[+tv_id+]][]" value="[+value+]" [+selected+] [+disabled+]> [+name+] <span class="fltr_count">[+count+]</span>
	</label>
';
$tplOuterCheckbox = '
	<div class="fltr_block fltr_block_checkbox fltr_block[+tv_id+]">
		<span class="fltr_name fltr_name_checkbox fltr_name[+tv_id+]">[+name+]</span>
		[+wrapper+]
	</div>
';


//выпадающий список - селект
$tplRowSelect = '<option value="[+value+]" [+selected+] [+disabled+]>[+name+] ([+count+])</option>';
$tplOuterSelect = '
	<div class="fltr_block fltr_block_select fltr_block[+tv_id+]">
		<span class="fltr_name fltr_name_select fltr_name[+tv_id+]">[+name+]</span>
		<select name="f[[+tv_id+]][]">
			<option value="0"> - [+name+] - </option>
			[+wrapper+]
		</select>
	</div>
';


//диапазон
$tplRowInterval = 'от<input type="text" name="f[[+tv_id+]][min]" value="[+minval+]" data-min-val="[+minvalcurr+]"> до <input type="text" name="f[[+tv_id+]][max]" value="[+maxval+]" data-max-val="[+maxvalcurr+]">';
$tplOuterInterval = '
	<div class="fltr_block fltr_block_interval fltr_block[+tv_id+]">
		<span class="fltr_name fltr_name_interval fltr_name[+tv_id+]">[+name+]</span>
		[+wrapper+]
	</div>
';


//радио - radio 
$tplRowRadio = '<input type="radio" name="f[[+tv_id+]][]" value="[+value+]" [+selected+] [+disabled+]> [+name+] <span class="fltr_count">[+count+]</span>';
$tplOuterRadio = '
	<div class="fltr_block fltr_block_radio fltr_block[+tv_id+]">
		<span class="fltr_name fltr_name_radio fltr_name[+tv_id+]">[+name+]</span>
		<input type="radio" name="f[[+tv_id+]][]" value="0"> Все
		[+wrapper+]
	</div>
';

//выпадающий список - мультиселект
$tplRowMultySelect = '<option value="[+value+]" [+selected+] [+disabled+]>[+name+] ([+count+])</option>';
$tplOuterMultySelect = '
	<div class="fltr_block fltr_block_multy fltr_block[+tv_id+]">
		<span class="fltr_name fltr_name_multy fltr_name[+tv_id+]">[+name+]</span>
		<select name="f[[+tv_id+]][]" multiple size="5">
			<option value="0"> - [+name+] - </option>
			[+wrapper+]
		</select>
	</div>
';

//слайдер
//слайдер
$tplRowSlider = '<div style="display:none;">
        от<input class="fltr_min" type="text" id="minCostInp[+tv_id+]" name="f[[+tv_id+]][min]" value="[+minval+]" data-min-val="[+minvalcurr+]">
    до<input class="fltr_max" type="text" id="maxCostInp[+tv_id+]" name="f[[+tv_id+]][max]" value="[+maxval+]" data-max-val="[+maxvalcurr+]">
</div>';
$tplOuterSlider = '
	<div class="fltr_block fltr_block_slider fltr_block[+tv_id+]">
		<span class="fltr_name fltr_name_slider fltr_name[+tv_id+]">[+name+]</span>
		<div class="fltr_inner fltr_inner_slider fltr_inner[+tv_id+]">
		<div class="slider_text slider_text[+tv_id+]">
		от <span class="minCost"></span> 
		до <span class="maxCost"></span></div>
		<div class="fltr_slider"></div>
		[+wrapper+]
		</div>
	</div>

';

//цвета
$tplRowColors = '
	<label class="[+disabled+] [+label_selected+]" style="background:[+value+]" title="[+name+] ([+count+])">
		<input type="checkbox" name="f[[+tv_id+]][]" value="[+value+]" [+selected+] [+disabled+]> [+name+] <span class="fltr_count">[+count+]</span>
	</label>
';
$tplOuterColors = '
	<div class="fltr_block fltr_block_checkbox fltr_colors fltr_block[+tv_id+] fltr_colors[+tv_id+]">
		<span class="fltr_name fltr_name_checkbox fltr_name[+tv_id+]">[+name+]</span>
		[+wrapper+]
	</div>
';

//паттерн
$tplRowPattern = '
	<label class="[+disabled+] [+label_selected+]" title="[+name+] ([+count+])">
		<input type="checkbox" name="f[[+tv_id+]][]" value="[+value+]" [+selected+] [+disabled+]> <img src="[+pattern_folder+][+value+]" alt="[+name+]"> [+name+] <span class="fltr_count">[+count+]</span>
	</label>
';
$tplOuterPattern = '
	<div class="fltr_block fltr_block_checkbox fltr_pattern fltr_block[+tv_id+] fltr_pattern[+tv_id+]">
		<span class="fltr_name fltr_name_checkbox fltr_name[+tv_id+]">[+name+]</span>
		[+wrapper+]
	</div>
';

