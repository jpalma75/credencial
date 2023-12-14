<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Departamentos;

/**
 * DepartamentosSearch represents the model behind the search form about `app\models\Departamentos`.
 */
class DepartamentosSearch extends Departamentos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_encargado'], 'integer'],
            [['nombre', 'cp', 'direccion', 'estatus_registro'], 'safe'],
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
        $query = Departamentos::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            // 'id' => $this->id,
            'id_encargado' => $this->id_encargado,
            // 'fecha_creacion' => $this->fecha_creacion,
            // 'fecha_modificacion' => $this->fecha_modificacion,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'cp', $this->cp])
            ->andFilterWhere(['like', 'direccion', $this->direccion]);
            // ->andFilterWhere(['like', 'estatus_registro', $this->estatus_registro])
            // ->andFilterWhere(['like', 'creado_por', $this->creado_por])
            // ->andFilterWhere(['like', 'modificado_por', $this->modificado_por]);

        return $dataProvider;
    }
}