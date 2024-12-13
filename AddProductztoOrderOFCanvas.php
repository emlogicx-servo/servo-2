<!-- Wappler include head-page="../SERVO/customers_copy.php" appConnect="local" is="dmx-app" bootstrap5="local" bootstrap_icons="local" fontawesome_5="local" jquery_slim_35="local" moment_2="cdn" components="{dmxBootstrap5Navigation:{},dmxBootstrap5Offcanvas:{}}" -->
<div class="offcanvas offcanvas-start" id="AddProductsToOrderOffCanvas" is="dmx-bs5-offcanvas" tabindex="-1" style="width: 99%;">
    <div class="offcanvas-header mb-0 pb-0">
        <h4 class="offcanvas-title">{{trans.data.addProducts[lang.value]}}</h4>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row scrollable row-cols-xxl-12 mt-0" id="productDisplay">
            <div class="col">
                <ul class="nav nav-tabs" id="navTabs1_tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="navTabs1_1_1tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1_1" role="tab" aria-controls="navTabs1_1" aria-selected="true">{{trans.data.products[lang.value]}}</a>
                    </li>
                    <li class="nav-item visually-hidden">
                        <a class="nav-link" id="navTabs1_3_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1_3" role="tab" aria-controls="navTabs1_3" aria-selected="false">{{trans.data.services[lang.value]}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="navTabs1_2_2tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2_2" role="tab" aria-controls="navTabs1_2" aria-selected="false">{{trans.data.grouped[lang.value]}}</a>
                    </li>

                </ul>
                <div class="tab-content" id="navTabs1_1content">
                    <div class="tab-pane fade show active" id="navTabs1_1_1" role="tabpanel">
                        <div class="row mt-1">
                            <div class="d-flex col-auto flex-wrap"><input id="searchProducts1" name="text1" type="text" class="form-control mb-1" dmx-bind:value="searchProducts1.value" dmx-on:changed="load_products.load({service_id: list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id, search: searchProducts1.value})" dmx-bind:placeholder="trans.data.search[lang.value]"><button id="btn17" class="btn btn-info text-white ms-2 me-2" dmx-on:click="searchProducts1.setValue(null);load_products.load({service_id: list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id})">
                                    <i class="fas fa-backspace"></i>
                                </button>
                                <button id="btn181" class="btn btn-info text-white me-2" dmx-on:click="AddProductsToOrderOffCanvas.btn181.toggleCategorySelect2.toggle()"> Cat
                                    <dmx-toggle id="toggleCategorySelect2"></dmx-toggle><i class="fas fa-chevron-down"></i>
                                </button>
                                <button id="toggleProductPic" class="btn btn-info text-white me-2" dmx-on:click="AddProductsToOrderOffCanvas.toggleProductPic.toggleProductPictures.toggle()">
                                    <dmx-toggle id="toggleProductPictures" checked="true"></dmx-toggle><i class="far fa-images"></i>
                                </button>

                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col" is="dmx-if" id="conditional33" dmx-bind:condition="btn181.toggleCategorySelect2.checked">
                                <div id="repeatProductCategories" is="dmx-repeat" dmx-bind:repeat="load_product_categories.data.query"><button id="btn11" class="btn mb-1 me-1 text-white bg-info" dmx-text="product_category_name" dmx-on:click="searchProductCategories.setValue(product_categories_id);load_products.load({product_category: product_categories_id})"></button></div>

                            </div>
                        </div>
                        <div class="row mt-md-1 ms-md-1 me-md-1 mt-sm-1 ms-sm-1 me-sm-1 mt-xxl-1 ms-xxl-1 me-xxl-1 mt-lg-1 ms-lg-1 me-lg-1 row-cols-12 row-cols-md-12 row-cols-lg-12 row-cols-xl-12 row-cols-xxl-12 mt-xl-1 mt-0" style="margin: 2px !important;">
                            <div class="flex-md-wrap flex-md-row border-dark bg-secondary d-flex rounded-bottom flex-xl-wrap mb-2 me-2 justify-content-sm-start justify-content-md-start justify-content-lg-start justify-content-xxl-start justify-content-start mb-md-2 me-md-2 offset-md-0 col-xxl-2 col-12 col-sm-4 mb-lg-2 me-lg-1 mb-sm-2 me-sm-1 mb-xl-2 me-xl-1 mb-xxl-2 me-xxl-1 col-lg-2 col-xl-2 col-md-3" dmx-repeat:repeatproducts="load_products.data.repeat" style="padding-top: 0px !important; margin-top: .5rem !; " id="productRepeats">
                                <form id="form3" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/create_order_item.php" dmx-on:success="form3.reset();list_order_items.load({order_id: session_variables.data.current_order});notifies1.success('Success:'+product_name+' Added to Order');list_customer_transactions_order_totals.load({order_id: session_variables.data.current_order});list_customer_orders_totals.load({customer_id: session_variables.data.current_customer})" dmx-on:error="notifies1.danger('Error!')">
                                    <div class="row mt-xxl-2 product-pic ps-1 pe-1" id="productPic" dmx-hide="toggleProductPic.toggleProductPictures.checked">
                                        <div class="col text-center" style="padding: 0px !important; height: 200px;" dmx-hide="product_picture==null">
                                            <img dmx-bind:src="'/servo/uploads/product_pictures/'+product_picture" width="100%" height="95%" loading="lazy" style="object-fit: cover;" class="mt-lg-1">
                                        </div>
                                        <div class="col text-center" style="padding: 0px !important; height: 200px;" dmx-hide="product_picture!==null">
                                            <img width="100%" height="95%" loading="lazy" style="object-fit: cover;" src="uploads/servo_no_image2.jpg" class="mt-lg-1">
                                        </div>
                                    </div>
                                    <div class="row row-cols-12 mt-2">
                                        <div class="col d-flex justify-content-center align-items-baseline">
                                            <h6 class="text-center fw-bold text-body">{{product_name}}</h6>
                                        </div>
                                    </div>
                                    <div class="row row-cols-12 mt-0">
                                        <div class="col d-flex justify-content-center">
                                            <h6 class="text-center text-body">{{product_price.formatNumber('4','.',',')}}</h6>
                                        </div>
                                    </div>


                                    <div class="row justify-content-between text-center mb-2 ms-1 me-1">
                                        <div class="col-4">
                                            <button id="btn5" class="btn btn-lg shadow-none text-muted" dmx-on:click="form3.inp_order_item_quantity.setValue((inp_order_item_quantity.value.toNumber()-1) )"><i class="fas fa-minus"></i>
                                            </button>
                                        </div>

                                        <div class="col-4 text-center" style="padding: 0px !important;"><input id="inp_order_item_quantity" name="order_item_quantity" type="number" class="form-control mb-sm-1 mb-2 form-control-lg" placeholder="1" min="0.001" data-rule-min="0.001" data-msg-min="Min. 0.001" style="width: 100% !important; border: 1px solid #696969 !important; border: none; background-color: transparent !important; color: #a1a1a1 !important;" dmx-bind:value="1"></div>
                                        <div class="col-4">
                                            <button id="btn16" class="btn btn-lg text-muted shadow-none" dmx-on:click="form3.inp_order_item_quantity.setValue((inp_order_item_quantity.value.toNumber()+1) )"><i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div><input id="inp_order_time_ordered" name="order_time_ordered" class="form-control mb-sm-1 mb-2 visually-hidden" type="datetime-local" dmx-bind:value="dateTime.datetime"><input id="inp_order_item_status" name="order_item_status" class="form-control mb-sm-1 mb-2 visually-hidden" value="Pending"><input id="inp_order_id" name="servo_orders_order_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="session_variables.data.current_order"><input id="inp_order_product_id" name="servo_products_product_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_id"><input id="inp_order_item_price" name="order_item_price" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_price">
                                    <input id="inp_order_item_type" name="order_item_type" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="'Simple'">
                                    <input id="inp_order_item_user_ordered2" name="servo_users_user_ordered" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="session_variables.data.user_id" type="number">

                                    <input id="orderitemDepartment" name="servo_departments_department_id" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="sdc_department_id" type="number">
                                    <textarea id="inp_order_notes" class="form-control" name="order_item_notes"></textarea>
                                    <div class="row row-cols-xxl-7 mt-2 mt-sm-2 mt-md-2 mt-lg-2 mt-xl-2 mt-xxl-2" id="optionsrow">
                                        <div class="w-25 flex-xxl-wrap justify-content-xxl-start d-flex col text-center ps-1 pe-1">
                                            <div id="repeatOptions" is="dmx-repeat" dmx-bind:repeat="query_list_options">
                                                <button class="btn mb-xxl-2 me-xxl-2 button-repeat text-body bg-opacity-10 bg-primary btn-sm lh-sm fw-bold" dmx-text="category_option_option" dmx-bind:value="category_option_option" dmx-on:click="form3.inp_order_notes.setValue(form3.inp_order_notes.value+' '+optionsButton.value+' ')" id="optionsButton">Button</button>
                                            </div>



                                        </div>



                                    </div>
                                    <div class="row row-cols-xxl-7 mt-2 mb-2 row-cols-12 justify-content-between" id="buttons">
                                        <div class="col"><button id="btn8" class="add-item-button btn align-self-end btn-lg lh-1 text-muted" dmx-on:click="form3.inp_order_notes.setValue(null)">
                                                <i class="fas fa-undo fa-lg"></i>
                                            </button></div>

                                        <div class="col w-25 flex-xxl-wrap justify-content-xxl-start">
                                            <div id="repeatStock" is="dmx-repeat" dmx-bind:repeat="query_list_product_stock">
                                                <button id="btn33" class="btn fw-bold btn-secondary btn-sm" dmx-text="trans.data.inStock[lang.value]+': '+TotalStock" dmx-class:redlight.redlight="TotalStock<=product_min_stock">
                                                </button>

                                            </div>



                                        </div>
                                        <div class="col w-25 flex-xxl-wrap justify-content-xxl-start">



                                            <button id="btn12" class="add-item-button btn align-self-end btn-lg text-success" type="submit">
                                                <i class="fas fa-cart-plus fa-lg"></i>
                                            </button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="navTabs1_2_2" role="tabpanel">
                        <div class="row mt-md-1 mt-2">
                            <div class="flex-xxl-wrap border border-secondary col-md-4 mb-sm-2 me-sm-2 col-lg-3 col-xl-3 col-xxl-3 mt-xxl-0 mb-xxl-3 me-xxl-3 pt-xxl-3 pb-xxl-1 ps-xxl-1 pe-xxl-1 mb-1 me-1" dmx-repeat:repeatproductgroups="load_product_groups.data.repeat_list_product_groups">
                                <form id="form4"></form>
                                <div class="row mt-2">
                                    <div class="col">
                                        <h3 class="text-center text-warning" dmx-text="product_group_name"></h3>
                                    </div>
                                </div>
                                <form id="addGroupedItemsToOrder" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_product_groups/add_grouped_products_to_order.php" dmx-on:success="form3.reset();list_order_items.load({order_id: session_variables.data.current_order});notifies1.success('Success:'+product_name+' Added to Order')">
                                    <input id="text6" name="servo_orders_order_id" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
                                    <input id="text7" name="servo_users_user_ordered" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
                                    <input id="text8" name="product_group_id" type="text" class="form-control visually-hidden" dmx-bind:value="product_group_id">
                                    <input id="text9" name="order_time_ordered" type="text" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">


                                    <div class="row row-cols-xxl-7 justify-content-between mt-2 mb-2" id="buttons1">
                                        <div class="col w-25 flex-xxl-wrap justify-content-xxl-start d-flex justify-content-end">



                                            <button id="btn14" class="add-item-button btn btn-warning align-self-end btn-lg" type="submit">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>