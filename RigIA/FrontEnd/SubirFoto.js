const dropZoon = document.querySelector('#zona');
const icon = document.querySelector(".icon")
const fileInput = document.querySelector('#fileInput');
const previewImage = document.querySelector('#previewImage');


const imagesTypes = [
  "jpeg",
  "jpg",
  "png",
  "bmp",
  "gif"
];

dropZoon.addEventListener('dragover', function (event) {
  event.preventDefault();
  dropZoon.classList.add('drop-zoon--over');
});

dropZoon.addEventListener('dragleave', function (event) {
  dropZoon.classList.remove('drop-zoon--over');
});
dropZoon.addEventListener('drop', function (event) {
  event.preventDefault();
  dropZoon.classList.remove('drop-zoon--over');
  const file = event.dataTransfer.files[0];
  previewFile(file);
});

dropZoon.addEventListener('click', function (event) {
  fileInput.click();
});

fileInput.addEventListener('change', function (event) {
  const file = event.target.files[0];
  previewFile(file);
});

function previewFile(file) {
  const fileReader = new FileReader();
  const fileType = file.type;
  const fileSize = file.size;

  if (fileValidate(fileType, fileSize)) {
    icon.classList.add('--Uploaded');

    fileReader.addEventListener('load', function () {
      setTimeout(function () {
        previewImage.style.display = 'block';
      }, 500);
      previewImage.setAttribute('src', fileReader.result);
    });
    fileReader.readAsDataURL(file);
  } else {
    this; 

  };
};


function fileValidate(fileType, fileSize) {
  let isImage = imagesTypes.filter((type) => fileType.indexOf(image/$,{type}) !== -1);


  if (isImage.length !== 0) {
    if (fileSize <= 2000000) { 
      return true;
    } else { 
      return alert('Please Your File Should be 2 Megabytes or Less');
    };
  } else { 
    return alert('Please make sure to upload An Image File Type');
  };
};