'use strict';

let SERVER_ADDR = 'http://php1.courses.local/';
let _200_OK = 200;

function buildGallery(responseText) {
    let arrData;
    try {

        arrData = JSON.parse(responseText);

    } catch (e) {

        console.log(responseText);
        console.log('Ошибка ' + e.name + ":" + e.message + "\n" + e.stack);
        return;

    }


    document.querySelector('#prev').setAttribute('page_no', arrData.prev_page);
    document.querySelector('#next').setAttribute('page_no', arrData.next_page);
    let parDiv = document.querySelector('#galery_section');
    while (parDiv.firstChild) parDiv.removeChild(parDiv.firstChild);
    for (let i = 1; i <= arrData.image_count; i++) {
        let aData = eval("arrData.pics.pic" + i);
        if (aData.imglink == '') {
            break;
        }
        let cur_a = document.createElement('a');
        cur_a.setAttribute('href', aData.imglink);
        cur_a.setAttribute('target', "_blank");
        let cur_img = document.createElement('img');
        cur_img.setAttribute('src', aData.thmblink);
        cur_img.setAttribute('alt', aData.alt);
        cur_img.setAttribute('image_id', aData.image_id);
        cur_a.appendChild(cur_img);
        parDiv.appendChild(cur_a);
    }

}

function requestPageByNo(navpage) {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', SERVER_ADDR + 'gallery/galleryAPI.php?page_no=' + navpage, true);
    xhr.timeout = 15000;
    xhr.ontimeout = function () {
        console.log('Время ожидания истекло');
    }
    xhr.send();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === xhr.DONE) {
            if (xhr.status === _200_OK) {
                buildGallery(xhr.responseText);
            } else {
                console.log(xhr.status + ': ' + xhr.statusText['errno']);
            }
        }
    }
}

function navSectionClickHandler(event) {
    let obj = event.target;
    if (obj.id == "prev" || obj.id == "next") {
        let navpage = obj.getAttribute('page_no');
        if (navpage > 0) {
            requestPageByNo(navpage);
        }
    }


}


function initiateNav() {

    let nav = document.querySelector('#prev');
    nav.addEventListener("click", navSectionClickHandler, false);
    nav = document.querySelector('#next');
    nav.addEventListener("click", navSectionClickHandler, false);

}


initiateNav();
requestPageByNo(1);

