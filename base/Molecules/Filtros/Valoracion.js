/**SELECT VALORACION */
const selectedOptionValoracion = document.querySelector('.selected-optionValoracion')
const selectValueValoracion = document.querySelector('.select-valueValoracion')
const optionContainerValoracion = document.querySelector('.optionsValoracion')
const optionListValoracion = document.querySelectorAll('.optionValoracion')
const iconRotateValoracion = document.querySelector('.icon-selectValoracion')

/*toggle function */
const selectValoracion = ()=> {
    if (optionContainerValoracion.dataset.valoracion == 'collapsedValoracion') {
        optionContainerValoracion.dataset.valoracion = ''
        iconRotateValoracion.dataset.valoracionicon = ''
    }
    else {
        optionContainerValoracion.dataset.valoracion = 'collapsedValoracion'
        iconRotateValoracion.dataset.valoracionicon = 'rotateValoracion'
    }
}
/**when click on selected-option */
selectedOptionValoracion.addEventListener('click', selectValoracion)

/**this funtion update select value */
const updateSelectValueValoracion = (optionValoracion) => {
    selectValueValoracion.innerText = optionValoracion.innerText;
}

optionListValoracion.forEach((optionValoracion) => {
    optionValoracion.addEventListener('click', (e) => {
        updateSelectValueValoracion(optionValoracion)
        selectValoracion()
    })
})