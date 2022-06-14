$(function () {
  init_events();


  /*******************************************************************************
   FUNCTIONS
   *******************************************************************************/

  function init_events() {
    // клик на кнопки Send  и Clear data
    $('#send_data').on('click', send_new_ad_to_server);
    $('#clear_data').on('click', clear_data);
    $(document).on("change", "#brand_list", load_car_model_datalist);
  }

  // подгрузка моделей машин после выбора брэнда
  function load_car_model_datalist(event) {
    // event.stopPropagation(); // остановка всех текущих JS событий
    event.preventDefault();  // остановка дефолтного события для текущего элемента - клик для <a> тега

    var brand_name = $(this).val();
    if (brand_name.length < 3) return;

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

    // AJAX запрос
    $.ajax({
      url: 'receive_and_save_new_ad',
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: data,
      cache: false, // dataType: 'json',
      processData: false, // отключаем обработку передаваемых данных, пусть передаются как есть
      contentType: false, // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
      success: function (response, status, jqXHR) {
        $(".car_list").html(response.html);
      },
      error: function (jqXHR, status, errorThrown) { // функция ошибки ответа сервера
        console.log('add new car ОШИБКА отправки : ' + status, jqXHR);
        if (jqXHR.status == 422) { // Input data has not been validated
          clog("INPUT DATA HAS NOT BEEN VALIDATED");
          Object.keys(jqXHR.responseJSON.errors).forEach(function (key) {
            if (key == "message") return ;
            if (!Array.isArray(jqXHR.responseJSON.errors[key])) return ;
            clog(" -> ", jqXHR.responseJSON.errors[key][0]);
          });
          /*
           for (let key of Object.keys(jqXHR.responseJSON.errors)) {
           if (key == "message") continue;
           if (!Array.isArray(jqXHR.responseJSON.errors[key])) continue;
           clog(" -> ", jqXHR.responseJSON.errors[key][0]);
           }
           */
        }
      }
    });
  }


  /*
   очистка введенных данных в форме
   */
  function clear_data(event) {

  }
});
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
