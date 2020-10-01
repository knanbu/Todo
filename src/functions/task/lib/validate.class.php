<?php
class TaskError
{

    private $err_array = [];
    private $err_empty = '空白です';


    public function err_check($data)
    {
        $this->check_task_name($data);
        $this->check_priority($data);
        return $this->err_array;
    }

    private function check_task_name($data)
    {
        if (empty($data['task_name'])) { //空白チェック
            $this->err_array['err_task_name'] = $this->err_empty;
            return;
        }
    }
    private function check_priority($data)
    {
        if (empty($data['priority'])) { //空白チェック
            $this->err_array['err_priority'] = '優先順位が未選択です';
            return;
        }
    }
}
