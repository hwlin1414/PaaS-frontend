<?php
namespace app\logs;
use app\models\Logs;
use Yii;
use yii\log\Logger;
use yii\log\DbTarget;
use yii\helpers\VarDumper;
class AppTarget extends DbTarget
{
    public function export()
    {
        $tableName = $this->db->quoteTableName($this->logTable);
        foreach ($this->messages as $message) {
            list($text, $level, $category, $timestamp) = $message;
            if (!is_string($text)) {
                // exceptions may not be serializable if in the call stack somewhere is a Closure
                $text = VarDumper::export($text);
            }
            $user = Yii::$app->user;
            $userId = ($user->isGuest ? (null) : ($user->identity->id));
            $model = new Logs();
            $model->user_id = $userId;
            $model->ip = Yii::$app->request->userIp;
            $model->level = Logger::getLevelName($level);
            $model->action = $category;
            $model->description = $text;
            $model->created_at = date('Y-m-d H:i:s', $timestamp);
            $model->save();
        }
    }
}
