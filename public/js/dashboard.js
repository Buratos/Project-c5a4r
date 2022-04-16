$(function () {
  // init_events();

  // ▪▪▪▪▪ пробовал 2 плагина для драг энд дроп загрузки фоток машин на сервер и они не дают получить файлы из инпута, хз где они их прячут, только сами отсылают
/*
  var photos_to_upload = $('#photos_to_upload').FancyFileUpload({
    params: {
      action: 'fileuploader'
    },
    maxfilesize: 10000000
  });
  var dropzone = $("#dropzone").dropzone({url: "/receive_photos"});
*/

  // клик на кнопки Send  и Clear data
  $('#send_data').on('click', send_new_ad_to_server);
  $('#save_data').on('click', send_new_ad_to_server_for_update);
  $('#clear_data').on('click', clear_data);
  $(document).on("change", "#brand_list", load_car_model_datalist);

  /*******************************************************************************
   FUNCTIONS
   *******************************************************************************/

  // подгрузка моделей машин после выбора брэнда
  function load_car_model_datalist(event) {
    event.stopPropagation(); // остановка всех текущих JS событий
    //event.preventDefault();  // остановка дефолтного события для текущего элемента - клик для <a> тега

    var brand_name = $(this).val();
    if (brand_name.length < 3) return;

    // brand_name = {};
    // brand_name["brand"] = "TEST";
    // AJAX запрос
    $.ajax({
      url: 'load_car_model_datalist',
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {data: JSON.stringify(brand_name)},
      cache: false,
      dataType: 'json',
      success: function (response, status, jqXHR) {
        if (response.success) {
          $("#car_model_datalist").html(response.html)
          $("#car_model_list").val("");
          $(".car_model_selection").removeClass("d-none");
          $(".first_choose_brand").addClass("d-none");
          $(".no_models_found").addClass("d-none");
        }
        else {
          $(".first_choose_brand").addClass("d-none");
          $(".car_model_selection").addClass("d-none");
          $(".no_models_found").removeClass("d-none");
        }
      },
      error: function (jqXHR, status, errorThrown) { // функция ошибки ответа сервера
        console.log('load_car_model_datalist ОШИБКА отправки : ' + status, jqXHR);
        // alert("load_car_model_datalist ОШИБКА отправки");
      }
    });
  }

  // отправка новой машины на сервак
  function send_new_ad_to_server(event) {
    event.stopPropagation(); // остановка всех текущих JS событий
    //event.preventDefault();  // остановка дефолтного события для текущего элемента - клик для <a> тега

    //    if (!validate_form_data()) return;

    // создадим объект данных формы
    var data = new FormData(document.forms.add_new_car_form);

    // заполняем объект данных файлами в подходящем для отправки формате
    var files = $("#input__upload_photos")[0].files;
    $.each(files, function (key, value) {
      data.append(key, value);
    });
    // debugger

    // AJAX запрос
    $.ajax({
      url: 'receive_and_save_new_ad',
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: data,
      cache: false,
      // dataType: 'json',
      processData: false, // отключаем обработку передаваемых данных, пусть передаются как есть
      contentType: false, // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
      success: function (response, status, jqXHR) {
        $(".car_list").html(response.html);
      },
      error: function (jqXHR, status, errorThrown) { // функция ошибки ответа сервера
        console.log('add new car ОШИБКА отправки : ' + status, jqXHR);
        // alert("add new car ОШИБКА отправки");
      }
    });
  }

  // отправка новой машины на сервак
  function send_new_ad_to_server_for_update(event) {
    // event.stopPropagation(); // остановка всех текущих JS событий
    event.preventDefault();  // остановка дефолтного события для текущего элемента - клик для <a> тега

    //    if (!validate_form_data()) return;

    // создадим объект данных формы
    var data = new FormData(document.forms.add_new_car_form);

    // заполняем объект данных файлами в подходящем для отправки формате
    var files = $("#input__upload_photos")[0].files;
    $.each(files, function (key, value) {
      data.append(key, value);
    });
    // debugger

    // AJAX запрос
    $.ajax({
      url: 'receive_and_update_model',
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: data,
      cache: false,
      // dataType: 'json',
      processData: false, // отключаем обработку передаваемых данных, пусть передаются как есть
      contentType: false, // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
      success: function (response, status, jqXHR) {
        $(".car_list").html(response.html);
      },
      error: function (jqXHR, status, errorThrown) { // функция ошибки ответа сервера
        console.log('add new car ОШИБКА отправки : ' + status, jqXHR);
        // alert("add new car ОШИБКА отправки");
      }
    });
  }

  // коллбэк успешного ответа сервера
  function successful_response(response, status, jqXHR) {
    return
    if (undef(response.error)) {
      // вывожу всё на экран
      var files_path = response.files;
      var html_str = '';
      $.each(files_path, function (key, val) {
        html_str += val + '<br>';
      });
      $('.php_response').removeClass("warning").html(html_str);
    }
    // скрипт PHP обнаружил непорядок и сообщил об ошибке
    else {
      var errors = response.error;
      var html_str = "<p>";
      $.each(errors, function (key, val) {
        html_str += val + "<br>";
      });
      $(".php_response").addClass("warning").html(html_str);
    }
  }

  /**
   проверка введённых данных в форме. Если чтото не так, то возвращает FALSE
   */
  function validate_form_data() {
    var all_is_ok = true;

    if (empty($("#login").val()) || ($("#login").val().length < 5)) {
      all_is_ok = false;
      $(".login").addClass("warning");
    }
    else {
      $(".login").removeClass("warning");
    }

    if (empty($("#password").val()) || ($("#login").val().length < 10)) {
      all_is_ok = false;
      $(".password").addClass("warning");
    }
    else {
      $(".password").removeClass("warning");
    }

    if (empty($("input[name='pol']:checked").val())) {
      all_is_ok = false;
      $(".pol").addClass("warning");
    }
    else {
      $(".pol").removeClass("warning");
    }

    if (empty($("#profession").val())) {
      all_is_ok = false;
      $(".profession").addClass("warning");
    }
    else {
      $(".profession").removeClass("warning");
    }

    if ($("#range100").val() < 50) {
      all_is_ok = false;
      $(".range100").addClass("warning");
    }
    else {
      $(".range100").removeClass("warning");
    }

    if (empty($("#email").val())) {
      all_is_ok = false;
      $(".email").addClass("warning");
    }
    else {
      $(".email").removeClass("warning");
    }

    if (empty($("#date").val())) {
      all_is_ok = false;
      $(".date").addClass("warning");
    }
    else {
      $(".date").removeClass("warning");
    }

    if (empty($("#color").val())) {
      all_is_ok = false;
      $(".color").addClass("warning");
    }
    else {
      $(".color").removeClass("warning");
    }

    if (empty($("#phone").val())) {
      all_is_ok = false;
      $(".phone").addClass("warning");
    }
    else {
      $(".phone").removeClass("warning");
    }

    if (empty($("#url").val())) {
      all_is_ok = false;
      $(".url").addClass("warning");
    }
    else {
      $(".url").removeClass("warning");
    }

    if (empty($("#search").val())) {
      all_is_ok = false;
      $(".search").addClass("warning");
    }
    else {
      $(".search").removeClass("warning");
    }

    if (empty($("#month").val())) {
      all_is_ok = false;
      $(".month").addClass("warning");
    }
    else {
      $(".month").removeClass("warning");
    }

    var files = $("#files_input")[0].files;
    if (!files.length) {      // ни одного файла не выбрано
      $(".files").addClass("warning");
      all_is_ok = false;
    }
    else {
      $(".files").removeClass("warning");
    }

    return all_is_ok;
  }

  /*
   очистка введенных данных в форме
   */
  function clear_data(event) {

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

  /*
   Установка обработчиков событий
   */
  function init_events() {


    $(document).on("click", "[data-func=clear_filters]", datafunc_click_handler);
    $(document).on("click", "a, button", {}, datafunc_click_handler);

    // $(document).on("change", ".filter_checkbox", filter_click_handler);
    // $(document).on("change", "input.filter_checkbox", reload_filtered_product_numbers);

    // КЛИК ПО INPUT ДЛЯ ПОИСКА
    /*
     $(document).on("focus", "#search_input", "ничо не передаю в event.data", function (event) {
     $("body").addClass("search_focus");

     $(document).on("click", ".search_background", {}, function (event) {
     if (event.target != event.currentTarget) return;
     $("body").removeClass("search_focus");
     $(this).off("click");
     });
     });
     */

  }


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


});

/*    $(document).on("click", "#apply_colour", {}, function () {
 var color = String($("#hex_colour").val());
 if (!color) color = "#AAAAAA";
 $("#colour_me").css("background-color", color);
 });
 */