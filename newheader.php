<!-- Wappler include head-page="products.php" appConnect="local" is="dmx-app" bootstrap5="local" bootstrap_icons="cdn" fontawesome_4="local" jquery_slim_33="cdn" -->
<div class="container header">
        <div class="row row-cols-6 mt-2 justify-content-xl-between justify-content-between">
            <div class="d-flex col justify-content-between">
    
                <h3 class="text-warning">SERVO</h3><button id="btn1" class="btn" data-bs-toggle="modal" data-bs-target="#menumodal">
<i class="fa fa-flag"></i>
</button>
            </div>
            <div class="top-badge d-flex justify-content-xl-between col justify-content-end">
                <h4 class="fw-lighter badge badge-pill badge-secondary mr-sm-1 pt-sm-2 ml-xl-0 mr-xl-1 pl-xl-3 pr-xl-3 bg-warning"><i class="far fa-user fa-xs"></i>&nbsp;{{session_variables.data.current_user}}</h4>
                <h4 class="fw-lighter badge badge-pill badge-secondary ml-xl-1 mr-xl-1 pl-xl-3 pr-xl-3 mr-sm-1 pt-sm-2 bg-secondary"><i class="fas fa-hourglass-half fa-xs"></i>&nbsp;{{session_variables.data.current_shift}}<i class="fa fa-search-plus"></i>
</h4>
    
            </div>
    
        </div>
    
    </div>