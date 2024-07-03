/**SELECT TAMAÑO */
const selectedOptionTamaño = document.querySelector('.selected-optionTamaño')
const selectValueTamaño = document.querySelector('.select-valueTamaño')
const optionContainerTamaño = document.querySelector('.optionsTamaño')
const optionListTamaño = document.querySelectorAll('.optionTamaño')
const iconRotateTamaño = document.querySelector('.icon-selectTamaño')

/*toggle function */
const selectTamaño = ()=> {
    if (optionContainerTamaño.dataset.tamaño == 'collapsedTamaño') {
        optionContainerTamaño.dataset.tamaño = ''
        iconRotateTamaño.dataset.tamañoicon = ''
    }
    else {
        optionContainerTamaño.dataset.tamaño = 'collapsedTamaño'
        iconRotateTamaño.dataset.tamañoicon = 'rotateTamaño'
    }
}
/**when click on selected-option */
selectedOptionTamaño.addEventListener('click', selectTamaño)

/**this funtion update select value */
const updateSelectValueTamaño = (optionTamaño) => {
    selectValueTamaño.innerText = optionTamaño.innerText;
}

optionListTamaño.forEach((optionTamaño) => {
    optionTamaño.addEventListener('click', (e) => {
        updateSelectValueTamaño(optionTamaño)
        selectTamaño()
    })
})