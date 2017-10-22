<?php

//дание из формы
if(!empty($_REQUEST['sortDisplay'])){
    $_SESSION['sortDisplay'] = $_REQUEST['sortDisplay'];
}
if(!empty($_REQUEST['sortBy']) && !empty($_SESSION['sortBy']) &&$_REQUEST['sortBy']==$_SESSION['sortBy']){
    //меняем направление
    $_SESSION['sortOrder'] = $_SESSION['sortOrder']=='desc'?'asc':'desc';
}
if(!empty($_REQUEST['sortBy'])){
    $resp  = explode(':',$_REQUEST['sortBy']);
    $sortBy = $resp[0];
    $sortOrder = $resp[1];


    $_SESSION['sortBy'] = $sortBy;
    if(!empty($sortOrder)){
        $_SESSION['sortOrder']  = $sortOrder;
    }


}


//default
$displayDefault = isset($displayDefault)?$displayDefault : '20';
$sortFieldDefault = isset($sortFieldDefault)?$sortFieldDefault : 'pagetitle';
$sortOrderDefault = isset($sortOrderDefault)?$sortOrderDefault : 'desc';

//устанавливаемм значений и  сесию
if(empty($_SESSION['sortDisplay'])) $_SESSION['sortDisplay'] = $displayDefault;
if(empty($_SESSION['sortBy'])) $_SESSION['sortBy'] = $sortFieldDefault;
if(empty($_SESSION['sortOrder'])) $_SESSION['sortOrder'] = $sortOrderDefault;




//поточние значения
$currentDisplay = $_SESSION['sortDisplay'];
$currentSortField = $_SESSION['sortBy'];
$currentSortOrder = $_SESSION['sortOrder'];

//конфиг
$displayConfig = isset($displayConfig)?$displayConfig:'20||30||40||все==all';
$sortConfig = isset($sortConfig)?$sortConfig:'По название==pagetitle||По индексу==menuindex';
$changeSortByClickField = isset($changeSortByClickField)?$changeSortByClickField:0;
//tpl
$ownerTpl = isset($ownerTpl)?$ownerTpl:'<div class="[+class+]">[+display.block+][+sort.block+][+sort.direction+]</div>';

$displayOwnerTpl  = isset($displayOwnerTpl)?$displayOwnerTpl:'<select class="[+class+]">[+wrapper+]</select>';
$displayRowTpl = isset($displayRowTpl)?$displayRowTpl:'<option value="[+value+]" [+selected+] [+data+] class="[+class+]">[+caption+]</option>';

$sortOwnerTpl = isset($sortOwnerTpl)?$sortOwnerTpl:'<ul>[+wrapper+]</ul>';
$sortRowTpl = isset($sortRowTpl)?$sortRowTpl: '<a class="[+class+]" [+data+] [+selected+] >[+caption+]</a>';

//напрявение
$sortDirectionTpl  = isset($sortDirectionTpl)?$sortDirectionTpl:'<div>[+up+][+down+]</div>';
$sortDirectionUpTpl  = isset($sortDirectionUpTpl)?$sortDirectionUpTpl:'<a class="[+class+]" [+data+]>По возрастанию</a>';
$sortDirectionDownTpl  = isset($sortDirectionDownTpl)?$sortDirectionDownTpl:'<a class="[+class+]" [+data+]>По убиванию</a>';

//class
$sortFieldClass = isset($sortFieldClass)?$sortFieldClass:'set-sort-field';
$sortActiveClass = isset($sortActiveClass)?$sortActiveClass:'active';
$sortUpClass = isset($sortUpClass)?$sortUpClass:'up';
$sortDownClass = isset($sortDownClass)?$sortDownClass:'down';
$displayActiveClass = isset($displayActiveClass)?$displayActiveClass:'active';
$sortDirectionActiveClass  = isset($sortDirectionActiveClass)?$sortDirectionActiveClass:'active';

$displayRow = '';
$display = explode('||',$displayConfig);
if(is_array($display)){
    foreach ($display as $el) {
        $resp = explode('==',$el);
        $caption = $resp[0];
        $value =empty($resp[1])?$resp[0]:$resp[1] ;
        $dataAttr = 'data-value = "'.$value.'"';

        $selected = '';
        $class = ' set-display-field';

        if($value==$currentDisplay){
            $class.=' '.$displayActiveClass;
            $selected = ' selected';
        }

        $data = [
            'value'=>$value,
            'caption'=>$caption,
            'selected'=>$selected,
            'data'=>$dataAttr,
            'class'=>$class,
        ];
        $displayRow .= $modx->parseText($displayRowTpl,$data);
    }
}
$data = [
    'class'=>' set-display-field',
    'wrapper'=>$displayRow
];
$displayOuter = $modx->parseText($displayOwnerTpl,$data);

$sortRow = '';
$sortField = explode('||',$sortConfig);
if(is_array($sortField)){
    foreach ($sortField as $el) {
        $resp = explode('==',$el);
        $caption = $resp[0];
        $resp  = empty($resp[1])?$resp[0]:$resp[1] ;
        $resp = explode(':',$resp);
        $value = $resp[0];
        if(!empty($resp[1])){
            $valueOrder = $resp[1];
        }
        else{
            $valueOrder = '';
        }
        $dataValue = $value;


        if(!empty($resp[1])){
            $dataValue .= ':'.$valueOrder;
        }
        else if($changeSortByClickField == 0){
            $dataValue .= ':'.$valueOrder;
        }
        $dataAttr = 'data-value = "'.$dataValue.'"';


        $selected = '';
        $class = ' '.$sortFieldClass;

        if($value==$currentSortField && empty($valueOrder)){
            $class.=' '.$sortActiveClass;
            $selected = ' selected';
        }
        if(!empty($valueOrder) && $valueOrder==$currentSortOrder && $value==$currentSortField){
            $class.=' '.$sortActiveClass;
            $selected = ' selected';
        }

        if($currentSortOrder=='desc'){
            $class.=' '.$sortUpClass;
        }
        else{
            $class.=' '.$sortDownClass;
        }
        $data = [
            'value'=>$value,

            'caption'=>$caption,
            'selected'=>$selected,
            'data'=>$dataAttr,
            'class'=>$class,
        ];
        $sortRow .= $modx->parseText($sortRowTpl,$data);
    }
}

$data = [
    'class'=>' '.$sortFieldClass,
    'wrapper'=>$sortRow,

];
$sortOuter = $modx->parseText($sortOwnerTpl,$data);


//блок направления
$upClass = $currentSortOrder == 'desc'?$sortDirectionActiveClass:'';
$downClass = $currentSortOrder == 'asc'?$sortDirectionActiveClass:'';


$up = $modx->parseText($sortDirectionUpTpl,[
    'class'=>$upClass,
    'data'=>'data-value="'.$currentSortField.':asc"',
]);
$down = $modx->parseText($sortDirectionDownTpl,[
    'class'=>$downClass,
    'data'=>'data-value="'.$currentSortField.':desc"',
]);
$directionOuter = $modx->parseText($sortDirectionTpl,[
    'up'=>$up,
    'down'=>$down
]);

$class = 'sort-wrap';
if($ajax==1){
    $class .= ' ajax';
}
$data = [
    'display.block'=>$displayOuter,
    'sort.block'=>$sortOuter,
    'sort.direction'=>$directionOuter,
    'class'=>$class
];
$output = $modx->parseText($ownerTpl,$data);
$modx->setPlaceholder('sort_display',$currentDisplay);
$modx->setPlaceholder('sort_field',$currentSortField);
$modx->setPlaceholder('sort_order',$currentSortOrder);

echo $output;
