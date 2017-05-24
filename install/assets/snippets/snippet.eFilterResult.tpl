//<?php
/**
 * eFilterResult
 * 
 * Вывод отфильтрованных товаров
 *
 * @author      webber (web-ber12@yandex.ru)
 * @category    snippet
 * @version     0.1
 * @license     http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
 * @internal    @modx_category Filters
 * @internal    @installset base, sample
 */
 //импортировать общие параметры из модуля eLists
 //использует для работы сниппет DocLister и выводит список товаров, при этом заменяя плейсхолдер [+params+] на список параметров товара, отмеченных для вывода в список
 //использует общие параметры из модуля eLists, также параметры $paramRow и $paramOuter для вывода параметров товара
 //доп.информация черпается из плейсхолдеров, установленных сниппетом [!eFilter!] который должен вызываться раньше
 //пример вызова [!eFilterResult? &tpl=`tovarDL` &addWhereList=`c.template=9` &parents=`[*id*]` &depth=`3` &paginate=`pages` &display=`15` &tvList=`image,price`!] [+pages+]
 //все параметры аналогичны параметрам вызова DocLister + доп.параметры $paramRow и $paramOuter для вывода параметров товара

 $prefix = isset($params['id'])?$params['id'].'.':'';
 $prefix_page = isset($params['id'])?$params['id'].'_':'';



//получаем из плейсхолдера список документов для documents
$ids = $modx->getPlaceholder('eFilter_ids');
$eFilter_ajax = $modx->getPlaceholder('eFilter_ajax');



//фиксим DocLister - при пустом списке documents и пустом фильтре - отдавать все
//при пустом списке documents и НЕ пустом фильтре - ничего не отдавать
if($ids == '' && (isset($_GET))) {
$ids = $modx->config['site_start'];
$f = $_GET;
foreach($f as $k => $val){
if (preg_match("/^f(\d+)/i", $k, $matches)) {
if($val != '0' && $val != '') {$ids = '2';}
}
}
if ($ids == $modx->config['site_start']) {$ids = '';}
}
if($ids == '' && (isset($_GET['f']))) {
$ids = $modx->config['site_start'];
$f = $_GET['f'];
foreach($f as $k=>$v){
foreach ($v as $val) {
if($val != '0' && $val != '') {$ids = '2';}
}
}
if ($ids == $modx->config['site_start']) {$ids = '';}
}

//получаем из плейсхолдера список ТВ для вывода в список
$tv_list = $modx->getPlaceholder('eFilter_tv_list');
//..и их имена из кэпшн
$tv_names = $modx->getPlaceholder('eFilter_tv_names');

// удаляеи из списка общие исключенные ТВ (в настройках модуля) -
// (например цена и т.п., которая выводится отдельно и есть у всех
if (isset($exclude_tvs_from_list) && $exclude_tvs_from_list != '') {
$exclude_tvs = explode(',', $exclude_tvs_from_list);
foreach($exclude_tvs as $k=>$v){
if (isset($tv_names[$v])) {
unset($tv_names[$v]);
}
if (isset($tv_list[$v])) {
unset($tv_list[$v]);
}
}
}
///////



//заменяем плейсхолдер [+params+] в чанке вывода товаров
//на нужный вывод параметров товаров
//шаблоны вывода параметра в списке по умолчанию
$paramRow = isset($paramRow) ? $paramRow : '<div class="eFilter_list_param eFilter_list_param[+param_id+]"><span class="eFilter_list_title">[+param_title+]: </span><span class="eFilter_list_value eFilter_list_value[+param_id+]">[+param_value+]</span></div>';
$paramOuter = isset($paramOuter) ? $paramOuter : '<div class="eFilter_list_params">[+wrapper+]</div>';


$tovar_params_tpl = '';
foreach($tv_names as $tv_id=>$tv_name) {
$param_value = '[+tv.' . $tv_list[$tv_id] . '+]';
$tovar_params_tpl .= str_replace(
array('[+param_title+]', '[+param_value+]', '[+param_id+]'),
array($tv_name, $param_value, $tv_id),
$paramRow
);
}

$tovar_params_wrapper = str_replace(
array('[+wrapper+]'),
array($tovar_params_tpl),
$paramOuter
);

$tovarChunkName = isset($params['tpl']) && !empty($params['tpl']) ? $params['tpl'] : $tovarChunkName;
$tovarChunk = $modx->getChunk($tovarChunkName);
$tovarChunk = '@CODE: ' . str_replace('[+params+]', $tovar_params_wrapper, $tovarChunk);
$params['tpl'] = $tovarChunk;
///////конец замены чанка вывода товаров


$out = '';
$pid = isset($pid) ? $pid : $modx->documentIdentifier;
$params['ownerTPL'] = isset($ownerTPL) ? $ownerTPL :'@CODE: <div id="eFiltr_results_wrapper"><div class="eFiltr_loader"></div><div id="eFiltr_results">[+dl.wrap+][+pages+]</div></div>';

//параметры сортировки и вывода из сессии
$docid = isset($docid) ? (int)$docid : $modx->documentIdentifier;
$display = isset($_SESSION['sortDisplay']) ? $modx->db->escape($_SESSION['sortDisplay']) : ($params['display'] ? $params['display'] : '12');
$sortBy = isset($_SESSION['sortBy']) ? $modx->db->escape($_SESSION['sortBy']) : ($params['sortBy'] ? $params['sortBy'] : 'menuindex');
$sortOrder = isset($_SESSION['sortOrder']) ? $modx->db->escape($_SESSION['sortOrder']) : ($params['sortOrder'] ? $params['sortOrder'] : 'DESC');
$params['orderBy'] = $sortBy . ' ' . $sortOrder;
$params['display'] = $display;
if ($display == 'all') unset($params['display']);


// если ajax переопределяем пагинацию
if($eFilter_ajax == 1){
$params['TplWrapPaginate'] = isset($TplWrapPaginate) ? $TplWrapPaginate : '@CODE:<div class="[+class+]">[+wrap+]</div>';
$params['TplNextP'] = isset($TplNextP) ? $TplNextP : '@CODE:<a data-prefix="'.$prefix_page.'" data-page="[+num+]">&gt;</a>';
$params['TplPrevP'] = isset($TplPrevP) ? $TplPrevP : '@CODE:<a data-prefix="'.$prefix_page.'" data-page="[+num+]">&lt;</a>';
$params['TplPage'] = isset($TplPage) ? $TplPage : '@CODE:<a data-prefix="'.$prefix_page.'" data-page="[+num+]" class="page">[+num+]</a>';
$params['TplCurrentPage'] = isset($TplCurrentPage) ? $TplCurrentPage : '@CODE:<b class="current">[+num+]</b>';
$params['TplFirstP'] = isset($TplFirstP) ? $TplFirstP : '';
$params['TplLastP'] = isset($TplLastP) ? $TplLastP : '';
$params['PrevNextAlwaysShow'] = isset($PrevNextAlwaysShow) ? $PrevNextAlwaysShow : '0';
}
if ($ids) {
$params['documents'] = $ids;
unset($params['parents']);
unset($params['depth']);
} else {
$params['parents'] = $pid;
}
$params['addWhereList'] = 'c.template IN(' . $product_templates_id . ')';
if (!empty($tv_list)) {
$params['tvList'] = $params['tvList'] == '' ? implode(',', $tv_list) : $params['tvList'] . ',' . implode(',', $tv_list);
$params['renderTV'] = $params['renderTV'] == '' ? implode(',', $tv_list) : $params['renderTV'] . ',' . implode(',', $tv_list);
}
$params['tvSortType'] = 'UNSIGNED';
if (!empty($params)) {
$out .= $modx->runSnippet("DocLister", $params);
}

$page = isset($_GET[$prefix_page.'page'])?intval($_GET[$prefix_page.'page']):1;





//получаем количество пры подгрузке ajax
if(!empty($_GET['start'])){
$start = intval($_GET['start']);
$count = ($page-$start) * $params['display'] + intval($modx->getPlaceholder($prefix.'display'));
$modx->setPlaceholder($prefix.'display',$count);
}
else{
$count = intval($modx->getPlaceholder($prefix.'display'));
}

//plural
$n = $count;
//var_dump($n);
//die();
$lang = isset($lang) ? $lang : 'ru';
$phrase1 = isset($phrase1) ? $phrase1 : 'Товар';
$phrase2 = isset($phrase2) ? $phrase2 : 'Товара';
$phrase3 = isset($phrase3) ? $phrase3 : 'Товаров';


if (in_array($lang,['ru','ua'])) {

$plural = $n%10==1 && $n%100!=11 ? $phrase1 : ($n%10>=2 && $n%10<=4 && ($n%100<10 || $n%100>=20) ? $phrase2 : $phrase3);
} else {
$plural = $n != 1 ? $phrase1 : $phrase2;
}
$modx->setPlaceholder($prefix.'plural',$plural);


//ссылка на следующую страницу
$stop = $modx->getPlaceholder($prefix.'isstop');
if($stop!=1){
$modx->setPlaceholder($prefix.'pages_next',$page + 1);
}
return $out;
