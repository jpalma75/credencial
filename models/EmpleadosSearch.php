<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Empleados;

/**
 * EmpleadosSearch represents the model behind the search form about `app\models\Empleados`.
 */
class EmpleadosSearch extends Empleados
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_departamento', 'id_empleado_anterior'], 'integer'],
            [['nombre', 'ap_paterno', 'ap_materno', 'curp', 'tipo_sanguineo', 'num_seguro', 'categoria', 'fecha_inicio_vigencia', 'fecha_termino_vigencia', 'ruta_firma', 'ruta_foto', 'ruta_credencial', 'tel_emergencia', 'estatus_registro', 'creado_por', 'fecha_creacion', 'modificado_por', 'fecha_modificacion'], 'safe'],
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
        $query = Empleados::find();

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
            'id' => $this->id,
            'id_departamento' => $this->id_departamento,
            'id_empleado_anterior' => $this->id_empleado_anterior,
            'fecha_inicio_vigencia' => $this->fecha_inicio_vigencia,
            'fecha_termino_vigencia' => $this->fecha_termino_vigencia,
            'fecha_creacion' => $this->fecha_creacion,
            'fecha_modificacion' => $this->fecha_modificacion,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'ap_paterno', $this->ap_paterno])
            ->andFilterWhere(['like', 'ap_materno', $this->ap_materno])
            ->andFilterWhere(['like', 'curp', $this->curp])
            ->andFilterWhere(['like', 'tipo_sanguineo', $this->tipo_sanguineo])
            ->andFilterWhere(['like', 'num_seguro', $this->num_seguro])
            ->andFilterWhere(['like', 'categoria', $this->categoria])
            ->andFilterWhere(['like', 'ruta_firma', $this->ruta_firma])
            ->andFilterWhere(['like', 'ruta_foto', $this->ruta_foto])
            ->andFilterWhere(['like', 'ruta_credencial', $this->ruta_credencial])
            ->andFilterWhere(['like', 'tel_emergencia', $this->tel_emergencia])
            ->andFilterWhere(['like', 'estatus_registro', $this->estatus_registro])
            ->andFilterWhere(['like', 'creado_por', $this->creado_por])
            ->andFilterWhere(['like', 'modificado_por', $this->modificado_por]);

        return $dataProvider;
    }
}
