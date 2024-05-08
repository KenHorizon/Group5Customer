const toggleButton0 = document.querySelector('submit')
const dropDownDetails0 = document.querySelector('.alert')

toggleButton0.onclick = function () {
    dropDownDetails0.classList.toggle('open')
    const isOpen = dropDownDetails0.classList.contains('open')
}