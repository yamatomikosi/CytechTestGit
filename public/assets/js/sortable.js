$(function() {
    $('dt').on('click', function () {
      const index = $(this).data('index'); // カスタムデータ属性からインデックスを取得
      const order = $(this).hasClass('asc') ? 'desc' : 'asc'; // 昇順と降順をトグル
      const data_type = $(this).data('type'); // カスタムデータ属性からデータタイプを取得
  
      // 商品リストの取得
      const products = $('.product').toArray();
  
      // 商品リストのソート
      products.sort(function (a, b) {
        let aValue = $(a).find('.sort-button').eq(index).text().trim();
        let bValue = $(b).find('.sort-button').eq(index).text().trim();
       
        if (data_type === 'number') {
          aValue = parseFloat(aValue.replace(/[^0-9.-]+/g, ""));
          bValue = parseFloat(bValue.replace(/[^0-9.-]+/g, ""));
        }
  
        if (order === 'asc') {
          return (data_type === 'number') ? aValue - bValue : aValue.localeCompare(bValue);
        } else {
          return (data_type === 'number') ? bValue - aValue : bValue.localeCompare(aValue);
        }
      });

    
      // 商品リストの更新
      $('#searchedProducts').empty().append(products);
  
        // リストの背景色を再設定
      $('#searchedProducts').children().css("background-color", "white");
      $("#searchedProducts .product:nth-child(odd)").css("background-color", "gray");
       
      // すべてのdt要素から 'asc' および 'desc' クラスを削除
      $('dt').removeClass('asc desc');
  
      // クリックされたdt要素に適切なクラスを追加
      $(this).addClass(order);
    });
   
    

  });
  