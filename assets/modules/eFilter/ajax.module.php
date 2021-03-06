<?php
if(!defined('MODX_BASE_PATH')){die('What are you doing? Get out of here!');}

require_once MODX_BASE_PATH.'assets/lib/MODxAPI/modResource.php';

$M = $modx->getFullTableName('site_modules');
$R = $modx->getFullTableName('site_content');
$T = $modx->getFullTableName('site_tmplvars');

$moduleId = $modx->db->getValue($modx->db->select('id', $M, 'name="eLists"'));
$moduleProperties = $modx->db->getValue($modx->db->select('properties', $M, 'name="eLists"'));
$resp = json_decode($moduleProperties, true);
if (empty($resp['product_templates_id'])) {
    return '';
} else {
    $template = $resp['category_template'][0]['value'];
    $tvCategory = $resp['param_cat_id'][0]['value'];

}

$type = $_REQUEST['type'];
if ($type == 'tree-data') {
    $resp = $modx->runSnippet('DocLister',
        [
            'parents'=>0,
            'depth'=>4,
            'showParent'=>1,
            'api'=>1,
            'selectFields'=>'id,pagetitle,parent',
            'orderBy'=>'parent asc',
            'addWhereList'=>'template in ('.$template.')'
        ]
    );
    $resp = json_decode($resp,true);
    function buildTree(array &$elements, $parentId = 0)
    {
        $branch = array();

        foreach ($elements as $element) {

            if ($element['parent'] == $parentId) {
                $children = buildTree($elements, $element['id']);
                if ($children) {
                    $element['data'] = $children;
                }
                $branch[] = $element;
                unset($elements[$element['id']]);
            }
        }
        return $branch;
    }
        $resp = buildTree($resp);
    echo json_encode($resp);

}
if ($type == 'get-form') {
    $id = intval($_POST['id']);

    $doc = new modResource($modx);
    $doc->edit($id);
    $docTVS = $doc->get('tovarparams');

    $docTVS = json_decode($docTVS,true);
    $docTVS = $docTVS['fieldValue'];
    $tvsList = [];



    //получаем все тв поля
    $tvCategory = $modx->db->escape($tvCategory);
    $tvs = $modx->db->makeArray($modx->db->select('id,name,caption', $T, 'category in (' . $tvCategory . ')'));
    $tvArray = [];

    foreach ($tvs as $tv) {
        $tvArray[] = [
            'name' => $id.'tv'. $tv['id'],
            'view' => 'checkbox',
            'id' => $tv['id'],
            'labelWidth'=>'120',
            'label' => $tv['caption'],
        ];

    }


    $tableTr = '';
    if(is_array($docTVS)){
        foreach ($docTVS as $e){
            $tvsList[]=$e['param_id'];

            $selected = [];
//            echo $e['fltr_type'].'<br>';
            $selected[$e['fltr_type']]='selected';

            if($e['hide'] == '1'){
                $selected['hide']='checked';
            }

            $selectList = '';
            foreach ($tvArray as $tv) {
                $sel = '';
                if($tv['id']==$e['param_id']){
                    $sel = 'selected';
                }


                $selectList .= '<option '.$sel.' value="'.$tv['id'].'">'.$tv['label'].'</option>';

            }
            $selectList = '<select class="form-control" name="tv_id" size="1">
                        <option value=""></option>
                        '.$selectList.'
                        </select>';

            $filterType = '<select class="form-control" name="tv_type" size="1">
                        <option value=""></option>
                        <option '.$selected[1].' value="1">Чекбокс</option>
                        <option '.$selected[2].' value="2">Список</option>
                        <option '.$selected[3].' value="3">Диапазон</option>
                        <option '.$selected[4].' value="4">Флажок</option>
                        <option '.$selected[5].' value="5">Мультиселект</option>
                        <option '.$selected[6].' value="6">Слайдер</option>
                        <option '.$selected[7].' value="7">Цвет</option>
                        <option '.$selected[8].' value="8">Паттерн</option>
                    </select>';


            $output .= '<tr id="tv'.$e['param_id'].'">
        <td>
            <img src="/assets/modules/eFilter/image/arrow_updown.png"/>
          
        </td>
        <td><input name="caption" value="'.$e['fltr_name'].'" class="form-control"/></td>
        <td>'.$selectList.'</td>
        <td style="text-align: center"><a class="remove-item">x</a></td>
        <td>'.$filterType.'</td>
        <td><input name="category"  class="form-control" placeholder="Категория.." value="'.$e['cat_name'].'"/></td>
        <td><div class="checkbox">
        <label>
          <input '.$selected['hide'].' name="hide" value="1" type="checkbox"> Скрыть
        </label>
      </div></td>
        
</tr>';

        }
    }


    $boxes = '';
    foreach($tvArray as $tv){

        $checked = '';
        if(in_array($tv['id'],$tvsList)){
            $checked = 'checked';
        }
        $boxes .= '
  <div class="checkbox">
    <label>
      <input type="checkbox" '.$checked.' class="tv-box" id="'.$tv['id'].'"> '.$tv['label'].'
    </label>
  </div>
        ';
    }

    echo json_encode([
        'table'=>$output,
        'boxes'=>$boxes,
    ]);


}

if($type=='get-elem'){

    $id = intval(str_replace('tv','',$_REQUEST['id']));

    //получаем все тв поля
    $tvCategory = $modx->db->escape($tvCategory);
    $tvs = $modx->db->makeArray($modx->db->select('id,name,caption', $T, 'category in (' . $tvCategory . ')'));
    $tvArray = [];

    foreach ($tvs as $tv) {
        $tvArray[] = [
            'name' => $id.'tv'. $tv['id'],
            'view' => 'checkbox',
            'id' => $tv['id'],
            'labelWidth'=>'120',
            'label' => $tv['caption'],
        ];

    }
    $tvs = $modx->db->makeArray($modx->db->select('*', $T, 'id =' . $id ));
    $tv = $tvs[0];



    $selectList = '';
    foreach ($tvArray as $elem) {
        $sel = '';
        if($elem['id']==$tv['id']){
            $sel = 'selected';
        }


        $selectList .= '<option '.$sel.' value="'.$elem['id'].'">'.$elem['label'].'</option>';

    }
    $selectList = '<select class="form-control" name="tv_id" size="1">
                        <option value=""></option>
                        '.$selectList.'
                        </select>';

    $filterType = '<select class="form-control" name="tv_type" size="1"><option value="" ></option><option selected="selected" value="1">Чекбокс</option><option value="2">Список</option><option value="3">Диапазон</option><option value="4">Флажок</option><option value="5">Мультиселект</option><option value="6">Слайдер</option><option value="7">Цвет</option><option value="8">Паттерн</option></select>';


    $output .= '<tr id="tv'.$tv['id'].'">
        <td>
            <img src="/assets/modules/eFilter/image/arrow_updown.png"/>
 
        </td>
        <td><input name="caption" value="'.$tv['caption'].'" class="form-control"/></td>
                <td>'.$selectList.'</td>
        <td style="text-align: center"><a class="remove-item">x</a></td>
        <td>'.$filterType.'</td>
        <td><input name="category" value="" class="form-control" placeholder="Категория.."/></td>
 <td><div class="checkbox">
        <label>
          <input '.$selected['hide'].' name="hide" value="1" type="checkbox"> Скрыть
        </label>
      </div></td>
</tr>';

    echo $output;


}
if($type=='save'){
    $data = $_REQUEST['data'];
    $category_id = intval($_REQUEST['category_id']);
    $tvs = [];



    if(is_array($data)){
        foreach ($data as $e){
            $tvs[] = [
                'param_id'=>$e['0'],
                'cat_name'=>$e['3'],
                'list_yes'=>1,
                'fltr_yes'=>1,
                'fltr_type'=>$e['2'],
                'fltr_name'=>$e['1'],
                'fltr_many'=>1,
                'param_choose'=>1,
                'hide'=>isset($e['4'])?$e['4']:'0',
            ];
        }
    }




    $doc = new modResource($modx);
    $doc->edit($category_id);
    $doc->set('tovarparams',json_encode(['fieldValue'=>$tvs]));
    $doc->save();
}