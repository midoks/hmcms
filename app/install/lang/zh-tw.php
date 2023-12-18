<?php
/*
*當前語言包是系統安裝語言包
*/
return [
    'hello'  => '歡迎使用',

    'install/title'=>'鴻蒙CMS系統安裝',
    'install/header'=>'感謝您選擇【鴻蒙CMS】系統搭建網站',
    'install/lang'=>'語言包[langs]',
    'install/select_lang'=>'請選擇語言包[select lang]',
    'install/lang_tip'=>'請根據自己身需要選擇後臺語言包',

    'install/user_agreement_title'=>'鴻蒙CMS用戶協議 適用於所有用戶',
    'install/user_agreement'=>' 請您在使用(鴻蒙CMS)前仔細閱讀如下條款。包括免除或者限製作者責任的免責條款及對用戶的權利限製。您的安裝使用行為將視為對本《用戶許可協議》的接受，並同意接受本《用戶許可協議》各項條款的約束。 <br /><br />
                一、安裝和使用： <br />
                (鴻蒙CMS)是免費和開源提供給您使用的，您可安裝無限製數量副本。 您必須保證在不進行非法活動，不違反所在國家相關政策法規的前提下使用本軟件。 <br /><br />
                二、免責聲明：  <br />
                本軟件並無附帶任何形式的明示的或暗示的保證，包括任何關於本軟件的適用性, 無侵犯知識產權或適合作某一特定用途的保證。  <br />
                在任何情況下，對於因使用本軟件或無法使用本軟件而導致的任何損害賠償，作者均無須承擔法律責任。作者不保證本軟件所包含的資料,文字、圖形、鏈接或其它事項的準確性或完整性。作者可隨時更改本軟件，無須另作通知。  <br />
                所有由用戶自己製作、下載、使用的第三方信息數據和插件所引起的一切版權問題或糾紛，本軟件概不承擔任何責任。<br /><br />
                三、協議規定的約束和限製：  <br />
                禁止去除(鴻蒙CMS)源碼裏的版權信息，商業授權版本可去除後臺界面及前臺界面的相關版權信息。</br>
                禁止在(鴻蒙CMS)整體或任何部分基礎上發展任何派生版本、修改版本或第三方版本用於重新分發。</br></br>
                <strong>版權所有 (c) 2023，鴻蒙CMS,保留所有權利</strong>。',

    'install/user_agreement_agree'=>'同意協議並安裝系統',
    'install/environment_title'=>'運行環境檢測',
    'install/environment_name'=>'環境名稱',
    'install/current_config'=>'當前配置',
    'install/required_config'=>'所需配置',

    'install/dir_file'=>'目錄/文件',
    'install/required_popedom'=>'所需權限',
    'install/current_popedom'=>'當前權限',

    'install/func_ext'=>'函數/擴展',
    'install/type'=>'類型',
    'install/result'=>'結果',
    'install/back_step'=>'返回上一步',
    'install/next_step'=>'進行下一步',
    'install/question'=>'常見問題解決辦法',
    'install/database_config'=>'數據庫配置',

    'install/server_address'=>'服務器地址',
    'install/server_address_tip'=>'數據庫服務器地址，一般為127.0.0.1',
    'install/database_port'=>'數據庫端口',
    'install/database_port_tip'=>'系統數據庫端口，一般為3306',
    'install/database_name'=>'數據庫名稱',
    'install/database_name_tip'=>'系統數據庫名,必須包含字母',
    'install/database_username'=>'數據庫賬號',
    'install/database_username_tip'=>'連接數據庫的用戶名',
    'install/database_pass'=>'數據庫密碼',
    'install/database_pass_tip'=>'連接數據庫的密碼',
    'install/database_pre'=>'數據庫前綴',
    'install/database_pre_tip'=>'建議使用默認,數據庫前綴必須帶_',
    'install/overwrite_database'=>'覆蓋數據庫',
    'install/overwrite'=>'覆蓋',
    'install/not_overwrite'=>'不覆蓋',
    'install/overwrite_tip'=>'如需保留原有數據，請選擇不覆蓋',
    'install/test_connect'=>'測試數據庫連接',
    'install/test_connect_tip'=>'請先點擊 【測試數據連接】 再安裝',
    'install/other_config'=>'其他設置',
    'install/admin_name'=>'管理員賬號',
    'install/admin_name_tip'=>'管理員賬號最少4位',
    'install/admin_pass'=>'管理員密碼',
    'install/admin_pass_tip'=>'保證密碼最少6位',
    'install/init_data'=>'初始化數據',
    'install/create'=>'創建',
    'install/not_create'=>'不創建',
    'install/create_tip'=>'是否創建基礎分類數據',
    'install/exec'=>'立即執行安裝',
    'install/submit_tip'=>'請先點擊並通過測試數據連接!',

    'install/environment_failed'=>'環境檢測未通過，不能進行下一步操作！',
    'install/init_err'=>'初始失敗！',
    'install/write_read_err'=>'無讀寫權限！',
    'install/not_found'=>'不存在',
    'install/database_connect_err'=>'數據庫連接失敗，請檢查數據庫配置！',
    'install/database_name_haved'=>'該數據庫已存在，可直接安裝。如需覆蓋，請選擇覆蓋數據庫！',
    'install/database_connect_ok'=>'數據庫連接成功',
    'install/access_denied'=>'非法訪問',
    'install/please_test_connect'=>'請先點擊測試數據庫連接！',
    'install/please_input_admin_name_pass'=>'請填寫管理賬號和密碼！',
    'install/sql_err'=>'導入表結構SQL失敗，請檢查install.sql的語句是否正確。',
    'install/init_data_err'=>'導入初始化數據SQL失敗，請檢查initdata.sql的語句是否正確。',
    'install/admin_err'=>'管理員賬號創建失敗',
    'install/is_ok'=>'系統安裝成功，歡迎您使用鴻蒙CMS建站',
    'install/os'=>'操作系統',
    'install/php'=>'php版本',
    'install/gd'=>'GD庫',

    'install/not_limited'=>'不限製',
    'install/not_installed'=>'未安裝',
    'install/read_and_write'=>'讀寫',
    'install/not_writable'=>'不可寫',
    'install/support'=>'支持',
    'install/not_support'=>'支持',
    'install/class'=>'類',
    'install/model'=>'模塊',
    'install/function'=>'函數',
    'install/config'=>'配置',
];