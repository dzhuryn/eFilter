;
!function(wnd, $, undefined){
    var autoSubmit = wnd.eFiltrAutoSubmit||0;
    var useAjax = wnd.eFiltrAjax;
    var eFilter = function(options) {
        this.Init(options);
    }
     eFilter.prototype = {
        constructor : eFilter,
        defaults : {
            start:'1',
            block : "#eFiltr",
            form : "form#eFiltr",
            form_selector : "form#eFiltr input, form#eFiltr select",
            result_list : "#eFiltr_results",
            loader : "#eFiltr_results_wrapper .eFiltr_loader",
            display_selector:'.filter_display',
            plural_selector :'.1',
            eFilter_more:'.eFilter_more',
            eFilter_more_wrap:'.eFilter_more_wrap',
            pagination_wrap_selector:'.pagination',
            delete_wrap_selector:'.fltr_delete_wrap',
            delete_item_selector:'.fltr_delete_item_link',
            more:'0',

        },
        params : {},
        Init : function(options) {
            this.params = $.extend({}, this.defaults, options);
            this.params = $.extend(this.params,
                {
                    block_obj : $(this.params.block),
                    form_obj : $(this.params.form),
                    form_selector_obj : $(this.params.form_selector),
                    result_list_obj : $(this.params.result_list),
                    eFilter_more_wrap_obj : $(this.params.eFilter_more_wrap),
                    pagination_wrap_obj : $(this.params.pagination_wrap_selector),
                    delete_wrap_obj : $(this.params.delete_wrap_selector),
                    delete_item_obj : $(this.params.delete_item_selector),

                    loader_obj : $(this.params.loader)
                }
            );

            this.checkActions();
        },
        checkActions : function() {
            this.checkPagination();
            this.bindForm();
            this.checkForm();
            this.checkSort();
            this.checkReset();
            this.checkDeleteBlock();

            this.bindSliders()
            this.bindMoreBtn()
        },
         pluralUpdate :function (msg) {
            msg = $(msg);
            if(msg.find(this.params.display_selector).length){
                $(this.params.display_selector).html(msg.find(this.params.display_selector).html())
            }

             if(msg.find(this.params.plural_selector).length){
                 $(this.params.plural_selector).html(msg.find(this.params.plural_selector).html())
             }



         },
        updateMoreBtn: function (msg) {
            if($(msg).find(this.params.eFilter_more_wrap).length){
                $(this.params.eFilter_more_wrap).show()
                $(this.params.eFilter_more_wrap_obj).html($(msg).find(this.params.eFilter_more_wrap).html())
            }
            else{
                $(this.params.eFilter_more_wrap).hide()
            }

         },
         updateDeleteBlock:function (msg) {
             if($(msg).find(this.params.delete_wrap_selector).length){
                 this.params.delete_wrap_obj.show()
                 this.params.delete_wrap_obj.html($(msg).find(this.params.delete_wrap_selector).html())
             }
         },
         updatePagination:function (msg) {
             if($(msg).find(this.params.pagination_wrap_selector).length){
                 this.params.pagination_wrap_obj.show()
                 this.params.pagination_wrap_obj.html($(msg).find(this.params.pagination_wrap_selector).html())
             }
             else{
                 this.params.pagination_wrap_obj.hide();
             }
         },
         checkDeleteBlock:function (msg) {
             var self = this;
             $(document).on("click", self.params.delete_item_selector, function(e){
                 if (typeof useAjax !== 'undefined') {
                     e.preventDefault();

                     var _form = '';
                     var url = $(this).attr('href');
                     var data2 = '&no_ajax_for_star_rating=1';

                     self.makeAjax(url, data2, _form, "GET","all");
                 }
             })
         },
         bindMoreBtn :function () {
          var self=   this;

            $(document).on("click",this.params.eFilter_more,function (e) {
                self.prepareBeforeMakeAjax()
                if (typeof useAjax !== 'undefined') {
                   e.preventDefault();

                    self.params.more = '1';


                    var _form = self.params.block_obj;
                    var url = self.params.block_obj.attr('action')
                    var page = $(this).data('page');
                    var prefix = $(this).data('prefix');

                    var data2 = _form.serialize()+'&no_ajax_for_star_rating=1&start='+self.params.start;
                    var action = url+'?'+prefix+'page='+page;



                    self.makeAjax(action, data2, '', "GET");

                }
            })
         },

        checkPagination : function() {
            var self = this;

            $(document).on("click", ".pagination a", function(e){
                self.prepareBeforeMakeAjax()
                self.prepareBeforeMakeAjax();
                if (typeof useAjax !== 'undefined') {
                    e.preventDefault();
                    var _form = self.params.block_obj;
                    var url = self.params.block_obj.attr('action')
                    var page = $(this).data('page');
                    var prefix = $(this).data('prefix');

                    self.params.start = page;

                    var data2 = _form.serialize()+'&no_ajax_for_star_rating=1';
                    var action = url+'?'+prefix+'page='+page;
                    self.makeAjax(action, data2, _form, "GET");
                }
            })
        },
         checkReset: function () {
             var self = this;
             $(document).on("click", ".eFiltr_reset", function (e) {
                 if (typeof useAjax !== 'undefined') {
                     e.preventDefault()
                     var url = self.params.block_obj.attr('action');
                     self.makeAjax(url, '', '', "GET","all")
                 }

             })
         },
        checkForm : function() {
            var self = this;

            $(document).on("change", this.params.form_selector, function(e) {

                if (typeof autoSubmit !== 'undefined' && autoSubmit !== 0) {
                    //self.submitForm();
                    $(document).find(self.params.form).submit();
                }
            })
        },
        checkSort : function() {

            var self = this;
            var _form = self.params.block_obj;
            var action = _form.attr('action');
            var data2;
            $(document).on('click change','.set-display-field',function (event) {
                self.prepareBeforeMakeAjax()
                data2 = _form.serialize();
                var val;
                var status = false;
                if(event.type==='change' && $(this).val()!=='0' && $(this).val()!=='' && typeof $(this).val() !=='undefined' && $(this).val()!==null){ //у нас selected
                    val = $(this).val();
                    status = true;
                }
                if(event.type==='click' && $(this)[0].tagName==='A'){ //клик по кнопке
                    val = $(this).data('value');
                    status = true;
                }
                if(status === true){
                    data2 = data2+"&sortDisplay="+val

                    self.makeAjax(action, data2, _form, "GET");
                }
            });
            $(document).on('click change','.set-sort-field',function (event) {
                self.prepareBeforeMakeAjax()
                data2 = _form.serialize();
                var status = false;
                if(event.type==='change' && $(this).val()!=='0' && $(this).val()!=='' && typeof $(this).val() !=='undefined' && $(this).val()!==null){ //у нас selected
                    val = $(this).val()
                    status = true;
                }
                if(event.type==='click' && $(this)[0].tagName==='A'){ //клик по кнопке
                    val = $(this).data('value');
                    status = true;
                }
                if(status === true){
                    data2 = data2+"&sortBy="+val;
                    self.makeAjax(action, data2, _form, "GET");
                }
            })

        },
         updateSort:function (msg) {
             if($(msg).find('.sort-wrap').length){
                 $('.sort-wrap').html($(msg).find('.sort-wrap'))
             }
         },

         afterInsertResult: function (msg) {
            this.pluralUpdate(msg);
            this.updateMoreBtn(msg);
            this.updatePagination(msg);
            this.updateDeleteBlock(msg);
            this.updateSort(msg);
            this.bindSliders()
         },
        bindSliders: function () {

            $('.fltr_slider').each(function (ind,elem) {

                var parent = $(elem).parent()

                var minObj = $(parent).find('.fltr_min');
                var maxObj = $(parent).find('.fltr_max');

                var min = parseInt( minObj.val());
                var mincurr = parseInt(minObj.data('min-val'));

                var max = parseInt(maxObj.val());
                var maxcurr = parseInt(maxObj.data('max-val'));

                var minCostObj = $(parent).find('.minCost')
                var maxCostObj = $(parent).find('.maxCost')

                minCostObj.text(min);
                maxCostObj.text(max)

                $(elem).slider({
                    min: mincurr,
                    max: maxcurr,
                     values: [min, max],
                    range: true,

                    stop:function () {
                        var slideMin = $(elem).slider('values',0);
                        var slideMax = $(elem).slider('values',1);

                        minCostObj.text(slideMin)
                        maxCostObj.text(slideMax)

                        minObj.val(slideMin);
                        maxObj.val(slideMax);

                        minObj.change();
                    },

                    slide: function(event, ui){
                        var slideMin = $(elem).slider('values',0);
                        var slideMax = $(elem).slider('values',1);

                        minCostObj.text(slideMin)
                        maxCostObj.text(slideMax)

                        minObj.val(slideMin);
                        maxObj.val(slideMax);
                    }

                })
            })
        },
        bindForm : function() {
            var self = this;

            $(document).on("submit", this.params.form, function(e) {
                self.prepareBeforeMakeAjax();
                if (typeof useAjax !== 'undefined') {
                    e.preventDefault();
                    var _form = $(this);
                    var data2 = _form.serialize() + '&no_ajax_for_star_rating=1';
                    var action = _form.attr("action");
                    self.makeAjax(action, data2, _form, "GET", "all");
                }
            })
        },
        makeAjax : function(action, data2, _form, type, updateAll) {
            var self = this;

            $.ajax({
                url: action,
                data: data2,
                type: type,
                beforeSend:function() {
                    self.prepareBeforeSend(_form, updateAll);
                },
                success: function(msg) {
                    self.updateAfterSuccess(msg, _form, updateAll);
                }
            })
        },
        blurBlocks : function() {
            this.params.form_obj.css({'opacity' : '0.5'});
            this.params.result_list_obj.css({'opacity' : '0.5'});
        },
        unblurBlocks : function() {
            this.params.form_obj.css({'opacity' : '1'});
            this.params.result_list_obj.css({'opacity' : '1'});
        },
        showLoader : function() {
            this.params.loader_obj.show();
        },
        hideLoader : function() {
            this.params.loader_obj.hide();
        },
        insertResult : function(msg, selector) {

            if(this.params.more === '1'){
                $(selector).append($(msg).find(selector).html());
            }
            else{
                $(selector).html($(msg).find(selector).html());
            }
            this.afterInsertResult(msg);
            this.params.more = '0';

        },
        updateAfterSuccess : function(msg, _form, updateAll) {
            if (typeof afterFilterSend == 'function') {
                afterFilterSend(msg);
            }
            this.hideLoader();
            this.insertResult(msg, this.params.result_list);


                this.insertResult(msg, this.params.form);
             
            this.unblurBlocks();
            if (typeof(afterFilterComplete) == 'function') {
                afterFilterComplete(_form);
            }
        },
        prepareBeforeSend : function(_form, updateAll) {
            if (typeof beforeFilterSend == 'function') {
                beforeFilterSend(_form);
            }
            this.blurBlocks();
            this.showLoader();


        },
         prepareBeforeMakeAjax:function () {
             this.cleanForm();

         },
         cleanForm:function () {

             $(this.params.block).find('input, select').each(function (ind,elem) {
                 if($(elem).hasClass('fltr_min')){
                     var objs = $(this).parent();
                     var input1 = objs.find('.fltr_min');
                     var input2 = objs.find('.fltr_max');
                     // alert(input1.val());
                     // alert(input1.data('min-val'));
                     // alert(input2.val());
                     // alert(input2.data('max-val'));

                     if(input1.val() == input1.data('min-val') && input2.val() == input2.data('max-val')){
                         input1.removeAttr('name')
                         input2.removeAttr('name');

                     }
                 }
             })
         }
        
    }
    $(function () {
        wnd.eFilter = new eFilter();
    })
}(window, jQuery);
