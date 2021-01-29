<!DOCTYPE html>
<html>
<head>
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="style.css">

    <title>
        kanban-chi
    </title>

</head>
<style>
    * {
        margin: 0px;
        padding: 0px;
    }

    body {
        overflow-x: auto;
    }

    button:hover,
    button:focus,
    .btn.focus,
    .readonly,
    .btn:focus {
        outline: 0;
        box-shadow: none !important;
        outline: none !important;
    }

    .card-bg-1 {
        background-image: url(https://plutoprojects.net/dev/assets/front/assets/img/card-bg-1.jpg);
        background-size: cover;
        width: 100%;
        height: 100%;
    }

    .btn-card-option {
        background-color: transparent;
        color: #fff;
        display: block;
        width: 100%;
        font-size: 20px;
        line-height: 30px;
        text-overflow: ellipsis;
    }

    .btn-card-option:hover {
        background-color: rgb(156, 166, 172, 0.2);
        color: #fff;
    }

    .dropdown-item {
        display: block;
        padding: .25rem 1.5rem;
        clear: both;
        font-weight: 400;
        color: gray;
        text-align: inherit;
        white-space: nowrap;
        background-color: transparent;
        border: 0;
    }

    .dropdown-item:hover {
        color: #000
        background-color: gray;
    }

    .dropdown-menu.show {
        width: 100%;
        display: inline-table;
        margin-top: 2px;
        border-radius: 6px;
        text-align: left;
        position: absolute;
        top: 0px;
        left: 0px !important;
    }

    .dropdown-item i {
        color: #b2bdc1 !important;
    }

    .dropdown-item i:hover {
        color: gray !important;
    }

    .dropdown-item:active,
    .dropdown-item:focus {
        outline: 0;
        box-shadow: none !important;
        outline: none !important;
        background-color: transparent !important;
        color: #b2bdc1 !important
    }

    .to-do {
        font-size: 20px;
        font-weight: 500;
        color: #fff;
    }

    button.btn.double-arrow {
        position: relative;
        padding: 15px 30px;
        outline: none;
        display: inline-block;
        height: auto;
        text-align: center;
        overflow: hidden;
        align-items: center;
        justify-content: center;
        color: #fff;
    }

    .flex {
        display: flex;
        text-align: center;
        justify-content: center;
        top: -4px;
    }

    button.btn.double-arrow span {
        opacity: 1;
        display: inline-block;
        margin-left: 10px;
    }

    button.btn.double-arrow img, button.btn.double-arrow span {
        position: absolute;
        top: 6px;
    }

    button.btn.double-arrow:hover span {
        opacity: 0;
        display: inline-block;
    }

    button.btn.double-arrow:hover img {
        opacity: 1;
        width: 20px;
        display: inline-block;
        top: 15px
    }

    button.btn.double-arrow img {
        opacity: 0;
    }

    .fa {
        color: #fff
    }

    img {
        max-width: 100%;
    }

    .textinput {
        border: 1px solid #673ab7;
        border-radius: 5px;
        margin-top: 3px;
    }

    .readonly {
        width: 100%;
        border-radius: 5px;
        margin: 2px;
        border: none;
        padding: 10px 15px;
        display: block;
        height: calc(1.5em + .75rem + 2px);
        font-size: 1rem;
        font-weight: 400;
        background-clip: padding-box;
    }

    .readonly:focus,
    .readonly:active,
    .readonly:focus-within {
        border-left: 8px solid #673ab7;
    }

    .input-group span {
        display: inline-block;
        padding: 7px;
        width: 100%;
        height: auto;
        font-size: 16px;
        text-align: center;
        justify-content: center;
        margin: 1px;
    }

    .input-group span .fa {
        color: #b2bdc1;
        font-size: 20px
    }

    /*.input-group:hover
        {
        border-radius: 5px;
        border:1px solid #673ab7;
        pa
        }*/

    #card-1 {

        width: 100%;
        height: 100%;
        max-height: 500px;
    }

    .modal-dialog-slideout {
        min-height: 100%;
        margin: 0 0 0 auto;
        background: #fff;
    }

    .modal.fade .modal-dialog.modal-dialog-slideout {
        -webkit-transform: translate(100%, 0) scale(1);
        transform: translate(100%, 0) scale(1);
    }

    .modal.fade.show .modal-dialog.modal-dialog-slideout {
        -webkit-transform: translate(0, 0);
        transform: translate(0, 0);
        display: flex;
        align-items: stretch;
        -webkit-box-align: stretch;
        height: 100%;
    }

    .modal.fade.show .modal-dialog.modal-dialog-slideout .modal-body {
        overflow-y: auto;
        overflow-x: hidden;
    }

    .modal-dialog-slideout .modal-content {
        border: 0;
    }

    .modal-dialog-slideout .modal-header, .modal-dialog-slideout .modal-footer {
        height: 69px;
        display: block;
    }

    .modal-dialog-slideout .modal-header h5 {
        float: left;
    }

    .tab-wrap {
        -webkit-transition: 0.3s box-shadow ease;
        transition: 0.3s box-shadow ease;
        border-radius: 4px;
        max-width: 100%;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-flex-wrap: wrap;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        position: relative;
        list-style: none;
        background-color: transparent;
        margin: 0px 0;
        /*
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);*/
    }

    .back {

        list-style: none;
        background-color: transparent;
        margin: 0px 0;
        display: none;
    }

    /*.tab-wrap:hover {
        box-shadow: 0 12px 23px rgba(0, 0, 0, 0.23), 0 10px 10px rgba(0, 0, 0, 0.19);
    }*/
    .modal-content {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        width: 93%;
        pointer-events: auto;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, .2);
        border-radius: .3rem;
        outline: 0;
    }

    .tab {
        display: none;
    }

    .tab:checked:nth-of-type(1) ~ .tab__content:nth-of-type(1) {
        opacity: 1;
        -webkit-transition: 0.5s opacity ease-in, 0.2s transform ease;
        transition: 0.5s opacity ease-in, 0.2s transform ease;
        position: relative;
        top: 0;
        z-index: 100;
        -webkit-transform: translateY(0px);
        transform: translateY(0px);
        text-shadow: 0 0 0;
    }

    .tab:checked:nth-of-type(2) ~ .tab__content:nth-of-type(2) {
        opacity: 1;
        -webkit-transition: 0.5s opacity ease-in, 0.2s transform ease;
        transition: 0.5s opacity ease-in, 0.2s transform ease;
        position: relative;
        top: 0;
        z-index: 100;
        -webkit-transform: translateY(0px);
        transform: translateY(0px);
        text-shadow: 0 0 0;
    }

    .tab:checked:nth-of-type(3) ~ .tab__content:nth-of-type(3) {
        opacity: 1;
        -webkit-transition: 0.5s opacity ease-in, 0.2s transform ease;
        transition: 0.5s opacity ease-in, 0.2s transform ease;
        position: relative;
        top: 0;
        z-index: 100;
        -webkit-transform: translateY(0px);
        transform: translateY(0px);
        text-shadow: 0 0 0;
    }

    .tab:checked:nth-of-type(4) ~ .tab__content:nth-of-type(4) {
        opacity: 1;
        -webkit-transition: 0.5s opacity ease-in, 0.2s transform ease;
        transition: 0.5s opacity ease-in, 0.2s transform ease;
        position: relative;
        top: 0;
        z-index: 100;
        -webkit-transform: translateY(0px);
        transform: translateY(0px);
        text-shadow: 0 0 0;
    }

    .tab:checked:nth-of-type(5) ~ .tab__content:nth-of-type(5) {
        opacity: 1;
        -webkit-transition: 0.5s opacity ease-in, 0.2s transform ease;
        transition: 0.5s opacity ease-in, 0.2s transform ease;
        position: relative;
        top: 0;
        z-index: 100;
        -webkit-transform: translateY(0px);
        transform: translateY(0px);
        text-shadow: 0 0 0;
    }

    .tab:first-of-type:not(:last-of-type) + label {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .tab:not(:first-of-type):not(:last-of-type) + label {
        border-radius: 0;
    }

    .tab:last-of-type:not(:first-of-type) + label {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    .tab:checked + label {
        background-color: #fff;
        color: #673ab7;
        box-shadow: 0 -1px 0 #fff inset;
        cursor: default;
    }

    /*.tab:checked + label:hover {
        box-shadow: 0 -1px 0 #fff inset;
        background-color: #fff;
    }*/
    .tab + label {
        width: 100%;
        box-shadow: 0 -1px 0 transparent inset;
        border-radius: 0px;
        cursor: pointer;
        display: block;
        text-decoration: none;
        color: gray;
        -webkit-box-flex: 3;
        -webkit-flex-grow: 3;
        -ms-flex-positive: 3;
        flex-grow: 3;
        background-color: transparent;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        text-align: center;
        -webkit-transition: 0.3s background-color ease, 0.3s box-shadow ease;
        transition: 0.3s background-color ease, 0.3s box-shadow ease;
        height: 40px;
        box-sizing: border-box;
        padding: 6px 0px;
        margin-top: 15px;
    }

    @media (min-width: 768px) {

        .tab + label {
            width: auto;
        }
    }

    .tab + label:hover {
        background-color: #f9f9f9;
    }

    .tab__content {
        padding: 10px 20px;
        background-color: transparent;
        position: absolute;
        width: 100%;
        z-index: -1;
        opacity: 0;
        left: 0;
        -webkit-transform: translateY(-3px);
        transform: translateY(-3px);
        border-radius: 6px;

    }

    /* Boring Styles */
    *,
    *:before,
    *:after {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    .container-1 {
        max-width: 1150px;
        margin: 0 auto;
    }

    .date-time {
        font-size: 11px;
        display: block;
    }

    .hours {
        font-size: 11px;
        padding: 6px 0px 0px 0px;
        text-align: center;
    }

    .name {
        padding: 6px 0px 0px 0px;
        text-align: left;
    }

    .profile-img {
        width: 100%;
    }

    .profile-name {
        font-size: 16px;
        font-weight: 500;
    }

    .menu.show {
        width: 100%;
        display: inline-table;
        margin-top: 3px;
        /* margin-left: -16px; */
        border-radius: 6px;
        text-align: left;
        position: absolute;
        top: 0px;
        left: 0px !important;
    }

    .menu-css {
        background-color: #fff;
        width: 100%;
        min-width: 130px;
        color: #6c757d;
        border-radius: 5px !important;
        border: 2px solid rgb(38 50 56 / 20%);
        font-size: 13px;
    }

    .menu-cs {
        background-color: #fff;
        width: 100%;
        min-width: 130px;
        color: #6c757d;
        border-radius: 5px !important;
        border: 2px solid rgb(38 50 56 / 20%);
    }

    li.dropdown-item a {
        color: #6c757d;
        text-decoration: none;
    }

    .menu-css:active,
    .menu-css:focus,
    .menu-css:hover {
        box-shadow: 0 0 11px rgba(33, 33, 33, .2);
        border: 2px solid rgb(38 50 56 / 10%);
        color: #000;

    }

    .menu-cs:active,
    .menu-cs:focus,
    .menu-cs:hover {
        box-shadow: 0 0 11px rgba(33, 33, 33, .2);
        color: #000;

    }

    .form-check-input {
        position: absolute;
        margin-top: 0.8rem;
        margin-left: 0rem;
    }

    /*.menu.show:focus
    {
        outline: 0;
        box-shadow: none !important;
        outline: none !important;
    }*/
    .caret {
        float: left;
        padding: 1px;
        margin-right: 1px;
        margin-top: 2px;
    }

    .dropdown-toggle-list::after {
        content: '\f107';
        font-family: fontawesome;
        font-size: 17px;
        color: rgb(38 50 56 / 20%);
        /* margin-left: 4px; */
        padding: 40px;
        /* top: 5px !important; */
        text-align: center !important;
        justify-content: center;
    }

    .dropdown-toggle-menu::after {
        content: '\f107';
        font-family: fontawesome;
        font-size: 17px;
        color: rgb(38 50 56 / 20%);
        /* margin-left: 4px; */
        padding: 0px;
        /* top: 5px !important; */
        text-align: center !important;
        justify-content: center;
    }

    .form-control:hover,
    .form-control:focus,
    .form-control:active {
        outline: 0;
        box-shadow: none !important;
        outline: none !important;
        border-left: 12px solid #673ab7;
        border-color: #673ab7;
    }

    input[type=checkbox] + label {
        margin: 0.2em;
        cursor: pointer;
        padding: 0.2em;
    }

    input[type=checkbox] {
        display: none;
    }

    input[type=checkbox] + label:before {
        content: "\f00c";
        font-size: 14px;
        font-size: 15px;
        font-weight: normal;
        font-family: fontawesome;
        border: 2px solid rgb(38 50 56 / 20%);
        display: inline-block;
        width: 20px;
        height: 10px;
        padding-left: 0rem;
        padding-bottom: 1.3em;
        margin-right: 0rem;
        vertical-align: bottom;
        color: transparent;
        margin-top: 5px;
        transition: .5s;
    }

    input[type=checkbox] + label:active:before {
        transform: scale(0);
    }

    input[type=checkbox]:checked + label:before {
        background-color: #673ab7;
        border-color: #673ab7;
        color: #fff;
    }

    .textarea {
        resize: none;
        width: 100%;
        height: auto;
        border: 2px solid rgba(38, 50, 56, .2) !important;
        border-radius: 4px;
    }

    .textarea:focus {
        resize: none;
        width: 100%;
        height: auto;
        border: 2px solid #673ab7 !important;
        border-radius: 4px !important;
        transition: 2.0s;
    }

    .form-check {
        position: relative;
        display: block;
        padding: 0px;
    }

    .list-cards {
        height: 100%;
        min-height: 40px;
        max-height: calc(100% - 56px);
        margin: 0;
    }

    .list-cards__scroll {
        width: 100% !important;
        overflow-x: hidden !important;
        height: 276px;
        width: 300px;
        overflow: auto;
        direction: ltr;
    }

    /* width */
    ::-webkit-scrollbar {
        width: 8px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: transparent;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #f7f1eb;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #f7f1eb;

    }

    @media screen and (max-width: 768px) {
        body {
            overflow-y: auto;
            overflow-x: hidden;
        }

        #card-1 {

            width: 100%;
            height: 20vh;
        }
    }


</style>
<body>
<section class="card-bg-1">
    <div class="container p-5">

        <div class="row">
            <div class="col-lg-4 col-sm-12">
                <div class="card list-cards" style="background-color: rgb(192, 198, 198, 0.2); height: 750px ">
                    <div class="card-body list-cards__scroll">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <p class=" to-do">To Do</p>
                            </div>
                            <div class="col-lg-6 col-sm-6 flex">
                                <button type="button" class="btn double-arrow pt-0"><img
                                            src="https://plutoprojects.net/dev/assets/front/assets/img/double-line-clipart_white.png">
                                    <span> 1 </span></button>
                                <div class="dropdown show">
                                    <a class="btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>

                                    <div class="dropdown-menu shadow" aria-labelledby="dropdownMenuLink">
                                        <!-- <a class="dropdown-item" href="#" id="exampleModal2"><i class="fa fa-pencil mr-3" aria-hidden="true"></i>Edit</a> -->
                                        <a class="dropdown-item " href="#"><i class="fa fa-trash-o mr-3"
                                                                              aria-hidden="true"></i>Delete</a>
                                        <hr>
                                        <a class="dropdown-item" href="#"><i class="fa fa-link mr-3"
                                                                             aria-hidden="true"></i>Get Link to card</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-print mr-3"
                                                                             aria-hidden="true"></i>Print</a>
                                    </div>
                                </div>
                                <button id="add" class="btn pt-0 add-more button-yellow uppercase" type="button"><i
                                            class="fa fa-plus" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <form id="card-1" ondrop="drop(event)" ondragover="allowDrop(event)" class="form-horizontal">
                            <fieldset>


                                <!-- Text input-->
                                <div id="items" class="form-group">
                                    <div class="col-lg-12 margin-bottom">

                                        <div class="next-referral col-lg-12">
                                            <!-- <div class="input-group mb-3 next-referral" draggable="true" ondragstart="drag(event)" id="drag1">
                                              <input type="text" class=" form-control readonly textinput input-md" placeholder="Hit Enter to add a card" data-toggle="modal" data-target="#exampleModal2" readonly>
                                              <span class="input_val"></span>
                                              <div class="input-group-append">
                                                <span class="input-group-text dropdown show" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><div class="">
                                            <a>
                                             <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>

                                            <div class="dropdown-menu shadow" aria-labelledby="dropdownMenuLink">

                                              <a class="dropdown-item " href="#"><i class="fa fa-trash-o mr-3" aria-hidden="true"></i>Delete</a>
                                              <hr>
                                              <a class="dropdown-item" href="#"><i class="fa fa-link mr-3" aria-hidden="true"></i>Get Link to card</a>
                                              <a class="dropdown-item" href="#"><i class="fa fa-print mr-3" aria-hidden="true"></i>Print</a>
                                            </div>
                                          </div></span>
                                              </div>
                                            </div> -->
                                            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog"
                                                 aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-slideout" role="document">
                                                    <div class="modal-content">

                                                        <div class="tab-wrap">
                                                            <input type="radio" id="tab4" name="tabGroup2" class="tab"
                                                                   checked>
                                                            <label for="tab4">Details</label>

                                                            <input type="radio" id="tab5" name="tabGroup2" class="tab">
                                                            <label for="tab5">Activity</label>

                                                            <input type="radio" id="tab6" name="tabGroup2" class="tab">
                                                            <label for="tab6">Timing </label>

                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                            <div class="tab__content mt-3">
                                                                <div class="">
                                                                    <div class="row">
                                                                        <div class="col-lg-2 col-sm-2">
                                                                            <img class="profile-img"
                                                                                 style="border-radius: 12px"
                                                                                 src="https://plutoprojects.net/dev/assets/front/assets/img/placeholder_11.jpg">
                                                                        </div>
                                                                        <div class="col-lg-5 col-sm-5 p-0">
                                                                            <span class="date-time mb-0 text-muted">31 Aug 2020 at 15:44</span>
                                                                            <p class="profile-name">Afshal Ahmed</p>
                                                                        </div>
                                                                        <div class="col-lg col-sm-5">
                                                                            <div class="btn-group">
                                                                                <a class="btn menu-css dropdown-toggle-list"
                                                                                   data-toggle="dropdown" href="#">
                                                                                    List: To Do <span
                                                                                            class="caret"></span></a>
                                                                                <ul class="dropdown-menu menu">
                                                                                    <li class="dropdown-item"><a
                                                                                                href="#" data-id="to do">To Do</a></li>
                                                                                    <li class="dropdown-item"><a
                                                                                                href="#" data-id="doing"> Doing</a></li>
                                                                                    <li class="dropdown-item"><a
                                                                                                href="#" data-id="done">Done</a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-5 col-sm-5 Subscribe-row">
                                                                            <div class="btn-group">
                                                                                <a class="btn menu-css dropdown-toggle-menu"
                                                                                   data-toggle="dropdown" href="#"> <img
                                                                                            class="mr-2"
                                                                                            src="https://plutoprojects.net/dev/assets/front/assets/img/P.png">No
                                                                                    priority <span class="caret"></span></a>
                                                                                <ul class="dropdown-menu menu">
                                                                                    <li class="dropdown-item"><a
                                                                                                href="#"><img
                                                                                                    class="mr-1"
                                                                                                    src="https://plutoprojects.net/dev/assets/front/assets/img/C.png">
                                                                                            Critical</a></li>
                                                                                    <li class="dropdown-item"><a
                                                                                                href="#"><img
                                                                                                    class="mr-2"
                                                                                                    src="https://plutoprojects.net/dev/assets/front/assets/img/H.png">High</a>
                                                                                    </li>
                                                                                    <li class="dropdown-item"><a
                                                                                                href="#"><img
                                                                                                    class="mr-2"
                                                                                                    src="https://plutoprojects.net/dev/assets/front/assets/img/M.png">Medium</a>
                                                                                    </li>
                                                                                    <li class="dropdown-item"><a
                                                                                                href="#"><img
                                                                                                    class="mr-2"
                                                                                                    src="https://plutoprojects.net/dev/assets/front/assets/img/L.png">Low</a>
                                                                                    </li>
                                                                                    <li class="dropdown-item"><a
                                                                                                href="#"><img
                                                                                                    class="mr-2"
                                                                                                    src="https://plutoprojects.net/dev/assets/front/assets/img/P.png">No
                                                                                            priority</a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3 col-sm-3">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" id="fruit1"
                                                                                       name="fruit-1" value="Apple">
                                                                                <label for="fruit1"> Done </label>
                                                                                <input type="checkbox" id="fruit2"
                                                                                       name="fruit-2">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3 col-sm-3"
                                                                             style="padding: 0px;">
                                                                            <a type="button" class=" btn menu-cs">Subscribe</a>
                                                                        </div>
                                                                        <div class="col-lg"></div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg">
                                                                            <div class="form-group">
                                                                                <label for="exampleFormControlTextarea1"
                                                                                       id="active"></label>
                                                                                <textarea
                                                                                        class="form-control textarea parrrr"
                                                                                        id="exampleFormControlTextarea1"
                                                                                        rows="3"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab__content">
                                                                <div class="card">
                                                                    <div class="card-header"
                                                                         style="background-color: #ebedf2">
                                                                        <div class="row">
                                                                            <div class="col-lg-2 col-sm-2">
                                                                                <img class="profile-img"
                                                                                     style="border-radius: 12px"
                                                                                     src="https://plutoprojects.net/dev/assets/front/assets/img/placeholder_11.jpg">
                                                                            </div>
                                                                            <div class="col-lg-3 col-sm-3 name">
                                                                                <p>Afshal Ahmed</p>
                                                                            </div>
                                                                            <div class="col-lg-7 col-sm-7 hours">
                                                                                <span class="mb-0 text-muted">an hour ago</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body text-center "
                                                                         style="background-color: #ebedf2">
                                                                        <blockquote class="blockquote mb-0">
                                                                            <p>Created new card</p>
                                                                            <input type="radio" id="tab4" class="back">
                                                                            <label for="tab4"><i style="color: gray"
                                                                                                 class="fa fa-keyboard-o mr-3"
                                                                                                 aria-hidden="true"></i><span
                                                                                        class="parrrr"></span></label>
                                                                        </blockquote>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab__content">
                                                                sa
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--  <input draggable="true" ondragstart="drag(event)" id="drag1" name="textinput" type="text" placeholder="Hit Enter to add a card" class="textinput form-control input-md">
                                             <span class="input_val"></span> -->

                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="card list-cards" style="background-color: rgb(192, 198, 198, 0.2); height: 750px">
                    <div class="card-body list-cards__scroll">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <p class=" to-do">Doing</p>
                            </div>
                            <div class="col-lg-6 col-sm-6 flex">
                                <button type="button" class="btn double-arrow pt-0"><img
                                            src="imgs/double-line-clipart_white.png"> <span> 1 </span></button>
                                <button type="button" class="btn pt-0"><i class="fa fa-ellipsis-v"
                                                                          aria-hidden="true"></i></button>
                                <button id="add-more" class="btn pt-0 add-more button-yellow uppercase" type="button"><i
                                            class="fa fa-plus" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <form id="card-1" ondrop="drop(event)" ondragover="allowDrop(event)" class="form-horizontal">
                            <fieldset>


                                <!-- Text input-->
                                <div id="item" class="form-group">
                                    <div class="col-lg-12 margin-bottom">

                                        <div class="next-referral col-12">
                                            <!--  <input draggable="true" ondragstart="drag(event)" id="drag1" name="textinput" type="text" placeholder="Hit Enter to add a card" class="textinput form-control input-md"><span class="input_val"></span> -->
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        <!-- <button class="delete btn button-white uppercase">- Remove referral</button> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="card list-cards" style="background-color: rgb(192, 198, 198, 0.2); height: 750px;">
                    <div class="card-body list-cards__scroll">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <p class=" to-do">Done</p>
                            </div>
                            <div class="col-lg-6 col-sm-6 flex">
                                <button type="button" class="btn double-arrow pt-0"><img
                                            src="imgs/double-line-clipart_white.png"> <span> 1 </span></button>
                                <button type="button" class="btn pt-0"><i class="fa fa-ellipsis-v"
                                                                          aria-hidden="true"></i></button>
                                <button id="added" class="btn pt-0 add-more button-yellow uppercase" type="button"><i
                                            class="fa fa-plus" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <form id="card-1" ondrop="drop(event)" ondragover="allowDrop(event)" class="form-horizontal">
                            <fieldset>


                                <!-- Text input-->
                                <div id="ite" class="form-group">
                                    <div class="col-lg-12 margin-bottom">

                                        <div class="next-referral col-12">
                                            <!-- <input draggable="true" ondragstart="drag(event)" id="drag1" name="textinput" type="text" placeholder="Hit Enter to add a card" class="textinput form-control input-md"><span class="input_val"></span> -->
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        <!-- <button class="delete btn button-white uppercase">- Remove referral</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<input type="hidden" vak>
<script>
    $(document).ready(function () {


        $(".delete").hide();
        //when the Add Field button is clicked
        $("#add").click(function (e) {
            $(".delete").fadeIn("1500");
            //Append a new row of code to the "#items" div
            $("#items").append(
                '<div class="next-referral col-lg-12" style="display:flex;" draggable="true" ondragstart="drag(event)" id="drag1">' +
                '<select class="form-control" name=""> ' +

                '<option>asdads</option>' +
                ' </select>' +
                ' <div class="input-group-append">' +
                '<span style="background-color:transparent; border-style: none;" class="input-group-text dropdown show" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                '<div class="">' +
                '<a><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>' +
                '<div class="dropdown-menu shadow" aria-labelledby="dropdownMenuLink">' +
                '<a class="dropdown-item " href="#"><i class="fa fa-trash-o mr-3" aria-hidden="true"></i>Delete</a><hr>' +
                '<a class="dropdown-item" href="#"><i class="fa fa-link mr-3" aria-hidden="true"></i>Get Link to card</a>' +
                '<a class="dropdown-item" href="#"><i class="fa fa-print mr-3" aria-hidden="true"></i>Print</a>' +
                '</div>' +
                '</div>' +
                '</span>' +
                '</div>' +
                '</div>'
            )
            ;
        });
        $("#add-more").click(function (e) {
            $(".delete").fadeIn("1500");
            //Append a new row of code to the "#items" div
            $("#item").append(
                '<div class="next-referral col-lg" style="display:flex;" draggable="true" ondragstart="drag(event)" id="drag2"><input autocomplete="off name="textinput" type="text" placeholder="Hit Enter to add a card" class="textinput1 form-control input-md"> <div class="input-group-append"><span style="background-color:transparent; border-style: none;" class="input-group-text dropdown show" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><div class=""><a><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a><div class="dropdown-menu shadow" aria-labelledby="dropdownMenuLink"><a class="dropdown-item " href="#"><i class="fa fa-trash-o mr-3" aria-hidden="true"></i>Delete</a><hr><a class="dropdown-item" href="#"><i class="fa fa-link mr-3" aria-hidden="true"></i>Get Link to card</a><a class="dropdown-item" href="#"><i class="fa fa-print mr-3" aria-hidden="true"></i>Print</a></div></div></span></div></div>'
            );
        });
        $("#added").click(function (e) {
            $(".delete").fadeIn("1500");
            //Append a new row of code to the "#items" div
            $("#ite").append(
                '<div class="next-referral col-lg" style="display:flex;" draggable="true" ondragstart="drag(event)" id="drag3"><input autocomplete="off name="textinput" type="text" placeholder="Hit Enter to add a card" class="textinput1 form-control input-md"> <div class="input-group-append"><span style="background-color:transparent; border-style: none;" class="input-group-text dropdown show" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><div class=""><a><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a><div class="dropdown-menu shadow" aria-labelledby="dropdownMenuLink"><a class="dropdown-item " href="#"><i class="fa fa-trash-o mr-3" aria-hidden="true"></i>Delete</a><hr><a class="dropdown-item" href="#"><i class="fa fa-link mr-3" aria-hidden="true"></i>Get Link to card</a><a class="dropdown-item" href="#"><i class="fa fa-print mr-3" aria-hidden="true"></i>Print</a></div></div></span></div></div>'
            );
        });
        $("body").on("click", ".delete", function (e) {
            $(".next-referral").last().remove();
            event.preventDefault();

        });

        $(document).on('keypress', '.textinput1', function (e) {
            if (e.which == 13) {
                let =
                para = $(this).val();
                $(this).attr('readonly', true);
                $('#exampleModal2').modal('show');
                $('.parrrr').text(para);
            }
        })
        $(document).on('keypress', '.textinput2', function (e) {
            if (e.which == 13) {
                let =
                para = $(this).val();
                $(this).attr('readonly', true);
                $('#exampleModal2').modal('show');
                $('.parrrr').text(para);
            }
        })
        $(document).on('keypress', '.textinput3', function (e) {
            if (e.which == 13) {
                let =
                para = $(this).val();
                $(this).attr('readonly', true);
                $('#exampleModal2').modal('show');
                $('.parrrr').text(para);
            }
        })
    });

</script>
<script>
    $(".dropdown-menu li a").click(function () {
        var selText = $(this).text();
        $(this).parents('.btn-group').find('.dropdown-toggle-list').html(selText + ' <span class="caret">List :</span>');
    });
</script>
<script>
    $(".dropdown-menu li a").click(function () {
        var selText = $(this).html();
        $(this).parents('.btn-group').find('.dropdown-toggle-menu').html(selText + ' <span class="caret"></span>');
    });
</script>

<script>
    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
    }

    function drop(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        ev.target.appendChild(document.getElementById(data));
    }
</script>

<script>
    $(document).keypress(
        function (event) {
            if (event.which == '13') {
                event.preventDefault();
            }
        });
</script>


</body>
</html>