/**SELECT TIPO DE PRODUCTO */
const selectedOptionTipoproducto = document.querySelector('.selected-optionTipoproducto')
const selectValueTipoproducto = document.querySelector('.select-valueTipoproducto')
const optionContainerTipoproducto = document.querySelector('.optionsTipoproducto')
const optionListTipoproducto = document.querySelectorAll('.optionTipoproducto')
const iconRotateTipoproducto = document.querySelector('.icon-selectTipoproducto')

/*toggle function */
const selectTipoproducto = ()=> {
    if (optionContainerTipoproducto.dataset.tipoproducto == 'collapsedTipoproducto') {
        optionContainerTipoproducto.dataset.tipoproducto = ''
        iconRotateTipoproducto.dataset.tipoproductoicon = ''
    }
    else {
        optionContainerTipoproducto.dataset.tipoproducto = 'collapsedTipoproducto'
        iconRotateTipoproducto.dataset.tipoproductoicon = 'rotateTipoproducto'
    }
}
/**when click on selected-option */
selectedOptionTipoproducto.addEventListener('click', selectTipoproducto)

/**this funtion update select value */
const updateSelectValueTipoproducto = (optionTipoproducto) => {
    selectValueTipoproducto.innerText = optionTipoproducto.innerText;
}

optionListTipoproducto.forEach((optionTipoproducto) => {
    optionTipoproducto.addEventListener('click', (e) => {
        updateSelectValueTipoproducto(optionTipoproducto)
        selectTipoproducto()
    })
})