var Kifu = require("Kifu");
Kifu.settings={ImageDirectoryPath: args.ImageDirectoryPath};

var i = 0;
var board_id_list = [];
$(".board").each(function(index, element){
  var board_id = "board-"+i;
  $(element).attr('id', board_id); // id を付与
  // console.log($(element));
  var url = $(element).attr('url'); // kifファイルのURLを取得
  // console.log(url);
  var text = $(element).attr('text'); // kifテキストを取得
  // console.log(text);
  Kifu.loadCallback(after_kifu_load);
  board_id_list.push(board_id);
  if(url !== void 0 && url != ''){
    Kifu.load(url, board_id); // urlからkifuforjsを表示
  }else if(text !== void 0 && text != ''){
    Kifu.loadString(text, board_id); // 文字列からkifuforjsを表示
  }
  i++;
})

function after_kifu_load(){
  setTimeout(function(){ // Kifu読み込み待ち
    var board_id = board_id_list.shift();
    var e = $('#'+board_id);
    e.find('.mochi1').insertBefore(e.find('.ban')); // 持ち駒をbanの上に移動
    e.find('.mochi0').insertAfter(e.find('.ban'));  // 持ち駒をbanの下に移動

    e.find('.mochi .forklist').css({'width':'auto','max-width':'120px','font-size':'12px'});
    e.find('.mochi .forklist').insertAfter(e.find('.kifuforjs button:contains("反転")'));
    e.find('.mochi .kifulist').css({'width':'auto','max-width':'180px','font-size':'12px'});
    e.find('.mochi .kifulist').attr('size','');
    e.find('.mochi .kifulist').insertAfter(e.find('.kifuforjs button:contains("反転")'));
    e.find('.kifuforjs > tbody > tr:first-child > td:first-child').remove(); // banの左のtdタグを削除
    e.find('.kifuforjs > tbody > tr:first-child > td:last-child').remove(); // banの右のtdタグを削除
    e.find('.kifuforjs button:contains("credit")').remove();

    // tesuuを進める処理
    var tesuu = e.attr('tesuu');
    for(var tesuu_10 = parseInt(tesuu/10); tesuu_10 != 0; tesuu_10--){
      e.find('.kifuforjs button[data-go="10"]').click();
      // console.log(tesuu_10);
    }
    for(var tesuu_1 = tesuu % 10; tesuu_1 != 0; tesuu_1--){
      e.find('.kifuforjs button[data-go="1"]').click();
      // console.log(tesuu_1);
    }
    // 反転
    var reverse = e.attr('reverse');
    if(reverse == 1){
      e.find('.kifuforjs button:contains("反転")').click();
    }
    // コメントの表示／非表示
    var comment = e.attr('comment');
    if(comment != 1){
      e.find('.kifuforjs textarea').css('display', 'none');
    }
  },1);
}
