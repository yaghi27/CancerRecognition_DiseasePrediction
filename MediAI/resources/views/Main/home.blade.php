
@extends('layouts.main')
@section('title', 'Home')
@section('content')

    <main role="main"  style="height: 85vh !important">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron mt-2">
        <div class="container">
          <h1>Hello, {{ $user_name . ' ' . $user_last_name }}!</h1>
        </div>
      </div>

      <div class="container mt-4">
        <!-- Example row of columns -->
        <h2>Quick actions:</h2>
        <div class="row mt-3">
          <div class="col-md-4">
            <h4>Predict disease now!</h4>
                <select id="symptom_select" style="margin-left:5px; width: 80%" class="js-example-basic-single">
                    <option value="">None</option>
                    @foreach ($symptoms as $option)
                        <option value="{{$option->VALUE}}">{{$option->NAME}}</option>
                    @endforeach
                </select>
                <br>
                <button class="btn btn-sm mt-2 btn-mediai col-md-3" onclick="predict_disease()" style="margin-left: 2px;" role="button">Predict <i class="fa-solid fa-magnifying-glass"></i></button>
          </div>
          <div class="col-md-4">
            <h4>Scan CT image.</h4>
            <label class="mb-2">Image type</label>
            <select id="ct_type_select" style="width: 35%">
                <option value="breastIm_inference">Breast cancer</option>
                <option value="tuberculosis_inference">Tuberculosis</option>
                <option value="fracture_inference">Fracture</option>
            </select>
            <br>
                <input type="file" class="custom-file-input" id="imageUpload" accept="image/*">
            <br>
            <button class="btn btn-sm mt-2 btn-mediai col-md-3" onclick="scan_mri()" style="margin-left: 2px;" role="button">Scan <i class="fa-solid fa-qrcode"></i></button>
          </div>
          <div class="col-md-4">
            <h4>Recent activity:</h4>
            <ol id="recent_activity_list" class="list-group">
                @foreach ($recent_act_list as $act)
                    <li onclick="go_to_ra(this, '{{$act->TYPE}}')" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Click for more details!" class="list-group-item d-flex justify-content-between align-items-start" style="cursor: pointer;">
                        <div class="ms-2 me-auto">
                            @if ($act->TYPE == 'DP')
                                <div class="fw-bold"><i class="fa-solid fa-magnifying-glass"></i> Disease</div>
                            @else
                                <div class="fw-bold"><i class="fa-solid fa-qrcode"></i> CT Scan</div>
                            @endif
                            <p style="margin-left: 9%; width: 100%;">
                                @if ($act->TYPE == "CT")
                                    <?php

                                        if($act->SYMPTOM1 == 'breastIm_inference'){
                                            echo "Breast cancer ";
                                        }else if($act->SYMPTOM1 == 'tuberculosis_inference'){
                                            echo "Tuberculosis ";
                                        }else{
                                            echo "Fracture ";
                                        }

                                    ?>
                               @endif {{ $act->DIAGNOSIS }} {{ str_replace('.000', '', $act->DATE); }}
                            </p>
                            <div class="d-none">
                                <input type="text" class="symptom1" value="{{$act->SYMPTOM1}}"/>
                                <input type="text" class="symptom2" value="{{$act->SYMPTOM2}}"/>
                                <input type="text" class="symptom3" value="{{$act->SYMPTOM3}}"/>
                                <input type="text" class="symptom4" value="{{$act->SYMPTOM4}}"/>
                                <input type="text" class="symptom5" value="{{$act->SYMPTOM5}}"/>
                                <input type="text" class="diagnosis" value="{{$act->DIAGNOSIS}}"/>
                            </div>
                        </div>
                    </li>
                @endforeach            
            </ol>
          </div>
        </div>
      </div> 

    </main>
@endsection

@section('script')
    
    <script>
        $(document).ready(function(){
            $("#symptom_select").select2();
        });

        function predict_disease(){
            var symptom = $('#symptom_select').val();
            if(symptom == ''){
                alert("Please select one symptom");
                return;
            }
            show_loader();
            window.location.href = "{{ route('disease_prediction') }}?symptom=" + symptom;
        }

        function go_to_ra(that, type){
            if(type == 'DP'){
                var symptom1 = that.querySelector('.symptom1').value;
                var symptom2 = that.querySelector('.symptom2').value;
                var symptom3 = that.querySelector('.symptom3').value;
                var symptom4 = that.querySelector('.symptom4').value;
                var symptom5 = that.querySelector('.symptom5').value;
    
                window.location.href = "{{ route('disease_prediction') }}?symptom1=" + symptom1 + "&symptom2=" + symptom2 + "&symptom3=" + symptom3 + "&symptom4=" + symptom4 + "&symptom5=" + symptom5;
            }else{
                var symptom1 = that.querySelector('.symptom1').value;
                var symptom2 = that.querySelector('.symptom2').value;
                var diagnosis = that.querySelector('.diagnosis').value;
                window.location.href = "{{ route('ct_scan') }}?symptom1=" + symptom1 + "&symptom2=" + symptom2 + "&diagnosis=" + diagnosis;

            }
        }

        function scan_mri(){
            if($('#imageUpload').val() != ''){
                show_loader();
                var fileInput = $('#imageUpload')[0];
                var formData = new FormData();
                formData.append('image', fileInput.files[0]);
                formData.append('type', $('#ct_type_select').val());

                $.ajax({
                    url: '/ct_scan/send_mri',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        hide_loader();
                        alert(response);
                        location.reload();
                    },
                    error: function(error) {
                        hide_loader();
                        console.error("There was an error with the scan:", error);
                        alert("An error occurred while processing the scan. Please try again.");
                    }
                });
            }else{
                alert("Please select an image.")
            }
        }

    </script>
@endsection