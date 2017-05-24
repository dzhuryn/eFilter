<?php
//создаем модуль и вставляем строку: include_once(MODX_BASE_PATH.'assets/modules/survar/survar.module.php');
if (IN_MANAGER_MODE != "true" || empty($modx) || !($modx instanceof DocumentParser)) {
    die("<b>INCLUDE_ORDERING_ERROR</b><br /><br />Please use the MODX Content Manager instead of accessing this file directly.");
}
if (!$modx->hasPermission('exec_module')) {
    header("location: " . $modx->getManagerPath() . "?a=106");
}
if(!is_array($modx->event->params)){
  $modx->event->params = array();
}

//Подключаем обработку шаблонов через DocLister
include_once(MODX_BASE_PATH.'assets/snippets/DocLister/lib/DLTemplate.class.php');
$tpl = DLTemplate::getInstance($modx);

$moduleurl = 'index.php?a=112&id='.$_GET['id'].'&';
$action = isset($_GET['action']) ? $_GET['action'] : 'home';

$data = array ('moduleurl'=>$moduleurl, 'manager_theme'=>$modx->config['manager_theme'], 'session'=>$_SESSION, 'action'=>$action , 'selected'=>array($action=>'selected')); 

//выполнение действий

//die();
switch ($action) {

    case 'ajax':
        require_once 'ajax.module.php';
        die();
        break;

  case 'home':
    $template = '@CODE:'.file_get_contents(dirname(__FILE__).'/templates/home.tpl');
    $outTpl = $tpl->parseChunk($template,$data);
  break;  
  
  case 'getStatuses':
    $result = $modx->db->select("*", $modx->getFullTableName('survey_variants'), '', 'id DESC'); 
    $result = $modx->db->makeArray( $result );
    foreach ($result as $key => $val){
      $result[$key]['content'] = json_decode($val['content']);
    }
    $outData = $result;
  break;

  case 'saveStatuses':
    $req = $modx->db->escape($_REQUEST);
    $table = $modx->getFullTableName( 'survey_variants' );
    switch ($_REQUEST['webix_operation']) {
      case 'update':
        $fields = $req;
        unset($fields['a']);
        unset($fields['action']);
        unset($fields['webix_operation']);
        unset($fields['title']);
        unset($fields['user']);
        $result = $modx->db->update( $fields, $table, 'id = "' . $req['id'] . '"' );   
        if( $result ) {  
          $outData = array('id'=>$req['id'], 'status'=>'success');  
        } else {  
          $outData = array('id'=>$req['id'], 'status'=>'error');
        }
      break;
      case 'delete':
        $modx->db->delete($table, "id = ".$req['id']);
        $outData = array('id'=>$req['id'], 'status'=>'success');
      break;
    }  
    $modx->clearCache('full');
  break;
}

// Вывод результата или шаблон или Ajax 
if(!is_null($outTpl)){
  $headerTpl = '@CODE:'.file_get_contents(dirname(__FILE__).'/templates/header.tpl');
  $footerTpl = '@CODE:'.file_get_contents(dirname(__FILE__).'/templates/footer.tpl');
  $output = $tpl->parseChunk($headerTpl,$data) . $outTpl . $tpl->parseChunk($footerTpl,$data);
}else{ 
  header('Content-type: application/json');
  $output = json_encode($outData, JSON_UNESCAPED_UNICODE);  
  	
}
echo $output;
?>