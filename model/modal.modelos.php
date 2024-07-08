<?php
class Modal_Model{
    public static function mdl_detalle($data){
        $respuesta = '<!-- Modal Header -->
        <div class="modal-header border-3 border-img-b d-flex justify-content-center align-items-center">
            <h4 class="modal-title text-center"><span class="FontPrimary">'.$data['name'].'</span></h4>
        </div>

        <!-- Modal body -->
        <div class="modal-body d-flex flex-column flex-wrap w-100">
            <div class="d-flex justify-content-center align-items-center w-100">
                <img src="./images/products/'.strtolower($data['image']).'" class="border border-3 border-warning rounded-3" alt="" class="">
            </div>
            <div class="FontParrafo w-100 fs-5 text-center my-2">
            '.$data['description'].'
            </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer border-3 border-img-t">
            <button type="button" class="btn btn-danger FontParrafo text-light" data-bs-dismiss="modal">Cerrar</button>
        </div>';
        return $respuesta;
    }
}