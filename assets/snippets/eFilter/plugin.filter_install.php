<?php

//
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//

echo '<br>';
echo '<br>';
echo '<br>';
echo '<br>';


$M = $modx->getFullTableName('site_modules');
$MD = $modx->getFullTableName('site_module_depobj');
$S = $modx->getFullTableName('site_snippets');
$P = $modx->getFullTableName('site_plugins');
$T = $modx->getFullTableName('site_tmplvars');


//id плагина



//поиск и обновление модуля
$tvId  = $modx->db->getValue($modx->db->select('id',$T,'name="tovarParams"'));
$value  = $modx->db->getValue($modx->db->select('id',$M,'name="eLists"'));
$moduleGuid  = $modx->db->getValue($modx->db->select('guid',$M,'name="eLists"'));
$moduleId =  $value;

$fields = [
    'enable_sharedparams'=>1,
];
if(!empty($tvId)){
    $properties = '{
  "param_tv_id": [
    {
      "label": "ID TV параметров товара",
      "type": "string",
      "value": '.$tvId.',
      "default": '.$tvId.',
      "desc": ""
    }
  ],
  "param_tv_id_simple": [
    {
      "label": "ID TV параметров товара (простой фильтр)",
      "type": "string",
      "value": "",
      "default": "",
      "desc": ""
    }
  ],
  "product_templates_id": [
    {
      "label": "ID шаблонов товара",
      "type": "string",
      "value": "",
      "default": "",
      "desc": ""
    }
  ],
  "param_cat_id": [
    {
      "label": "ID категории параметров",
      "type": "string",
      "value": "",
      "default": "",
      "desc": ""
    }
  ],
  "exclude_tvs_from_list": [
    {
      "label": "Не включать ТВ в параметры при выводе",
      "type": "string",
      "value": "",
      "default": "",
      "desc": ""
    }
  ],
  "tovarChunkName": [
    {
      "label": "Имя чанка вывода товара",
      "type": "string",
      "value": "",
      "default": "",
      "desc": ""
    }
  ],
  "pattern_folder": [
    {
      "label": "Папка паттернов",
      "type": "string",
      "value": "assets/images/pattern/",
      "default": "assets/images/pattern/",
      "desc": ""
    }
  ]
}';
    $fields['properties']=$properties;
}
$modx->db->update( $fields, $M, 'id = "' . $moduleId . '"' );

$snippets = [
    'eFilter','eFilterResult','multiParams','tovarParams'
];
$plugins = [
    'tovarParams'
];

foreach ($snippets as $snippet){
    $snippetId  = $modx->db->getValue($modx->db->select('id',$S,'name="'.$snippet.'"'));

    if(empty($snippetId)){
        continue;
    }

    $value = $modx->db->getValue($modx->db->select('id',$MD,'resource="'.$snippetId.'" and module="'.$moduleId.'"'));
      if(!empty($value)){
          continue;
      }
    //запись в site_module_depobj
    $fields = [
        'module'=>$moduleId,
        'resource'=>$snippetId,
        'type'=>40,
    ];
    $modx->db->insert( $fields, $MD);

    //добавляем модуль в сныппет
    $fields = [
        'moduleguid'=>$moduleGuid,
    ];
    $modx->db->update( $fields, $S, 'id = "' . $snippetId . '"' );
}

foreach ($plugins as $plugin){
    $pluginId  = $modx->db->getValue($modx->db->select('id',$P,'name="'.$plugin.'"'));

    if(empty($pluginId)){
        continue;
    }

    //запись в site_module_depobj
    $value = $modx->db->getValue($modx->db->select('id',$MD,'resource="'.$pluginId.'" and module="'.$moduleId.'"'));
    if(!empty($value)){
        continue;
    }
    $fields = [
        'module'=>$moduleId,
        'resource'=>$pluginId,
        'type'=>30,
    ];
    $modx->db->insert( $fields, $MD);
    $fields = [
        'moduleguid'=>$moduleGuid,
    ];
    $modx->db->update( $fields, $P, 'id = "' . $pluginId . '"' );

}



//удаляем плагин
$pluginId  = $modx->db->getValue($modx->db->select('id',$P,'name="filter_install"'));

if(!empty($pluginId)){
    $modx->db->delete($P, "id = $pluginId");
}

//$e = &$modx->event;
//$output = &$modx->documentContent;
//$e->output($output);