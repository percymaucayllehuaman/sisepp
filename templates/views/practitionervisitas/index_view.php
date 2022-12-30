<?php require_once INCLUDES . "inc_head_html.php"; ?>

<div class="body-main w-full max-w-[1200px] mx-auto my-0 relative bg-[#f5f55] h-screen ">

    <?php require_once MODULES . "mod_header_main.php"; ?>




    <!-- <div class="panel-praticing bg-[#efefef] w-full flex"> -->
    <div class="w-full min-h-fit bg-transparent pt-2 flex " style="height: calc(100vh - 110px);">
        <?php require_once MODULES . "mod_sidebar_practitioner.php"; ?>

        <div class="block bg-[#f3f3f3]" style="width: calc(100% - 250px); border-left:8px solid #ffffff">
            <div class="main_panel overflow-auto" style="height: calc(100vh - 90px);">
                <div class="main_panel_registervisitas_practitioner w-full ">
                    <div class="py-1 w-full relative px-4" style="max-height: calc(100vh - 90px);">
                        <div class="overflow-x-auto container_register_teacher pb-2">
                            <h2 class="font-bold text-[1.2rem] py-2 px-1 w-full">Visitas y Supervisión</h2>
                            <div class="w-full flex">
                                <form id="form_visitassupervi_pract" action="<?php echo ROUTE_PREFIX.'practitionervisitas/show_visitas';?>" method="post" class="w-autp items-center py-2">
                                    <div class="flex gap-3 flex-wrap">
                                        <div class="flex w-full gap-3 flex-wrap">
                                            <div class="w-auto flex items-center border flex-wrap ">
                                                <label for="" class="w-auto mr-2 px-1">Seleccione Especialidad </label>
                                                <select id="select_especialidad_visi_pract" name="select_especialidad_visi" class="text-[.9rem] h-8 rounded input-border-blue border-slate-500 px-1">
                                                    <option value="">-- Seleccionar --</option>
                                                    <?php
                                                        require_once(MODELS.'especialidad_model.php');
                                                        $es = new Especialidad_model();
                                                        $data = $es->get_all("especialidad")->fetchAll();
                                                        
                                                        foreach ($data as $item) {
                                                            echo "<option value='".$item['id_especialidad']."'>".$item['nombre']."</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="w-auto flex items-center border">
                                                <label for="" class="w-auto mr-2 px-1">Módulo </label>
                                                <select id="select_module_visi_pract" name="select_module_visi" class="text-[.9rem] h-8 rounded input-border-blue border-slate-500 px-1">
                                                    <option value="">-- Seleccionar --</option>
                                                    <?php
                                                        // require_once(MODELS.'empresa_model.php');
                                                        // $m = new Empresa_model();
                                                        // $data = $m->get_all_order_by("modulo","Especialidad_id_especialidad")->fetchAll();
                                                        // foreach ($data as $item) {
                                                        //     echo "<option value='".$item['id_modulo']."'>".$item['nombre']."</option>";
                                                        // }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="w-auto flex items-center border">
                                            <label for="" class="w-auto mr-2 px-1">Año </label>
                                            <select name="select_year_visi" class="text-[.9rem] h-8 rounded input-border-blue border-slate-500 px-1">
                                                <option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
                                                <option value="<?php echo date('Y') - 1; ?>"><?php echo date('Y') - 1; ?></option>
                                                <option value="<?php echo date('Y') - 2; ?>"><?php echo date('Y') - 2; ?></option>
                                                <option value="<?php echo date('Y') - 3; ?>"><?php echo date('Y') - 3; ?></option>
                                                <option value="<?php echo date('Y') - 4; ?>"><?php echo date('Y') - 4; ?></option>
                                                <option value="<?php echo date('Y') - 5; ?>"><?php echo date('Y') - 5; ?></option>
                                            </select>
                                        </div>
                                        <div class="w-auto flex items-center border">
                                            <label for="" class="w-auto mr-2 px-1">Periodo </label>
                                            <select name="select_period_visi" class="text-[.9rem] h-8 rounded input-border-blue border-slate-500 px-1">
                                                <option value="I">I</option>
                                                <option value="II">II</option>
                                                <option value="III">III</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="w-auto px- py-2 my-2">
                                        <button id="button_show_visitas_pract" class="bg-blue-700 text-[#efefef] hover:text-white hover:bg-blue-800 px-5 py-1 rounded-md min-w-[8rem]">
                                            <span>Mostrar</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto w-12/12">
                    <div class="container_results_list block w-full px-5 bottom max-h-screen overflow-auto min-w-[800px] ">
                        <div id="div_results_visitas_pract" class="list_title_results w-12/12">
                            <div class="flex bg-[rgba(2,77,131,.95)] w-12/12 text-slate-100 justify-center items-center center text-sm py-0.5 rounded-sm">
                                <label class="w-2/12 text-center px-0.5 py-0.5">Fecha</label>
                                <label class="w-2/12 text-center px-0.5 py-0.5">Cumple con sus asistencias de entrada y salida</label>
                                <label class="w-2/12 text-center px-0.5 py-0.5">Cumple con los trabajos o actividades</label>
                                <label class="w-2/12 text-center px-0.5 py-0.5">No se encontró en su centro de prácticas</label>
                                <label class="w-4/12 text-center px-0.5 py-0.5">Sugerencias</label>
                            </div>
                        </div>
                        <div id="div_visitas_p_content_lists" class="w-12/12">

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

    ///load data visitas
    $(document).ready(function (){
        $('#form_visitassupervi_pract').submit(function (e){
            e.preventDefault();   ///no send form
        });

        $('#button_show_visitas_pract').click(function(){
            ///cargando el combobox de modulos con ayax
            $.ajax({
                type: "POST",
                url: window.location.href + "/show_visitas",
                data: $("#form_visitassupervi_pract").serialize(), //send data of form id=form_send_ppp_teacher
                success: function(response) {
                    var jsonData = JSON.parse(response);
                    // user is logged in successfully in the back-end
                    // let's redirect
                    // if (jsonData.success == "1")
                    if (jsonData.success != null) {
                        let data = jsonData.success;
                        let row = '';
                        console.log(data);
                        for (const item in data) {
                            if(!data[item]['asistencia_ent_sal'] || data[item]['asistencia_ent_sal']=='Si'){ data[item]['asistencia_ent_sal'] = "Si"; }
                                else{ data[item]['asistencia_ent_sal'] = "No";}
                            if(!data[item]['actividad_trabajo'] || data[item]['actividad_trabajo']=='Si'){ data[item]['actividad_trabajo'] = "Si"; }
                                else{data[item]['actividad_trabajo'] = "No";}
                            if(!data[item]['no_se_encontro']){ data[item]['no_se_encontro'] = "Si"; }
                                //else{data[item]['no_se_encontro'] = "";}
                            
                            row += "<div class='w-full 12/12 flex'>"+
                            "<label class='w-2/12 text-center'>"+data[item]['fecha']+"</label>"+
                            "<label class='w-2/12 text-center'>"+data[item][4]+"</label>"+
                            "<label class='w-2/12 text-center'>"+data[item][5]+"</label>"+
                            "<label class='w-2/12 text-center'>"+data[item][6]+"</label>"+
                            "<label class='w-4/12 '>"+data[item]['sugerencias']+"</label>"+
                            "</div>";
                        }
                        $('#div_visitas_p_content_lists').html(row);
                    } else if (jsonData.success == [] || jsonData.success == null) {
                        $('#div_visitas_p_content_lists').html('No hay Resultados');
                        // $('#div_results_visitas_pract').html('No hay Resultados');
                        // alert('No hay Resultados');
                    }
                }
            });
        });
    });                                                            


    ///load modules with ayax                                                            
    $(document).ready(function() {
        ///cargando el combobox de modulos con ayax
        $("#select_especialidad_visi_pract").change(function() {
            $.ajax({
                type: "POST",
                url: window.location.href + "/load_modules",
                data: $("#form_visitassupervi_pract").serialize(), //send data of form id=form_send_ppp_teacher
                success: function(response) {
                    var jsonData = JSON.parse(response);
                    // if (jsonData.success == "1")
                    if (jsonData.success != null && jsonData.success != []) {
                        // console.log(jsonData.success);
                        let data = jsonData.success;
                        let row = "<option value=''>--seleccionar--</option>";
                        for (const item in data) {
                           row = row + "<option value='"+data[item]['id_modulo']+"'>"+data[item]['nombre']+"</option>";
                        }
                        $('#select_module_visi_pract').html(row);
                    } else {
                        alert('No Hay Módulos');
                    }
                }
            });

        });
    });
</script>