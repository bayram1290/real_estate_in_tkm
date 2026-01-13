function file_upload(id, file, i) {
    const dragndrop = document.getElementById(`${i}`);
    const wrapper = dragndrop.nextSibling.nextSibling.childNodes[1].childNodes[1];
    const html = '<div class="col-md-3" style="margin-bottom: 4%;"><div class="img-up" onmouseover="showBtn(this)" onmouseout="hideBtn(this)">\n' +
        '                <input id="img_name_' + id + '"  type="hidden" value="">\n' +
        '                <div class="img-wrapper">\n' +
        '                    <img src="" alt="">\n' +
        '                    <button id="check" class="btn btn-success" onclick="makeMain(this,' + i.substring(5, i.length) + ')" title="Сделать главной картинкой"><i class="fa fa-check"></i></button>\n' +
        '                    <button id="times" class="btn btn-danger" onclick="deleteImg(this,' + i.substring(5, i.length) + ')" title="Удалить картинку"><i class="fa fa-times"></i></button>\n' +
        '                </div>\n' +
        '                <div class="progress" style="width: 100%; height: 20%">\n' +
        '                    <div id="' + id + '" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>\n' +
        '                </div>\n' +
        '            </div></div>';
    wrapper.innerHTML += html;
    if (document.getElementById(`mainImg_${dragndrop.id.substring(5, dragndrop.id.length)}`) == null) {
        const mainImg = document.createElement('input');
        mainImg.type = 'hidden';
        mainImg.name = 'mainImg';
        mainImg.id = `mainImg_${dragndrop.id.substring(5, dragndrop.id.length)}`;
        dragndrop.parentNode.insertBefore(mainImg, dragndrop);
    }
}

function uploadProgress(id, percent) {
    const progressBar = document.getElementById(id);
    progressBar.style.width = percent + "%";
    progressBar.textContent = percent + "%"
}

//Create hidden inputs that contains array of uploaded images
function createImageArray(id, data, i) {
    const dragndrop = document.getElementById(`${i}`);
    const newImage = document.createElement('input');
    newImage.type = "hidden";
    newImage.id = data;
    newImage.value = data;
    newImage.name = "img[]";
    dragndrop.parentNode.insertBefore(newImage, dragndrop);
    const img_wrapper = dragndrop.nextSibling.nextSibling.children;
    const mainImg = document.getElementById(`mainImg_${dragndrop.id.substring(5, dragndrop.id.length)}`);
    mainImg.value = `${window.location.protocol}//${window.location.hostname}/img/unconfirm_upload/${data}`;
    const img = img_wrapper[img_wrapper.length - 1].children[0].childNodes[img_wrapper[img_wrapper.length - 1].children[0].childNodes.length - 1].childNodes[0].childNodes[3].childNodes[1];
    img.src = `/img/unconfirm_upload/${data}`;
}