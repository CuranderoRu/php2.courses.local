'use strict';

let SERVER_ADDR = 'http://php1.courses.local/';
let _200_OK = 200;

function formHandler(context){
    console.log('нажата кнопка');
    //console.log(context);
}

function assignEventListeners(){
    let elements = document.querySelectorAll('item_form');
    for (let i = 1; i <= elements.image_count; i++) {
        console.log(elements[i]);
    }
}

assignEventListeners()

