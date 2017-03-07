<?php
echo '<br>';
echo '<br>';
echo '<br>';
echo '<br>';
echo '<br>';
$M = $modx->getFullTableName('site_modules');
$MD = $modx->getFullTableName('site_module_depobj');
$S = $modx->getFullTableName('site_snippets');
$P = $modx->getFullTableName('site_plugins');

$value  = $modx->db->getValue($modx->db->select('id',$M,'name="eLists"'));
$moduleId =  $value;

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

    //запись в site_module_depobj
    $fields = [
        'module'=>$moduleId,
        'resource'=>$snippetId,
        'type'=>40,
    ];
    $modx->db->insert( $fields, $MD);

    //добавляем модуль в сныппет
    $fields = [
        'moduleguid'=>$moduleId,
    ];
    $modx->db->update( $fields, $S, 'id = "' . $snippetId . '"' );
}

foreach ($plugins as $plugin){
    $pluginId  = $modx->db->getValue($modx->db->select('id',$P,'name="'.$plugin.'"'));

    if(empty($pluginId)){
        continue;
    }

    //запись в site_module_depobj
    $fields = [
        'module'=>$moduleId,
        'resource'=>$pluginId,
        'type'=>30,
    ];
    $modx->db->insert( $fields, $MD);
    $fields = [
        'moduleguid'=>$moduleId,
    ];
    $modx->db->update( $fields, $P, 'id = "' . $pluginId . '"' );

}