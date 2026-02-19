import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

document.addEventListener("DOMContentLoaded", function () {
  const dropzoneEl = document.querySelector('#my-dropzone');

  if (!dropzoneEl) return; // ⛔ Stop if element not found

  new Dropzone(dropzoneEl, {
    url: 'https://httpbin.org/post',
    maxFilesize: 5,
    acceptedFiles: 'image/*',
    addRemoveLinks: true,
    autoProcessQueue: true,
  });
});
