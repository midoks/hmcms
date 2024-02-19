<?php
declare (strict_types = 1);

namespace app\v3\controller;

class App extends Base
{

    public function start(){
        $m = $this->model('Option');
        $data = $m->getValueByName('base');

        $d = [];
        $d['url'] = getDefault($data, 'app_start_url', '');
        $d['image'] = getDefault($data, 'app_start_image', '');
        $d['app_download_url'] =  getDefault($data, 'app_start_download_url', '');
        $d['app_text'] = getDefault($data, 'app_start_title', '');
        
        return $this->returnData(1,$d);
    }
}
