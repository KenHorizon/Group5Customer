const toggleButton0 = document.querySelector('.about-developer-button-toggle0')
const toggleButton1 = document.querySelector('.about-developer-button-toggle1')
const toggleButton2 = document.querySelector('.about-developer-button-toggle2')
const toggleButton3 = document.querySelector('.about-developer-button-toggle3')
const dropDownDetails0 = document.querySelector('.dropDownDetails0')
const dropDownDetails1 = document.querySelector('.dropDownDetails1')
const dropDownDetails2 = document.querySelector('.dropDownDetails2')
const dropDownDetails3 = document.querySelector('.dropDownDetail

toggleButton0.onclick = function () {
    dropDownDetails0.classList.toggle('open')
    const isOpen = dropDownDetails0.classList.contains('open')
    dropDownDetails1.classList.remove('open')
    dropDownDetails2.classList.remove('open')
    dropDownDetails3.classList.remove('open')
}
toggleButton1.onclick = function () {
    dropDownDetails1.classList.toggle('open')
    const isOpen = dropDownDetails1.classList.contains('open')
    dropDownDetails0.classList.remove('open')
    dropDownDetails2.classList.remove('open')
    dropDownDetails3.classList.remove('open')
}
toggleButton2.onclick = function () {
    dropDownDetails2.classList.toggle('open')
    const isOpen = dropDownDetails2.classList.contains('open')
    dropDownDetails0.classList.remove('open')
    dropDownDetails1.classList.remove('open')
    dropDownDetails3.classList.remove('open')
}
toggleButton3.onclick = function () {
    dropDownDetails3.classList.toggle('open')
    const isOpen = dropDownDetails3.classList.contains('open')
    dropDownDetails0.classList.remove('open')
    dropDownDetails1.classList.remove('open')
    dropDownDetails2.classList.remove('open')
}