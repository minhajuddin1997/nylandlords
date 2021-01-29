<style type="text/css">
    #sig-canvas {
        border: 2px dotted #CCCCCC;
        border-radius: 15px;
        cursor: crosshair;
    }
</style>
<div class="content">
    <div class="container-fluid">
        <div>
            <h1 style="display:inline-block;">
                Inquiry
            </h1>
            <h3 class="box-title" style="display:inline-block;">Add</h3>
        </div>
        <div class="col-md-6">
            <form role="form" action="<?php echo base_url('department/client_add')?>" method="post" enctype="multipart/form-data">
                <div class="box-body">

                    <div class="form-group">
                        <label>Inquiry Name</label>
                        <input type="text" class="form-control" id="inquiry_name" required name="inquiry_name" >
                    </div>

                    <input type="hidden" name="client_id" value="<?php echo $this->session->userdata('client_id');?>">
                    <input type="hidden" name="delivery_status" value="Free Consultation">


                    <div class="form-group">
                        <label>Inquiry Type: </label>
                        <select class="form-control" id="inquiry_type" name="inquiry_type" required>
                            <?php $departments = get_list('department'); ?>
                            <option value="">Please Select</option>
                            <?php if(!empty($departments)): foreach($departments as $row):?>
                                <option value="<?php echo $row->department_id?>"><?php echo $row->department_name ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Inquiry Summary</label>
                        <textarea class="form-control editor" rows="3" id="inquiry_summary" name="inquiry_summary"><?php echo !empty($record->inquiry_summary)?$record->inquiry_summary:''?></textarea>
                    </div>
                    <input type="hidden" name="uploaded_month" value="<?php echo date("m") ?>">

                    <div class="form-group">
                        <label>Upload Summary File</label>
                        <div class="form-group">
                            <label><p>Only these file format should be accepted .pdf, .docx, .pptx, .txt, .xlsx, .rar, .zip, .xlsm, .xls, .csv, .xlsb, .xlw, xltx</p>
                                 <span id="file_name"></span>
                            </label><div class="input-group-btn"><div class="multi-image-upload"><div class="file-btn"><input type="file" id="summary_file"  name="summary_file" accept=".pdf, .docx, .pptx, .txt, .xlsx, .rar, .zip, .xlsm, .xls, .csv, .xlsb, .xlw, xltx" ><label class="btn btn-info">Upload</label>

                            </div></div></div></div>
                       <!--  <div class="input-group-btn">
                            <div class="multi-image-upload"> -->
                                   <!--    <button id="showfileupload" style="border-color: #09af3b;color: #fff;background: #09af3b;font-size: 12px;" type="button" class="btn btn-primary "><b>Add Files</b></button> -->
                      <!--              <img src="'+linkvar+'">
                                <div class="file-btn">
                                    <input type="file" id="summary_file"  name="summary_file">
                                    <p>Only these file format should be accepted .pdf, .docx, .pptx, .txt, .xlsx, .rar, .zip, .xlsm, .xls, .csv, .xlsb, .xlw, xltx</p>
                                    <label class="btn btn-info">Upload</label>
                                </div>
                            </div>
                        </div> -->
                    </div>

                    <div class="notvisiblefile">
                    </div>
                    
                    <div id="questionHtml"></div>
                    <div class="form-group">
                        <canvas id="sig-canvas" width="250" height="100" required>
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-primary" id="sig-submitBtn">Submit Signature</button>
                        <button type="button" class="btn btn-default" id="sig-clearBtn">Clear Signature</button>
                    </div>

                    <div class="form-group">
                        <textarea style="display: none" id="sig-dataUrl" name="image_path" class="form-control" rows="5"></textarea>
                    </div>

                    <div class="form-group" id='sig_image'>

                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    $(function () {
        var checkbox = (id, options) => {
            let check = '';
            for (let op of options) {
                check += `<label>
							<input type="checkbox" value="${op}" name="${id}[]" >
							${op}</label><br>`;
            }
            return check;
        }
        var radio = (id, options) => {
            let radio = '';
            for (let op of options) {
                radio += `<label>
							<input type="radio" value="${op}" name="${id}" >
							${op}</label><br>`;
            }
            return radio;
        }
        var select = (options) => {
            let select = '';
            for (let op of options) {
                select += `<option value="${op}">${op}</option>`;
            }
            return select;
        }
        $(document).on('change','#inquiry_type',function(){
            let inquiry_type = $(this).val();
            if (inquiry_type) {
                $.ajax({
                    type: 'GET',
                    url: "<?php echo base_url('department/questions/?inquiry_type=') ?>"+inquiry_type,
                    dataType: "JSON",
                    success: function(data){
                        let questionHtml = '';
                        for (let question of data) {
                            switch (question.department_question_type) {
                                case "Text":
                                    questionHtml += `<div class="form-group">
														<label>${question.department_question_text}</label>
														<input type="text" class="form-control" name="${question.department_question_id}">
													</div>`;
                                    break;
                                case "Checkbox":
                                    questionHtml += `<div class="form-group">
														<label>${question.department_question_text}</label><br>`
                                        +checkbox(question.department_question_id, JSON.parse(question.department_question_options))+
                                        `</div>`;
                                    break;
                                case "Radio":
                                    questionHtml += `<div class="form-group">
														<label>${question.department_question_text}</label><br>`
                                        +radio(question.department_question_id, JSON.parse(question.department_question_options))+
                                        `</div>`;
                                    break;
                                case "Dropdown":
                                    questionHtml += `<div class="form-group">
														<label>${question.department_question_text}</label>
														<select name="${question.department_question_id}" class="form-control">
														<option value="">${question.department_question_text}</option>`
                                        +select(JSON.parse(question.department_question_options))+
                                        `</select></div>`;
                                    break;
                                default:
                                    questionHtml += ``;

                            }
                        }
                        $('#questionHtml').html(questionHtml);
                        let abc = JSON.parse(data[0].department_question_options);
                        console.log(abc[0])
                    }
                })
            }
        })
    })
</script>


<script type="text/javascript">
    (function() {
        // $input_field = $('#summary_file');
        // $("#summary_file").on('change',function(){
        //     if ( !(/\.(pdf|docx|xls|xlsm|pptx|txt|zip|rar)$/i).test( $input_field.val() )) {
        //   toastr.error('File Not allowed');
        //     $('#summary_file').val() == '';

        //   return false;
        //     }else{
        //         var name = document.getElementById('summary_file'); 
        //         console.log(name.files.item(0).name);
        //         $("#file_name").html('Selected file: '+name.files.item(0).name);
        //         return true;
        //     }
        // });
        
        window.requestAnimFrame = (function(callback) {
            return window.requestAnimationFrame ||
                window.webkitRequestAnimationFrame ||
                window.mozRequestAnimationFrame ||
                window.oRequestAnimationFrame ||
                window.msRequestAnimaitonFrame ||
                function(callback) {
                    window.setTimeout(callback, 1000 / 60);
                };
        })();

        var canvas = document.getElementById("sig-canvas");
        var ctx = canvas.getContext("2d");
        ctx.strokeStyle = "#222222";
        ctx.lineWidth = 4;

        var drawing = false;
        var mousePos = {
            x: 0,
            y: 0
        };
        var lastPos = mousePos;

        canvas.addEventListener("mousedown", function(e) {
            drawing = true;
            lastPos = getMousePos(canvas, e);
        }, false);

        canvas.addEventListener("mouseup", function(e) {
            drawing = false;
        }, false);

        canvas.addEventListener("mousemove", function(e) {
            mousePos = getMousePos(canvas, e);
        }, false);

        // Add touch event support for mobile
        canvas.addEventListener("touchstart", function(e) {

        }, false);

        canvas.addEventListener("touchmove", function(e) {
            var touch = e.touches[0];
            var me = new MouseEvent("mousemove", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(me);
        }, false);

        canvas.addEventListener("touchstart", function(e) {
            mousePos = getTouchPos(canvas, e);
            var touch = e.touches[0];
            var me = new MouseEvent("mousedown", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(me);
        }, false);

        canvas.addEventListener("touchend", function(e) {
            var me = new MouseEvent("mouseup", {});
            canvas.dispatchEvent(me);
        }, false);

        function getMousePos(canvasDom, mouseEvent) {
            var rect = canvasDom.getBoundingClientRect();
            return {
                x: mouseEvent.clientX - rect.left,
                y: mouseEvent.clientY - rect.top
            }
        }

        function getTouchPos(canvasDom, touchEvent) {
            var rect = canvasDom.getBoundingClientRect();
            return {
                x: touchEvent.touches[0].clientX - rect.left,
                y: touchEvent.touches[0].clientY - rect.top
            }
        }

        function renderCanvas() {
            if (drawing) {
                ctx.moveTo(lastPos.x, lastPos.y);
                ctx.lineTo(mousePos.x, mousePos.y);
                ctx.stroke();
                lastPos = mousePos;
            }
        }

        // Prevent scrolling when touching the canvas
        document.body.addEventListener("touchstart", function(e) {
            if (e.target == canvas) {
                e.preventDefault();
            }
        }, false);
        document.body.addEventListener("touchend", function(e) {
            if (e.target == canvas) {
                e.preventDefault();
            }
        }, false);
        document.body.addEventListener("touchmove", function(e) {
            if (e.target == canvas) {
                e.preventDefault();
            }
        }, false);

        (function drawLoop() {
            requestAnimFrame(drawLoop);
            renderCanvas();
        })();

        function clearCanvas() {
            canvas.width = canvas.width;
        }

        // Set up the UI
        var sigText = document.getElementById("sig-dataUrl");
        var sigImage = document.getElementById("sig-image");
        var clearBtn = document.getElementById("sig-clearBtn");
        var submitBtn = document.getElementById("sig-submitBtn");
        clearBtn.addEventListener("click", function(e) {
            clearCanvas();
            sigText.innerHTML = "Data URL for your signature will go here!";
            
           // sigImage.setAttribute("src", "");
        }, false);
        submitBtn.addEventListener("click", function(e) {
            var dataUrl = canvas.toDataURL();
            sigText.innerHTML = dataUrl;
            $("#sig_image").html('<img id="sig-image" src="'+ dataUrl +'" alt="Your signature will go here!"/>');
            // sigImage.setAttribute("src", dataUrl);
        }, false);

    })();
</script>
