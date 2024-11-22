
@extends('layouts.main')
@section('title', 'Disease Prediction')
@section('content')

    <div class="container">
        <div class="row mt-2" style="height: 85vh; width: 100%;">
            <div class="col-md-3">
                <p style="display: inline-block; font-size: 25px; font-weight: bold; margin-top: 11%;">Select Symptoms: 
                    <div id="removeSymptom" style="color: rgb(255, 94, 94); display: inline; font-size: 40px; margin-left: 10%; cursor:pointer">-</div>
                    <div id="addSymptom" style="color: rgb(94, 159, 255); display: inline; font-size: 40px; cursor:pointer">+</div>
                </p>
              <div id="selectContainer">
                <!-- Initially show one select -->
                <div class="form-group mb-2">
                  <select class="form-control select_class" name="Symptom1" id="symptom-select1" style="width: 100%">
                        <option value="">None</option>
                        @foreach ($symptoms as $option)
                            <option value="{{$option->VALUE}}">{{$option->NAME}}</option>
                        @endforeach
                  </select>
                </div>            
                
                <div class="form-group mb-2" id="select_cont1">
                  <select class="form-control select_class" name="Symptom2" id="symptom-select2" style="width: 100%">
                    <option value="">None</option>
                    @foreach ($symptoms as $option)
                        <option value="{{$option->VALUE}}">{{$option->NAME}}</option>
                    @endforeach
                  </select>
                </div>            
                
                <div class="form-group mb-2" id="select_cont2">
                  <select class="form-control select_class" name="Symptom3" id="symptom-select3" style="width: 100%">
                    <option value="">None</option>
                    @foreach ($symptoms as $option)
                        <option value="{{$option->VALUE}}">{{$option->NAME}}</option>
                    @endforeach
                  </select>
                </div>            
                
                <div class="form-group mb-2" id="select_cont3">
                  <select class="form-control select_class" name="Symptom4" id="symptom-select4" style="width: 100%">
                    <option value="">None</option>
                    @foreach ($symptoms as $option)
                        <option value="{{$option->VALUE}}">{{$option->NAME}}</option>
                    @endforeach
                  </select>
                </div>            
                
                <div class="form-group mb-2" id="select_cont4">
                  <select class="form-control select_class" name="Symptom5" id="symptom-select5" style="width: 100%">
                    <option value="">None</option>
                    @foreach ($symptoms as $option)
                        <option value="{{$option->VALUE}}">{{$option->NAME}}</option>
                    @endforeach
                  </select>
                </div>            
                </div>
                <button class="btn btn-mediai mt-2" id="submit_btn" onclick="form_submit()">Predict <i class="fa-solid fa-magnifying-glass"></i></button>
              </div>
              <div class="col-md-9 mt-3" id="result_div" style="height: 81vh; border: 1px solid rgb(94, 159, 255); border-radius: 10px; background-color: white;">
                <h2 style="margin: 10px">Result:</h2>
                <div id="diagnosis" style="margin: 10px"></div>
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var global_selects = 5;
        $(document).ready(function(){

            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            let symptom = urlParams.get('symptom');

            let symptom1 = urlParams.get('symptom1');
            let symptom2 = urlParams.get('symptom2');
            let symptom3 = urlParams.get('symptom3');
            let symptom4 = urlParams.get('symptom4');
            let symptom5 = urlParams.get('symptom5');


            // Check if symptom is null
            if (symptom !== null) {
                $("#symptom-select1").val(symptom);
            }else if(symptom1 !== null){
                $("#symptom-select1").val(symptom1);
                $("#symptom-select2").val(symptom2);
                $("#symptom-select3").val(symptom3);
                $("#symptom-select4").val(symptom4);
                $("#symptom-select5").val(symptom5);
            } 

            for(let i = 1; i < 6; i++){
                $("#symptom-select" + i).select2();
            }

            $("#addSymptom").click(function(){
                // Check if there are less than 5 select elements
                if(global_selects < 5) {
                    $("#select_cont" + global_selects).removeClass("d-none");
                    global_selects++;
                }
            });

            $("#removeSymptom").click(function(){
                // Check if there are less than 5 select elements
                if(global_selects > 1) {
                    global_selects--;
                    $("#select_cont" + global_selects).addClass("d-none");
                }
            });

            if (symptom !== null)
            {
                form_submit();
            }else if(symptom1 !== null){
                form_submit(true);
            }

        });

        function form_submit(from_history = false){

            var symptom1 = $('#symptom-select1').val();
            var symptom2 = $('#symptom-select2').val();
            var symptom3 = $('#symptom-select3').val();
            var symptom4 = $('#symptom-select4').val();
            var symptom5 = $('#symptom-select5').val();

            if(symptom1 != '' || symptom2 != '' || symptom3 != '' || symptom4 != '' || symptom5 != ''){

                show_loader();
                $.ajax({
                    url: '/disease_prediction/predict', // Assuming this is the route to your form submission controller method
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        Symptom1: $('#symptom-select1').val(),
                        Symptom2: $('#symptom-select2').val(),
                        Symptom3: $('#symptom-select3').val(),
                        Symptom4: $('#symptom-select4').val(),
                        Symptom5: $('#symptom-select5').val(),
                        form: 'form',
                        from_history: from_history
                    },
                    success: function(response) {
                        // Check if the request was successful
                        if (response.html) {
                            var paragraghs = extractParagraphs(response.html).map(str => str.trim());
                            $('#diagnosis').empty();
                            let newH4 = $("<h4>");
                            newH4.text("There are chances you may have: " + paragraghs[0]);
                            $('#diagnosis').append(newH4);
                            
                            let newp = $("<p>");
                            newp.text(paragraghs[1]);
                            $('#diagnosis').append(newp);
                            
                            let newp2 = $("<p>");
                            newp2.text(paragraghs[2]);
                            $('#diagnosis').append(newp2);

                        } else {
                            // Handle error response
                            alert('Failed to submit form. Please try again.');
                        }
                        hide_loader();
                    },
                    error: function(xhr, status, error) {
                        // Handle AJAX errors
                        alert('An error occurred while submitting the form: ' + error);
                        hide_loader();
                    }
                });
            }else{
                alert("Please fill at least one symptom!");
            }
        }

        function extractParagraphs(divString) {
            // Create a temporary element to hold the provided HTML string
            let tempDiv = document.createElement('div');
            tempDiv.innerHTML = divString;

            // Select all <p> elements within the temporary <div>
            let paragraphs = tempDiv.querySelectorAll('p');

            // Extract the text content of the first three <p> elements
            let result = [];
            for (let i = 0; i < 3 && i < paragraphs.length; i++) {
                p2push = paragraphs[i].textContent.replace('  ', '');
                result.push(p2push);
            }

            return result;
        }

    </script>
@endsection