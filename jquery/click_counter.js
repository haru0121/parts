$(function(){
  //リンクボタンクリックでページジャンプ前にAjax送信（失敗しても成功してもリンク先にジャンプ）
  let preventEvent = true;//trueだとクリックした対象DOMをpreventDefaultする（カウント開始）
  let is_sending=false;//Ajax処理中かどうか(連打防止)
  function postClickData(id){
    let formData = {id:id};
    let def = $.Deferred();
      $.ajax({
        url: url,
        type: "POST",
        data: formData,
        timeout: 5000,
      })
        .done(function (data) {
          def.resolve(data);
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
          def.reject('false');
        });
      return def.promise();
  }

  $('a').on('click',function(e){
    if(preventEvent){
    e.preventDefault();
    let id = $(this).attr('data-clickid');
    if(!id||id===undefined||is_sending===true){
      //idの取得ができない時やすでにAjax送信中でリトライしない時の処理
      preventEvent=false;
      $(e.target).trigger("click");
    }else{
      is_sending=true;//送信中フラグtrue
      $.when(
        postClickData(id)
      ).done(function (data) {
        //クリックデータの送信に成功した時の処理
        preventEvent=false;
        is_sending=false;
        $(e.target).trigger("click");
      }).fail(function(data){
        //クリックデータの送信に失敗した時の処理
        preventEvent=false;
        is_sending=false;
        $(e.target).trigger("click");
      });    
    }
  }else{
    preventEvent=true;//trueー＞ページ内にとどまり、再度クリックした時もカウントする
    return true;
  }
  });
});