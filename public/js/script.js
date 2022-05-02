$(function () {

  init_events();


  /*  открыть фильтры
   var elem = $('#filters_global_container');
   elem.collapse("toggle")
   // распахнуть фильтры на мобилке
   if (mobile_viewport()) {
   $("body").css("pointer-events", "none");
   elem.addClass("h-100");
   }
   */

  /*
   создание динамического поиска, надо ввести 3+ букв чтобы начался поиск в БД
   */
/*
  function search_input_handler(event) {
    if (mobile_viewport()) {
      var div_title = ".dynamic_search_results_mobile";
      var input_title = "#search_mobile";
    }
    else {
      var div_title = ".dynamic_search_results";
      var input_title = "#search";
    }
    dynamic_search_results = $(div_title);
    var search_str = $(input_title).val();
    if (search_str.length < 2) {
      dynamic_search_results.addClass("d-none");
      return;
    }
    // bip();
    $.ajax({
      url: '/dynamic_search',
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {data: search_str},
      dataType: 'json',
      success: function (response_data, b, c) {
        if (!response_data.success) {
          dynamic_search_results.addClass("d-none");
          return;
        }
        dynamic_search_results.removeClass("d-none");
        dynamic_search_results.html(response_data.html)
        var handle = function (event) {
          dynamic_search_results.addClass("d-none");
          $(document).off("click", "*", handle);
        }
        $(document).on("click", "*", handle);
      },
      error: function (jqXHR, status, errorThrown) { // функция ошибки ответа сервера
        console.log('DYNAMIC_SEARCH > ОШИБКА AJAX запроса: ' + status, jqXHR);
      }
    });

  }
*/

  // клик по фильтру
  function filter_click_handler(e) {
    var data_func = $(this).attr("data-func");
    if (data_func == undefined) data_func = "filters_checkbox";
    switch (data_func) {
      case "filters_checkbox" :
        e.stopImmediatePropagation();
        check_and_process_filters_and_xbtns();
        reload_filtered_product_numbers();
        // for___test();
        break;
      case "apply_filters__price" :
        e.stopImmediatePropagation();
        break;
      default:
        break;
    }
  }

  function load_more() {
    var btn_load_more = $(".btn_load_more");
    var already_loaded_pages = Number(btn_load_more.attr("data-already-loaded-pages"));

    $.ajax({
      url: 'default_content_load_more',
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {data: already_loaded_pages},
      dataType: 'json',
      success: function (response_data, b, c) {
        btn_load_more.attr("data-already-loaded-pages", response_data.new_already_loaded_pages);
        $(".car_list_container").append(response_data.content);
        $(".total_loaded_cars").text(response_data.total_loaded_cars);
      },
      error: function (jqXHR, status, errorThrown) { // функция ошибки ответа сервера
        console.log('default_content_load_more > ОШИБКА AJAX запроса: ' + status, jqXHR);
      }
    });
  }

  /*
   обработчик клика по кнопкам, у которых установлен параметр data-func
   */
  function datafunc_click_handler(e) {
    var func = $(e.currentTarget).attr("data-func");
    if (!func) return;
    switch (func) {
      case "close_fullscreen_photo" :
        $(".product_photos").removeClass("fullscreen_photos");
        e.stopImmediatePropagation();
        break;
      case "show_filters":
        var elem = $('#filters_global_container');
        elem.collapse("toggle")
        if (get_viewport_mode() == "576-" && $("#filters_global_container ").hasClass("show")) {
          // закрыть фильтры на мобилке
          $("body").css("pointer-events", "auto");
          elem.removeClass("h-100");
        }
        else if (get_viewport_mode() == "576-") {
          // распахнуть фильтры на мобилке
          $("body").css("pointer-events", "none");
          elem.addClass("h-100");
        }
        clog(get_viewport_mode());
        break;
      case "clear_filters" :
        // e.stopPropagation();
        e.stopImmediatePropagation();
        $(this).addClass("d-none");
        var parent = find_parent($(this), "accordion-item");
        var filter_set = parent.find(".btn_checkbox > input");
        filter_set.prop("checked", false);
        check_and_process_filters_and_xbtns();
        reload_filtered_product_numbers();
        // load_filtered_list_of_products();
        break;
      case "clear_all_filters" :
        e.stopImmediatePropagation();
        $("*[data-func=clear_all_filters]").addClass("d-none");
        var filter_set = $(".btn_checkbox > input");
        filter_set.prop("checked", false);
        check_and_process_filters_and_xbtns();
        reload_filtered_product_numbers();
        // load_filtered_list_of_products();

        break
        var filter_set = $(".filter_checkbox");
        filter_set.prop("checked", false);
        $("#price_min").val("0");
        $("#price_max").val("0");
        check_and_process_filters_and_xbtns();
        reload_filtered_product_numbers();
        load_filtered_list_of_products();
        break;
      case "apply_filters":
        if ($("*[data-func=clear_all_filters]").eq(0).hasClass("d-none")) break;
        // применить фильтры и закрыть окно
        $('#filters_global_container').removeClass("h-100");
        $('#filters_global_container').collapse("toggle");
        $("body").css("pointer-events", "auto");
        break;
      case "close_fullscreen_filters":
        $('#filters_global_container').removeClass("h-100");
        $('#filters_global_container').collapse("toggle");
        $("body").css("pointer-events", "auto");
        break;
      case "apply_price_filter" :
        break;
      case "load_more" :
        load_more();
        break;

        check_and_process_filters_and_xbtns();
        reload_filtered_product_numbers();
        load_filtered_list_of_products();
      default:
        break;
    }

  }

  function check_and_process_filters_and_xbtns() {
    var filter_groups = $(".filters_content .accordion-item");
    var total_checked_counter = 0;

    for (let i = 0; i < filter_groups.length; i++) {
      var filter_inputs = filter_groups.eq(i).find("input[name^=filters_checkbox__]");
      var checked_counter = 0;
      for (let j = 0; j < filter_inputs.length; j++) {
        if (filter_inputs.eq(j).is(":checked")) checked_counter++;
      }
      total_checked_counter += checked_counter;
      if (checked_counter) {
        var number_and_xbtn = filter_groups.eq(i).find("a[data-func=clear_filters]");
        number_and_xbtn.find("span").text(checked_counter);
        number_and_xbtn.removeClass("d-none");
      }
      else {
        filter_groups.eq(i).find("a[data-func=clear_filters]").addClass("d-none");
      }
    }

    var clear_all_filters_btn = $("#filters_global_container").find("[data-func=clear_all_filters]");
    clear_all_filters_btn.each(function (index, element) {
      if (total_checked_counter) $(this).removeClass("d-none"); else $(this).addClass("d-none");
    });
  }

  function reload_filtered_product_numbers(e) {
    var checked_filters_by_groups = get_checked_filers(); // возвращает объект

    // отсылаю включенные фильтры и получаю цифры товаров для каждого невключенного фильстра с учетом включенных
    $.ajax({
      url: 'load_filters_numbers',
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {data: JSON.stringify(checked_filters_by_groups)},
      dataType: 'json',
      success: function (response_data, b, c) {
        $(".paginator__test_container").html(response_data.template);

        var filters = response_data.filters;
        $(".total_cars_found").each(function () {
          $(this).text(response_data.total_cars_found);
        });
        for (var category of Object.keys(filters)) {
          for (var key of Object.keys(filters[category])) {

            let span_tag_with_number = $(`#${category + "_" + filters[category][key].id}`);
            if (filters[category][key].checked) span_tag_with_number.addClass("d-none"); else span_tag_with_number.removeClass("d-none").text(filters[category][key].count);
          }
        }
      },
      error: function (jqXHR, status, errorThrown) { // функция ошибки ответа сервера
        console.log('reload_filtered_product_numbers > ОШИБКА AJAX запроса: ' + status, jqXHR);
      }
    });
  }

  /*
   загружает список страницу товаров с учетом фильтров и view_type список/карточки
   */
  function load_filtered_list_of_products() {
    var checked_filters = get_checked_filers();
    if (!myapp.sorting_method) myapp.sorting_method = SORT_NAME;
    if (!myapp.page_number) myapp.page_number = 1;

    load_products(checked_filters, myapp.page_number, 50, myapp.sorting_method);
  }

  // возвращает список включенных фильтров, включая цены
  function get_checked_filers() {
    var checked_filters = $(".btn_checkbox_filters > :checkbox:checked");
    var checked_filters_by_groups = {};
    for (let i = 0; i < checked_filters.length; i++) {
      let group_name = find_parent_by_attr(checked_filters.eq(i), "data-group-name").attr("data-group-name");
      if (!checked_filters_by_groups[group_name]) checked_filters_by_groups[group_name] = [];

      var value = checked_filters.eq(i).attr("data-value");
      checked_filters_by_groups[group_name].push(value);
    }
    return checked_filters_by_groups;
  }


  /*
   Установка обработчиков событий
   */
  function init_events() {
    // обработчик клика кнопка-checkbox  фильтра
    // $(document).on("change", "input[type=checkbox,name^='filters_']", filter_click_handler);
    $(document).on("click", "*[data-func]", {}, datafunc_click_handler);
    $(document).on("change", "input[name^=filters_checkbox__]", filter_click_handler);
    $(document).on("click", "*[data-func^=apply_filters_]", {}, filter_click_handler);
    // $(document).on("keyup input", "#search, #search_mobile", search_input_handler);
    $(document).on("click", "a, button", {}, datafunc_click_handler);


  }

});

/*
 в зависимости размера вьюпорта возвращает одно из 3х значений:
 "576-"    "576+"    "768+"
 при этом в CSS надо добавить такой код:
 @media only screen and (max-width: 575.98px) {
 body {
 content: "576-";
 }
 }
 @media only screen and (min-width: 576px) {
 body {
 content: "576+";
 }
 }
 @media only screen and (min-width: 768px) {
 body {
 content: "768+";
 }
 }
 */
function get_viewport_mode() {
  var response = "768+";
  switch ($("body").css("content")) {
    case '\"576-\"' :
      response = "576-";
      break;
    case '\"576+\"' :
      response = "576+";
      break;
    case '\"768+\"' :
      response = "768+";
      break;
  }
  return response;
}

/*
 вернёт true, если это вьюпорт телефона/планшета вертикально
 */
function mobile_viewport() {
  return $("body").css("content") == '\"576-\"';
}
