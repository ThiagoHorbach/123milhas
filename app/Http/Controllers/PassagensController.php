<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;

class PassagensController extends Controller
{
    

    

    public function index(){
        
        
        $cod = 4959;
        

        $json = file_get_contents("http://prova.123milhas.net/api/flights");
        $data = json_decode($json);

        $contador = 0;
        foreach ($data as $key => $value) {     
            $passagens[$contador]['id'] = $value->id;
            $passagens[$contador]['cia'] = $value->cia;
            $passagens[$contador]['fare'] = $value->fare;
            $passagens[$contador]['flightNumber'] = $value->flightNumber;
            $passagens[$contador]['departureDate'] = $value->departureDate;
            $passagens[$contador]['arrivalDate'] = $value->arrivalDate;
            $passagens[$contador]['origin'] = $value->origin;
            $passagens[$contador]['destination'] = $value->destination;
            $passagens[$contador]['price'] = $value->price;
            $passagens[$contador]['outbound'] = $value->outbound;
            $passagens[$contador]['inbound'] = $value->inbound;
            $contador++;
        }

        /* ORGANIZA OS PREÇOS */
        foreach ($passagens as $key => $value) {
            //echo $passagens[$key];
            //echo $passagens[$key]['cia'];
            if($passagens[$key]['outbound'] == 1){
                //ida
                if($passagens[$key]['fare'] == '4DA'){
                    //executivo
                    if(!isset($valores_ida_exec)){
                        $valores_ida_exec[] = $passagens[$key]['price'];
                    }else if(!in_array($passagens[$key]['price'], $valores_ida_exec))
                    {
                        $valores_ida_exec[] = $passagens[$key]['price'];
                    }
                    
                    
                    
                }else{
                    //economica
                    if(!isset($valores_ida)){
                        $valores_ida[] = $passagens[$key]['price'];
                    }else if(!in_array($passagens[$key]['price'], $valores_ida))
                    {
                        $valores_ida[] = $passagens[$key]['price'];
                    }
                }
            }else{
                //volta
                if($passagens[$key]['fare'] == '4DA'){
                    //executivo
                    if(!isset($valores_volta_exec)){
                        $valores_volta_exec[] = $passagens[$key]['price'];
                    }else if(!in_array($passagens[$key]['price'], $valores_volta_exec))
                    {
                        $valores_volta_exec[] = $passagens[$key]['price'];
                    }
                }else{
                    //economica
                    if(!isset($valores_volta)){
                        $valores_volta[] = $passagens[$key]['price'];
                    }else if(!in_array($passagens[$key]['price'], $valores_volta))
                    {
                        $valores_volta[] = $passagens[$key]['price'];
                    }
                }
                
            }
        }
        /* FIM ORGANIZA OS PREÇOS */

        /* SEPARA AS PASSAGENS NOS GRUPOS DE IDA,VOLTA,ECONOMICA OU NÃO */
        $contador_precos_asc = 0;
        $contador_exec_precos_asc = 0;	

        $contador_volta_precos_asc = 0;	
        $contador_volta_exec_precos_asc = 0;
        foreach ($passagens as $key => $value) {
            //echo $passagens[$key];
            //echo $passagens[$key]['cia'];
            if($passagens[$key]['outbound'] == 1){
                //ida
                if($passagens[$key]['fare'] == '4DA'){
                   
                    $ida_exec_precos_asc[$passagens[$key]['price']][$contador_exec_precos_asc]['id'] = $passagens[$key]['id'];
                    $ida_exec_precos_asc[$passagens[$key]['price']][$contador_exec_precos_asc]['cia'] = $passagens[$key]['cia'];
                    $ida_exec_precos_asc[$passagens[$key]['price']][$contador_exec_precos_asc]['fare'] = $passagens[$key]['fare'];
                    $ida_exec_precos_asc[$passagens[$key]['price']][$contador_exec_precos_asc]['flightNumber'] = $passagens[$key]['flightNumber'];
                    $ida_exec_precos_asc[$passagens[$key]['price']][$contador_exec_precos_asc]['departureDate'] = $passagens[$key]['departureDate'];
                    $ida_exec_precos_asc[$passagens[$key]['price']][$contador_exec_precos_asc]['arrivalDate'] = $passagens[$key]['arrivalDate'];
                    $ida_exec_precos_asc[$passagens[$key]['price']][$contador_exec_precos_asc]['origin'] = $passagens[$key]['origin'];
                    $ida_exec_precos_asc[$passagens[$key]['price']][$contador_exec_precos_asc]['destination'] = $passagens[$key]['destination'];
                    $ida_exec_precos_asc[$passagens[$key]['price']][$contador_exec_precos_asc]['price'] = $passagens[$key]['price'];
                    $ida_exec_precos_asc[$passagens[$key]['price']][$contador_exec_precos_asc]['outbound'] = $passagens[$key]['outbound'];
                    $ida_exec_precos_asc[$passagens[$key]['price']][$contador_exec_precos_asc]['inbound'] = $passagens[$key]['inbound'];
                    $contador_exec_precos_asc++;
                }else{
                    
                    $ida_precos_asc[$passagens[$key]['price']][$contador_precos_asc]['id'] = $passagens[$key]['id'];
                    $ida_precos_asc[$passagens[$key]['price']][$contador_precos_asc]['cia'] = $passagens[$key]['cia'];
                    $ida_precos_asc[$passagens[$key]['price']][$contador_precos_asc]['fare'] = $passagens[$key]['fare'];
                    $ida_precos_asc[$passagens[$key]['price']][$contador_precos_asc]['flightNumber'] = $passagens[$key]['flightNumber'];
                    $ida_precos_asc[$passagens[$key]['price']][$contador_precos_asc]['departureDate'] = $passagens[$key]['departureDate'];
                    $ida_precos_asc[$passagens[$key]['price']][$contador_precos_asc]['arrivalDate'] = $passagens[$key]['arrivalDate'];
                    $ida_precos_asc[$passagens[$key]['price']][$contador_precos_asc]['origin'] = $passagens[$key]['origin'];
                    $ida_precos_asc[$passagens[$key]['price']][$contador_precos_asc]['destination'] = $passagens[$key]['destination'];
                    $ida_precos_asc[$passagens[$key]['price']][$contador_precos_asc]['price'] = $passagens[$key]['price'];
                    $ida_precos_asc[$passagens[$key]['price']][$contador_precos_asc]['outbound'] = $passagens[$key]['outbound'];
                    $ida_precos_asc[$passagens[$key]['price']][$contador_precos_asc]['inbound'] = $passagens[$key]['inbound'];
                    $contador_precos_asc++;
                }
            }else{
                //volta
                if($passagens[$key]['fare'] == '4DA'){
                    $volta_exec_precos_asc[$passagens[$key]['price']][$contador_volta_exec_precos_asc]['id'] = $passagens[$key]['id'];
                    $volta_exec_precos_asc[$passagens[$key]['price']][$contador_volta_exec_precos_asc]['cia'] = $passagens[$key]['cia'];
                    $volta_exec_precos_asc[$passagens[$key]['price']][$contador_volta_exec_precos_asc]['fare'] = $passagens[$key]['fare'];
                    $volta_exec_precos_asc[$passagens[$key]['price']][$contador_volta_exec_precos_asc]['flightNumber'] = $passagens[$key]['flightNumber'];
                    $volta_exec_precos_asc[$passagens[$key]['price']][$contador_volta_exec_precos_asc]['departureDate'] = $passagens[$key]['departureDate'];
                    $volta_exec_precos_asc[$passagens[$key]['price']][$contador_volta_exec_precos_asc]['arrivalDate'] = $passagens[$key]['arrivalDate'];
                    $volta_exec_precos_asc[$passagens[$key]['price']][$contador_volta_exec_precos_asc]['origin'] = $passagens[$key]['origin'];
                    $volta_exec_precos_asc[$passagens[$key]['price']][$contador_volta_exec_precos_asc]['destination'] = $passagens[$key]['destination'];
                    $volta_exec_precos_asc[$passagens[$key]['price']][$contador_volta_exec_precos_asc]['price'] = $passagens[$key]['price'];
                    $volta_exec_precos_asc[$passagens[$key]['price']][$contador_volta_exec_precos_asc]['outbound'] = $passagens[$key]['outbound'];
                    $volta_exec_precos_asc[$passagens[$key]['price']][$contador_volta_exec_precos_asc]['inbound'] = $passagens[$key]['inbound'];
                    $contador_volta_exec_precos_asc++;
                }else{
                    $volta_precos_asc[$passagens[$key]['price']][$contador_volta_precos_asc]['id'] = $passagens[$key]['id'];
                    $volta_precos_asc[$passagens[$key]['price']][$contador_volta_precos_asc]['cia'] = $passagens[$key]['cia'];
                    $volta_precos_asc[$passagens[$key]['price']][$contador_volta_precos_asc]['fare'] = $passagens[$key]['fare'];
                    $volta_precos_asc[$passagens[$key]['price']][$contador_volta_precos_asc]['flightNumber'] = $passagens[$key]['flightNumber'];
                    $volta_precos_asc[$passagens[$key]['price']][$contador_volta_precos_asc]['departureDate'] = $passagens[$key]['departureDate'];
                    $volta_precos_asc[$passagens[$key]['price']][$contador_volta_precos_asc]['arrivalDate'] = $passagens[$key]['arrivalDate'];
                    $volta_precos_asc[$passagens[$key]['price']][$contador_volta_precos_asc]['origin'] = $passagens[$key]['origin'];
                    $volta_precos_asc[$passagens[$key]['price']][$contador_volta_precos_asc]['destination'] = $passagens[$key]['destination'];
                    $volta_precos_asc[$passagens[$key]['price']][$contador_volta_precos_asc]['price'] = $passagens[$key]['price'];
                    $volta_precos_asc[$passagens[$key]['price']][$contador_volta_precos_asc]['outbound'] = $passagens[$key]['outbound'];
                    $volta_precos_asc[$passagens[$key]['price']][$contador_volta_precos_asc]['inbound'] = $passagens[$key]['inbound'];
                    $contador_volta_precos_asc++;
                }
                
            }
        }
        /* FIM SEPARA AS PASSAGENS NOS GRUPOS DE IDA,VOLTA,ECONOMICA OU NÃO */
        
        //-------------------- MONTAR VOOS --------------------------------------------
        $contador_voos = 1;

        // ------------------ ---------------- ------------------ economica	
        //foreach valores de ida	
        foreach($valores_ida as $key => $value){
            //foreach valores de volta
            foreach($valores_volta as $key2 => $value2){
                $total = $value + $value2;
                
                $cod++;
                $voos[$contador_voos]['cod_promo']=$cod;
                $voos[$contador_voos]['valor_ida']=$value;
                $voos[$contador_voos]['valor_volta']=$value2;
                $voos[$contador_voos]['valor_total']=$total;
                
                //foreach com todas as passagens de ida que se encaixam neste valor e classe
                $contador_ida = 0;
                foreach($ida_precos_asc[$value] as $key3 => $value3){
                    if($value3['price'] == $value){
                        $voos[$contador_voos]['ida'][$contador_ida]['id'] = $value3['id'];
                        $voos[$contador_voos]['ida'][$contador_ida]['cia'] = $value3['cia'];
                        $voos[$contador_voos]['ida'][$contador_ida]['fare'] = $value3['fare'];
                        $voos[$contador_voos]['ida'][$contador_ida]['flightNumber'] = $value3['flightNumber'];
                        $voos[$contador_voos]['ida'][$contador_ida]['departureDate'] = $value3['departureDate'];
                        $voos[$contador_voos]['ida'][$contador_ida]['arrivalDate'] = $value3['arrivalDate'];
                        $voos[$contador_voos]['ida'][$contador_ida]['origin'] = $value3['origin'];
                        $voos[$contador_voos]['ida'][$contador_ida]['destination'] = $value3['destination'];
                        $voos[$contador_voos]['ida'][$contador_ida]['price'] = $value3['price'];
                        $voos[$contador_voos]['ida'][$contador_ida]['outbound'] = $value3['outbound'];
                        $voos[$contador_voos]['ida'][$contador_ida]['inbound'] = $value3['inbound'];
                        $contador_ida++;
                    }
                }
               
                //foreach com todas as passagens de volta que se encaixam neste valor e classe
                $contador_volta = 0;
                foreach($volta_precos_asc[$value2] as $key4 => $value4){
                    if($value4['price'] == $value2){
                        $voos[$contador_voos]['volta'][$contador_volta]['id'] = $value4['id'];
                        $voos[$contador_voos]['volta'][$contador_volta]['cia'] = $value4['cia'];
                        $voos[$contador_voos]['volta'][$contador_volta]['fare'] = $value4['fare'];
                        $voos[$contador_voos]['volta'][$contador_volta]['flightNumber'] = $value4['flightNumber'];
                        $voos[$contador_voos]['volta'][$contador_volta]['departureDate'] = $value4['departureDate'];
                        $voos[$contador_voos]['volta'][$contador_volta]['arrivalDate'] = $value4['arrivalDate'];
                        $voos[$contador_voos]['volta'][$contador_volta]['origin'] = $value4['origin'];
                        $voos[$contador_voos]['volta'][$contador_volta]['destination'] = $value4['destination'];
                        $voos[$contador_voos]['volta'][$contador_volta]['price'] = $value4['price'];
                        $voos[$contador_voos]['volta'][$contador_volta]['outbound'] = $value4['outbound'];
                        $voos[$contador_voos]['volta'][$contador_volta]['inbound'] = $value4['inbound'];
                        $contador_volta++;
                    }
                }
              
                $contador_voos++;
            }
        }
            
            
        // ------------------ ---------------- ------------------ Executiva	
        //foreach valores de ida	
        foreach($valores_ida_exec as $key => $value){
            //foreach valores de volta
            foreach($valores_volta_exec as $key2 => $value2){
                $total = $value + $value2;
                
                $cod++;
                
                $voos[$contador_voos]['cod_promo']=$cod;
                $voos[$contador_voos]['valor_ida']=$value;
                $voos[$contador_voos]['valor_volta']=$value2;
                $voos[$contador_voos]['valor_total']=$total;
                
                //foreach com todas as passagens de ida que se encaixam neste valor e classe
                $contador_ida = 0;
                
                foreach($ida_exec_precos_asc[$value] as $key3 => $value3){
                    if($value3['price'] == $value){
                        $voos[$contador_voos]['ida'][$contador_ida]['id'] = $value3['id'];
                        $voos[$contador_voos]['ida'][$contador_ida]['cia'] = $value3['cia'];
                        $voos[$contador_voos]['ida'][$contador_ida]['fare'] = $value3['fare'];
                        $voos[$contador_voos]['ida'][$contador_ida]['flightNumber'] = $value3['flightNumber'];
                        $voos[$contador_voos]['ida'][$contador_ida]['departureDate'] = $value3['departureDate'];
                        $voos[$contador_voos]['ida'][$contador_ida]['arrivalDate'] = $value3['arrivalDate'];
                        $voos[$contador_voos]['ida'][$contador_ida]['origin'] = $value3['origin'];
                        $voos[$contador_voos]['ida'][$contador_ida]['destination'] = $value3['destination'];
                        $voos[$contador_voos]['ida'][$contador_ida]['price'] = $value3['price'];
                        $voos[$contador_voos]['ida'][$contador_ida]['outbound'] = $value3['outbound'];
                        $voos[$contador_voos]['ida'][$contador_ida]['inbound'] = $value3['inbound'];
                        $contador_ida++;
                    }
                }
               
                //foreach com todas as passagens de volta que se encaixam neste valor e classe
                $contador_volta = 0;
                foreach($volta_exec_precos_asc[$value2] as $key4 => $value4){
                    if($value4['price'] == $value2){
                        $voos[$contador_voos]['volta'][$contador_volta]['id'] = $value4['id'];
                        $voos[$contador_voos]['volta'][$contador_volta]['cia'] = $value4['cia'];
                        $voos[$contador_voos]['volta'][$contador_volta]['fare'] = $value4['fare'];
                        $voos[$contador_voos]['volta'][$contador_volta]['flightNumber'] = $value4['flightNumber'];
                        $voos[$contador_voos]['volta'][$contador_volta]['departureDate'] = $value4['departureDate'];
                        $voos[$contador_voos]['volta'][$contador_volta]['arrivalDate'] = $value4['arrivalDate'];
                        $voos[$contador_voos]['volta'][$contador_volta]['origin'] = $value4['origin'];
                        $voos[$contador_voos]['volta'][$contador_volta]['destination'] = $value4['destination'];
                        $voos[$contador_voos]['volta'][$contador_volta]['price'] = $value4['price'];
                        $voos[$contador_voos]['volta'][$contador_volta]['outbound'] = $value4['outbound'];
                        $voos[$contador_voos]['volta'][$contador_volta]['inbound'] = $value4['inbound'];
                        $contador_volta++;
                    }
                }
                
               
                $contador_voos++;
            }
        }	

        // Ordena
        usort($voos, function($a, $b) {
            return $a['valor_total'] > $b['valor_total'];
        });
        
        //$events = Event::all();

        //$voos = json_encode($voos);

        return view('welcome', ['voos' => $voos]);
        //return view('welcome')->with('voos', json_encode($voos, true));

        
    }

   
       

}
