### author webber (web-ber12@yandex.ru)

### набор eFilter - автоматическое построение фильтров товаров в MODx Evo (версия 0.1)

### DONATE
---------
если считаете данный продукт полезным и хотите отблагодарить автора материально,
либо просто пожертвовать немного средств на развитие проекта - 
можете сделать это на любой удобный Вам электронный кошелек в системе <strong>Webmoney</strong><br>
<strong>WMR:</strong> R133161482227<br>
<strong>WMZ:</strong> Z202420836069<br>
с необязательной пометкой от кого и за что именно :)


### содержит:
- модуль eLists - для удобного формирования списков значений ТВ (чтобы не захламлять дерево и визуально понятно их редактировать)
- плагин tovarParams - для показа в админке при редактировании товара только тех параметров, которые заданы для данной категории товаров
- набор сниппетов для формирования формы и проведения фильтрации

### обязательные дополнительные компоненты (без их установки решение не работает):
- сниппет DocLister
- компонент multiTV
- сниппет DocInfo

### установка

1. создать шаблон для вывода товара



2. Отредактировать параметры настройки модуля  - &param_tv_id=ID TV параметров товара;string; &product_templates_id=ID шаблонов товара;string; &param_cat_id=ID категории параметров;string; &exclude_tvs_from_list=Не включать ТВ в параметры при выводе;string; &tovarChunkName=Имя чанка вывода товара;string;
где
&param_tv_id - id tv в котором размещается вызов multiTV для настройки параметров товара (созданный в пункте 2)
&product_templates_id=ID шаблонов товара  - они общие для всех видов товаров (может быть несколько через запятую)
&param_cat_id=ID категории параметров (фильтруемые параметры TV и просто параметры для товаров в TV должны быть помещены для идентификации в отдельную категорию/категории - например "Параметры товара" - id этой категории и необходимо сюда внести
              это очень важно
&exclude_tvs_from_list=Не включать ТВ в параметры при выводе - т.к. изначально в списке параметров будут выведены все параметры для данного типа товара из категории "Параметры товара", то можно его проредить, убрав ненужные ТВ (например цена, наличие и другие общие параметры для всех товаров которые можно вывести отдельно) 
&tovarChunkName=Имя чанка вывода товара;string - имя чанка вывода товара в список (используется вместо задания &tpl) 

6. Для каждой категории товаров можно настроить в TV "Параметры товара" из multiTV свой набор для параметров товара
7. На страницах категорий товаров, где необходим фильтр разместить вызов сниппета [!eFilter!] (либо [!eFilter? &tv_config=`[*tovarparams*]`!], где tovarparams - это имя TV, в котором хранится json-конфиг из multiTV - это ускоряет обработку), затем - в нужном месте шаблона плейсхолдер для вывода формы фильтра [+eFilter_form+] и сниппет для вывода результата 
например

    <b>Дополнительные параметры вызова сниппета eFilter</b>
	&hide_zero=`1` - если не указан, то при отсутствии вариантов показывает в количестве найденных 0, если указан - ничего не показывает
    &remove_disabled=`1` - удалять варианты с нулевым результатом из списка возможных (по умолчанию - 0 - варианты в списке остаются с атрибутом disabled)
	&autoSubmit=`0` - не сабмитить форму при изменении, не забудьте в этом случае в шаблон формы добавить кнопку submit ( по умолчанию - ничего задавать не нужно - форма сабмитится автоматически после каждого изменения). 
    &ajax=`1` - режим ajax - подгрузка формы и результатов поиска после сабмита формы поиска без перезагрузки страницы (по умолчанию - отключен)
	в режиме ajax три callback-функции javascript
		- beforeFilterSend(_form) - исполняется до отправки состояния формы на сервер
		- afterFilterSend(msg) - исполняется после получения ответа от сервера msg
		- afterFilterComplete(_form) - исполняется после обновления фильтра и результатов поиска из ответа на сервере

        [!eFilterResult? &parents=`[*id*]` &depth=`3` &paginate=`pages` &display=`15` &tvList=`image,price`!]

        [+pages+]

        в данном сниппете используется DocLister, собственно, параметры вызова аналогичны.
        В чанке вывода товара в список &tpl плейсхолдер [+params+] будет заменен на список установленных для данной категории товаров параметров товара
        В параметре &tvList=`image,price` включаем нужные параметры из других категорий, а также общих tv-параметров для всех видов товаров
8. У нужном месте шаблона вывода товара (он у нас общий для всех видов товаров) помещаем вызов сниппета [[tovarParams]] для вывода нужного списка нужных ТВ из категории "Параметры товара" (id этой категории задан в модуле и он важен для всей работы).
9. Для удаления недоступных для выбора вариантов надо вызывать фильтр с параметром &remove_disabled=`1` - [!eFilter? &remove_disabled=`1`!]

### Примеры
http://efilter.sitex.by/odezhda/muzhskaya/
http://efilter.sitex.by/aksessuary/aksessuary-dlya-odezhdy/solncezashhitnye-ochki/

один и тот же фильтр формируется исходя из заданных и имеющихся в наличии параметров для конкретной категории товаров (если для категории не задано, то берется фильтр родительской категорий).
(кнопки мужская(10), женская(10) и детская (10) не являются частью фильтра - это элемент дизайна)


### Сотрудничество:
---------
По вопросам сотрудничества обращайтесь на электронный ящик web-ber12@yandex.ru
