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
    public $departamento_nombre, $encargado_nombre;

    public function rules()
    {
        return [
            [['id_departamento', 'id_encargado'], 'integer'],
            [['nombre', 'ap_paterno', 'ap_materno', 'curp', 'tipo_sanguineo', 'num_seguro', 'categoria', 'fecha_inicio_vigencia', 'fecha_termino_vigencia', 'ruta_firma', 'ruta_foto', 'tel_emergencia', 'estatus_registro', 'creado_por', 'fecha_creacion', 'modificado_por', 'fecha_modificacion', 'departamento_nombre', 'encargado_nombre'], 'safe'],
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

        $query->joinWith(['departamento']);
        $query->joinWith(['encargado']);

        if(!empty($this->fecha_inicio_vigencia) && strpos($this->fecha_inicio_vigencia, '-') !== false) {
            list($start_date, $end_date) = explode(' - ', $this->fecha_inicio_vigencia);
            $query->andFilterWhere(['between', 'empleados.fecha_inicio_vigencia', $start_date, $end_date]);
        }

        if(!empty($this->fecha_termino_vigencia) && strpos($this->fecha_termino_vigencia, '-') !== false) {
            list($start_date, $end_date) = explode(' - ', $this->fecha_termino_vigencia);
            $query->andFilterWhere(['between', 'empleados.fecha_termino_vigencia', $start_date, $end_date]);
        }       

        $query->andFilterWhere([
            // 'id_departamento' => $this->id_departamento,
            // 'id_encargado' => $this->id_encargado,
            'departamentos.nombre' => $this->departamento_nombre,
            'encargados.nombre' => $this->encargado_nombre,
            // 'fecha_creacion' => $this->fecha_creacion,
            // 'fecha_modificacion' => $this->fecha_modificacion,
        ]);

        // echo '<pre>'; print_r($this->departamento_nombre); echo '</pre>';
        // echo '<pre>'; print_r($this->encargado_nombre); echo '</pre>';
        // die();

        $query->andFilterWhere(['like', 'UPPER(empleados.nombre)', strtoupper($this->nombre)])
            ->andFilterWhere(['like', 'UPPER(ap_paterno)', strtoupper($this->ap_paterno)])
            ->andFilterWhere(['like', 'UPPER(ap_materno)', strtoupper($this->ap_materno)])
            ->andFilterWhere(['like', 'UPPER(curp)', strtoupper($this->curp)])
            ->andFilterWhere(['like', 'UPPER(tipo_sanguineo)', strtoupper($this->tipo_sanguineo)])
            ->andFilterWhere(['like', 'UPPER(num_seguro)', strtoupper($this->num_seguro)])
            ->andFilterWhere(['like', 'UPPER(categoria)', strtoupper($this->categoria)])
            ->andFilterWhere(['like', 'UPPER(empleados.ruta_firma)', strtoupper($this->ruta_firma)])
            ->andFilterWhere(['like', 'UPPER(ruta_foto)', strtoupper($this->ruta_foto)])
            ->andFilterWhere(['like', 'UPPER(tel_emergencia)', strtoupper($this->tel_emergencia)]);
            // ->andFilterWhere(['like', 'UPPER(departamentos.nombre)', strtoupper('Secretaría Particular')])
            // ->andFilterWhere(['like', 'UPPER(encargados.nombre)', strtoupper('Lic. Carlos Enrique Iñiguez Rosique')]);
            // ->andFilterWhere(['like', 'UPPER(departamentos.nombre)', strtoupper($this->departamento_nombre)])
            // ->andFilterWhere(['like', 'UPPER(encargados.nombre)', strtoupper($this->encargado_nombre)]);



            // ->andFilterWhere(['like', 'estatus_registro', $this->estatus_registro])
            // ->andFilterWhere(['like', 'creado_por', $this->creado_por])
            // ->andFilterWhere(['like', 'modificado_por', $this->modificado_por]);

        $orden = $dataProvider->getSort()->attributes;

        $orden['departamento_nombre'] = [
            'asc'  =>["lower(departamentos.nombre)"=>SORT_ASC],
            'desc' =>["lower(departamentos.nombre)"=>SORT_DESC],
            'label'=>'Departamento'
        ];

        $orden['encargado_nombre'] = [
            'asc'  =>["lower(encargados.nombre)"=>SORT_ASC],
            'desc' =>["lower(encargados.nombre)"=>SORT_DESC],
            'label'=>'Encargado'
        ];

        $dataProvider->setSort([
            'attributes'=>$orden
        ]);

        return $dataProvider;
    }
}
