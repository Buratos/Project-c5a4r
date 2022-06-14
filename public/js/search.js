$(function () {
  init_events();


  function submit_test(event) {
    debugger
  }

  function search_input_handler(event) {
    if (typeof (search_input_handler.saved_search_phrase) == "undefined") search_input_handler.saved_search_phrase = "";

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
    words = words.filter(function (item, index) {
      return item.length >= 2;
    });
    if (words.length == 0) return;
    search_str = words.slice(0, 2).join(" ");

    var request_type, request_url;
    if (event.data.dynamic) {
      event.preventDefault();  // disable other event handlers
      if (search_str == search_input_handler.saved_search_phrase) return;
      search_input_handler.saved_search_phrase = search_str;
      request_type = "POST";
      request_url = "/dynamic_search";
    }
    else {
      request_type = "GET";
      request_url = "/search";
      return
    }

    $.ajax({
      url: request_url,
      type: request_type,
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
    // load results for dynamic search
    $(document).on("keyup", "#search, #search_mobile", {dynamic: true}, search_input_handler);
    // Enter-key pressed in the search input
    $(document).on("submit ", "#search_form"/*"#search, #search_mobile"*/, {dynamic: false}, search_input_handler);
    // click on search-btn
    $(document).on("click", "#btn_search_submit", {dynamic: false}, search_input_handler);
  }


});

/*
 вернёт true, если это вьюпорт телефона/планшета вертикально
 */
function mobile_viewport() {
  return $("body").css("content") == '\"576-\"';
}
