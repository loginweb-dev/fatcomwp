<div class="card mt-1">
                            <article class="filter-group">
                                <header class="card-header">
                                    <a href="#" data-toggle="collapse" data-target="#collapse34">
                                        <i class="icon-control fa fa-chevron-down"></i>
                                        <h6 class="title"> Opciones de Restaurant </h6>
                                    </a>
                                </header>
                                <div class="filter-content collapse show" id="collapse34">
                                    <div class="card-body">
                                    <div class="form-group">
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio"  id="rt" name="option_restaurant" value="option1">
                                        <span class="custom-control-label"> Recoger en Tienda </span>
                                    </label>
                                    <br>
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" checked type="radio" id="em"  name="option_restaurant" value="option2">
                                        <span class="custom-control-label"> En Mesa </span>
                                    </label>
                                    <br>
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" id="de" name="option_restaurant" value="option3">
                                        <span class="custom-control-label"> Delivery </span>
                                    </label>
                                </div>
                                <hr>
                                <p for="" class="text-center"><u>Extras</u></p>
                                <?php 
                                    $results = $wpdb->get_row('SELECT meta_value FROM wp_postmeta WHERE post_id = 401 AND  meta_key = "_product_addons"');
                                    $results = unserialize($results->meta_value);
                                    $k=0;
                                    foreach ( $results  as $j => $fieldoption ) {
                                        if($fieldoption['type'] == "checkbox"){
                                            foreach ( $fieldoption['options'] as $i => $option ) {
                                                $title = $option['label'];
                                                $price = $option['price'];

                                                ?>
                                                    <div class="form-check" id="miextra" disabled>
                                                        <input id='<?php echo $i+1; ?>' onclick="extras('<?php echo $k+1; ?>', '<?php echo $title; ?>', <?php echo $price; ?>)" class="form-check-input" type="checkbox">
                                                        <label for="my-input" class="form-check-label"> <?php echo $title; echo ' - '; echo $price; ?> Bs.</label>
                                                    </div>
                                                <?php
                                            }
                                        }else if($fieldoption['type'] == "input_multiplier"){
                                            ?>
                                                <div class="input-group">
                                                    <label for=""><?php echo $fieldoption['name'].' Bs.'.$fieldoption['price']; ?></small>
                                                    <button class="btn btn-light text-primary btn-sm" type="button" onclick="extras('<?php echo $k+1; ?>', '<?php echo $fieldoption['name']; ?>', <?php echo $fieldoption['price']; ?>)">Agregar</button>
                                                </div>
                                            <?php
                                        }
                                        $k++;
                                    }
                                    
                                ?> 
                                <hr>
                                <p for="" class="text-center">
                                    <u>Linea</u>
                                    <br />
                                    <button class="btn btn-light text-primary btn-sm" type="button" onclick="linea()">Agregar</button>								
                                </p>
                                
                            </article>
                        </div>