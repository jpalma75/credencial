<?php
namespace app\components;

use Yii;
// use yii\db\Expression;

class Utilidades
{
  public static function formatoFecha($f) 
  {
    if($f === '0000-00-00 00:00:00'){
      return 'No se asignado fecha';
    }
    setlocale(LC_ALL, "es_ES.utf8", "es_ES", "esp");
    $diasemana = strftime("%A", strtotime($f));
    $diames    = strftime("%e", strtotime($f));
    $mes       = strftime("%B", strtotime($f));
    $anio      = strftime("%Y", strtotime($f));      
    return utf8_encode("{$diames} de {$mes} de {$anio}");
  }

  public static function formatoFechaSinAno($f) 
  {
    if($f === '0000-00-00 00:00:00'){
      return 'No se asignado fecha';
    }
    setlocale(LC_ALL, "es_ES.utf8", "es_ES", "esp");
    $diasemana = strftime("%A", strtotime($f));
    $diames    = strftime("%e", strtotime($f));
    $mes       = strftime("%B", strtotime($f));
    return utf8_encode("{$diasemana} {$diames} de {$mes} de ");
  }

  public static function formatoFechaHora($f) 
  {
    if($f === '0000-00-00 00:00:00'){
      return 'No se asignado fecha';
    }
    setlocale(LC_ALL, "es_ES.utf8", "es_ES", "esp");
    $diasemana = strftime("%A", strtotime($f));
    $diames    = strftime("%e", strtotime($f));
    $mes       = strftime("%B", strtotime($f));
    $anio      = strftime("%Y", strtotime($f));      
    $horas     = strftime("%H", strtotime($f));      
    $minutos   = strftime("%M", strtotime($f));      
    $segundos  = strftime("%S", strtotime($f));   
    return "{$diasemana} {$diames} de {$mes} de {$anio} a las {$horas}:{$minutos}:{$segundos}";
  }

  public static function formatoaHoras($f) 
  {
    setlocale(LC_ALL, "es_ES.utf8", "es_ES", "esp");
    $horas    = strftime("%H", strtotime($f));      
    $minutos  = strftime("%M", strtotime($f));      
    $segundos = strftime("%S", strtotime($f));   
    return " a las {$horas}:{$minutos}:{$segundos}";
  }

  public static function formatoHoras($f) 
  {
    setlocale(LC_ALL, "es_ES.utf8", "es_ES", "esp");
    $horas    = strftime("%H", strtotime($f));      
    $minutos  = strftime("%M", strtotime($f));      
    $segundos = strftime("%S", strtotime($f));   
    return "{$horas}:{$minutos}:{$segundos}";
  }
    
  public static function formatoFechaCorta($f) 
  {
    if($f === '0000-00-00 00:00:00'){
      return 'No se asignado fecha';
    }
    setlocale(LC_ALL, "es_ES.utf8", "es_ES", "esp");
    // $diasemana = strftime("%A", strtotime($f));
    $diames = strftime("%d", strtotime($f));
    $mes    = strftime("%m", strtotime($f));
    $anio   = strftime("%Y", strtotime($f));      
    // return utf8_encode("{$diames} de {$mes} de {$anio}");
    return utf8_encode("{$anio}-{$mes}-{$diames}");
  }

  public static function rutaImg($rutaImg){
    $ext = explode('.', $rutaImg);

    if(isset($ext[1])){
        
        if($ext[1] == 'pdf' || $ext[1] == 'png' || $ext[1] == 'jpg' || $ext[1] == 'jpeg'){

          return  $rutaImg;
        
        }else{
          
          return  'img/logos/general.jpg';

        }
        
    }

    return '';
  }

  public static function configImg($rutaImg){
    $ext = explode('.', $rutaImg);

    if($ext[1] != ''){
      if($ext[1] == 'pdf'){
        // return ['type' => 'pdf', 'size'=> 3072,'height'=>'100%', 'showRemove'=>true, 'url'=> Url::home(true).'notas/delete-file?id='.$this->id_biblioteca_ente];
        return [
                'type'       => 'pdf',
                'size'       => 3072,
                'height'     => '100%',
                'showRemove' => false,
                // 'url'        => Url::home(true).'biblioteca/delete-file?id='.$this->id_biblioteca_ente
               ];
      }else if ($ext[1] == 'png' || $ext[1] == 'jpg' || $ext[1] == 'jpeg'){
        return [
                'type'       => 'image',
                'width'      => '100%',
                'height'     => '100%',
                'showRemove' => false,
                // 'url'        => Url::home(true).'biblioteca/delete-file?id='.$this->id_biblioteca_ente
               ];
      }else{
        return [
                'type'       => 'image',
                'width'      => '100%',
                'height'     => '100%',
                'showRemove' => false,
                // 'showRemove' =>false, 'url'=> Url::home(true).'biblioteca/delete-file?id='.$this->id_biblioteca_ente
               ];
      }
    }
  }

  public static function getMonth($f) 
  {
    switch ($f) {
    
      case '1':  return 'Enero';      break;
      case '2':  return 'Febrero';    break;
      case '3':  return 'Marzo';      break;
      case '4':  return 'Abril';      break;
      case '5':  return 'Mayo';       break;
      case '6':  return 'Junio';      break;
      case '7':  return 'Julio';      break;
      case '8':  return 'Agosto';     break;
      case '9':  return 'Septiembre'; break;
      case '10': return 'Octubre';    break;
      case '11': return 'Noviembre';  break;
      case '12': return 'Diciembre';  break;
      
      default:
        return 'Error';
      break;
    }

  }

  public static function nombreArchivo()
    {
      return date("Ymdhis");
    }
  
}