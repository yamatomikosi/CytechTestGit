
let $products = document.getElementsByClassName("product");
let $searched_products = document.getElementById("searchedProducts");

let $column = 10;
let $num = $products.length;
let $height = $products[0].offsetHeight;

let $column_num = Math.ceil($num / $column);
let $column_height = $column * $height;

let $search_button = document.getElementById("searchButton");

$searched_products.style.height = $height + $column_height + 6.7 + "px";

let $slider = document.getElementById("slider");
let $slider_elements = document.getElementsByClassName("slider_element");


for (i = 0; i < $num; i += 2) {
  $products[i].style.backgroundColor = "gray"
  $products[i].style.border = "solid black 1px"
}

$search_button.addEventListener("click", (e) => {

  $products = document.getElementsByClassName("product");
})

for (let i = 0; i < $column_num; i++) {

  let newElement = document.createElement("span");


  newElement.textContent = i + 1;
  newElement.className = "slider_element";

  $slider.insertBefore(newElement, $slider_elements[i + 1])

}



const activeClass = "active-page";

let $current_page = $slider_elements[1];
let $current_index = 1;

let $list_bottom = 9;
let $list_top = 0;

$current_page.classList.add(activeClass)

for (i = 0; i < $num; i++) {
  if (i < $list_top || $list_bottom < i) {
    $products[i].style.display = 'none';
  } else {
    $products[i].style.display = 'flex';
  }
};

for (let i = 0; i < $slider_elements.length; i++) {
  $slider_elements[i].addEventListener("mouseover", (e) => {
    e.target.classList.add(activeClass);
  });

  $slider_elements[i].addEventListener("mouseout", (e) => {
    if (e.target !== $current_page) {
      e.target.classList.remove(activeClass); // クラスを削除してスタイルをリセット
    }
  });

  $slider_elements[i].addEventListener("click", (e) => {

    if (e.target !== $current_page) {

      $current_page.classList.remove(activeClass);

      if (i === 0 || i === $slider_elements.length - 1) {
        if (i === 0) {
          if ($current_index > 1) {
            $current_index--;
          }
        } else if (i === $slider_elements.length - 1) {
          if ($current_index < $slider_elements.length - 2) {
            $current_index++;
          }
        }
        $current_page = $slider_elements[$current_index];
      } else {
        $current_page = e.target;
        $current_index = Array.from($slider_elements).indexOf($current_page);
      }
      $current_page.classList.add(activeClass);
      $list_bottom = $current_index * $column - 1;
      $list_top = $list_bottom - 9;


      for (let j = 0; j < $num; j++) {
        if (j < $list_top && j < $list_bottom) {
          $products[j].style.display = 'none';
        } else {
          $products[j].style.display = 'flex';
        }
      }
    }
  });

}



