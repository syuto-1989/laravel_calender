$("#bt2").click(function () {
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });
  var formData = $("#form").serialize();
  console.log(formData);

  $.ajax({
    //POST通信
    type: "post", //HTTP通信のメソッドをPOSTで指定
    //ここでデータの送信先URLを指定します。
    url: "/ajax_holiday_setting", //通信先のURL
    dataType: "json", // データタイプをjsonで指定
    data: formData, // serializeしたデータを指定
  })
    //通信が成功したとき
    .then((res) => {
      console.log(res);
    })
    //通信が失敗したとき
    .fail((error) => {
      console.log('error.statusText');
    });
});