let $backpage = document.getElementById("backPage");
$backpage.addEventListener('click', () => {
  history.back();
})

let $img_path = document.getElementById("imgPath");
let $img_path_pver = document.getElementById("imgPathPrev");

$img_path.addEventListener('change', function () {
  const reader = new FileReader();
  reader.onload = function (ev) {
    $img_path_pver.src = ev.target.result;
  }
  reader.readAsDataURL(this.files[0]);
})
