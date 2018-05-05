'use strict';

var _200_OK = 200;
var d = document;

// кроссбраузерная установка обработчика событий
function addEvent(elem, type, handler) {
    if (elem.addEventListener) {
        elem.addEventListener(type, handler, false);
    } else {
        elem.attachEvent('on' + type, handler);
    }
    return false;
}
// Универсальная функция для создания нового объекта XMLHttpRequest
function getXhrObject() {
    if (typeof XMLHttpRequest === 'undefined') {
        XMLHttpRequest = function () {
            try {
                return new window.ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {}
        };
    }
    return new XMLHttpRequest();
}
// Функция Ajax-запроса
function sendAjaxRequest(e) {
    var evt = e || window.event;
    // Отменяем стандартное действие формы по событию submit
    if (evt.preventDefault) {
        evt.preventDefault(); // для нормальных браузров
    } else {
        evt.returnValue = false; // для IE старых версий
    }
    var myform = evt.srcElement;
    // получаем новый XMLHttpRequest-объект
    var xhr = getXhrObject();
    if (xhr) {
        // формируем данные формы
        var elems = myform.elements, // все элементы формы
            url = myform.action, // путь к обработчику
            params = new Object(),
            elName,
            elType;
        // проходимся в цикле по всем элементам формы
        params['id'] = myform.getAttribute("item_id");
        for (var i = 0; i < elems.length; i++) {
            elType = elems[i].type; // тип текущего элемента (атрибут type)
            elName = elems[i].name; // имя текущего элемента (атрибут name)
            if (elName) { // если атрибут name присутствует
                // если это переключатель или чекбокс, но он не отмечен, то пропускаем
                if ((elType == 'checkbox' || elType == 'radio') && !elems[i].checked) continue;
                params[elems[i].name] = elems[i].value;
            }
        }
        // Для GET-запроса 
        //url += '?' + params.join('&');

        xhr.open('POST', url, true); // открываем соединение
        // заголовки - для POST-запроса
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == _200_OK) { 
                // output.innerHTML = JSON.parse(xhr.responseText);
                //console.log(xhr.responseText);
                
                
                var response = JSON.parse(xhr.responseText);
                alert(response.message);
            }
        }
        // стартуем ajax-запрос
        var sts = JSON.stringify(params);
        console.log(sts);
        xhr.send(sts); // для GET запроса - xhr.send(null);
    }
    return false;
}


// Инициализация после загрузки документа
function init() {
    var arrForms = d.getElementsByClassName('item_form');
    for (var i = 0; i <= arrForms.length-1; i++) {
        var myform = arrForms[i];
        //addEvent(myform, 'submit', sendAjaxRequest);
        addEvent(myform, 'submit', sendAjaxRequest);
    }

    //output = d.getElementById('output');
    //myform = d.getElementById('my_form');
    //addEvent(myform, 'submit', sendAjaxRequest);
    return false;
}

// Обработчик события загрузки документа
addEvent(window, 'load', init);
