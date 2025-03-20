$(function () {
  let $products = document.getElementsByClassName("product");
  let $searched_products = document.getElementById("searchedProducts");

  let $column = 10;
  let $num = $products.length;
  let $height = $products[0].offsetHeight;

  let $column_num = Math.ceil($num / $column);
  let $column_height = $column * $height;

  $searched_products.style.height = $column_height + 6.7 + "px";

  let $slider = document.getElementById("slider");
  let $slider_elements = document.getElementsByClassName("slider_element");


  for (i = 0; i < $num; i += 2) {
    $products[i].style.backgroundColor = "gray"
    $products[i].style.border = "solid black 1px"
  }


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
              $current_page = $slider_elements[$current_index];
            }
          } else if (i === $slider_elements.length - 1) {
            if ($current_index < $slider_elements.length - 2) {
              $current_index++;
              $current_page = $slider_elements[$current_index];
            }
          }
          
        } else {
          $current_page = e.target;
          $current_index = Array.from($slider_elements).indexOf($current_page);
        }
        $current_page.classList.add(activeClass);
        $list_bottom = $current_index * $column - 1;
        $list_top = $list_bottom - 9;


        for (let j = 0; j < $num; j++) {
          if (j < $list_top || $list_bottom < j) {
            $products[j].style.display = 'none';
          } else {
            $products[j].style.display = 'flex';
          }
        }
      }
    });

  }




  $('.product_delete_button').on('click', function () {

    let clickEle = $(this);

    $.ajax({
      url: 'product_informants',
      type: 'GET',
      dateType: 'html',
      data: {
        'remove_id': $(this).val(),
      }
    })

      .done(function (response) {
        clickEle.parents('.product').remove();
        console.log(response);
      })

      .fail(function (jqXHR, textStatus, errorThrown) {
        alert('Ajax通信に失敗しました。');
        console.log("jqXHR          : " + jqXHR.status);
        console.log("textStatus     : " + textStatus);
        console.log("errorThrown    : " + errorThrown.message);
      });
  });


  $(document).on('submit', "#Search", function (event) {

    event.preventDefault();

    let formData = new FormData(this);
    formData.append('is_search', true);
    $.ajax({
      url: 'product_informants',
      type: 'POST',
      data: formData,
      dateType: 'json',
      processData: false,
      contentType: false,
    })
      .done(function (response) {
        updateListView(response);

        $products = document.getElementsByClassName("product");
        $num = $products.length;
        $column_num = Math.ceil($num / $column);
        $column_height = $column * $height;

        $('.slider_element').not('.slider--to-side').remove();
        for (let i = 0; i < $column_num; i++) {

          let newElement = document.createElement("span");


          newElement.textContent = i + 1;
          newElement.className = "slider_element";

          $slider.insertBefore(newElement, $slider_elements[i + 1])

        }
        $slider_elements = document.getElementsByClassName("slider_element");
        $current_page = $slider_elements[1];
        $current_index = 1;
        for (i = 0; i < $num; i += 2) {
          $products[i].style.backgroundColor = "gray"
          $products[i].style.border = "solid black 1px"
        }

        $list_bottom = 9;
        $list_top = 0;

        $('.slider_element').removeClass(activeClass);
        $('.slider_element').eq(1).addClass(activeClass);

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
              e.target.classList.remove(activeClass); 
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
                if (j < $list_top || $list_bottom < j) {
                  $products[j].style.display = 'none';
                } else {
                  $products[j].style.display = 'flex';
                }
              }
            }
          });
      
        }
      })

      .fail(function (jqXHR, textStatus, errorThrown) {

        alert('Ajax通信に失敗しました。');
        console.log("jqXHR          : " + jqXHR.status);
        console.log("textStatus     : " + textStatus);
        console.log("errorThrown    : " + errorThrown.message);
      });

  });

});

function updateListView(products) {
  $('#searchedProducts').empty();

  $.each(products, function (_, product) {
    $('#searchedProducts').append('<div class="product">'
      + '<dd class="order--id sort-button">' + product.id + '.</dd>'
      + '<img class = "product_img sort-button""  src = " ' + product.img_path + '">'
      + '<dd class="order--name sort-button">' + product.product_name + ' </dd>'
      + ' <dd class="order--price sort-button"> ' + product.price + '</dd>'
      + '<dd class="order--stock sort-button">' + product.stock + '</dd>'
      + ' <dd class="order--company sort-button">' + product.companies.company_name + '</dd>'
      + '<dd class="flex--size-big">'
        + '<form class="product_buttons" method="GET" action="?">'
          + '<button class="product_specific_button" type="submit" name="product_id" value="' + product.id
               + '" formaction="' + "{{ route('prodSp') }}" + '">'
               + '<span class="font-color--white"> 詳細 </span>'
          + '</button>'
         + '<button class="product_delete_button" type="button" name="product_id" value="' + product.id + '" >'
              + '<span class="font-color--white"> 削除 </span>'
          + '</button>'
        + ' </form>'
      + '</dd>'
      + '</div>');
  });
}

