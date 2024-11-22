

<?php $__env->startSection('title', 'CT Scan'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container p-1" style="height: 86vh;">
        <div class="row">
            <div class="col-md-6">
                <h3 class="mt-2 mb-2">Upload your CT image</h3>
                <label>Image type</label>
                <select id="ct_type_select" style="width: 35%;">
                  <option value="breastIm_inference">Breast cancer</option>
                  <option value="tuberculosis_inference">Tuberculosis</option>
                  <option value="fracture_inference">Fracture</option>
                </select>
                <br>
                <input type="file" class="custom-file-input" id="imageUpload" accept="image/*" style="margin-top: 5px;">
                <br>
                <button type="button" onclick="scan_mri()" class="btn btn-mediai mt-2">Scan <i class="fa-solid fa-qrcode"></i></button>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12" style="height: 65vh; border: 1px solid rgb(94, 159, 255); border-radius: 10px; background-color: white; padding-top: 15px">
                <img id="imageDisplay" src="" alt="Selected Image" style="max-width: 50%; max-height: 75%; display: none;">
                <h3 id="result"></h3>
            </div>
        </div>
      </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function(){
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            let diagnosis = urlParams.get('diagnosis');
            let symptom1 = urlParams.get('symptom1');
            let symptom2 = urlParams.get('symptom2');

            if(diagnosis !== null){
                $("#ct_type_select").val(symptom1);
                $('#imageDisplay').attr('src', 'storage/' + symptom2);
                const img = document.getElementById('imageDisplay');
                img.style.display = 'block'; 
                $('#result').text(diagnosis);
            }

        });

        function scan_mri(){

            var fileInput = $('#imageUpload')[0];
            if (fileInput.files.length > 0) {
                var formData = new FormData();
                formData.append('image', fileInput.files[0]);
                formData.append('type', $('#ct_type_select').val());

                show_loader();

                $.ajax({
                    url: '/ct_scan/send_mri',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        hide_loader();
                        $("#result").html(response);
                    },
                    error: function(error) {
                        hide_loader();
                        console.error("There was an error with the scan:", error);
                        alert("An error occurred while processing the scan. Please try again.");
                    }
                });
            } else {
                alert("Please select a photo");
            }
        }

        document.getElementById('imageUpload').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.getElementById('imageDisplay');
                    img.src = e.target.result;
                    img.style.display = 'block'; // Show the image element
                    document.getElementById('result').innerHTML = '';
                };

                reader.readAsDataURL(file);
            }
        });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\mediAI\resources\views/Main/ct_scan.blade.php ENDPATH**/ ?>