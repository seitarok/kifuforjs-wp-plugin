# kifuforjs-wp-plugin
Kifu-for-JSをWordpressのブログに貼り付けるためのプラグイン

## 概要
javascriptで動作する棋譜再生将棋盤[Kifu-for-JS](https://github.com/na2hiro/Kifu-for-JS)をWordpressのブログに貼り付けるためのプラグイン。

## インストール方法

  1. githubの[Download ZIP](https://github.com/seitarok/kifuforjs-wp-plugin/archive/master.zip)からkifuforjs-wp-plugin-master.zipをダウンロードする。
  2. Wordpressの管理画面から[プラグイン]→[新規追加]→[プラグインのアップロード]を順にクリックする。
  3. [ファイルの選択]でkifuforjs-wp-plugin-master.zipを選択し、[今すぐインストール]をクリックする。
  4. Wordpressの管理画面から[プラグイン]から「kifuforjs」の[有効化]をクリックする。

## 使い方

[board]shortcodeを使用する。

### 棋譜をブログ記事から指定する場合

    [board text="開始日時：2018/04/09 12:16:23
    持ち時間：10分切れ負け
    手合割：平手
    手数----指手---------消費時間--
    1 ７六歩(77) ( 00:06/00:00:06)
    2 ３四歩(33) ( 00:02/00:00:02)
    3 ７八金(69) ( 00:02/00:00:08)
    4 ５二飛(82) ( 00:02/00:00:04)
    5 ６八銀(79) ( 00:01/00:00:09)"]

### 棋譜をkifファイルから指定する場合

urlにkifファイルのURLを指定する。

urlとtextの両方を指定した場合、urlで指定した棋譜を優先して表示する。

  1. kifファイルをWordpressにアップロードする。アップロード方法は画像のアップロードと同様。
  2. アップロードしたkifファイルのURLを確認する。
  3. ブログ記事に下記のようにshortcodeを書く。

    [board url=wp-content/uploads/2018/04/sample.kif]

### 手数を進めた状態で表示する場合

tesuuに進める手数を指定する。

    [board url=wp-content/uploads/2018/04/sample.kif tesuu=30]

### 反転して表示したい場合

reverseに1を指定する。

    [board url=wp-content/uploads/2018/04/sample.kif reverse=1]

### コメント表示したい場合

commentに1を指定する。

    [board url=wp-content/uploads/2018/04/sample.kif comment=1]

## 参照
  * [javascriptで動作する棋譜再生将棋盤 Kifu-for-JS](https://github.com/na2hiro/Kifu-for-JS)
  * [Kifu for JS をブログで動かす](https://docs.google.com/document/d/12Oa7lPmqueWqf-qVlmOkSh2ivIRcN5K34JqPiRdTJPQ/edit#heading=h.ybx7atb92s64)
