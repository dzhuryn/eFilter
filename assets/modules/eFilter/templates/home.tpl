


<div class="row">
    <div class="col-md-3">
        <div id="statuses"></div>
    </div>
    <div class="col-md-9" id="tv-list">
    </div>
</div>

<table class="table " id="filter-table">
    <tbody>
    </tbody>
</table>
<button id="save" class="btn btn-success">Сохранить</button>

<script>
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
                    datatype:"xml",
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
            $('#filter-table').html(data['table'])
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
</style>


