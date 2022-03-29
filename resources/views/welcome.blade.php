
@extends('layouts.main')

@section('title','123milhas')

@section('content')

<!--
foreach($voos as $key => $value){
	//echo $value['valor_total'];
	echo "<br><h3>Id ".$key.": Ida: R$ ".$value['valor_ida'].", volta: R$ ".$value['valor_volta'].". Total: R$ ".$value['valor_total']."</h3>";
	echo"<p><b>Voos de ida</b>:<br>";
	foreach($value['ida'] as $key2 => $value2){
		echo"<br>Voo ".$value2['id'].": Companhia aérea: ".$value2['cia'].". Data Saída: ".$value2['departureDate']."Data Chegada: ".$value2['arrivalDate'];
	}
	echo"</p><p><b>Voos de volta</b>:<br>";
	foreach($value['volta'] as $key3 => $value3){
		echo"<br>Voo ".$value3['id'].": Companhia aérea: ".$value3['cia'].". Data Saída: ".$value3['departureDate']."Data Chegada: ".$value3['arrivalDate'];
	}
	
}	
-->

<div id="search-container" class="col-md-12">
    &nbsp;
</div>

<div id="events-container" class="col-md-12">
    <h2>Veja o que separamos para você</h2>
    <p class="subtitle">Acompanhe...</p>
    <div id="cards-container" class="row">
        <!--
        php
        foreach($voos as $key => $value){
            //echo $value['valor_total'];
            echo "<br><h3>Id ".$key.": Ida: R$ ".$value['valor_ida'].", volta: R$ ".$value['valor_volta'].". Total: R$ ".$value['valor_total']."</h3>";
            echo"<p><b>Voos de ida</b>:<br>";
            foreach($value['ida'] as $key2 => $value2){
                echo"<br>Voo ".$value2['id'].": Companhia aérea: ".$value2['cia'].". Data Saída: ".$value2['departureDate']."Data Chegada: ".$value2['arrivalDate'];
            }
            echo"</p><p><b>Voos de volta</b>:<br>";
            foreach($value['volta'] as $key3 => $value3){
                echo"<br>Voo ".$value3['id'].": Companhia aérea: ".$value3['cia'].". Data Saída: ".$value3['departureDate']."Data Chegada: ".$value3['arrivalDate'];
            }
            
        }	
        endphp
        
        foreach(json_decode($voos) as $voo => $value)
            <div class="card col-md-12 mt-2">
                <div class="card-body">
                <p></p>
                </div>
            </div>
        endforeach
        -->
        @php
        //print_r($voos)
        @endphp
        
            
        @foreach($voos as $voo)
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-12 titulo_ida_volta">
                                IDA
                            </div>
                            <div class="col-sm-12">
                                <hr>
                                @foreach($voo['ida'] as $idas)
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <b>Cód. Voo:</b> {{$idas['id']}}
                                        </div>
                                        <div class="col-sm-3">
                                            <b>Comapnhia Aérea:</b> {{$idas['cia']}}
                                        </div>
                                        <div class="col-sm-3">
                                            <b>Data Saída:</b> {{$idas['arrivalDate']}}
                                        </div>
                                        <div class="col-sm-3">
                                        <b>Data Chegada:</b> {{$idas['arrivalDate']}}
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            </div>
                            <div class="col-sm-12 titulo_ida_volta">
                                VOLTA
                            </div>
                            <div class="col-sm-12">
                                <hr>
                                @foreach($voo['volta'] as $idas)
                                <div class="row">
                                        <div class="col-sm-3">
                                            <b>Cód. Voo:</b> {{$idas['id']}}
                                        </div>
                                        <div class="col-sm-3">
                                            <b>Comapnhia Aérea:</b> {{$idas['cia']}}
                                        </div>
                                        <div class="col-sm-3">
                                            <b>Data Saída:</b> {{$idas['arrivalDate']}}
                                        </div>
                                        <div class="col-sm-3">
                                        <b>Data Chegada:</b> {{$idas['arrivalDate']}}
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 valor_passagem">
                        <div class="row">
                            <div class="col-sm-12  text-center">
                                <b>R$ {{$voo['valor_total']}},00</b><br>
                                Por passageiro<br><br>
                                Cód. Promo: {{$voo['cod_promo']}}
                            </div>
                        </div>
                    </div>
                </div>    

            </div>
        </div>
            @php
                //print_r($k)
            @endphp
            <br><br><br>
        @endforeach
       
        
        
    </div>
</div>



<!-- comentario normal que aparece no codigo fonte -->
{{-- Comentario com blade que nao aparece no codigo fonte --}}

@endsection