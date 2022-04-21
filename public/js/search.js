$(function () {
  init_events();


  function search_input_handler(event) {
    if (typeof(search_input_handler.saved_search_phrase) == "undefined") search_input_handler.saved_search_phrase = "";

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
    var words = search_str.split(" ");
    words = words.filter(function(item, index) {
      return item.length >= 2;
    });
    if (words.length == 0) return;
    search_str = words.slice(0,2).join(" ");
    if (search_str == search_input_handler.saved_search_phrase) return;
    bip();
    search_input_handler.saved_search_phrase = search_str;

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


  /*
   Установка обработчиков событий
   */
  function init_events() {
    // обработчик клика кнопка-checkbox  фильтра
    $(document).on("keyup", "#search, #search_mobile", search_input_handler);
  }


});

