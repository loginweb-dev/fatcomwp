<?php 
    require_once('../../../../wp-load.php');
    require_once '../library/class.Cart.php';
    $cart = new Cart([
        'cartMaxItem'      => 0,
        'itemMaxQuantity'  => 99,
        'useCookie'        => false,
    ]);
    $allItems = $cart->getItems();
    ?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group text-center">
                    <h5 >DETELLA DE CARRITO</h5>  
                </div>
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr class="small text-uppercase">
                        <th scope="col" width="350">Producto</th>
                        <th scope="col" width="120">Cant</th>
                        <th scope="col" width="120">Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  foreach ($allItems as $items) { foreach ($items as $item) { ?>
                            <?php if($item['attributes']['sku'] == 'linea'){ ?>
                                <tr>
                                    <td >
                                        <?php echo $item['attributes']['name'] ?>
                                        <small># <?php echo $item['attributes']['order'] ?> </small>
                                        <br>
                                        <a href="#" onclick="remove('<?php echo $item['id'];  ?>')" class="btn btn-dark btn-sm"> Quitar</a>
                                    </td>
                                    <td> 
                                        ------------
                                    </td>
                                    <td> 
                                        ------------
                                    </td>
                                </tr>
                            <?php } else {?>
                                <tr>
                                    <td>
                                        <figure class="itemside">
                                            <div class="aside"><img src="<?php echo $item['attributes']['image'] ? $item['attributes']['image'] : WP_PLUGIN_URL.'/fatcomwp/resources/default_product.png';?>" class="img-sm"></div>
                                            <figcaption class="info">
                                                <a href="#" class="title text-dark"><?php echo $item['attributes']['name'] ?></a>
                                                <p class="text-muted small">ID: <?php echo $item['attributes']['product_id'] ?> <br> SKU: <?php echo $item['attributes']['sku'] ?></p>
                                                <!-- <p class="text-muted small">Info: <?php echo $item['attributes']['description'] ?></p> -->

                                            </figcaption>
                                        </figure>
                                    </td>
                                    <td> 
                                        <div class="input-group text-center">
                                                <a href="#" onclick="update_rest('<?php echo $item['id'];  ?>')" class="btn btn-light btn-sm"> - </a>
                                                <h4 class="m-1"> <?php echo $item['quantity'];  ?></h4>
                                                <a href="#" onclick="update_sum('<?php echo $item['id'];  ?>')" class="btn btn-light btn-sm"> + </a>
                                        <div>
                                    </td>
                                    <td> 
                                        <div class="price-wrap"> 
                                            <var class="price"><?php echo $item['attributes']['price'] ?> Bs</var> 
                                            <br>
                                            <a href="#" onclick="remove('<?php echo $item['id'];  ?>')" class="btn btn-dark btn-sm"> Quitar</a>
                                        </div>
                                    </td>
                                </tr>
                        <?php } } } ?>
                    </tbody>
                </table>
                <div class="border-top form-group text-center">
                    <a href="#" class="btn btn-dark btn-sm" onclick='cart_clear()'>  Limpiar </a>   
                    <a href="#" class="btn btn-dark btn-sm" onclick='clear_search_products()'>  Cerrar </a>   
                </div>	
            </div> 
        </div>
    </div>