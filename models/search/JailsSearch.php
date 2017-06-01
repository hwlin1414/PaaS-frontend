<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Jails;

/**
 * JailsSearch represents the model behind the search form about `app\models\Jails`.
 */
class JailsSearch extends Jails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'enabled', 'enabledby'], 'integer'],
            [['hostname', 'ip', 'quota', 'description', 'sshkey', 'created_at', 'enabled_at', 'expired_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Jails::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'enabled' => $this->enabled,
            'enabledby' => $this->enabledby,
            'created_at' => $this->created_at,
            'enabled_at' => $this->enabled_at,
            'expired_at' => $this->expired_at,
        ]);

        $query->andFilterWhere(['like', 'hostname', $this->hostname])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'quota', $this->quota])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'sshkey', $this->sshkey]);

        return $dataProvider;
    }
}
