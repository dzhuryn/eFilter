


<div class="row">
    <div class="col-md-3">
        <div id="statuses"></div>
    </div>
    <div class="col-md-9" >
        <div class="col-md-12">
            <input type="text" name="filter" style="margin: 10px;0l" class="form-control"  placeholder="Поиск">
        </div>
        <div class="col-md-12" id="tv-list"></div>

    </div>
</div>

<table class="table " id="filter-table">
    <thead>
    <tr>
        <th></th>
        <th>Название</th>
        <th>Тв</th>
        <th>x</th>
        <th>Тып</th>
        <th>Категория</th>
        <th>Скрыть</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<button id="save" class="btn btn-success">Сохранить</button>

<script>

    $('input[name="filter"]').val('');
    $('input[name="filter"]').keyup(function(e){
        var inputValue = $.trim($(this).val()).toLowerCase()


            , i = 0
            , $menuElements = $('.checkbox')
            , len = $menuElements.length;
        if (inputValue !== '') {
            $menuElements.hide();
            for (i=0; i < len; i += 1) {
                var search = $menuElements.eq(i).find('label').text().toLowerCase();
                search =  $.trim(search)
                var pos = search.indexOf(inputValue);

                if (pos>=0) {
                    $menuElements.eq(i).show()
                }
            }
        } else {
            $menuElements.show();
        }
    });

    var category_id ;
    var ajax = '/assets/modules/eFilter/ajax.module.php';
    $('#save').click(function () {
        var array = [];
        $('#filter-table tr').each(function (ind,elem) {

            array.push([
                    $(elem).find('[name="tv_id"]').val(),
                    $(elem).find('[name="caption"]').val(),
                    $(elem).find('[name="tv_type"]').val(),
                    $(elem).find('[name="category"]').val(),
                    $(elem).find('[name="hide"]:checked').val(),
            ])

        })
        $.get(ajax+"?type=save&category_id="+category_id,{data:array},
        function () {
            webix.message('Сохраненно')
        })
    })


    webix.ui({
        container :"statuses",
        width:"300px"  ,
        rows:[
            { type:"header", template:"[+session.itemname+]" },
            { cols:[
                {
                    view:"tree",
                    id:"mytree",
                    gravity:0.3,
                    minHeight:200,
                    select:true,
                    datatype:"json",
                    template:"{common.icon()} {common.folder()} #pagetitle#",
                    url:ajax+"?type=tree-data"
                },
            ]},
        ]
    })


    $$("mytree").attachEvent("onBeforeSelect", function(newv, oldv){
        category_id = newv;
        webix.ajax().get(ajax,{type:'get-form',id:newv},function (data) {
            data = JSON.parse(data)
            $('#tv-list').html(data['boxes'])
            $('#filter-table tbody').html(data['table'])
            //$("[type='checkbox']").bootstrapSwitch();
        })
    });
    $('body').on('change','.tv-box',function () {
        if($(this).prop('checked')){

            $.get(ajax,{
                type:'get-elem',
                id:$(this).attr('id')
            },function (data) {
                $('#filter-table').append(data)
                $('tbody').sortable();

            })
        }
        else{
            $('#tv'+$(this).attr('id')).remove()
        }
    })

    $('body').on('click','.remove-item',function(){
        $(this).closest('tr').remove()
    })




</script>

<style>
    [view_id="$layout3"] {
        background: #fff;
    }
    #statuses{
        width: 300px;
        overflow: hidden;
    }
    .checkbox{
        display: inline-block;
        margin: 5px;
    }
    #tv-list{
        background: #fff;
    }
    .remove-item{
        cursor: pointer;
    }
</style>


