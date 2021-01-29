<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
<div class="content">
    <div class="container-fluid">
        <div>
            <h2 style="display:inline-block;">
                File Upload
            </h2>
            <h3 class="box-title" style="display:inline-block;">View</h3>
        </div>
        <hr style="border-top: 1px solid #504444;">
        <div class="col-md-12">
            <div class="box-body">
                <div class="table-responsive">

                    <form action="<?php echo base_url('File_Upload/mult_file'); ?>" class="dropzone" id="dropzoneFrom">

                    </form>
                    <br/>
                    <br/>
                    <div align="center">
                        <button type="button" class="btn btn-info" id="submit-all">Upload</button>
                    </div>
                    <br/>
                    <br/>
                    <div id="preview"></div>

                </div>
            </div>
            <div class="box-footer">
            </div>
        </div>
    </div>
</div>
<script>
    //this dropzone Drag and drop
    Dropzone.options.dropzoneFrom = {
        autoProcessQueue: false,
        parallelUploads: 5,
        acceptedFiles: ".bmp,.docx,.xltx,.csv,.zip,.rar,.pdf,.pptx,.txt,.xlsx,.xlsm,.xls,.xlw",
        init: function () {
            var submitButton = document.querySelector('#submit-all');
            myDropzone = this;
            submitButton.addEventListener("click", function () {

                myDropzone.processQueue();
            });
            this.on("complete", function () {
                if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                    var _this = this;
                    _this.removeAllFiles();

                }
                //list_image();
            });
            this.on('success', function(){

                                    toastr.success('Documents Uploaded');

            });
            this.on('error',function(){
                toastr.error('Error');
            });
        },
    };

    function list_image() {
        $.ajax({
            url: '<?php echo base_url("File_Upload/mult_file");?>',
            success: function (data) {
                console.log(data);
                toastr.success('Documents Uploaded');
            }
        });
    }

</script>