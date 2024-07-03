<div class="d-flex justify-content-end fixed-bottom" id="CarritoCompras">
    <button class="border-0 me-sm-4 mb-sm-4" style="background: transparent;" onclick="validate()">
        <div class="d-flex justify-content-center">
            <div class="bg-black rounded-circle border border-3 border-warning position-absolute ms-5" style="width: 35px;height:35px" >
                <span class="FontParrafo fs-5">0</span>
            </div>
            <div class="position-absolute mt-5 pt-4 me-2">
                <span class="FontParrafo fs-5">$ 0</span>
            </div>
            <img src="./images/icons/carrito.avif" alt="" style="width: 120px;">
        </div>
    </button>
</div>
<script>
    function validate(){
        var session;
        <?php 
        if(isset($currentUser)){
            ?> 
                alert('con sesión');
            <?php
        } else {
            ?> 
                
                alert('Para continuar debes iniciar sesión');
                return;
            <?php
        }?>
    }
</script>