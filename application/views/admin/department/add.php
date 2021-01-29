<div class="content">
    <div class="container-fluid">
        <div>
            <h1 style="display:inline-block;">
                Departments
            </h1>
            <h3 class="box-title" style="display:inline-block;">Add</h3>
        </div>
        <div class="col-md-6">
            <form role="form" action="<?php echo base_url('department/add_data') ?>" method="post"
                  enctype="multipart/form-data">
                <div class="box-body">

                    <div class="form-group">
                        <label>Department name</label>
                        <input type="name" class="form-control" id="department_name" name="department_name" required>
                    </div>

                    <div id="questions"></div>

                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-info" id="add_question">Add Question</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(() => {
        let addQuestion = (id) => {
            let card = `<div id="card${id}">
                            <button type="button" class="btn-sm remove btn btn-danger" data-id="${id}" style="color: red"><i
                                        class="fa fa-trash"></i></button>
                            <div class="form-group">
                                <label>Enter Question</label>
                                <input type="text" class="form-control" placeholder="Enter Question"
                                       name="question[${id}]" required>
                            </div>

                            <div class="form-group">
                                <label>Select Question Type</label>
                                <select name="question_type[${id}]" id="${id}" class="form-control question_type" required>
                                    <option value="" disabled="" selected="">Select Question Type</option>
                                    <option value="Text">Text</option>
                                    <option value="Checkbox">Checkbox</option>
                                    <option value="Radio">Radio</option>
                                    <option value="Dropdown">Dropdown</option>
                                </select>
                            </div>
                            <div id="form${id}"></div>
                        </div>`;
            return card;
        }
        let id = 0;
        let opt_id = 1;
        $(document).on('click','#add_question',() => $('#questions').append(addQuestion(id++)))

        $(document).on('change','.question_type',function() {
            let id = $(this).attr('id');
            let value = $(this).val();
            $(`#form${id}`).empty();
            var form;
            if (value == 'Checkbox') {
                form = `
                    <div class="form-group">
                            <input class="form-check-input disabled" type="checkbox" value="option">
                    <input type="text" name="op[${id}][]" class="form-control" aria-label="Text input with radio button">
                    <button type="button" class="btn btn-danger add" id="${id}" data-type="${value}"><i class="fa fa-plus"></i></button>
                    </div>`
            } else if (value == 'Radio') {
                form = `
                    <div class="form-group">
                            <input class="form-check-input disabled" type="radio" value="option">
                    <input type="text" name="op[${id}][]" class="form-control" aria-label="Text input with radio button">
                    <button type="button" class="btn btn-danger add" id="${id}" data-type="${value}"><i class="fa fa-plus"></i></button>
                    </div>`
            } else if (value == 'Dropdown') {
                form = `
                    <div class="form-group">
                    <input type="text" name="op[${id}][]" class="form-control" aria-label="Text input with radio button">
                    <button type="button" class="btn btn-danger add" id="${id}" data-type="${value}"><i class="fa fa-plus"></i></button>
                    </div>`
            }
            $(`#form${id}`).append(form);
        })

        let addInput = (id, type) => {
            var form;
            if (type == 'Checkbox') {
                form = `<div class="form-group">
                            <input class="form-check-input disabled" type="checkbox" value="option">
                    <input type="text" name="op[${id}][]" class="form-control" aria-label="Text input with radio button">
                    <button type="button" class="btn btn-danger minus" id="${id}"><i class="fa fa-minus"></i></button>
                    </div>`;
            } else if (type == 'Radio') {
                form = `<div class="form-group">
                            <input class="form-check-input disabled" type="radio" value="option">
                    <input type="text" name="op[${id}][]" class="form-control" aria-label="Text input with radio button">
                    <button type="button" class="btn btn-danger minus" id="${id}"><i class="fa fa-minus"></i></button>
                    </div>`;
            } else if (type == 'Dropdown') {
                form = `<div class="form-group">
                    <input type="text" name="op[${id}][]" class="form-control" aria-label="Text input with radio button">
                    <button type="button" class="btn btn-danger minus" id="${id}"><i class="fa fa-minus"></i></button>
                    </div>`;
            }
            $(`#form${id}`).append(form);
        }

        $(document).on('click','.add',function () {
            addInput($(this).attr("id"),$(this).attr("data-type"));
        });

        $(document).on('click','.minus',function() {
            $(this).closest('div').remove();
        })

        $(document).on('click','.remove',function () {
            let id=$(this).attr("data-id");
            $(`#card${id}`).remove();
        });
    })
</script>