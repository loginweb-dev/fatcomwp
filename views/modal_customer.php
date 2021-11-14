<?php 
    ?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-4 col-lg-4 col-sm-12">
                <div class="form-group text-center">
                    <h5 class="">Nuevo Cliente</h5>
                </div>
              
                <div class="form-group">
                    <label><u>Primer Nombre</u></label>
                    <input id="first_name" type="text" class="form-control" placeholder="first_name">
                </div>
                <div class="form-group">
                    <label><u>Segundo Nombre</u></label>
                    <input id="last_name" type="text" class="form-control" placeholder="last_name">
                </div>
                <div class="form-group">
                    <label><u>Telefono</u></label>
                    <input id="billing_phone" type="text" class="form-control" placeholder="billing_phone">
                </div>
                <div class="form-group">
                    <label><u>Nit o Carnet</u></label>
                    <input id="billing_postcode" type="text" class="form-control" placeholder="billing_postcode">
                </div>
                <!-- <div class="form-group">
                    <label><u>Correo</u></label>
                    <input id="user_email" type="text" class="form-control" placeholder="user_email">
                </div> -->
                <div class="form-group text-center">
                    <button href="#" id="" onclick="customer_store()" type="button" class="btn btn-dark btn-sm"><i class="fa fa-save"> </i> Guardar </button>
                    <a href="#" class="btn btn-dark btn-sm" onclick='clear_search_products()'>  Cancelar </a>   

                </div>
            </div>
        </div>
    </div>