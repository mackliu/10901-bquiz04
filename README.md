# 題組四解題步驟



#### 解題參考影片
* **[影片列表](https://www.youtube.com/playlist?list=PLL26U2k-yzXsrWXiniLQf6OwVhxHthpRj)**
* **[解題影片程式碼](https://github.com/mackliu/10901-bquiz04-v)**


## 步驟一：將素材目錄複製到崗位目錄下，確認素材內容與抽題題號一致
監評長按下倒數計時後，可以先把桌面上素材目錄中的題目素材複製一份到自己的工作目錄下，這時要確認自己複製的題目和抽到的題目是一致的，之後都在工作目錄下來取用相關的素材，這樣比較不容易出錯；在安裝軟體的準備時間裏，也要確認一下電腦桌面中是否有包含了素材這個目錄，並且四個題組的素材都在其中。

---

## 步驟二：將版型檔案及相關素材複製到網站根目錄下，並進行相應的更名及整理
  1. 開立./css, ./js, ./api, ./icon, ./img等常用目錄以利檔案分類及管理
  2. 將素材檔中的.css, .js, 及icon圖檔複製到相應的目錄下
  3. 此題組版型中沒有包含jQuery，請至函式庫目錄下複製jQuery檔案至 ./js目錄下
  4. 將素材目錄下的icon圖檔複製到 `./icon` 目錄下
  5. 將素材目錄下的八件商品圖檔先複製到 `./img` 目錄下
  6. 更改版型素材的相關檔名，以符合解題的需要：
      * 04P01.htm => index.php
      * 04P02.htm => admin.php
  7. 更改版型素材的相關連結及匯入檔內容
      * 修改 `index.php` 及 `admin.php` 中 `<link>` 及 `<script>` 中的連結路徑，指向正確的位置
      * 記得加入jQuery的路徑
      * 修改 `index.php` & `admin.php` 中的圖片連結 ，指向根目錄下的 `./icon` 
  8. 開啟 `xampp` 及 `apache` 伺服器，使用 `localhost` 或 `127.0.0.1` 檢視網頁是否正確顯示，css 的載入是否正確

---

## 步驟三：進行前後台的檔案整理及切版，分離出共用的區塊或功能
  1. 建立 `front`及 `backend` 兩個目錄，一個代表前台的相關檔案，一個代表後台的相關檔案，前後台共用的元件則先放在根目錄下，或另開一個 `comm` 目錄用來存放共用的元件。
  2. 在 `index.php` 中找到中間主要內容區的 `right` 區塊，我們會在這裏建立include的語法，用來載入各個功能的內容。
  3. 在 `admin.php` 中找到中間主要內容區的 `right` 區塊，我們會在這裏建立include的語法，用來載入各個功能的內容。
  4. 使用 `include` 指令來重新組合 `index.php` 及 `admin.php` 頁面，並加上判斷式來確保要組合的檔案是存在的。
  5. 以 `get` 的方式來傳遞各頁面要組合的元件內容，比如 `do=login` 表示要看到的是登入頁面，因此在前台的 `include` 中可以併入 `login.php` 來呈現。

```php
    //index.php        
    $do=(!empty($_GET['do']))?$_GET['do']:"main";
    $file='front/'.$do.".php";
    if(file_exists($file)){
            include $file;
    }else{
            include "front/main.php";
    
```

```php
    //admin.php
    $do=(!empty($_GET['do']))?$_GET['do']:"admin";
    $file='backend/'.$do.".php";
    if(file_exists($file)){
            include $file;
    }else{
            include "backend/admin.php";
    }

```
  6. 修改 `index.php` 及 `admin.php` 中的連結內容及寫法，確保可以正確的連結到相應的頁面。
  7. 可以依照選單的連結預先在 `./front/` 及 `./backend/` 目錄中建立所需的連結頁面，可以節省後續製作的檔案操作時間。

---

## 步驟四：建立資料庫連線檔及常用函式。
  1. 建立 `base.php` 檔，用來放共用的設定及函式。
  2. 採用類別方式來包裝整個db的連線及資料表的存取函式
```php
class DB{

//類別內容

}
```
  3. 設定好PDO的連線參數 `$this->pdo=new PDO($setting,$user,$pw,$config)`

```php
    private $dsn="mysql:host=localhost;charset=utf8;dbname=db66";
    private $root="root";
    private $password="";
    private $pdo;

    //設定建構式
    public function __construct($table){

        //將建立物件時代入的資料表名稱代入類別中的屬性table
        $this->table=$table

        //建立pdo的連線資訊，並將pdo連線指定給類別內的屬性pdo
        $this->pdo=new PDO($this->dsn,$this->root,$this->password); 
    }
```

  4. 啟用session `session_start()`
  5. 建立全域變數或是共用函式
      * find(\$arg) - 尋找特定條件的單筆資料或第一筆資料
      * all(...\$arg) - 取得資料表的全部資料或是特定條件的全部資料
      * count(...\$arg) - 計算符合條件的資料筆數
      * save(\$arg) - 新增或更新單筆資料
      * del(...\$arg) - 刪除特定條件的全部資料
      * q(\$sql) - 簡化 \$pdo->query(\$sql)->fetchAll() 的使用;
      * to(\$url) - 簡化 header("location:xxxxxx") 的使用;
```php
class DB{
    //......

    public function __construct($table){

        //.....

    }

  public function all(...$arg){
    //...... 
  }
  public function find($arg){
    //......
  }
  public function count(...$arg){
    //......
  }
  public function save($arg){
    //......
  }
  public function del($arg){
    //......
  }
  public function q($sql){
    //......
  }

}

function to($url){
    //......
}

```
  6. 為方便之後在各功能中不用再new一次db，可以先把各個資料表的物件都在base.php中先new一次，這樣可以省很多事，使用首字母大寫的方式來和一般變數做區隔

```php
$Admin=new DB('admin');
$Member=new DB('member');
$Goods=new DB('Goods');
$Type=new DB('type');
$Ord=new DB('ord');
$Bottom=new DB('bottom');

```
  6. 做好以上工作後，可以先建一張簡單的資料表，把資料庫連線及所有自訂函式功能先測試一次，以確保後續使用不會有問題。

---

## 步驟五：建立資料表及預設資料。
每個題組依狀況不同，在這一步有不同的做法，視自己對題目的熟悉程度來做應變，可以一次把全部資料表建完，也可以視解題的進度來逐步建立或修改資料表。
根據題意，題組四會需要用到以下的資料表：
* admin - 管理員資料表
* bottom - 頁尾版權資料表
* goods - 商品資料表
* member - 會員資料表
* ord - 訂單資料表
* type - 分類資料表

1. 依序建立功能需要的六張資料表:
  * admin

    | name  |  type   |  pk   | default |  A_I  |  note  |
    | :---: | :-----: | :---: | :-----: | :---: | :----: |
    |  id   | int(10) |  yes  |         |  yes  | 流水號 |
    |  acc  |  text   |       |         |       |  帳號  |
    |  pw   |  text   |       |         |       |  密碼  |
    |  pr   |  text   |       |         |       |  權限  |
    
  * bottom

    |  name  |  type   |  pk   | default |  A_I  |   note   |
    | :----: | :-----: | :---: | :-----: | :---: | :------: |
    |   id   | int(10) |  yes  |         |  yes  |  流水號  |
    | bottom |  text   |       |         |       | 頁尾版權 |

  * goods
  
    | name  |  type   |  pk   | default |  A_I  |   note   |
    | :---: | :-----: | :---: | :-----: | :---: | :------: |
    |  id   | int(10) |  yes  |         |  yes  |  流水號  |
    |  no   |  text   |       |         |       | 商品編號 |
    | name  |  text   |       |         |       | 商品名稱 |
    | price | int(5)  |       |         |       | 商品單價 |
    | stock | int(5)  |       |         |       |  庫存量  |
    | spec  |  text   |       |         |       |   規格   |
    | intro |  text   |       |         |       | 商品簡介 |
    |  img  |  text   |       |         |       | 商品圖片 |
    |  big  | int(5)  |       |         |       |  大分類  |
    |  mid  | int(5)  |       |         |       |  次分類  |
    |  sh   | int(2)  |       |    1    |       | 是否上架 |

  * member
  
    |  name   |  type   |  pk   |       default       |  A_I  |   note   |
    | :-----: | :-----: | :---: | :-----------------: | :---: | :------: |
    |   id    | int(10) |  yes  |                     |  yes  |  流水號  |
    |   acc   |  text   |       |                     |       |   帳號   |
    |   pw    |  text   |       |                     |       |   密碼   |
    |  name   |  text   |       |                     |       |   姓名   |
    |   tel   |  text   |       |                     |       |   電話   |
    |  addr   |  text   |       |                     |       |   地址   |
    |  email  |  text   |       |                     |       | 電子郵件 |
    | regdate |  date   |       | current_timestamp() |       | 註冊日期 |
    |  total  | int(10) |       |          0          |       |   總價   |

  * ord
  
    |  name   |  type   |  pk   |       default       |  A_I  |   note   |
    | :-----: | :-----: | :---: | :-----------------: | :---: | :------: |
    |   id    | int(10) |  yes  |                     |  yes  |  流水號  |
    |   no    |  text   |       |                     |       |   編號   |
    |   acc   |  text   |       |                     |       |   帳號   |
    |  name   |  text   |       |                     |       |   姓名   |
    |  email  |  text   |       |                     |       | 電子郵件 |
    |  addr   |  text   |       |                     |       |   地址   |
    |   tel   |  text   |       |                     |       |   電話   |
    |  total  | int(10) |       |                     |       |   總價   |
    |  goods  |  text   |       |                     |       |   商品   |
    | orddate |  text   |       | current_timestamp() |       | 訂購日期 |

  * type
  
    |  name  |  type   |  pk   | default |  A_I  |   note   |
    | :----: | :-----: | :---: | :-----: | :---: | :------: |
    |   id   | int(10) |  yes  |         |  yes  |  流水號  |
    |  name  |  text   |       |         |       | 選單名稱 |
    | parent | int(2)  |       |    0    |       |  大分類  |

2. 為了解題順利，可以把資料表中的一些欄位設為可接受空值的狀況，這樣即使未設定內容，也能正常新增或更改資料，不過這個做法只是為了先求解題完成而做的取巧，實務上應該根據需求及功能來決定欄位是否可以接受空值，並在程式端檢查來源資料是否為空值

---

## 步驟六：建置首頁標題區及相關頁面內容-最新消息及購物流程。
項目三提到的內容大多都是後面的功能有做完就會有的，但反過來說，如果後面的相關功能沒完成的話，這邊會再多扣五分，而題組四中有些功能是和資料庫無關的，因此我們會先在這步驟把這些相較之下可以快速完成的功能先做完。

1. 在 `./front/` 中的 `news.php` 中建置最新消息內容，參考項目(六)
2. 在 index.php  中加入最新消息的兩則跑馬燈消息

```html
<marquee>
    情人節特惠活動 &nbsp; 年終特賣會開跑了  
</marquee>
```

3. 最新消息的描述中，並沒有提到點擊標題後顯示詳細內容，再加上後台也沒有最新消息管理的功能，因此這邊我們只先做到顯示兩則消息的標題即可，後續功能做完再回頭來補，而詳細內容的功能，我建議是使用jQuery的hide()和show()來做切換顯示即可，參考以下寫法：

```html

<table class="all" id="n0">
    <tr class="tt">
        <td>標題</td>
    </tr>
    <tr class="pp">
        <td onclick="javascript:$('.all').hide();$('#n1').show()">
            年終特賣會開跑了
        </td>
    </tr>
    <tr class="pp">
        <td onclick="javascript:$('.all').hide();$('#n2').show()">
            情人節特惠活動
        </td>
    </tr>
</table>

<table class="all" id="n1" style="display:none">
    <tr>
        <td class="tt">標題</td>
        <td class="pp">
            年終特賣會開跑了
        </td>
    </tr>
    <tr>
        <td class="tt">內容</td>
        <td class="pp">
            即日期至年底，凡會員購物滿仟送佰，買越多送越多~
        </td>
    </tr>
    <tr class="ct">
        <td colspan="2">
            <button onclick="javascript:location.href='index.php?do=news'">
                返回
            </button>
        </td>
    </tr>
</table>
<table class="all" id="n2" style="display:none">
    <tr>
        <td class="tt">標題</td>
        <td class="pp">
            情人節特惠活動
        </td>
    </tr>
    <tr>
        <td class="tt">內容</td>
        <td class="pp">
            為了慶祝七夕情人節，將舉辦情人兩人到現場有七七折之特惠活動~
        </td>
    </tr>
    <tr class="ct">
        <td colspan="2">
            <button onclick="javascript:location.href='index.php?do=news'">
                返回
            </button>
        </td>
    </tr>
</table>

```
4. 在 `./front/` 中的 `look.php` 中加入購物流程圖片

---

## 步驟七：製作後台頁尾版權區
本題組有些項目的配分明顯的CP值不同，比如頁尾版權區合計有四項描述共二十分，但實際完成這個功能的前後台，可能不用到五分鐘，所以我們會優先把這些項目做完，爭取時間來處理其它的項目

1. 分別先在 `index.php` 及 `admin.php` 的最前頭加上 `<?php include_once "base.php";?>` 這樣可以方便之後的引入檔來使用
2. 先在 `index.php` 及 `admin.php` 的最後頁尾版權區加上取出版權文字的語法 `<?=$Bottom->find(1)['bottom'];?>`
3. 接著在 `./backend/` 目錄中的 `bot.php` 檔，建置後台需要的表單及功能
4. 這邊我們不另外寫一個API檔來處理更新資料，而是在form表單的action中指定傳送表單到 `?do=bot`，這樣會比較省時間
5. 我們直接在 `bot.php` 中判斷是否有表單送出的動作，同時更新頁尾版權的內容

---

## 步驟八：製作會員註冊及會員登入功能
本題組在會員註冊及登入的描述上有點不清楚，比如登入失敗時的處理並沒有說明，而驗證碼錯誤的提示則是放在管理登入的描述上，因此在解題前一定要先把題目看過一次，了解題目沒有提到的細節，然後自行判斷要採用什麼對策。

1. 先確定素材目錄中會用到的圖片都已複製到 `icon` 目錄下了
2. 在 `./front/login.php` 中建立登入頁面需要的註冊按鈕及登入表單
3. 在 `login.php` 中建立驗證碼程式，這裏我們採session的方式來建立驗證碼，將答案存在session中，然後登入時先使用ajax去確認答案是否正確，如果正確則繼續下一步，如果錯誤則出現錯誤提示
4. 在 `./api/` 目錄中建立 `chk_ans.php` 檔案，並撰寫檢查驗證碼的功能
5. 在 `login.php` 中建立檢查帳號密碼的js程式碼
6.  在 `./api/` 目錄中建立 `chk_pw.php` 檔案，並撰寫檢查帳號及密碼的功能，考慮到後面管理登入時會再使用一次這支程式，因此我們增加了table這個變數，用來增加程式的適用性
7. 在 `./front/` 目錄中建立 `reg.php` 檔案，並且建立會員註冊需要的表單內容
8. 在 `reg.php` 中撰寫檢查帳號是否重覆的按鈕功能.
9.  在 `./api/` 目錄中建立 `chk_acc.php` 檔案，並撰寫檢查帳號的功能
10. 在 `reg.php` 中撰寫註冊會員的功能
11. 在 `./api/` 目錄中建立 `reg.php` 檔案，並撰寫新增會員資料到資料表的功能
12. 由於題目中並沒有描述註冊是否需要驗證所有的欄位，也沒有提到登入失敗會如何，因此這些細節可以自己視時間來決定是否增加

---

## 步驟九：製作管理登入功能
管理登入功能和會員登入功能幾乎一樣，差別在於管理登入的資料表中有一個權限的欄位我們採用序列化的字串來儲存。

1. 把 `./front/login.php` 中的程式碼複製一份到 `./front/admin.php`，並調整內容以符合題目要求
2. 如果要測試管理者帳號的話，可以先手動在資料表中塞一筆資料，而權限的字串我們可以先做一個測試用的php來產生這個序列化的字串，並寫入到資料表中

```php
//手動產生一筆管理者資料進db
$admin["admin"]="admin";
$admin["pw"]="1234";
$admin["pr"]=serialize([1,2,3,4,5]);

$Admin->save($admin);

```

---

## 步驟十：製作後台管理權限設置功能
這邊我們順著步驟九的功能接著把後台的一些簡單功能及頁面設置先做完，爭取更多的時間來製作比較麻煩的購物車及商品管理功能

1. 在 `./backend/admin.php` 中建置讀出管理帳號的頁面，這邊要注意過濾**admin**帳號為沒有功能按鈕的項目
2. 為了方便測試，可以先手動建置幾個管理者帳號在資料表中
3. 直接利用js的語法來製作新增管理者的按鈕跳頁功能
```php
<button onclick="location.href='?do=add_admin'">新增管理員</button>
```
4. 在 `./js/js.js` 中建立一個javascript函式 `del(table,id)` 做為刪除資料的功能
5. 在 `./admin/` 目錄中建立 `add_admin.php` 檔案，並建立新增管理帳號的頁面及表單
6. 在 `./api/` 目錄中建立 `save_admin.php` 檔案，並撰寫新增/更新管理帳號的程式碼
7. 複製一份 `./admin/add_admin.php` 並改名為 `edit_admin.php` ，然後根據 `$_GET['id']` 的值來取出資料
8. 要記得在 `edit_admin.php` 中增加一個隱藏欄位把資料的**id**值帶入
9. 為了做到登入時的權限限制，我們需要透過session來紀錄使用者的登入狀態，而這個功能在後面的購物車時也會用到，因此我們在這個步驟中先把功能做掉會比較省事。
10. 在 `./api/chk_pw.php` 中增加登入成功後紀錄**session**的功能，會員和管理者我們都紀錄一份。
11. 在 `admin.php` 的最上面進行session的判斷並取出登入者的帳號資料，如果使用者不是正確的登入者，則不顯示 `admin.php` 的內容．
12. 將 `pr` 欄位的內容轉換成為權限陣列，然後在選單區進行判斷，藉此做到管理權限的功能

```php
<div style="min-height:400px;">
    <a href="?do=admin">管理權限設置</a>
    <?php
        $manager=$Admin->find(['acc'=>$_SESSION['admin']]);
        $pr=unserialize($manager['pr']);
    ?>

    <a href="?do=th" style="display:<?=(in_array(1,$pr))?"block":"none";?>">商品分類與管理</a>
    <a href="?do=order"  style="display:<?=(in_array(2,$pr))?"block":"none";?>">訂單管理</a>
    <a href="?do=mem" style="display:<?=(in_array(3,$pr))?"block":"none";?>">會員管理</a>
    <a href="?do=bot" style="display:<?=(in_array(4,$pr))?"block":"none";?>">頁尾版權管理</a>
    <a href="?do=news" style="display:<?=(in_array(5,$pr))?"block":"none";?>">最新消息管理</a>
    <a href="javascript:location.href='api/logout.php?logout=admin'" style="color:#f00;">登出</a>
</div>

```
---

## 步驟十一：製作後台會員管理功能
會員管理功能算是後台功能中較簡單的，而且大部份的程式碼都和管理權限設置相似，因此這邊建議是接在管理權限設置功能做完後順著做下來把它先完成。

1. 複製 `./admin/admin.php` 的內容貼到 `./admin/mem.php` 中，接著修改相關的程式碼及表格欄位，連結參數等，即可快速完成會員列表的功能。
2. 在 `./admin` 目錄中建立 `edit_mem.php` ，並撰寫編輯會員的表單頁面
3. 複製 `./api/save_admin.php` ，並更名為 `save_mem.php`，修改相關的資料表名，及最後要導向的位置，即可完會編輯會員資料的功能。

---

## 步驟十二：後台訂單功能製作-訂單列表
雖然訂單功能應該是購物流桯整個做完之後再來做會比較合理，但因此這邊的功能和前面的會員列表幾乎也是一模一樣，因此我們就順手複製過來小改一下。

另一個考量是，如果屆時發現購物車功能來不及做完時，可以手動塞入訂單資訊，直接跳過來先做訂單功能也可以爭取一些分數。

1. 複製 `./admin/mem.php` 的內容到 `./admin.php/order.php` 中，然後修改資料表名及欄位名稱，訂單列表就做完了。
2. 在訂單編號的位置加上一個連結，導引到訂單詳細資料的頁面。
3. 在 `./admin/` 目錄中增加一個 `order_detail.php` 檔案做為詳細資料的頁面．

---

## 步驟十三：製作後台商品分類管理-商品分類
這裏題目的描述方式明顯在指的是後台的商品分類與管理的功能，由於截圖的內容並不完全，我們不清楚這兩個功能是在同一個頁面呈現的還有不同的分頁，基於時間的考慮，我們直接把兩個功能做在同一頁即可。

1. 在 `./backend/th.php` 中建立商品分類的表單，這邊我們採用ajax來傳遞資料。
2. 撰寫新增大分類和新增中分類的js函式程式碼，需要多個ajax函式來控制所有的行為
3. 在 `./backend/th.php` 中接著使用ajax的方式來載入商品分類的列表
4. 這邊示意圖是以主副分類的順序來顯示，我們在 `api`目錄中新增一個 `get_type_list.php` 專門用來產生前端需要的分類頁面。
5. 最後撰寫編輯分類的功能，這邊我們使用js內建的prompt()來提供編輯的彈出畫面，然後再以ajax的方式將修改後的文字送到 `./api/save_type.php` 去做資料表的更新
6. 在更新完分類資料表後，我們可以利用dom的操作來直接更改頁面上的分類文字，也可以在資料表更新完成後reload()一下頁面。
7. 在這邊要注意一下，題目中有暗示版面不能因為內容而自動擴展高度，所以我們們要在css中把 `#right` 改成固定高度，並且加上 `overflow:auto`，讓版面會自動出現滾軸。

---

## 步驟十四：製作後台商品分類管理-商品管理

1. 先在 `th.php` 中把商品列表及四個按鈕的基本功能先做好。
2. 在 `./backend/` 目錄中新增 `add_goods.php`，並撰寫新增商品需要的表單內容
3. 製作大分類和中分類的選單連動功能，這邊我們利用和題組三訂票功能一樣的ajax方式來達成
4. 在 `./api/` 目錄新增 `get_big.php` 及 `get_mid.php` 兩個檔案，分別撰寫取得大分類和中分類的選項內容回傳給前端選單使用
5. 在 `./api/` 目錄中新增 `save_goods.php`，並撰寫新增商品資料到資料表的程式碼，此時要記得產生一組商品編號後才寫入到資料表
6. 複製 `./backend/add_goods.php`，改名為 `edit_goods.php`，並將商品資料填入對應的表單欄位中，要記得加入隱藏欄位id


---

## 步驟十五：製作前台商品分類區
前台商品分類區和購物車功能算是一氣呵成的功能，因此我們放在後台告一段落後來製作這部份。

1. 在 `index.php` 中找到 `#left` 中用來放置選單的區塊
2. 撰寫產生分類選單的程式碼，這邊我們利用巢狀迴圈的方式來分別取出大分類及所屬的中分類，並利用內建的css功能來達到出現中分類的功能
3. 在 `./front/main.php` 中撰寫導航文字及撈出商品內容的程式碼，注意商品簡介只需要顯示固定長度的一部份字串即可。
4. 在 `main.php` 中要注意的是在使用者按下 `我要購買` 按鈕時，我們除了要把使用者導向購物車頁面外，也同時要把商品的`id`及`數量`一起帶過去。
5. 在 `./front/` 目錄中增加 `detail.php` 檔案，並且撰寫商品詳細內容的頁面。
6. 在詳細內容頁面中，要注意的是我們採用 javascript 的方式來做商品資料的傳送，中間放了一個隱藏欄位`id`，這在使用者按下我要購買後會觸發buy()函式，並將使用者導向購物車頁面。

```javascript
            function buy(){
                let id=$("#id").val();
                let qt=$("#qt").val();
                location.href=`?do=buycart&id=${id}&qt=${qt}`;
            }

```
7. 這邊我們利用內建的css來達到出現中分類的功能，但是因為裏頭的a標籤用的是同一組設定，所以大分類和中分類的樣子看起來題一樣的，不好分辨，如果要讓中分類的選單顏色不一樣，一個是直接在頁面中直接加入行內樣式來強制變成，另一個做法是在css中指定中分類的樣式背景:

```css
/* 在./css/css.css中指定詳細的中分類樣式，並指定其中的選單背景為淺綠色*/
#left .s a{
	background:lightgreen;
}

```
```php
/* 寫在程式碼中 */
echo "<a href='index.php?m=".$m['id']."&s=".$s['id']."' style='background:lightgreen'>".$s['text']."</a>";

```

---

## 步驟十六：製作前台購物功能
購物功能被我們切成兩個部份來製作，一個是會員登入及註冊，一個則是登入後的購物功能，題目在這邊的描述並不是很清楚，簡單來說，就是購物車的功能必須是登入的會員才能看到及使用的，如果不是登入的會員則會被導引去進行會員註冊或登入。

#### 購物車功能
1. 先前在 `./api/chk_pw.php` 中已經增加了一個session變數，用來紀錄使用者登入的狀況
2. 在 `./front/buycart.php` 中增加對會員登入的判斷，如果使用者是登入的狀況，則可以看到購物車的內容，如果使用者不是登入的狀況，則將使用者導向會員登入頁面
3. 接著增加把選購商品加入購物車的程式碼，這邊我們使用一個session變數來代表購物車，選購的商品都會先存放到這個變數中形成一個陣列，等最後確認購買完成，才會把商品內容存到資料表中

```php
//先判斷網址是否帶有商品，有的話先加入到購物車
if(!empty($_GET['id'])){

    $_SESSION['cart'][$_GET['id']]=$_GET['qt'];

}else if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){ //判斷購物車是否為空車及購物車是否存在

    echo "<h2 class='ct'>請選擇商品</h2>";

}

//判斷是否為登入的使用者，未登入則導向登入頁
if(empty($_SESSION['member'])){
    
    to("?do=login");

}


```

4. 在建立購物商品列表時，使用內建的css 樣式.all時會發現表格的大小超出版面範圍，這時可以去css檔案調整一下內距和右側區塊的大小，讓畫面可以容納更多的內容。

```css
.all td
{
	min-width:86px;
	padding:10px;
}
```

5. 雖然參考畫面中的購物車列表把商品數量以input的欄位來顯示，但題目中並沒有說明這個input欄位是否有其它的功能，`比如改變數量時，小計欄位也會跟著改變`，為了減少不必要的爭議，這邊我是使用直接顯示的方式來處理，如果要改變數量的話，可以回到商品詳細內容去填入數量即可。
6. 刪除購物車商品的功能我們延用先前寫好的**del(table,id)函式即可，將要刪除的商品id傳到後台api去，然後由api來刪除session中的商品內容，完成後再重新導向 `buycart.php` 一次並清除網址帶的商品參數，此時因為購物車內的商品數量減少了，所以列表就會少一樣商品，達成題目要求的功能
7. 在 `./api/` 目錄中增加一個 `del_cart.php`的檔案，並撰寫刪除購物車商品的功能。

#### 結帳櫃台功能
1. 在 `./front/` 目錄中增加 `check.php` 檔案，並撰寫列出會員資料及商品清單功能，這邊的填寫資料內容會完整的寫入訂單資料表中，而不是以參照的方式去更新會員資料表，理由是在電商網站的流程中，本來就允許訂購者和收件人的資料是不同的，這邊只是題目沒說明清楚而已。
2. 在傳送訂單資料方面我們採用ajax的方式來傳送表單的內容，這樣在處理彈出視窗訊息時會比較單純一些。
3. 另外一個題目沒提到的細節是在送出訂單後的購物車及會員登入狀態要怎麼處理？如果檢定時只照題目的流程走一遍，那做到寫入訂單就可以了，但是當要操作第二筆訂單時，就會發生原有的購物車內容還有上一筆訂單的資料在的狀況，所以這邊建議如果時間上來得及，同時也已經做到這一步了，可以把一些細節補上，這樣在評分時會減少一些爭議。

```javascript
function buy(){
    //建立表單的資料
    let data=$("input").serialize();
    
    //傳送表單的資料到後做訂單處理
    $.post('api/buy.php',data,function(){

        //顯示提示訊息後將頁面導向首頁
        alert("訂購成功\n感謝您的選購")
        location.href="index.php"
    })
}
```
2. 我的做法是在ajax傳送表單資料後彈出感謝訊息的視窗，然後把使用者導回首頁去；而此同時，在後端的api除了收集ajax傳來的內容並寫入資料表外，也會同時清除購物車的session內容，這樣使用者就有一台空的購物車可以進行第二筆訂單。

```php

//儲存訂單資料
$Ord->save($data);

//刪除購物車(檢定可不做)
unset($_SESSION['cart']);

```

3. 最後的補強是在首頁的功能連結上，針對會員登入的連結加入判斷，如果會員登入成功，則會員登入改成登出。
4. 在 `./api/logout.php` 中撰寫登出功能，這邊我們為了兼容前台會員登出及後台的管理者登出，因此使用switch..case的方式來分辨要登出的對像，如果是管理者登出，則只要清楚管理者的session，如果是會員登出，則除了清楚會員的session，也會一併清除會員的購物車session。
5. 在 `index.php` 中的會員登出連結上加入 `logout=member` 的參數，同時也可以順手在 `admin.php` 的登出功能上加入 `logout=admin` 參數。

---

## 步驟十七：後台訂單功能製作-訂單詳細內容
後台訂單功能的內容其實都是前面做過的功能的組合，因此如果能做到這邊來，基本上這題組就十拿九穩了。

1. 複製 `./front/check.php` 的內容到 `./backend/detail.php`
2. 在 `./backend/detail.php` 中撰寫訂單詳細資料的內容，將原本的輸入欄位拿掉即可。
