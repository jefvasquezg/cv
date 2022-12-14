<?php


  include '../clientes/conexion/conn.php';
    $conf = new Configuracion();
    $conf->conectar();
  $query1=mysqli_query($conf->conectar(),"SELECT primer_nombre From contacto_cliente")
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Application</title>
	<link rel="stylesheet" type="text/css" href="../clientes/themes/black/easyui.css">
	<link rel="stylesheet" type="text/css" href="../clientes/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="../clientes/themes/color.css">
    <script type="text/javascript" src="../clientes/js/jquery.min.js"></script>
    <script type="text/javascript" src="../clientes/js/jquery.easyui.min.js"></script>
    
</head>
<body>
    <table id="dg" title="Clientes" class="easyui-datagrid" style="width:1150px;height:500px"
            url="get_cliente.php" 
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true" data-options="remoteSort:false,multiSort:true,singleSelect:true">
        <thead>
            <tr onclick="alert('Hola Mindo')">
		        <th onclick="alert('Hola Mindo')" field="index_id" width="50" data-options="sortable:true">Id</th>
                <th field="nombre_cliente" width="50" data-options="sortable:true">Nombre Cliente</th>
                <th field="identificacion" width="50" data-options="sortable:true">Identificacion</th>
                <th field="tipo_identificacion" width="50" data-options="sortable:true">Tip Id</th>
                <th field="email" width="50" data-options="sortable:true">Email</th>
                <th field="telefono" width="50" data-options="sortable:true">Telefono</th>
                <th field="direccion" width="50" data-options="sortable:true">Direccion</th>
                <th field="contacto_cliente" width="50" data-options="sortable:true">Contacto_cliente</th>
                <th field="close" width="50" data-options="sortable:true">disable</th>
            </tr>
        </thead>
    </table>
    
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Nuevo</a>
        <a href="javascript:void(0)" id="editar" name="editar" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Editar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Remover</a>
        <div id="tb" style="padding:3px">

		
        <select id="op_busqueda" class="easyui-combobox" panelHeight="auto" style="width:150px">
            <option value="">Buscar todo</option>
            <option value="nombre_cliente">Nombre Cliente</option>
            <option value="identificacion">Identificacion</option>
            <option value="tipo_identificacion">Tipo Identificacion</option>
            <option value="email">Email</option>
            <option value="telefono">Telefono</option>
            <option value="direccion">Direccion</option>
        </select>
		    <input id="itemid" style="line-height:26px;border:1px solid #ccc">
		<a href="#" class="easyui-linkbutton" plain="true" onclick="doSearch()">Buscar</a>
	</div>
    </div>
    
    <div id="dlg" class="easyui-dialog" style="width:500px; height:500px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
        <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
        <h3>Informacion Registro Clientes</h3><br>
            <br>
            
            <div style="margin-bottom:10px">
                <input name="nombre_cliente" class="easyui-textbox" required="true" label="Nombre Cliente:" labelPosition="top" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="identificacion" class="easyui-textbox" required="true" label="Identificacion:" labelPosition="top" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="tipo_identificacion" class="easyui-textbox" required="true" label="Tipo Identificacion:" labelPosition="top" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input type="email" name="email" class="easyui-textbox" validType="email" required="true" label="Email:" labelPosition="top" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="telefono" class="easyui-maskedbox" mask="(999) 999-9999" required="true" label="Telefono:" labelPosition="top" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="direccion" class="easyui-textbox" required="true" label="Direccion:" labelPosition="top" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
            <select class="easyui-combobox" name="contacto_cliente" label="Contacto Cliente:" labelPosition="top" style="width:100%" require="true">
                 <option value="Seleccione...">Seleccione...</option>
                 <?php
                     while($datos = mysqli_fetch_array($query1))
                     {
                 ?>
                        <option value="<?php echo $datos['primer_nombre']?>"> <?php echo $datos['primer_nombre']?> </option>
                 <?php
                     }
                 ?>
            </select>
            </div>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
    </div>  
    <script type="text/javascript">
        var url;
        function newUser(){
            $('#dlg').dialog('open').dialog('center').dialog('setTitle','New User');
            $('#fm').form('clear');
            url = 'save_cliente.php';
        }
        function editUser(){
            var row = $('#dg').datagrid('getSelected');
            
            if (row.close == 0){
                let boton = document.getElementById("editar").setAttribute("style","display:none");
                console.log(document.getElementById("editar"));
                //let boton2= document.getElementById("editar").setAttribute("disabled","true");
                //console.log(boton2);
            }
            if (row.close != 0){
                let boton = document.getElementById("editar").setAttribute("style","display:unset");
                console.log(document.getElementById("editar"));
                 $('#dlg').dialog('open').dialog('center').dialog('setTitle','Edit User');
                 $('#fm').form('load',row);
                 url = 'update_cliente.php?index_id='+row.index_id;
            }
            console.log(row.close);
            
        }

        function removerBoton(x){
            //var row = $('#dg').datagrid('getSelected');
            console.log(x);
            if (row.close == 0){
                let boton = document.getElementById("editar").setAttribute("style","display:none");
                console.log(document.getElementById("editar"));
            }
            else{
                let boton = document.getElementById("editar").setAttribute("style","display:unset");
                console.log(document.getElementById("editar"));
            }
        }



        function saveUser(){
            $('#fm').form('submit',{
                url: url,
                iframe: false,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    var result = eval('('+result+')');
                    if (result.errorMsg){
                        $.messager.show({
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    } else {
                        $('#dlg').dialog('close');        // close the dialog
                        $('#dg').datagrid('reload');    // reload the user data
                    }
                }
            });
        }
        function destroyUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirm','Are you sure you want to destroy this user?',function(r){
                    if (r){
                        $.post('destroy_cliente.php',{index_id:row.index_id},function(result){
                            if (result.success){
                                $('#dg').datagrid('reload');    // reload the user data
                            } else {
                                $.messager.show({    // show error message
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            }
                        },'json');
                    }
                });
            }
        }
        
        function doSearch(value,name){
            
            let item=$('#op_busqueda').val();
            let valor=$('#itemid').val();
            //console.log(item+valor);
            $('#dg').datagrid('load',{
                itemid: item,
                productid: valor
            });
        }        
    </script>
</body>
</html>