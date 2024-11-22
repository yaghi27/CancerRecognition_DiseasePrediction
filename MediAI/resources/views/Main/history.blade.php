
@extends('layouts.main')
@section('title', 'History')
@section('content')

    <div class="container p-2" style="height: 86vh">
        <div class="row">
            <div class="col-md-6 p-2">
              <div class="bg-white p-2" style="border-radius: 10px; height: 82vh; overflow-y: scroll;">
                <h3 class="mb-3">Diagnosis</h3>
                    <ol class="list-group">
                        @foreach ($disease_prediction_list as $act)
                        <li onclick="go_to_dp(this)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Click for more details!" class="list-group-item d-flex justify-content-between align-items-start mb-2" style="background-color: hsl(0, 0%, 96%); border-radius: 10px; cursor: pointer;">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold"><i class="fa-solid fa-magnifying-glass"></i> Disease</div>
                                <p style="margin-left: 7%; width: 100%;">
                                    {{ $act->DIAGNOSIS }} {{ str_replace('.000', '', $act->DATE); }}
                                </p>
                                <div class="d-none">
                                    <input type="text" class="symptom1" value="{{$act->SYMPTOM1}}"/>
                                    <input type="text" class="symptom2" value="{{$act->SYMPTOM2}}"/>
                                    <input type="text" class="symptom3" value="{{$act->SYMPTOM3}}"/>
                                    <input type="text" class="symptom4" value="{{$act->SYMPTOM4}}"/>
                                    <input type="text" class="symptom5" value="{{$act->SYMPTOM5}}"/>
                                </div>
                            </div>
                        </li>
                        @endforeach    
                    </ol>
                </div>
            </div>
            <div class="col-md-6 p-2">
              <div class="bg-white p-2" style="border-radius: 10px; height: 82vh; overflow-y: scroll;">
                  <h3>CT Scans</h3>
                  <ol class="list-group">
                    @foreach ($ct_image_list as $act)
                    <li onclick="go_to_ct(this)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Click for more details!" class="list-group-item d-flex justify-content-between align-items-start mb-1" style="background-color: hsl(0, 0%, 96%); border-radius: 10px; cursor: pointer;">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold"><i class="fa-solid fa-qrcode"></i> CT Scan</div>
                            <p style="margin-left: 7%; width: 100%;">
                                <?php

                                    if($act->SYMPTOM1 == 'breastIm_inference'){
                                        echo "Breast cancer ";
                                    }else if($act->SYMPTOM1 == 'tuberculosis_inference'){
                                        echo "Tuberculosis ";
                                    }else{
                                        echo "Fracture ";
                                    }

                                ?>
                               {{ $act->DIAGNOSIS }} {{ str_replace('.000', '', $act->DATE); }}
                            </p>
                            <div class="d-none">
                                <input type="text" class="symptom1" value="{{$act->SYMPTOM1}}"/>
                                <input type="text" class="symptom2" value="{{$act->SYMPTOM2}}"/>
                                <input type="text" class="diagnosis" value="{{$act->DIAGNOSIS}}"/>
                            </div>
                        </div>
                    </li>
                    @endforeach    
                  </ol>
              </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function go_to_dp(that){
            var symptom1 = that.querySelector('.symptom1').value;
            var symptom2 = that.querySelector('.symptom2').value;
            var symptom3 = that.querySelector('.symptom3').value;
            var symptom4 = that.querySelector('.symptom4').value;
            var symptom5 = that.querySelector('.symptom5').value;

            window.location.href = "{{ route('disease_prediction') }}?symptom1=" + symptom1 + "&symptom2=" + symptom2 + "&symptom3=" + symptom3 + "&symptom4=" + symptom4 + "&symptom5=" + symptom5;
        }

        function go_to_ct(that){
            var symptom1 = that.querySelector('.symptom1').value;
            var symptom2 = that.querySelector('.symptom2').value;
            var diagnosis = that.querySelector('.diagnosis').value;
            window.location.href = "{{ route('ct_scan') }}?symptom1=" + symptom1 + "&symptom2=" + symptom2  + "&diagnosis=" + diagnosis;

        }

    </script>
@endsection