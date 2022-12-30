<?php require_once INCLUDES . "inc_head_html.php"; ?>

<div class="body-main w-full max-w-[1200px] mx-auto my-0 relative bg-[#f5f55] h-screen ">

    <?php require_once MODULES . "mod_header_main.php"; ?>

    <!-- <div class="panel-praticing bg-[#efefef] w-full flex"> -->
    <div class="w-full min-h-fit bg-transparent pt-2 flex " style="height: calc(100vh - 110px);">
        <?php require_once MODULES . "mod_sidebar_teacher.php"; ?>

        <div class="block bg-[#f3f3f3] overflow-auto" style="width: calc(100% - 250px); border-left:8px solid #ffffff">
            <div class="main_panel">
                <div class="main_panel_registervisitas_teacher w-full overflow-y-auto">
                    <div class="py-1 w-full relative px-4" style="max-height: calc(100vh - 90px);">
                        <div class="overflow-x-auto container_register_teacher pb-2px-1">
                            <h2 class="font-bold text-[1.2rem] py-2 px-1 w-full text-[#4b4b4b]">Visitas y Supervisión</h2> <!-- title -->
                            <div class="w-full flex">
                                <form id="form_visitas_teacher" action="<?php echo ROUTE_PREFIX.'teachervisitas/show_teacher_visitas';?>" method="post" class="w-autp items-center py-2">
                                    <div class="flex gap-3 flex-wrap">
                                        <div class="flex w-full gap-3 flex-wrap">
                                            <div class="w-auto flex items-center flex-wrap ">
                                                <div class="flex border h-8 items-center">
                                                    <label for="" class="w-auto mr-2 px-1 px-1 text-[.9rem]">Seleccione Especialidad</label>
                                                </div>
                                                <select id="select_especialidad_teacher" name="select_especialidad_visitas" class="text-[.9rem] h-8 rounded input-border-blue border-slate-500 px-1">
                                                    <?php
                                                    require_once(MODELS.'especialidad_model.php');
                                                    $es = new Especialidad_model();
                                                    echo "<option value=''>-- Seleccionar --</option>";
                                                    foreach ($es->get_all('especialidad')->fetchAll() as $item) {
                                                        $checked = "";
                                                        if (isset($_SESSION['data_visitas'])) {
                                                            require_once(MODELS.'practicas_model.php');
                                                            $prac = new Practicas_model();
                                                            $p = $prac->get_practica_by_id($_SESSION['data_visitas']->id_visitas_supervicion);
                                                            if ($d) {
                                                                if ($item['id_especialidad'] == $p->Especialidad_id_especialidad) {
                                                                    $checked = 'checked';
                                                                }
                                                            }
                                                        }
                                                        echo '<option value=' . $item['id_especialidad'] . ' ' . $checked . '>' . $item['nombre'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="w-auto flex items-center border">
                                                <label for="" class="w-auto mr-2 px-1 text-[.9rem]">Módulo </label>
                                                <select id="select_modules_teacher" name="select_module_visitas" class="text-[.9rem] h-8 rounded input-border-blue border-slate-500 px-1">
                                                    <option value="">-- Seleccionar --</option>
                                                    <?php
                                                    // require_once(MODELS.'modulo_model.php');
                                                    // $es = new Modulo_model();
                                                    // foreach ($es->get_all_order_by('modulo', 'especialidad_id_especialidad')->fetchAll() as $item) {
                                                    //     $checked = "";
                                                    //     if (isset($_SESSION['data_visitas'])) {
                                                    //         require_once(MODELS.'practicas_model.php');
                                                    //         $prac = new Practicas_model();
                                                    //         $p = $prac->get_practica_by_id($_SESSION['data_visitas']->id_visitas_supervicion);
                                                    //         if ($d) {
                                                    //             if ($item['id_modulo'] == $p->Modulo_id_modulo) {
                                                    //                 $checked = 'checked';
                                                    //             }
                                                    //         }
                                                    //     }
                                                    //     echo '<option value=' . $item['id_modulo'] . ' ' . $checked . ' >' . $item['nombre'] . '</option>';
                                                    // }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="w-auto flex items-center border">
                                            <div class="flex border h-8 items-center">
                                                <label for="" class="w-auto mr-2 px-1 px-1 text-[.9rem]">DNI </label>
                                            </div>
                                            <input name="select_dni_visitas" type="text" placeholder="Ingrese DNI" maxlength="8" class="text-[.9rem] h-8 rounded input-border-blue border-slate-500 px-1" required value="<?php if (isset($_SESSION['data_visitas'])) {
                                                                                                                                                                                                                                echo $_SESSION['data_visitas']->Estudiantes_DNI;
                                                                                                                                                                                                                            } ?>">
                                        </div>
                                    </div>
                                    <div class="w-auto px- py-2 my-2">
                                        <button name="button_show_visitas" class="bg-blue-700 text-[#efefef] hover:text-white hover:bg-blue-800 px-5 py-1 rounded-md min-w-[8rem]">
                                            <span>Mostrar</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto w-12/12">
                    <div class="container_results_list block w-full px-5 bottom max-h-screen overflow-auto min-w-[600px] ">
                        <div class="list_title_results w-12/12">
                            <h2 class="font-bold text-[1rem] py-2 px-1 w-full text-[#5b5b5b]">
                                <?php
                                require_once(MODELS.'estudiantes_model.php');
                                if (isset($_SESSION['data_visitas'])) {
                                    $est = new Estudiantes_model();
                                    $e = $est->get_by_DNI($_SESSION['data_visitas']->Estudiantes_DNI);
                                    echo "Estudiante: " . ucfirst($e->nombres) . " " . ucfirst($e->apellido_paterno) . " " . ucfirst($e->apellido_materno)."    DNI N°:".$e->DNI;
                                }

                                ?>
                            </h2>
                            <div class="flex bg-[rgba(2,77,131,.95)] w-10/12 text-slate-100 center text-sm py-0.5 rounded-sm">
                                <label class="w-1/12 text-center px-0.5 py-0.5">#</label>
                                <label class="w-5/12 text-center px-0.5 py-0.5">Criterio</label>
                                <label class="w-3/12 text-center px-0.5 py-0.5">Validación</label>
                            </div>
                            <?php
                            if (isset($_SESSION['data_visitas'])) {
                            ?>
                                <form action="teachervisitas/">
                                    <div class="flex bg-[rgba(2,77,131,.1)] w-10/12 text-slate-800 center text-sm py-0.5 rounded-sm">
                                        <div class="w-1/12 text-center px-0.5 py-0.5">
                                            <span>1</span> 
                                            <?php
                                                echo '<input id="asistencia_ent_sal" type="hidden" type="text" value="'.$_SESSION['data_visitas']->asistencia_ent_sal.'">';
                                            ?>
                                        </div>
                                        <div class="w-5/12 px-0.5 py-0.5">
                                            Cumple con sus Asistencias Entradas y Salidas
                                        </div>
                                        <div class="w-3/12 text-center px-0.5 py-0.5">
                                            <?php if (isset($_SESSION['data_visitas'])) {
                                                if($_SESSION['data_visitas']->asistencia_ent_sal =='No'){
                                                    echo "<label class='switch'><input id='input_check_asistencia' type='checkbox'><span class='slider round'></span></label>";
                                                }else if($_SESSION['data_visitas']->asistencia_ent_sal =='Si'){
                                                    echo "<label class='switch'><input id='input_check_asistencia' type='checkbox' checked><span class='slider round'></span></label>";
                                                } else{
                                                    echo "<label class='switch'><input id='input_check_asistencia' type='checkbox'><span class='slider round'></span></label>";
                                                }
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="flex bg-[rgba(2,77,131,.1)] w-10/12 text-slate-800 center text-sm py-0.5 rounded-sm">
                                        <div class="w-1/12 text-center px-0.5 py-0.5">
                                            <span>2</span> 
                                            <?php
                                                echo '<input id="actividad_trabajo" type="hidden" type="text" value="'.$_SESSION['data_visitas']->actividad_trabajo.'">';
                                            ?>
                                        </div>
                                        <div class="w-5/12 px-0.5 py-0.5">
                                            Cumple con sus Trabajos o Actividades
                                        </div>
                                        <div class="w-3/12 text-center px-0.5 py-0.5">
                                            <?php if (isset($_SESSION['data_visitas'])) {
                                                if($_SESSION['data_visitas']->actividad_trabajo =='No'){
                                                    echo "<label class='switch'><input id='input_check_actividad' type='checkbox'><span class='slider round'></span></label>";
                                                }else if($_SESSION['data_visitas']->actividad_trabajo =='Si'){
                                                    echo "<label class='switch'><input id='input_check_actividad' type='checkbox' checked><span class='slider round'></span></label>";
                                                }else{
                                                    echo "<label class='switch'><input id='input_check_actividad' type='checkbox'><span class='slider round'></span></label>";
                                                }
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="flex bg-[rgba(2,77,131,.1)] w-10/12 text-slate-800 text-sm py-0.5 rounded-sm">
                                        <div class="w-1/12 text-center px-0.5 py-0.5">
                                            <span>3</span>
                                            <?php
                                                echo '<input id="nose_encontro" type="hidden" type="text" value="'.$_SESSION['data_visitas']->no_se_encontro.'">';
                                            ?>
                                        </div>
                                        <div class="w-5/12 px-0.5 py-0.5">
                                            No se encontro en su Centro de Prácticas
                                        </div>
                                        <div class="w-3/12 text-center px-0.5 py-0.5">
                                            <?php 
                                            if (isset($_SESSION['data_visitas'])) {
                                                if($_SESSION['data_visitas']->no_se_encontro =='No'){
                                                    echo "<label class='switch'><input id='input_check_ausencia' type='checkbox'><span class='slider round'></span></label>";
                                                }else if($_SESSION['data_visitas']->no_se_encontro =='Si'){
                                                    echo "<label class='switch'><input id='input_check_ausencia' type='checkbox' checked><span class='slider round'></span></label>";
                                                }else{
                                                    echo "<label class='switch'><input id='input_check_ausencia' type='checkbox'><span class='slider round'></span></label>";
                                                }
                                                // echo $_SESSION['data_visitas']->no_se_encontro;
                                            } 
                                            ?>

                                        </div>
                                    </div>
                                    <div class="flex flex-wrap py-2 my-2 w-10/12">
                                        <div class="flex border h-8 items-center">
                                            <label for="" class="w-auto mr-2 px-1 px-1 text-[.9rem]">Sugerencias </label>
                                        </div>
                                        <div class="" style="width: calc(100% - 100px);">
                                            <input id='id_input_sugerencias' type="text" placeholder="Mejorar la comunicación con el Personal" class="text-[.9rem] h-8 rounded input-border-blue border-slate-500 px-1 w-full" value="<?php echo $_SESSION['data_visitas']->sugerencias; ?>">
                                        </div>
                                    </div>
                                    <div class="w-10/12 justify-center flex">
                                        <?php
                                            echo '<input id="id_visitassupervision" type="hidden" type="text" value="'.$_SESSION['data_visitas']->id_visitas_supervicion.'">';
                                        ?>
                                        <button type='button' id='button_save_visita' class="text-[.9rem] text-[#000] h-8 rounded input-border-blue border-slate-500 px-8 bg-green-400 hover:bg-green-700 hover:text-[#efefef]">Guardar</button>
                                    </div>
                                            <?php 
                                            unset($_SESSION['data_visitas']);
                                            ?>
                                </form>
                                <style>
                                    /* The switch - the box around the slider */
                                    .switch {
                                        position: relative;
                                        display: inline-block;
                                        width: 2.7rem;
                                        /* width: 60px; */
                                        height: 1.2rem;
                                        /* height: 34px; */
                                    }

                                    /* Hide default HTML checkbox */
                                    .switch input {
                                        opacity: 0;
                                        width: 0;
                                        height: 0;
                                    }

                                    /* The slider */
                                    .slider {
                                        position: absolute;
                                        cursor: pointer;
                                        top: 0;
                                        left: 0;
                                        right: 0;
                                        bottom: 0;
                                        background-color: #ccc;
                                        -webkit-transition: .4s;
                                        transition: .4s;
                                    }

                                    .slider:before {
                                        position: absolute;
                                        content: "";
                                        height: 10px;
                                        width: 10px;
                                        left: 4px;
                                        bottom: 4.5px;
                                        background-color: white;
                                        -webkit-transition: .4s;
                                        transition: .4s;
                                    }

                                    input:checked+.slider {
                                        background-color: #2196F3;
                                    }

                                    input:focus+.slider {
                                        box-shadow: 0 0 1px #2196F3;
                                    }

                                    input:checked+.slider:before {
                                        -webkit-transform: translateX(26px);
                                        -ms-transform: translateX(26px);
                                        transform: translateX(26px);
                                    }

                                    /* Rounded sliders */
                                    .slider.round {
                                        border-radius: 34px;
                                    }

                                    .slider.round:before {
                                        border-radius: 50%;
                                    }
                                </style>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once INCLUDES . "inc_footer.php"; ?>


</div>


<?php require_once INCLUDES . "inc_footer_html.php"; ?>

<script>


    //select_especialidad for load modulos
    ///load modules with ajax                                                            
    $(document).ready(function() {
        ///cargando el combobox de modulos con ajax
        $("#select_especialidad_teacher").change(function() {
            $.ajax({
                type: "POST",
                url: window.location.href + "/load_modules",
                data: $("#form_visitas_teacher").serialize(), //send data of form id=form_send_ppp_teacher
                success: function(response) {
                    var jsonData = JSON.parse(response);
                    if (jsonData.success != null) {
                        console.log(jsonData.success);
                        let data = jsonData.success;
                        let row = "<option value=''>-- seleccionar --</option>";
                        for (const item in data) {
                           row = row + "<option value='"+data[item]['id_modulo']+"'>"+data[item]['nombre']+"</option>";
                        }
                        $('#select_modules_teacher').html(row);
                    } else if (jsonData.success == []) {
                        alert('0 Resultados');
                    } else {
                        alert('0 Resultados');
                    }
                }
            });

        });
        

        /** add event for update asistencia */
        $('#input_check_asistencia').on('click', function(e){
            console.log($('#id_visitassupervision').val());
            console.log($('#asistencia_ent_sal').val()) ;
            // console.log($(this).parent().parent().parent().children().eq(0).children().eq(1).val());
            $.ajax({
                type: 'POST',
                url: window.location.href+'/visita_asistencia_update',
                data: {
                    id_visitas_supervision: $('#id_visitassupervision').val(),
                    asistencia :$('#asistencia_ent_sal').val()  //$(this).parent().parent().parent().children().eq(0).children().eq(1).val()
                },
                success: function(response){
                    var json_data = JSON.parse(response);
                    if(json_data.success == 1){
                        console.log($('#asistencia_ent_sal').val(json_data.asistencia));
                        console.log(json_data);
                    }
                }
            });
        });

        /** add event for update actividad_trabajo */
        $('#input_check_actividad').on('click', function(e){
            console.log($('#id_visitassupervision').val());
            console.log($(this).parent().parent().parent().children().eq(0).children().eq(1).val());
            $.ajax({
                type: 'POST',
                url: window.location.href+'/visita_actividad_update',
                data: {
                    id_visitas_supervision: $('#id_visitassupervision').val(),
                    actividad :$(this).parent().parent().parent().children().eq(0).children().eq(1).val()
                },
                success: function(response){
                    var json_data = JSON.parse(response);
                    if(json_data.success == 1){
                        $('#actividad_trabajo').val(json_data.actividad);
                        console.log(json_data);
                    }
                }
            });
        });

        /** add event for update no_se_encontro */
        $('#input_check_ausencia').on('click', function(e){
            console.log($('#id_visitassupervision').val());
            console.log($(this).parent().parent().parent().children().eq(0).children().eq(1).val());
            $.ajax({
                type: 'POST',
                url: window.location.href+'/visita_ausencia_update',
                data: {
                    id_visitas_supervision: $('#id_visitassupervision').val(),
                    ausencia :$(this).parent().parent().parent().children().eq(0).children().eq(1).val()
                },
                success: function(response){
                    var json_data = JSON.parse(response);
                    if(json_data.success == 1){
                        $('#nose_encontro').val(json_data.no_se_encontro);
                        console.log(json_data);
                    }
                }
            });
        });


        $('#button_save_visita').on('click',function(e){
            console.log($('#id_visitassupervision').val());
            console.log($('#id_input_sugerencias').val());
            $.ajax({
                type: 'POST',
                url: window.location.href+'/visita_sugerencia_update',
                data: {
                    id_visitas_supervision: $('#id_visitassupervision').val(),
                    sugerencias: $('#id_input_sugerencias').val()
                },
                success: function(response){
                    var jsonData = JSON.parse(response);
                    console.log(jsonData);
                }
            });
        });
    });
</script>